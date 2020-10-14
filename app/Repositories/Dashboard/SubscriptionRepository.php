<?php

namespace App\Repositories\Dashboard;

use App\Subscription;

/**
 * Subscription entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class SubscriptionRepository
{
    /**
     * Fetch all subscriptions from the database.
     *
     * @return \App\Subscription[]
     */
    public static function getAll()
    {
        return Subscription::orderBy('id', 'desc')
                ->paginate(25);
    }
    
    /**
     * Fetch all subscriptions from the database.
     *
     * @return \App\Subscription[]
     */
    public static function getforNewsletters()
    {
        return Subscription::all();
    }
    
    /**
     * Delete subscription instance from the database.
     *
     * @param  \App\Subscription  $subscription
     */
    public static function delete(Subscription $subscription)
    {
        $subscription->delete();
    }
}
