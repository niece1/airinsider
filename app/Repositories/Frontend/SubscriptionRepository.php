<?php

namespace App\Repositories\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Support\Str;

/**
 * Subscription entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class SubscriptionRepository
{
    /**
     * Add subscription email to the database.
     *
     * @param  \App\Http\Requests\SubscriptionRequest  $request
     * @return void
     */
    public static function subscribe(SubscriptionRequest $request)
    {
        $request['remember_token'] = Str::random(16);
        Subscription::create($request->all());
    }

    /**
     * Delete subscription instance from the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public static function unsubscribe(Request $request)
    {
        $subscription = Subscription::where('remember_token', $request->remember_token)
                ->firstOrFail();
        $subscription->delete();
    }
}
