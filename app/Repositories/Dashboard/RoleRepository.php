<?php

namespace App\Repositories\Dashboard;

use App\Role;
use App\Http\Requests\RoleRequest;

/**
 * Role entity database query class
 *
 * @author Volodymyr Zhonchuk
 */
class RoleRepository
{
    /**
     * Fetch all roles from the database
     *
     * @return \App\Role[]
     */
    public static function getAll()
    {
        return Role::with(['permissions'])->get();
    }
    
    /**
     * Save role instance to the database
     *
     * @param \App\Http\Requests\RoleRequest  $request
     * @return \App\Role
     */
    public static function save(RoleRequest $request)
    {
        return Role::create($request->all());
    }
    
    /**
     * Update role instance in the database
     *
     * @param \App\Http\Requests\RoleRequest  $request
     * @param  \App\Role  $role
     */
    public static function update(RoleRequest $request, Role $role)
    {
        $role->update($request->all());
    }
    
    /**
     * Delete role instance from the database
     *
     * @param  \App\Role  $role
     */
    public static function delete(Role $role)
    {
        $role->delete();
    }
}
