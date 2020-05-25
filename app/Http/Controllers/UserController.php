<?php
namespace App\Http\Controllers;

use App\User;
use App\Role;

class UserController extends BackendController
{
    public function index()
    {
        abort_unless(\Gate::allows('user_access'), 403);
        $users = User::with(['roles'])->get();
        
        return view('backend.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);
        $roles = Role::all();

        return view('backend.user.edit', compact('user', 'roles'));
    }

    public function update(User $user)
    {
        $user->syncRoles($user);

        return redirect('dashboard/users')->withSuccessMessage('User Updated Successfully!');
    }

    public function destroy(User $user)
    {
        abort_unless(\Gate::allows('user_delete'), 403);
        $user->delete();

        return redirect('dashboard/users')->withSuccessMessage('User Deleted Successfully!');
    }
}
