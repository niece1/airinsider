<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ContactFormRequest;
use App\Jobs\SendContactMailJob;
use App\Http\Controllers\Controller;
use App\Interfaces\Frontend\PostRepositoryInterface;

class ContactController extends Controller
{
    private $postRepository;
    
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $random_posts = $this->postRepository->getRandom();
        
        return view('frontend.contact.index', compact('random_posts'));
    }

    public function store(ContactFormRequest $request)
    {
        $data = $request->all();
        dispatch(new SendContactMailJob($data));

        return redirect('contact')->withSuccess('Сообщение успешно отправлено. Ожидайте ответ.');
    }
}
