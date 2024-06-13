<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index', ['categories' => Category::orderByDesc('id')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // dd($request->all());

        // Validate
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->name, '-');

        // Create
        Category::create($val_data);

        // Redirect
        return to_route('admin.categories.index')->with('message', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // dd($request->all());

        // Validate
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->name, '-');

        // Update
        $category->update($val_data);

        // Redirect
        return to_route('admin.categories.index')->with('message', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Delete the Category
        $category->delete();

        // Redirect
        return to_route('admin.categories.index')->with('message', 'Category deleted successfully!');
    }
}
