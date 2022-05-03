<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Product\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductController extends Controller
{
    public function show()
    {
        return view('dashboard');
    }
    public function product()
    {
        return view('admin');
    }
    public function post_product(Request $request, EntityManagerInterface $em)
    {
        $product = new Product(
            $request->get('name'),
            $request->get('description'),
            $request->get('image'),
            $request->get('price')
        );
        $em->persist($product);
        $em->flush();

        return redirect('admin')->with('success_message', 'Product added successfully!');
    }
}
