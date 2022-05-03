<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Product\Product;
use App\Helpers\SecurityHelper;
use Illuminate\Http\Request;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
final class ProductController extends CrudController
{
    protected string $entityClass = Product::class;
    protected string $templatePrefix = 'admin.product';
    protected string $routePrefix = 'admin.products';
    protected array $validationRules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'price' => ['required', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
        'image' => 'required|string|max:255', // TODO: add regex validation
        'remaining_count' => 'required|numeric|min:-1',
    ];

    public function index()
    {
        SecurityHelper::abortUnlessAdmin();

        return $this->crudIndex();
    }

    public function create(Request $request)
    {
        SecurityHelper::abortUnlessAdmin();

        return $this->crudCreate($request);
    }

    public function edit(Request $request, int $id)
    {
        SecurityHelper::abortUnlessAdmin();

        return $this->crudEdit($request, $id);
    }

    public function delete(Request $request, int $id)
    {
        SecurityHelper::abortUnlessAdmin();
    }

    protected function store(Request $request, object $entity)
    {
        $entity->setName($request->input('name'))
            ->setDescription($request->input('description'))
            ->setPrice(floatval($request->input('price')))
            ->setImage($request->input('image'))
            ->setRemainingCount(floatval($request->input('remaining_count')))
        ;

        $this->em->persist($entity);
        $this->em->flush();

        return redirect()->route("{$this->routePrefix}.index");
    }
}
