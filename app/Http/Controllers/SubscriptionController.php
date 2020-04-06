<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Http\Requests\SubscriptionRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\SubscriptionExport;
use Maatwebsite\Excel\Facades\Excel;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('subscription_access'), 403);

        $subscriptions = Subscription::orderBy('id', 'desc')->paginate(25);

        if(session('success_message')){
        Alert::success( session('success_message'))->toToast();
        }

        return view('backend.subscription.index', compact('subscriptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SubscriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriptionRequest $request)
    {     
        Subscription::create($request->all());        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        abort_unless(\Gate::allows('subscription_delete'), 403);

        $subscription->delete();

        return redirect('dashboard/subscriptions')->withSuccessMessage('Email Deleted Successfully!');
    }

    public function exportExcel() 
    {
        abort_unless(\Gate::allows('subscription_export'), 403);

        return Excel::download(new SubscriptionExport, 'subscriptions.xlsx');
    }

    public function exportCsv() 
    {
        abort_unless(\Gate::allows('subscription_export'), 403);
        
        return Excel::download(new SubscriptionExport, 'subscriptions.csv');
    }
}
