<?php

namespace App\Dto\Frontend;

class CommentDataDto
{
    /**
     * Create a new instance.
     *
     * @param $body
     * @param $comment_id
     * @return void
     */
    public function __construct(
        private string $body,
        private ?int $comment_id
    ) {
    }

    /**
     * Get a comment body.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Get a comment id in reply.
     *
     * @return mixed
     */
    public function getCommentId(): ?int
    {
        return $this->comment_id;
    }
}
