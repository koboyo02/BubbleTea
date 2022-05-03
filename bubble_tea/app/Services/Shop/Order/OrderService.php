<?php

namespace App\Services\Shop\Order;

use App\Entities\Order\DiscountCode;
use App\Entities\Order\Order;
use App\Entities\Order\OrderItem;
use App\Repositories\Order\DiscountCodeRepository;
use App\Services\Shop\Order\Storage\OrderStorageInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
final class OrderService
{
    private ?Order $order = null;

    public function __construct(
        private EntityManagerInterface $em,
        private OrderStorageInterface $storage
    ) {
    }

    public function getCurrentOrder(): Order
    {
        if (null === $this->order) {
            $order = $this->storage->getOrder();
            if ($order instanceof Order) {
                return $this->order = $order;
            }

            $order = new Order();
            $this->em->persist($order);
            $this->em->flush();

            $this->storage->setOrderId($order->getId());

            return $order;
        }

        return $this->order;
    }

    public function containsItem(OrderItem $orderItem): array
    {
        $items = $this->getCurrentOrder()->getItems();
        foreach ($items as $item) {
            if ($item instanceof OrderItem) {
                // check if the item is the same
                if ($orderItem->getProduct()->getId() !== $item->getProduct()->getId()) {
                    return [false, null];
                }

                // check the order's supplements
                foreach ($orderItem->getSupplements() as $supplement) {
                    if (!$item->getSupplements()->contains($supplement)) {
                        return [false, null];
                    }
                }

                if ($orderItem->getProduct()->getId() === $item->getProduct()->getId()) {
                    return [true, $item];
                }
            }
        }

        return [false, null];
    }

    public function addItem(OrderItem $item): void
    {
        [$contains, $targetItem] = $this->containsItem($item);
        $itemPrice = $item->getProduct()->getPrice();
        if ($contains) {
            // update the targetItem
            $targetItem->setQuantity($targetItem->getQuantity() + $item->getQuantity());
            $targetItem->setTotalPrice($targetItem->getTotalPrice() + $itemPrice * $item->getQuantity());
            $this->em->persist($targetItem);
        } else {
            // add the item
            $order = $this->getCurrentOrder();
            $item->setTotalPrice($item->getQuantity() * $item->getProduct()->getPrice());
            $order->addItem($item);
            $this->em->persist($order);
        }
        $this->updateOrderTotalPrice();

        $this->em->flush();
    }

    public function removeItem(OrderItem $item): void
    {
        $this->em->remove($item);
        $this->updateOrderTotalPrice();

        $this->em->flush();
    }

    public function setItemQuantity(OrderItem $item, int $quantity): void
    {
        $item->setQuantity($quantity);
        $item->setTotalPrice($item->getQuantity() * $item->getProduct()->getPrice());
        $this->em->persist($item);

        $this->updateOrderTotalPrice();
        $this->em->flush();
    }

    public function setOwnerId(int $ownerId): void
    {
        $this->getCurrentOrder()
            ->setOwner($this->em->getReference(User::class, $ownerId))
        ;
    }

    public function applyCoupon(DiscountCode $code): void
    {
        // check if the code is valid
        if (new \DateTimeImmutable() >= $code->getExpireAt()) {
            throw new \Exception('Le code a expiré');
        }

        $order = $this->getCurrentOrder();
        // check if the code is already used
        if ($order->getDiscountCode()->getId() === $code->getId()) {
            return;
        }

        // check if there is usage left on the code
        if (-1 !== $code->getMaxUses()) {
            /** @var DiscountCodeRepository */
            $discountCodeRepository = $this->em->getRepository(DiscountCode::class);
            $usagesLeft = $code->getMaxUses() - $discountCodeRepository->findUsageCount($code);
            if (0 >= $usagesLeft) {
                throw new \Exception('Le code a expiré');
            }
        }

        $order->setDiscountCode($code);
        $this->updateOrderTotalPrice();

        $this->em->persist($order);
        $this->em->flush();
    }

    public function updateOrderTotalPrice(): void
    {
        $order = $this->getCurrentOrder();
        $price = 0;
        foreach ($order->getItems() as $item) {
            $price += $item->getTotalPrice();
        }
        $order->setTotalPriceWithoutDiscount($price);
        $order->setTotalPrice($price);

        // if there is a discount code, apply it
        if (null !== $code = $order->getDiscountCode()) {
            $order->setTotalPrice($order->getTotalPriceWithoutDiscount() - $code->getValue());

            $order->setTotalPrice($price - $price * $order->getDiscountCode()->ge);
        }

        $this->em->persist($order);
    }
}
