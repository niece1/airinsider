<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @return void
     */
    public function created()
    {
        $this->clearCache();
    }

    /**
     * Handle the Post "updated" event.
     *
     * @return void
     */
    public function updated()
    {
        $this->clearCache();
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @return void
     */
    public function deleted()
    {
        $this->clearCache();
    }

    /**
     * Handle the Post "restored" event.
     *
     * @return void
     */
    public function restored()
    {
        $this->clearCache();
    }

    /**
     * Clear cache of the specific tag.
     *
     * @return void
     */
    private function clearCache()
    {
        Cache::tags('posts')->flush();
    }
}
