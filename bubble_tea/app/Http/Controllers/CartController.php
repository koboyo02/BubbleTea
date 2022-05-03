<?php

namespace App\Http\Controllers;

use App\Entities\Order\Order;
use App\Entities\Order\OrderItem;
use App\Entities\Product\Product;
use App\Entities\User;
use App\Repositories\Order\DiscountCodeRepository;
use App\Repositories\Order\OrderItemRepository;
use App\Repositories\User\UserShippingAddressRepository;
use App\Services\Shop\Order\OrderService;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

final class CartController extends Controller
{
    public function __construct(
        private EntityManagerInterface $em,
        private OrderService $orderService
    ) {
    }

    public function index(Request $request, UserShippingAddressRepository $shippingAddressRepository)
    {
        dump(Session::all());
        dump($this->orderService->getCurrentOrder());
        $user = Auth::user();
        $shippingAddress = [];
        if ($user instanceof User) {
            $shippingAddress = $shippingAddressRepository->findBy(['parent' => $user->getId()]);
        }

        return view('cart.index', [
            'products' => $this->em->getRepository(Product::class)->findAll(),
            'order' => $this->orderService->getCurrentOrder(),
            'userShippingAddresses' => $shippingAddress,
        ]);
    }

    public function addItem(Request $request, int $productId)
    {
        if (null === $product = $this->em->getRepository(Product::class)->find($productId)) {
            abort(404);
        }

        $this->validateForm($request, [
            'quantity' => 'required|int|min:1|max:10',
        ], 'cart.add_item');

        $this->orderService->addItem(
            (new OrderItem())
                ->setProduct($product)
                ->setQuantity($request->quantity)
        );

        return redirect()->route('cart.index');
    }

    public function setItemQuantity(
        Request $request,
        OrderItemRepository $repository,
        int $orderItemId
    ) {
        if (null === $orderItem = $repository->find($orderItemId)) {
            return redirect()->route('cart.index');
        }

        $this->validateForm($request, [
            'quantity' => 'required|int|min:1|max:10',
        ], 'cart.set_item_quantity');

        $this->orderService->setItemQuantity($orderItem, $request->quantity);

        return redirect()->route('cart.index');
    }

    public function removeItem(OrderItemRepository $repository, int $orderItemId)
    {
        if (null !== $orderItem = $repository->find($orderItemId)) {
            $this->orderService->removeItem($orderItem);
        }

        return redirect()->route('cart.index');
    }

    public function checkout(
        Request $request,
        UserShippingAddressRepository $shippingAddressRepository,
        DiscountCodeRepository $discountCodeRepository
    ) {
        // if post request then validate the form
        if ($request->isMethod('POST')) {
            [$isValid, $response] = $this->validateForm($request, [
                'shipping_address' => 'required|int',
                'discount_code' => 'nullable|string|max:10',
            ], 'cart.checkout');

            if (!$isValid) {
                return $response;
            }

            $order = $this->orderService->getCurrentOrder();
            if ('-1' === $request->shipping_address) {
                $order->setShippingAddress(null);
            } else {
                if (null === $shippingAddress = $shippingAddressRepository->findWhere([
                    'parent' => Auth::user()?->getId() ?? 0,
                    'id' => $request->shipping_address,
                ])) {
                    Session::flash('error', 'Adresse de livraison invalide');

                    return redirect()->route('cart.index');
                }

                $order->setShippingAddress($shippingAddress);
            }

            if (null !== $code = $request->discount_code) {
                if (null === $discountCode = $discountCodeRepository->find($code)) {
                    Session::flash('error', 'Code promo invalide');

                    return redirect()->route('cart.index');
                }

                try {
                    $this->orderService->applyCoupon($discountCode);
                } catch (\Exception $e) {
                    Session::flash('error', $e->getMessage());

                    return redirect()->route('cart.index');
                }
            }

            if ($order->getItems()->isEmpty()) {
                Session::flash('error', 'Votre panier est vide');

                return redirect()->route('cart.index');
            }

            $this->order->setStatus(order::STATUS_CHECKOUT);

            $this->em->persist($order);
            $this->em->flush();

            // TODO: redirect to payment page
            return redirect()->route('cart.payment');
        }

        return view('cart._checkout', [
            'shippingAddresses' => $shippingAddressRepository->findAll(),
            'order' => $this->orderService->getCurrentOrder(),
        ]);
    }

    public function payment(Request $request)
    {
        $order = $this->orderService->getCurrentOrder();
        // if order's status is not 'created' then redirect to cart page
        if (Order::STATUS_CHECKOUT !== $order->getStatus()) {
            return redirect()->route('cart.index');
        }

        if ($request->isMethod('POST')) {
            [$isValid, $response] = $this->validateForm($request, [
                'card_owner_full_name' => 'required|string|max:2',
                'card_number' => 'required|regex:/^[0-9]{16}$/',
                'card_expiration_date' => ['required', 'regex:/^\d{4}-(0[1-9]|1[0-2])$/'],
                'card_cvv' => 'required|regex:/^\d{3}$/',
            ], 'cart.payment');

            if (!$isValid) {
                return $response;
            }

            $order->setStatus(Order::STATUS_COMPLETED);

            $this->em->persist($order);
            $this->em->flush();

            return redirect()->route('cart.confirmation');
        }

        return view('cart.payment');
    }

    private function validateForm(Request $request, array $rules, string $route)
    {
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response = redirect()->route($route)
                ->withErrors($validator)
                ->withInput()
            ;

            return [false, $response];
        }

        return [true, null];
    }
}
