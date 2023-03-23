<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::paginate();

        return CategoryResource::collection($category);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Category deleted successfully',
            ], 204);
        }

        return response()->json([
            'status' => false,
            'message' => 'Cannot delete Category',
        ], 400);
    }

    public function products(Category $category)
    {
        return response()->json(ProductResource::collection($category->products));
    }
}
