<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LikeController extends Controller
{
    public function like($entityId, $type) {
        $entity = $this->getEntity($entityId);
        return auth()->user()->toggleLike($entity, $type);
    }

    public function getEntity($entityId)
    {       
        $comment = Comment::find($entityId);
        if ($comment) {
        	return $comment;
        }else{
            return Post::find($entityId);
        }
        throw new ModelNotFoundException('Entity not found.');
    }
}