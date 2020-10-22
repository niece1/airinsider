<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Dashboard\PostRepository;
use App\Repositories\Dashboard\SubscriptionRepository;
use App\Jobs\SendNewsletterJob;

class SendNewsletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletter email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $posts = PostRepository::getForNewsletters();
        $subscriptions = SubscriptionRepository::getforNewsletters();
        if (!sizeof($posts) == 0 && !sizeof($subscriptions) == 0) {
            dispatch(new SendNewsletterJob($posts, $subscriptions));
            $this->info('Newsletter emails are sent!');
        }
    }
}
