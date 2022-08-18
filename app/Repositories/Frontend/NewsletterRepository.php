<?php

namespace App\Repositories\Frontend;

use App\Models\Subscription;
use App\Models\Post;
use Carbon\Carbon;

/**
 * Newsletter mail database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class NewsletterRepository
{
    /**
     * Fetch all subscriptions from the database.
     *
     * @return \App\Subscription[]
     */
    public static function getSubscriptions()
    {
        return Subscription::where('subscribed', 1)
                ->get();
    }

    /**
     * Fetch posts for the last 7 days to send newsletter.
     *
     * @return \App\Post[]
     */
    public static function getPosts()
    {
        return Post::with(['photo', 'category', 'user'])
                ->whereDate('publish_time', '>', Carbon::now()->sub(7, 'days'))
                ->where('published', 1)
                ->get();
    }
}
