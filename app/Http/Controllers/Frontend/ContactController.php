<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ContactFormRequest;
use App\Jobs\SendContactMailJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function create()
    {
        return view('frontend.contact.create');
    }
    /**
     * Dispatch a job to send a contact mail.
     *
     * @param  \App\Http\Requests\ContactFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactFormRequest $request)
    {
        $data = $request->all();
        //dispatch(new SendContactMailJob($data));
        Mail::to('mediaairways@gmail.com')->send(new ContactMail($data));

        return redirect('contact')->withSuccess('Your message send successfully.');
    }
}
