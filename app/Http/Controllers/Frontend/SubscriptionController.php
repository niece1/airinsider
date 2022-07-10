<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Frontend\SubscriptionRepository;

class SubscriptionController extends Controller
{
    /**
     * Unsubscribe from newsletter mail.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        SubscriptionRepository::unsubscribe($request);

        return redirect()->route('unsubscribe', ['remember_token' => $request->remember_token]);
    }

    /**
     * Displays unsubscribe page.
     *
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe()
    {
        return view('emails.newsletter.unsubscribe');
    }
}
