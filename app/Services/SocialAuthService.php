<?php

namespace App\Services;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

/**
 * Store social network user.
 *
 * @author Volodymyr Zhonchuk
 */
class SocialAuthService
{
    /**
     * Store authenticated user to the database.
     *
     * @param $provider
     * @return void
     */
    public function store($provider, Request $request)
    {
        if (!$request->has('code') || $request->has('denied')) {
            return redirect('/login');
        }
        if ($provider == 'google') {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        }
        $socialUser = Socialite::driver($provider)->user();
        $user = User::where('email', $socialUser->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'email' => $socialUser->getEmail(),
                'name' => $socialUser->getName(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        }
        Auth::login($user, true);
    }
}
