<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
	public function  index()
	{
		$users = User::all();

		if(session('success_message')){
        Alert::success( session('success_message'))->toToast();
        }

		return view('backend.user.index', compact('users'));
	}

    public function edit(User $user)
    {
    	$roles = Role::all();

        return view('backend.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {        
        $this->syncRoles($user);

        return redirect('dashboard/users')->withSuccessMessage('User Updated Successfully!');
    }

    public function destroy(User $user)
    {
    	abort_unless(\Gate::allows('user_delete'), 403);
        $user->delete();

        return redirect('dashboard/users');
    }

    private function syncRoles($user)
    {
       $user->roles()->sync(request('role_id'));
    }
}