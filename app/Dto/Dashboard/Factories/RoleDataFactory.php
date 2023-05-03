<?php

namespace App\Dto\Dashboard\Factories;

use App\Dto\Dashboard\RoleDataDto;

class RoleDataFactory
{
    /**
     * Role data transfer object factory.
     *
     * @param $request
     * @return \App\Dto\Dashboard\RoleDataDto
     */
    public function createDto($request): RoleDataDto
    {
        return new RoleDataDto(
            title: $request->get('title')
        );
    }
}
