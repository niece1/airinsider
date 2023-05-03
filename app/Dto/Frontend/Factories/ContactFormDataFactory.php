<?php

namespace App\Dto\Frontend\Factories;

use App\Dto\Frontend\ContactFormDataDto;

class ContactFormDataFactory
{
    /**
     * Contact form data transfer object factory.
     *
     * @param $request
     * @return \App\Dto\Frontend\ContactFormDataDto
     */
    public function createDto($request): ContactFormDataDto
    {
        return new ContactFormDataDto(
            name: $request->get('name'),
            email: $request->get('email'),
            message: $request->get('message')
        );
    }
}
