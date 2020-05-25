<?php
namespace App\Exports;

use App\Subscription;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubscriptionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Subscription::select(['email'])->get();
    }
}
