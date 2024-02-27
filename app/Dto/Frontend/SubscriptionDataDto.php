<?php

namespace App\Dto\Frontend;

class SubscriptionDataDto
{
    /**
     * Create a new instance.
     *
     * @param $email
     * @return void
     */
    public function __construct(
        public string $email,
    ) {
    }

    /**
     * Create a new form data instance.
     *
     * @param $request
     * @return string $email
     */
    public static function fromRequest($request)
    {
        return new static(
            $request->get('email'),
        );
    }
}
