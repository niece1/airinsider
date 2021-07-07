<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Permission;
use App\Http\Requests\PermissionRequest;
use App\Repositories\Dashboard\PermissionRepository;
use Illuminate\Support\Facades\Gate;

class PermissionController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('permission_access'), 403);
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
        abort_unless(Gate::allows('permission_create'), 403);
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
        abort_unless(Gate::allows('permission_delete'), 403);
        PermissionRepository::delete($permission);

        return redirect('dashboard/permissions')->withSuccessMessage('Permission Deleted Successfully!');
    }
}
