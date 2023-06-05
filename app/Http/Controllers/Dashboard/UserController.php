<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Repositories\Dashboard\RoleRepository;
use App\Repositories\Dashboard\UserRepository;

class UserController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = UserRepository::getAll();

        return view('dashboard.user.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', User::class);
        $roles = RoleRepository::getAll();

        return view('dashboard.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $this->authorize('update', User::class);
        $user->syncRoles($user);

        return redirect('dashboard/users')->withSuccessMessage('User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);
        UserRepository::delete($user);

        return redirect('dashboard/users')->withSuccessMessage('User Deleted Successfully!');
    }
}
