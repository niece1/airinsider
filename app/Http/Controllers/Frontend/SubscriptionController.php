<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Frontend\SubscriptionRepository;

class SubscriptionController extends Controller
{
    /**
     * Confirm newsletter subscription by clicking confirm link in the subscription confirmation mail.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        SubscriptionRepository::confirm($request->email, $request->remember_token);

        return view('frontend.subscription.subscribed')->with([
            'email' => $request->email,
            'remember_token' => $request->remember_token]);
    }

    /**
     * Unsubscribe from newsletter mail.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        SubscriptionRepository::unsubscribe($request->remember_token);

        return view('frontend.subscription.unsubscribed')->with([
            'remember_token' => $request->remember_token
        ]);
    }
}
