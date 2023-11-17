<?php

namespace App\Imports\HoldPaymentMerchant;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SearchBulkImportTolakan implements ToCollection,WithHeadingRow{
    function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param Collectoin $collection
     */

     public function collection(Collection $collection){
        foreach ($collection as $row) {
            DB::table('data_bulk_tolakan_'.$this->userId.'')->insert
            ([
                'mid' => $row['mid']
            ]);
        }
     }
}