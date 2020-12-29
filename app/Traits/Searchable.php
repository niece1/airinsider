<?php

namespace App\Traits;

use App\Observers\PostObserver;

/**
 * Search with Elasticsearch.
 *
 * @author Volodymyr Zhonchuk
 */
trait Searchable
{
    /**
     * Register event for an app.
     *
     * @return void
     */
    public static function bootSearchable()
    {
        if (config('services.elasticsearch.enabled')) {
            static::observe(PostObserver::class);
        }
    }

    /**
     * Fetch table name of the entity.
     *
     * @return string
     */
    public function getSearchIndex()
    {
        return $this->getTable();
    }

    /**
     * Fetch type of the entity.
     *
     * @return string
     */
    public function getSearchType()
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }
        return $this->getTable();
    }

    /**
     * Define table fields to be searchable.
     *
     * @return array
     */
    public function toSearchArray()
    {
        return $this->toArray();
    }

    /**
     * Elasticsearch query attributes.
     *
     * @return array
     */
    public function params()
    {
        return [
            'index' => $this->getSearchIndex(),
            'type' => $this->getSearchType(),
            'id' => $this->getKey(),
        ];
    }
}
