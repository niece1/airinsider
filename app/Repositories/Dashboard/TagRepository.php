<?php

namespace App\Repositories\Dashboard;

use App\Models\Tag;

/**
 * Tag entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class TagRepository
{
    /**
     * Fetch all tags from the database.
     *
     * @return \App\Tag[]
     */
    public static function getAll()
    {
        return Tag::all();
    }

    /**
     * Save tag instance to the database.
     *
     * @param $request
     */
    public static function save($request)
    {
        Tag::create($request->getDto());
    }

    /**
     * Update tag instance in the database.
     *
     * @param $request
     * @param  \App\Tag  $tag
     */
    public static function update($request, Tag $tag)
    {
        $tag->update($request->getDto());
    }

    /**
     * Delete tag instance from the database.
     *
     * @param  \App\Tag  $tag
     */
    public static function delete(Tag $tag)
    {
        $tag->delete();
    }
}
