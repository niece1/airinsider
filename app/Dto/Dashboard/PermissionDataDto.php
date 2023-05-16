<?php

namespace App\Dto\Dashboard;

class PermissionDataDto
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
     * Get a permission title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
