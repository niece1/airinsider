<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Repositories\Dashboard\RoleRepository;
use App\Repositories\Dashboard\UserRepository;

class UserController extends DashboardController
{
    public function index()
    {
        abort_unless(\Gate::allows('user_access'), 403);
        $users = UserRepository::getAll();
        
        return view('dashboard.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);
        $roles = RoleRepository::getAll();

        return view('dashboard.user.edit', compact('user', 'roles'));
    }

    public function update(User $user)
    {
        $user->syncRoles($user);

        return redirect('dashboard/users')->withSuccessMessage('User Updated Successfully!');
    }

    public function destroy(User $user)
    {
        abort_unless(\Gate::allows('user_delete'), 403);
        UserRepository::delete($user);

        return redirect('dashboard/users')->withSuccessMessage('User Deleted Successfully!');
    }
}
