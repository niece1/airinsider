<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch\Client;
use App\Post;

class CreateIndices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'indices:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create elasticsearch indices';

    /**
     * Elasticsearch client instance.
     *
     * @var object
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param Client $client
     * @return void
     */
    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @param \App\Post $post
     * @return mixed
     */
    public function handle(Post $post)
    {
        $params = ['index' => $post->getSearchIndex()];

        if ($this->client->indices()->exists($params)) {
            $this->client->indices()->delete($params);
            $this->info('Indices deleted successfully!');
        }
        $start = microtime(true);
        $this->info('Creating indices in progress...');

        foreach (Post::where('published', 1)->cursor() as $indexed_post) {
            $this->client->index([
                'index' => $indexed_post->getSearchIndex(),
                'type' => $indexed_post->getSearchType(),
                'id' => $indexed_post->getKey(),
                'body' => $indexed_post->toSearchArray(),
            ]);
            $this->output->write('.');
        }
        $this->output->writeln('');
        $end = microtime(true);
        $this->info('Indices created in ' . round($end - $start, 2) . ' seconds');
    }
}
