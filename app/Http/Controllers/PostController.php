<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['photo'])->orderBy('id', 'desc')->paginate(50);

        return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = new Post();

        return view('backend.post.create', compact('categories', 'tags', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request, [
          'title' => 'required|min:3',
          'body' => 'required',
          'time_to_read' => 'required',
          'published' => 'required',
          'category_id' => 'required',
          'post-photo' => 'sometimes|file|image|max:5000',
        ]);

        $post = Post::create([
           'title' => $request->title,
           'body' => $request->body,
           'category_id' => $request->category_id,
           'slug'=> Str::slug($request->title, '-'),
           'published' => $request->published,
           'time_to_read' => $request->time_to_read,
           'user_id' => Auth::id()
        ]);
      //  $this->storeImage($post);
      
        $this->syncTags($post);
        
        return redirect('dashboard/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $this->detachTags($post);

        return redirect('dashboard/posts');
    }

    private function validateRequest()
    {
        return request()->validate([
          'title' => 'required|min:3',
          'body' => 'required',
          'time_to_read' => 'required',
          'published' => 'required',
          'category_id' => 'required',
          'slug' => '',
       
        //  'image' => 'sometimes|file|image|max:5000',
        ]); 
    }

    private function syncTags($post)
    {
       $post->tags()->sync(request('tag_id'));
    }

    private function detachTags($post)
    {
       $post->tags()->detach(request('tag_id'));
    }

     private function storeImage(Request $request)
    {
        if($request->hasFile('postPhoto')) {
       /* $article->update([
            'image' => request()->image->store('uploads', 'public'),
        ]);
     
        $image->save();*/
        $path = $request->file('postPhoto')->store('uploads', 'public');
        if(count($post->photos) != 0);
        {
            $photo = $this->getPhoto($post->photos->first()->id);
            Storage::disk('public')->delete($photo->storagepath);
            $photo->path = $path;
            $this->updatePostPhoto($post $photo);
        }else{
            $this->createPostPhoto($post $path);
        }

        }
    }

    public function getPhoto($id)
    {
        return Photo::find($id);
    }

    public function createPostPhoto($post $path)
    {
        $photo = new Photo;
        $photo->path = $path;
        $post->photos->save($photo);
    }

    public function updatePostPhoto(Post $post, Photo $photo)
    {
        return $post->photos->save($photo);
    }

    public function deletePhoto(Photo $photo)
    {
        $path = $photo->storagepath;
        $photo->delete();
        return $path;
    }

}
