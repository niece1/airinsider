<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Posts to be send.
     *
     */
    public $posts;

    /**
     * Subscribers to receive newsletter mail.
     *
     */
    public $subscriptions;

    /**
     * Create a new job instance.
     *
     * @param $posts
     * @param $subscriptions
     * @return void
     */
    public function __construct($posts, $subscriptions)
    {
        $this->posts = $posts;
        $this->subscriptions = $subscriptions;
    }

    /**
     * Send newsletter mail.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->subscriptions as $subscription) {
            Mail::to($subscription->email)->send(new NewsletterMail($this->posts, $subscription));
        }
    }
}
