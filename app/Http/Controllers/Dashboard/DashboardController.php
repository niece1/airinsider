<?php

namespace App\Http\Controllers\Dashboard;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
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
