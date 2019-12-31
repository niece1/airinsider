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

        toast('User Deleted','success')->position('top-end')->padding('30px')->autoClose(5000);

        return redirect('dashboard/users');
    }
}
