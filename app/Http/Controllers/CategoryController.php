<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $categories= Category::all();
        return  $categories;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:100'
                ]);
                $categories=new Category();
                $categories->name=$request->name;
                $categories->save();
                return Category::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json($categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required|string|max:100'
                ]);
                $category->update($request->all());
                return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
      $category->delete();
      return response()->json(['message' => 'Category deleted']);

    }
}
