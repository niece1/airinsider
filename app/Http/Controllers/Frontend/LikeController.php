<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LikeController extends Controller
{
    /**
     * Like or dislike entity.
     *
     * @param  Comment|Post  $entityId
     * @param  \App\Like  $type
     * @return \App\Like
     */
    public function like($entityId, $type)
    {
        $entity = $this->getEntity($entityId);

        return auth()->user()->toggleLike($entity, $type);
    }

    /**
     * Get entity of likeable instance.
     *
     * @param  Comment|Post  $entityId
     * @return mixed
     * @throws ModelNotFoundException
     */
    private function getEntity($entityId)
    {
        $comment = Comment::find($entityId);
        if ($comment) {
            return $comment;
        } else {
            return Post::find($entityId);
        }
        throw new ModelNotFoundException('Entity not found.');
    }
}
