<?php

namespace App\Repositories\Dashboard;

use App\Models\Permission;

/**
 * Permission entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class PermissionRepository
{
    /**
     * Fetch all permissions from the database.
     *
     * @return \App\Permission[]
     */
    public static function getAll()
    {
        return Permission::all();
    }

    /**
     * Save permission instance to the database.
     *
     * @param $request
     */
    public static function save($request)
    {
        Permission::create($request->getDto());
    }

    /**
     * Delete permission instance from the database.
     *
     * @param  \App\Permission  $permission
     */
    public static function delete(Permission $permission)
    {
        $permission->delete();
    }
}
