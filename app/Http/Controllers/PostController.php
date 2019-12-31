<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

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
       // dd($posts);
        

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
          'image' => 'sometimes|file|image|max:5000',
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
        $this->storeImage($request, $post);

        $this->syncTags($post);

        toast('Post Created Successfully','success')->position('top-end')->padding('30px')->autoClose(5000);

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
        $post = Post::where('id', $post->id)->firstOrFail();
     
        return view('backend.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('backend.post.edit', compact('categories', 'tags', 'post'));
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
        $this->validate($request, [
          'title' => 'required|min:3',
          'body' => 'required',
          'time_to_read' => 'required',
          'published' => 'required',
          'category_id' => 'required',
          'image' => 'sometimes|file|image|max:5000',
      ]);

        $post->update([
           'title' => $request->title,
           'body' => $request->body,
           'category_id' => $request->category_id,
           'slug'=> Str::slug($request->title, '-'),
           'published' => $request->published,
           'time_to_read' => $request->time_to_read,
           'user_id' => Auth::id()
       ]);

        $this->storeImage($request, $post);

        $this->syncTags($post);
    
        toast('Post Updated Successfully','success')->position('top-end')->padding('30px')->autoClose(5000);
       
        return redirect('dashboard/posts');

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

        if($post->tags) {
        $this->detachTags($post);
        }

        if($post->photo) {
        $this->deletePhoto($post->photo->id);
        }
      
        toast('Post Deleted','success')->position('top-end')->padding('30px')->autoClose(5000);
   
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
          'image' => 'sometimes|file|image|max:5000',
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

   private function storeImage(Request $request, Post $post)
   {
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('posts', 'public');
                if($post->photo)
                {
                $photo = $this->getPhoto($post->photo->id);
                Storage::disk('public')->delete($photo->storagepath);
                $photo->path = $path;
                $this->updatePostPhoto($post, $photo);
            }
            else
            {
                $this->createPostPhoto($post, $path);
            }
        }
    }

    public function getPhoto($id)
    {
        return Photo::find($id);
    }

    public function createPostPhoto($post, $path)
    {
        $photo = new Photo;
        $photo->path = $path;
        $post->photo()->save($photo);
    }

    public function updatePostPhoto(Post $post, Photo $photo)
    {
        return $post->photo()->save($photo);
    }

    public function deletePhoto($id)
    {
        $photo = $this->getPhoto($id);       
               
        Storage::disk('public')->delete($photo->storagepath); 
        $photo->delete($id);

        return redirect()->back();
    }

}
