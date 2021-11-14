<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    /**
     * Posts to send to subscribers.
     *
     */
    public $posts;

    /**
     * Distinct subscription to make unsubscribe.
     *
     */
    public $subscription;

    /**
     * Create a new message instance.
     *
     * @param $posts
     * @param $subscription
     * @return void
     */
    public function __construct($posts, $subscription)
    {
        $this->posts = $posts;
        $this->subscription = $subscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newsletter.newsletter');
    }
}
