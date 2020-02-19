<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Post;
use App\Photo;

class ContactController extends Controller
{
    public function create()
    {
        $random_news = Post::with(['photo', 'category', 'user', 'comments'])->where('published', 1)->inRandomOrder()->limit(5)->get();
        return view('contact.create', compact('random_news'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::to('test@test.com')->send(new ContactMail($data));
        return redirect('contact')->with('message', 'Сообщение успешно отправлено. Ожидайте ответ.');
    }
}
