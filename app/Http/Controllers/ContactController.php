<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Post;
use Carbon\Carbon;

class ContactController extends Controller {

    public function create() {
        $random_news = Post::with(['photo', 'category', 'user', 'comments'])
                ->whereDate('created_at', '>', Carbon::now()->sub(20, 'days'))
                ->where('published', 1)
                ->inRandomOrder()
                ->limit(5)
                ->get();

        return view('contact.create', compact('random_news'));
    }

    public function store() {
        $data = request()->validate([
            'name' => 'bail|required|min:2',
            'email' => 'bail|required|email',
            'message' => 'required',
        ]);

        Mail::to('test@test.com')->send(new ContactMail($data));
        
        return redirect('contact')->withSuccess('Сообщение успешно отправлено. Ожидайте ответ.');      
    }
}   