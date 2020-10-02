<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\SubscriptionExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    public function exportExcel()
    {
        abort_unless(\Gate::allows('subscription_export'), 403);

        return Excel::download(new SubscriptionExport(), 'subscriptions.xlsx');
    }

    public function exportCsv()
    {
        abort_unless(\Gate::allows('subscription_export'), 403);
        
        return Excel::download(new SubscriptionExport(), 'subscriptions.csv');
    }
}
