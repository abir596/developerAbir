<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderby('created_at', 'DESC')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'name' => 'required|min:2|max:50|unique:categories'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        flash('Category created successfully')->success();
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation
        $this->validate($request, [
            'name' => 'required|min:2|max:50|unique:categories,name,' . $id
        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->save();

        flash('Category updated successfully')->success();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        flash('Category deleted successfully')->success();
        return redirect()->route('categories.index');
    }
}
