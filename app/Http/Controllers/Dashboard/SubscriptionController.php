<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Subscription;
use App\Repositories\Dashboard\SubscriptionRepository;

class SubscriptionController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Subscription::class);
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
        $this->authorize('delete', Subscription::class);
        SubscriptionRepository::delete($subscription);

        return redirect('dashboard/subscriptions')->withSuccessMessage('Email Deleted Successfully!');
    }
}
