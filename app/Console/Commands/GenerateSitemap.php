<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap';

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
     * @return int
     */
    public function handle()
    {
        $start = microtime(true);
        $this->info('Sitemap generation in progress...');

        SitemapGenerator::create(config('app.url'))
                ->hasCrawled(function (Url $url) {
                    if ($url->segment(1) === 'login' || $url->segment(1) === 'register') {
                        return;
                    }
                    return $url;
                })
                ->writeToFile(public_path('sitemap.xml'));

        $end = microtime(true);
        $this->info('Sitemap generated successfully in ' . round($end - $start, 2) . ' seconds.');
    }
}
