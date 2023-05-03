<?php

namespace App\Repositories\Dashboard;

use App\Models\Role;

/**
 * Role entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class RoleRepository
{
    /**
     * Fetch all roles from the database.
     *
     * @return \App\Role[]
     */
    public static function getAll()
    {
        return Role::with(['permissions'])->get();
    }

    /**
     * Save role instance to the database.
     *
     * @param $request
     * @return \App\Role
     */
    public static function save($request)
    {
        return Role::create($request->getDto());
    }

    /**
     * Update role instance in the database.
     *
     * @param $request
     * @param \App\Role $role
     */
    public static function update($request, Role $role)
    {
        $role->update($request->getDto());
    }

    /**
     * Delete role instance from the database.
     *
     * @param  \App\Role  $role
     */
    public static function delete(Role $role)
    {
        $role->delete();
    }
}
