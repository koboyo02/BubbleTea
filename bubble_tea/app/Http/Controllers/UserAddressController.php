<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\User\UserShippingAddress;
use App\Http\Controllers\Admin\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

final class UserAddressController extends CrudController
{
    protected string $entityClass = UserShippingAddress::class;
    protected string $templatePrefix = 'account.address';
    protected string $routePrefix = 'account.addresses';
    protected array $validationRules = [
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'zip_code' => 'required|numeric|digits:5',
        'country' => 'required|string|max:255',
    ];

    public function index()
    {
        return view('account.address.index', [
            'addresses' => $this->getEntityRepository()
                ->findBy(['parent' => Auth::user()->getId()]),
        ]);
    }

    public function create(Request $request)
    {
        $addressesCount = $this->getEntityRepository()->countForUser(Auth::user()->getId());
        if (3 <= $addressesCount) {
            Session::flash('error', 'Vous ne pouvez pas ajouter plus de 3 adresses');

            return redirect()->route('account.addresses.index');
        }

        return $this->crudCreate($request);
    }

    public function edit(Request $request, int $id)
    {
        return $this->crudEdit($request, $id);
    }

    public function delete(Request $request, int $id)
    {
        return $this->crudDelete($request, $id);
    }

    protected function store(Request $request, object $entity)
    {
        $entity
            ->setAddress($request->input('address'))
            ->setCity($request->input('city'))
            ->setZipCode($request->input('zip_code'))
            ->setCountry($request->input('country'))
            ->setParent($this->em->getReference(User::class, Auth::user()->getId()))
        ;

        $this->em->persist($entity);
        $this->em->flush();

        return redirect()->route("{$this->routePrefix}.index");
    }
}
