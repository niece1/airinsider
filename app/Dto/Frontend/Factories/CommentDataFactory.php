<?php

namespace App\Dto\Frontend\Factories;

use App\Dto\Frontend\CommentDataDto;

class CommentDataFactory
{
    /**
     * Comment data transfer object factory.
     *
     * @param $request
     * @return \App\Dto\Frontend\CommentDataDto
     */
    public function createDto($request): CommentDataDto
    {
        return new CommentDataDto(
            body: $request->get('body'),
            comment_id: $request->get('comment_id')
        );
    }
}
