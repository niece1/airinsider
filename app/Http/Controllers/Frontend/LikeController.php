<?php

namespace App\Http\Controllers\Frontend;

use App\Post;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LikeController extends Controller
{
    public function like($entityId, $type)
    {
        $entity = $this->getEntity($entityId);
        
        return auth()->user()->toggleLike($entity, $type);
    }

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
