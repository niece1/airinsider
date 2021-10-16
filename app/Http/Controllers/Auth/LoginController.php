<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Services\RedirectService;
use App\Services\SocialAuthService;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Number of login attempts.
     *
     * @var int
     */
    protected $maxAttempts = 3;

    /**
     * Login time range.
     *
     * @var int
     */
    protected $decayMinutes = 5;

    /**
     * Redirect to previous page after login.
     */
    private $redirectService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RedirectService $redirect)
    {
        $this->redirectService = $redirect;
        $this->redirectService->redirectToPreviousPage();
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect user to the provider's authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(
        $provider,
        SocialAuthService $socialAuthService,
        Request $request
    ) {
        $socialAuthService->store($provider, $request);
        return redirect()->intended('/');
    }

    /**
     * Get last login time and IP address.
     *
     * @return void
     */
    public function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip_address' => $request->ip(),
        ]);
    }
}
