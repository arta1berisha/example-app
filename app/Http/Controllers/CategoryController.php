<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(StoreCategoryRequest $request)
    {
        return Category::create($request->all());
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $category = Category::find($category);
        $category->update($request->all());
        return $category;
    }

    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category);
        $category->delete();

        return 204;
    }

    public function products(Category $category)
    {
        return response()->json($category->products);
    }
}
