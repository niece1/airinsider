<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\Http\Requests\RoleRequest;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('role_access'), 403);

        $roles = Role::with(['permissions'])->get();

        if(session('success_message')){
        Alert::success( session('success_message'))->toToast();
        }

        return view('backend.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('role_create'), 403);

        $role = new Role();
        $permissions = Permission::all();

        return view('backend.role.create', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());
        $this->syncPermissions($role);

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
        abort_unless(\Gate::allows('role_edit'), 403);

        $permissions = Permission::all();

        return view('backend.role.edit', compact('role', 'permissions'));
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
        $role->update($request->all());
        $this->syncPermissions($role);

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
        abort_unless(\Gate::allows('role_delete'), 403);

        $role->delete();

        return redirect('dashboard/roles')->withSuccessMessage('Role Deleted Successfully!');
    }

    private function syncPermissions($role)
    {
       $role->permissions()->sync(request('permission_id'));
    }

}
