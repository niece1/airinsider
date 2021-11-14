<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\SubscriptionRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Frontend\SubscriptionRepository;

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
        SubscriptionRepository::subscribe($request);
    }

    /**
     * Unsubscribe from newsletter mail.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        SubscriptionRepository::unsubscribe($request);

        return redirect()->route('unsubscribe', ['remember_token' => $request->remember_token]);
    }

    /**
     * Displays unsubscribe page.
     *
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe()
    {
        return view('emails.newsletter.unsubscribe');
    }
}
