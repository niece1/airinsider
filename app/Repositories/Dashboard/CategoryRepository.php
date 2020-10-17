<?php

namespace App\Repositories\Dashboard;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Dashboard\BaseRepository;

/**
 * Category entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class CategoryRepository
{
    /**
     * Fetch all categories from the database.
     *
     * @return \App\Category[]
     */
    public static function getAll()
    {
        return Category::all();
    }
    
    /**
     * Save category instance to the database.
     *
     * @param \App\Http\Requests\CategoryRequest  $request
     */
    public static function save(CategoryRequest $request)
    {
        Category::create($request->all());
    }
    
    /**
     * Update category instance in the database.
     *
     * @param \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Category  $category
     */
    public static function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
    }
    
    /**
     * Delete category instance from the database.
     *
     * @param  \App\Category  $category
     */
    public static function delete(Category $category)
    {
        $category->delete();
    }
}
