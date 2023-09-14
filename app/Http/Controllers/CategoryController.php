<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id , Request $request)
    {
        $category = Category::find($id);
        $category->update($request->except('_method', '_token'));
        // $category->update($request->input('name'));
        return redirect()->route('category.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $category = Category::find($id);
        return view('categories.update', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     Category::find($id)->delete();
    //     return redirect()->route('category.index');
    // }

    public function destroy(string $id)
{
    $category = Category::find($id);

    if ($category) {
        if ($category->products()->count() > 0) {
            return redirect()->route('category.index')->with('error', 'Cannot delete category with associated products');
        }

        $category->delete();
    }

    return redirect()->route('category.index')->with('success', 'Category deleted successfully');
}

}
