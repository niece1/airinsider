<?php

namespace App\Dto\Dashboard;

class CategoryDataDto
{
    /**
     * Create a new instance.
     *
     * @param $title
     * @return void
     */
    public function __construct(private string $title)
    {
    }

    /**
     * Get a category title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
