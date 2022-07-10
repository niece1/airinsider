<?php

namespace App\Repositories\Frontend;

use Illuminate\Http\Request;
use App\Models\Subscription;

/**
 * Subscription entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class SubscriptionRepository
{
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
