<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Http\Requests\Dashboard\RoleRequest;
use App\Repositories\Dashboard\RoleRepository;
use App\Repositories\Dashboard\PermissionRepository;

class RoleController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);
        $roles = RoleRepository::getAll();

        return view('dashboard.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        $role = new Role();
        $permissions = PermissionRepository::getAll();

        return view('dashboard.role.create', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('create', Role::class);
        $role = RoleRepository::save($request);
        $role->syncPermissions($role);

        return redirect('dashboard/roles')->withSuccessMessage('Role Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', Role::class);
        $permissions = PermissionRepository::getAll();

        return view('dashboard.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('update', Role::class);
        RoleRepository::update($request, $role);
        $role->syncPermissions($role);

        return redirect('dashboard/roles')->withSuccessMessage('Role Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', Role::class);
        RoleRepository::delete($role);

        return redirect('dashboard/roles')->withSuccessMessage('Role Deleted Successfully!');
    }
}
