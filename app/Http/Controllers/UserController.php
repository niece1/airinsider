<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	public function  index()
	{
		$users = User::all();

		return view('backend.user.index', compact('users'));
	}

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('dashboard/users');
    }
}
