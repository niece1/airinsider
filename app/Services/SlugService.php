<?php
namespace App\Services;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Description of GenerateSlugService
 *
 * @author test
 */
class SlugService
{
    public function generateSlug(Request $request, Post $post)
    {
        $post->update([
            'slug' => Str::slug($request->title, '-'),
        ]);
    }
}
