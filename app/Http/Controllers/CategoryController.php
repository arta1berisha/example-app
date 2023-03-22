<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Products\UpdateProductsRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
    }

    public function index()
    {
        $category = Category::all();

        return CategoryResource::collection($category);
    }

    public function show(Category $category)
    {
        return Category::find($category);
    }

    public function update(UpdateProductsRequest $request, Category $category)
    {
        $category->update($request->validated());
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return 204;
    }

    public function products(Category $category)
    {
        return response()->json($category->products);
    }
}
