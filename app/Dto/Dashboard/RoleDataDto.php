<?php

namespace App\Dto\Dashboard;

class RoleDataDto
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
     * Get a role title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
