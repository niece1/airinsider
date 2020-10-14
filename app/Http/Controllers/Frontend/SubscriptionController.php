<?php

namespace App\Http\Controllers\Frontend;

use App\Subscription;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SubscriptionRequest  $request
     * @return void
     */
    public function store(SubscriptionRequest $request)
    {
        Subscription::create($request->all());
    }
}
