<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('permission_access'), 403);

        $permissions = Permission::all();

        if(session('success_message')){
        Alert::success( session('success_message'))->toToast();
        }

        return view('backend.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('permission_create'), 403);

        $permissions = new Permission();

        return view('backend.permission.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = Permission::create($this->validateRequest());

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
        abort_unless(\Gate::allows('permission_delete'), 403);

        $permission->delete();

        return redirect('dashboard/permissions')->withSuccessMessage('Permission Deleted Successfully!');
    }

    private function validateRequest()
    {
        return request()->validate([
          'title' => 'bail|required|min:2|max:30',          
      ]); 
    }
}
