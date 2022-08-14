<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class MissingSubscriptionException extends Exception
{
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        return false;
    }

    /**
     * Throwed when you click confirm link after having been unsubscribed.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render(Request $request)
    {
        $email = $request->email;

        return view('frontend.subscription.missing-subscription', compact('email'));
    }
}
