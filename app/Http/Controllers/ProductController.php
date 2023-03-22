<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Products\StoreProductsRequest;
use App\Http\Requests\Products\UpdateProductsRequest;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    public function store(StoreProductsRequest $request)
    {
        $product = Product::create($request->validated());
    }

    public function index()
    {
        $product = Product::all();

        return ProductResource::collection($product);
    }

    public function show(Product $product)
    {
        return Product::find($product);
    }

    public function update(UpdateProductsRequest $request, Product $product)
    {

        $product->update($request->validated());
        return new ProductResource($product);
    }

    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return 204;
    }
}
