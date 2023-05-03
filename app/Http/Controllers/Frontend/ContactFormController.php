<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\ContactFormRequest;
use App\Jobs\SendContactFormMailJob;
use App\Http\Controllers\Controller;

class ContactFormController extends Controller
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
        $data = $request->getDto();
        dispatch(new SendContactFormMailJob($data));

        return redirect('contact')->withSuccess('Your message send successfully.');
    }
}
