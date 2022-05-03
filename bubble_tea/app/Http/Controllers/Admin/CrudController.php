<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
abstract class CrudController extends Controller
{
    protected string $entityClass;
    protected string $templatePrefix;
    protected string $routePrefix;
    protected array $validationRules = [];

    public function __construct(protected EntityManagerInterface $em)
    {
    }

    public function crudIndex()
    {
        $entities = $this->getEntityRepository()->findAll();

        return view("{$this->templatePrefix}.index", [
            'entities' => $entities,
            'templatePrefix' => $this->templatePrefix,
            'routePrefix' => $this->routePrefix,
        ]);
    }

    public function crudCreate(Request $request)
    {
        $entity = new $this->entityClass();

        if ($request->isMethod('POST')) {
            [$isValid, $response] = $this->validateForm(
                $request,
                $this->validationRules,
                "{$this->routePrefix}.create"
            );

            if (!$isValid) {
                return $response;
            }

            $this->store($request, $entity);

            return redirect()->route("{$this->routePrefix}.index");
        }

        return view("{$this->templatePrefix}.create", [
            'entity' => $entity,
            'templatePrefix' => $this->templatePrefix,
            'routePrefix' => $this->routePrefix,
        ]);
    }

    public function crudEdit(Request $request, int $id)
    {
        if (null === $entity = $this->getEntityRepository()->find($id)) {
            abort(404);
        }

        if ($request->isMethod('POST')) {
            [$isValid, $response] = $this->validateForm(
                $request,
                $this->validationRules,
                "{$this->routePrefix}.edit"
            );

            if (!$isValid) {
                return $response;
            }

            $this->store($request, $entity);

            return redirect()->route("{$this->routePrefix}.index");
        }

        return view("{$this->templatePrefix}.edit", [
            'entity' => $entity,
            'templatePrefix' => $this->templatePrefix,
            'routePrefix' => $this->routePrefix,
        ]);
    }

    abstract protected function store(Request $request, object $entity);

    protected function getEntityRepository(): EntityRepository
    {
        return $this->em->getRepository($this->entityClass);
    }

    protected function validateForm(Request $request, array $rules, string $route)
    {
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response = redirect($request->fullUrl())
                ->withErrors($validator)
                ->withInput()
            ;

            return [false, $response];
        }

        return [true, null];
    }
}
