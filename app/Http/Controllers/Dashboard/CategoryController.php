<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Repositories\Dashboard\CategoryRepository;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Gate;

class CategoryController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('category_access'), 403);
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
        abort_unless(Gate::allows('category_create'), 403);
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
        abort_unless(Gate::allows('category_edit'), 403);

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
        abort_unless(Gate::allows('category_delete'), 403);
        CategoryRepository::delete($category);

        return redirect('dashboard/categories')->withSuccessMessage('Category Deleted Successfully!');
    }
}
