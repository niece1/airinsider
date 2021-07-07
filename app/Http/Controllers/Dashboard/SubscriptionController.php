<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Subscription;
use App\Repositories\Dashboard\SubscriptionRepository;
use Illuminate\Support\Facades\Gate;

class SubscriptionController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('subscription_access'), 403);
        $subscriptions = SubscriptionRepository::getAll();

        return view('dashboard.subscription.index', compact('subscriptions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        abort_unless(Gate::allows('subscription_delete'), 403);
        SubscriptionRepository::delete($subscription);

        return redirect('dashboard/subscriptions')->withSuccessMessage('Email Deleted Successfully!');
    }
}
