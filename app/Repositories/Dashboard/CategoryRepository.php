<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;

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
     * @param $request
     */
    public static function save($request)
    {
        Category::create($request->getDto());
    }

    /**
     * Update category instance in the database.
     *
     * @param $request
     * @param  \App\Category  $category
     */
    public static function update($request, Category $category)
    {
        $category->update($request->getDto());
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
