<?php

namespace App\Repositories\Frontend;

use App\Models\Subscription;
use App\Exceptions\AlreadyUnsubscribedException;
use App\Exceptions\MissingSubscriptionException;
use Illuminate\Support\Str;
use App\Dto\Frontend\SubscriptionDataDto;

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
     * @param $request
     * @return void
     */
    public static function subscribe($request)
    {

        $formData = SubscriptionDataDto::fromRequest($request);

        return Subscription::create([
            'email' => $formData->email,
            'remember_token' => $request['remember_token'] = Str::random(16)
        ]);
    }

    /**
     * Update subscription instance in the database.
     *
     * @param string $email
     * @param string $remember_token
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
     * @param string $remember_token
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
