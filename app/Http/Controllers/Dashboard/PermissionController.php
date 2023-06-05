<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Permission;
use App\Http\Requests\Dashboard\PermissionRequest;
use App\Repositories\Dashboard\PermissionRepository;

class PermissionController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Permission::class);
        $permissions = PermissionRepository::getAll();

        return view('dashboard.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Permission::class);
        $permission = new Permission();

        return view('dashboard.permission.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $this->authorize('create', Permission::class);
        PermissionRepository::save($request);

        return redirect('dashboard/permissions')->withSuccessMessage('Permission Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('delete', Permission::class);
        PermissionRepository::delete($permission);

        return redirect('dashboard/permissions')->withSuccessMessage('Permission Deleted Successfully!');
    }
}
