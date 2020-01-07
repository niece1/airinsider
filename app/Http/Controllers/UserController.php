<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($this->validateRequest());

        return redirect('dashboard/users')->withSuccessMessage('User Updated Successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('dashboard/users');
    }

    private function validateRequest()
    {
        return request()->validate([
          'title' => 'bail|required|min:2|max:30',          
      ]); 
    }
}
