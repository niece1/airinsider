<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
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
        $role = new Role();
        $permissions = Permission::all();

        return view('backend.role.create', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($this->validateRequest());
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
        $permissions = Permission::all();

        return view('backend.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($this->validateRequest());
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
        $role->delete();

        if($role->permissions) {
        $this->detachPermissions($role);
        }

        return redirect('dashboard/roles')->withSuccessMessage('Role Deleted Successfully!');
    }

    private function validateRequest()
    {
        return request()->validate([
          'title' => 'bail|required|min:2|max:30',
        ]); 
    }

    private function syncPermissions($role)
    {
       $role->permissions()->sync(request('permission_id'));
    }

    private function detachPermissions($role)
    {
       $role->permissions()->detach(request('permission_id'));
    }
}
