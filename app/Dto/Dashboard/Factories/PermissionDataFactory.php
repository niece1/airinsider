<?php

namespace App\Dto\Dashboard\Factories;

use App\Dto\Dashboard\PermissionDataDto;

class PermissionDataFactory
{
    /**
     * Permission data transfer object factory.
     *
     * @param $request
     * @return \App\Dto\Dashboard\PermissionDataDto
     */
    public function createDto($request): PermissionDataDto
    {
        return new PermissionDataDto(
            title: $request->get('title')
        );
    }
}
