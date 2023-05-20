<?php

namespace App\Dto\Frontend;

class ContactFormDataDto
{
    /**
     * Create a new instance.
     *
     * @param $name
     * @param $email
     * @param $message
     * @return void
     */
    public function __construct(
        private string $name,
        private string $email,
        private string $message,
    ) {
    }

    /**
     * Get a contact form name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get a contact form email.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get a contact form message.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
