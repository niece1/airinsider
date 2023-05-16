<?php

namespace App\Dto\Dashboard;

class TagDataDto
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
     * Get a tag title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
