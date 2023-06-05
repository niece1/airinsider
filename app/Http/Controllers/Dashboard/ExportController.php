<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\SubscriptionExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    /**
     * Export all subscriptions in .xlsx format.
     *
     * @return \App\Exports\SubscriptionExport
     */
    public function exportExcel()
    {
        $this->authorize('export', Subscription::class);

        return Excel::download(new SubscriptionExport(), 'subscriptions.xlsx');
    }

    /**
     * Export all subscriptions in .csv format.
     *
     * @return \App\Exports\SubscriptionExport
     */
    public function exportCsv()
    {
        $this->authorize('export', Subscription::class);

        return Excel::download(new SubscriptionExport(), 'subscriptions.csv');
    }
}
