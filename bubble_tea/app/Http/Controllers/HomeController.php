<?php

namespace App\Http\Controllers;

use App\Repositories\Product\ProductRepository;

final class HomeController extends Controller
{
    public function index(ProductRepository $repository)
    {
        return view('home.index', [
            'products' => $repository->findAll(),
        ]);
    }
}
