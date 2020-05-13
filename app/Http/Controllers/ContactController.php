<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use App\Http\Requests\ContactFormRequest;
use App\Jobs\SendContactMailJob;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller {

    public function createSlider()
    {
        $random_news = Cache::remember('random_news', now()->addSeconds(config('app.cache')), function() {
            return Post::with(['photo', 'category', 'user', 'comments', 'comments.replies'])
                ->whereDate('created_at', '>', Carbon::now()->sub(20, 'days'))
                ->where('published', 1)
                ->inRandomOrder()
                ->limit(5)
                ->get();
        });
        
        return view('contact.create', compact('random_news'));
    }

    public function storeContactForm(ContactFormRequest $request)
    {
        $data = $request->all();
        dispatch(new SendContactMailJob($data));

        return redirect('contact')->withSuccess('Сообщение успешно отправлено. Ожидайте ответ.');
    }
}
