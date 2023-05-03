<?php

namespace App\Dto\Dashboard\Factories;

use App\Dto\Dashboard\TagDataDto;

class TagDataFactory
{
    /**
     * Tag data transfer object factory.
     *
     * @param $request
     * @return \App\Dto\Dashboard\TagDataDto
     */
    public function createDto($request): TagDataDto
    {
        return new TagDataDto(
            title: $request->get('title')
        );
    }
}
