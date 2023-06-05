<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Repositories\Dashboard\CategoryRepository;
use App\Http\Requests\Dashboard\CategoryRequest;

class CategoryController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $categories = CategoryRepository::getAll();

        return view('dashboard.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        $category = new Category();

        return view('dashboard.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->authorize('create', Category::class);
        CategoryRepository::save($request);

        return redirect('dashboard/categories')->withSuccessMessage('Category Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->authorize('update', Category::class);

        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', Category::class);
        CategoryRepository::update($request, $category);

        return redirect('dashboard/categories')->withSuccessMessage('Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', Category::class);
        CategoryRepository::delete($category);

        return redirect('dashboard/categories')->withSuccessMessage('Category Deleted Successfully!');
    }
}
