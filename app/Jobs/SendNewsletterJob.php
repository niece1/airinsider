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

    public $posts;
    public $subscriptions;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($posts, $subscriptions)
    {
        $this->posts = $posts;
        $this->subscriptions = $subscriptions;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->subscriptions as $subscription) {
            Mail::to($subscription->email)->send(new NewsletterMail($this->posts));
        }
    }
}
