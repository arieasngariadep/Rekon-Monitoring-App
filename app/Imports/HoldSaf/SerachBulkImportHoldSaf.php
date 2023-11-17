<?php

namespace App\Imports\HoldSaf;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SearchBulkImportHoldSaf implements ToCollection,WithHeadingRow{
    function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param Collectoin $collection
     */

     public function collection(Collection $collection){
        foreach ($collection as $row) {
            DB::table('data_bulk_holdsaf_'.$this->userId.'')->insert
            ([
                'nama_merchant' => $row['name_merchant'],
                'mid' => $row['mid'],
                'no_kartu' => $row['no_kartu'],
                'nominal' => $row['nominal'],
                'apprvl' => $row['apprvl'],
                'nama_bank' => $row['nama_bank'],
                'cust_name' => $row['cust_name'],
                'act_hold' => $row['act_hold'],
                'settled_amt' => $row['settled_amt'],
                'hold_amt' => $row['hold_amt'],
                'mdr' => $row['mdr'],
                'disc_amt' => $row['disc_amt'],
                'net_hold' => $row['net_hold'],
                'paid_amt' => $row['yang_dibayarkan'],
                'tanggal_hold' => $row['tanggal_hold'],
                'tanggal_release' => $row['tanggal_release']
            ]);
        }
     }
}