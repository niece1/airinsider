<?php

namespace App\Repositories\Dashboard;

use App\Permission;
use App\Http\Requests\PermissionRequest;

/**
 * Permission entity database query class
 *
 * @author Volodymyr Zhonchuk
 */
class PermissionRepository
{
    /**
     * Fetch all permissions from the database
     *
     * @return \App\Permission[]
     */
    public static function getAll()
    {
        return Permission::all();
    }
    
    /**
     * Save permission instance to the database
     *
     * @param \App\Http\Requests\PermissionRequest  $request
     */
    public static function save(PermissionRequest $request)
    {
        Permission::create($request->all());
    }
    
    /**
     * Delete permission instance from the database
     *
     * @param  \App\Permission  $permission
     */
    public static function delete(Permission $permission)
    {
        $permission->delete();
    }
}
