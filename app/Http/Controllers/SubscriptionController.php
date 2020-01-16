<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::orderBy('id', 'desc')->paginate(5);

        if(session('success_message')){
        Alert::success( session('success_message'))->toToast();
        }

        return view('backend.subscription.index', compact('subscriptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
          'email' => 'required|email|unique:subscriptions,email|max:20'
        ]);

        $subscription = new Subscription();
        $subscription->email = request('email');
        $subscription->save();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect('dashboard/subscriptions')->withSuccessMessage('Email Deleted Successfully!');
    }
}
