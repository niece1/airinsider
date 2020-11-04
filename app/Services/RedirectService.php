<?php

namespace App\Services;

use App\Providers\RouteServiceProvider;

/**
 * Redirect to previous page after login.
 *
 * @author Volodymyr Zhonchuk
 */
class RedirectService
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Redirect to previous page after login.
     *
     * @return void
     */
    public function redirectToPreviousPage()
    {
        session(['url.intended' => url()->previous()]);
        $this->redirectTo = session()->get('url.intended');
    }
}
