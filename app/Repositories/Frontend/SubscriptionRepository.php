<?php

namespace App\Repositories\Frontend;

use App\Models\Subscription;
use App\Exceptions\AlreadyUnsubscribedException;
use App\Exceptions\MissingSubscriptionException;

/**
 * Subscription entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class SubscriptionRepository
{
    /**
     * Update subscription instance in the database.
     *
     * @param  string  $email
     * @param  string  $remember_token
     * @return void
     */
    public static function confirm($email, $remember_token)
    {
        $subscription = Subscription::where('email', $email)
                ->where('remember_token', $remember_token)
                ->first();
        if (!$subscription) {
            throw new MissingSubscriptionException('Missing email');
        }
        $subscription->subscribed = 1;
        $subscription->save();
    }

    /**
     * Delete subscription instance from the database.
     *
     * @param  string  $remember_token
     * @return void
     */
    public static function unsubscribe($remember_token)
    {
        $subscription = Subscription::where('remember_token', $remember_token)
                ->first();
        if (!$subscription) {
            throw new AlreadyUnsubscribedException('Email has been already deleted');
        }
        $subscription->delete();
    }
}
