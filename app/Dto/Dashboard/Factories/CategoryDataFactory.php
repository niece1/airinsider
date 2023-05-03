<?php

namespace App\Dto\Dashboard\Factories;

use App\Dto\Dashboard\CategoryDataDto;

class CategoryDataFactory
{
    /**
     * Category data transfer object factory.
     *
     * @param $request
     * @return \App\Dto\Dashboard\CategoryDataDto
     */
    public function createDto($request): CategoryDataDto
    {
        return new CategoryDataDto(
            title: $request->get('title')
        );
    }
}
