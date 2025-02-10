<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
 
    public function getCategory()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    
    public function addCategory(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return response()->json($category, 201); // 201 Created
    }

   
    public function showCategory(Category $category)
    {  
        $category = Category::find($category->id);
        return response()->json($category);
    }

   
    public function updateCategory(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return response()->json($category);
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return response()->json($category); // 204 No Content
    }
}
