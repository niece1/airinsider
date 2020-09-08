<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;

class BackendController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success_message')) {
                Alert::success(session('success_message'))->toToast();
            }
            return $next($request);
        });
    }
}
