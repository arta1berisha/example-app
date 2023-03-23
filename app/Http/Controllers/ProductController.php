<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::paginate();

        return ProductResource::collection($product);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
       if ($product->delete()) {
        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully',
        ], 204);
       }

        return response()->json([
            'status' => false,
            'message' => 'Cannot delete Product',
        ], 400);
    }
}
