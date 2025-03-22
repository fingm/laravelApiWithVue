<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function all(){
        return response()->json(Category::get());
    }

    public function index()
    {
        return response()->json(Category::paginate(10));
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Category::create($request->validated()));
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function slug(Category $category){
        return response()->json($category);
    }

    public function update(StoreRequest $request, Category $category)
    {
        return response()->json($category->update($request->Validated()));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json('delete ok');
    }
}
