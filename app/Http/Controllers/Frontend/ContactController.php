<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ContactFormRequest;
use App\Jobs\SendContactMailJob;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Dispatch a job to send a contact mail.
     *
     * @param  \App\Http\Requests\ContactFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactFormRequest $request)
    {
        $data = $request->all();
        dispatch(new SendContactMailJob($data));

        return redirect('contact')->withSuccess('Сообщение успешно отправлено. Ожидайте ответ.');
    }
}
