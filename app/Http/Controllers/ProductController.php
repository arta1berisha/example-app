<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        return Product::create($request->all());
    }

    public function index()
    {
        return Product::all();
    }

    public function show(Product $product)
    {
        return Product::find($product);
    }

    public function update(Request $request, Product $product)
    {
        $product = Product::find($product);
        $product->update($request->all());
        return $product;
    }

    public function destroy(Product $product)
    {
        $product = Product::findOrFail($product);
        $product->delete();

        return 204;
    }
}
