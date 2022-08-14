<?php

namespace App\Exceptions;

use Exception;

class AlreadyUnsubscribedException extends Exception
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
     * Throwed when you click unsubscribe link after having been already unsubscribed.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view('frontend.subscription.already-unsubscribed');
    }
}
