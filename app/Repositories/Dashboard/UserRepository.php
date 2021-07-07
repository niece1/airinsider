<?php

namespace App\Repositories\Dashboard;

use App\Models\User;

/**
 * User entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class UserRepository
{
    /**
     * Fetch all users from the database.
     *
     * @return \App\User[]
     */
    public static function getAll()
    {
        return User::with(['roles'])->get();
    }

    /**
     * Delete user instance from the database.
     *
     * @param  \App\User  $user
     */
    public static function delete(User $user)
    {
        $user->delete();
    }
}
