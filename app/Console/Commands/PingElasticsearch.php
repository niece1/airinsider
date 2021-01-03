<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\NoNodesAvailableException;

class PingElasticsearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping Elasticsearch';

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
     * @return string
     */
    public function handle(Client $client)
    {
        try {
            if ($client->ping()) {
                $this->info('pong');
            }
        } catch (NoNodesAvailableException $e) {
            $this->error($e->getMessage());
        }
    }
}
