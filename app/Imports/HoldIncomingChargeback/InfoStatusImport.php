<?php

namespace App\Imports\HoldIncomingChargeback;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\HoldIncomingChargeback\InfoStatusModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InfoStatusImport implements ToModel, WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        date_default_timezone_set("Asia/Jakarta");
        return new InfoStatusModel([
            'info_status' => $row[1],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
