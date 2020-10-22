<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\SubscriptionExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ExportController extends Controller
{
    /**
     * Export all subscriptions in .xlsx format.
     *
     * @return \App\Exports\SubscriptionExport
     */
    public function exportExcel()
    {
        abort_unless(Gate::allows('subscription_export'), 403);

        return Excel::download(new SubscriptionExport(), 'subscriptions.xlsx');
    }
    
    /**
     * Export all subscriptions in .csv format.
     *
     * @return \App\Exports\SubscriptionExport
     */
    public function exportCsv()
    {
        abort_unless(Gate::allows('subscription_export'), 403);
        
        return Excel::download(new SubscriptionExport(), 'subscriptions.csv');
    }
}
