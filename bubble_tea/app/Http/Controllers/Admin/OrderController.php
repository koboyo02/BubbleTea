<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Order\Order;
use App\Helpers\SecurityHelper;
use Illuminate\Http\Request;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
final class OrderController extends CrudController
{
    protected string $entityClass = Order::class;
    protected string $templatePrefix = 'admin.order';
    protected string $routePrefix = 'admin.orders';

    public function index()
    {
        SecurityHelper::abortUnlessAdmin();

        return $this->crudIndex();
    }

    public function view(int $id)
    {
        SecurityHelper::abortUnlessAdmin();
    }

    protected function store(Request $request, object $entity)
    {
        throw new \Exception('Not implemented yet');
    }
}
