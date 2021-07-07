<?php

namespace App\Exports;

use App\Models\Subscription;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubscriptionExport implements FromCollection
{
    /**
     * Get all emails.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Subscription::select(['email'])->get();
    }
}
