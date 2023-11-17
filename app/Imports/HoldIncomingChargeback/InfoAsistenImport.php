<?php

namespace App\Imports\HoldIncomingChargeback;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\HoldIncomingChargeback\InfoAsistenModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InfoAsistenImport implements ToModel, WithStartRow
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
        return new InfoAsistenModel([
            'proses_incoming' => $row[1],
            'info_status' => $row[2],
            'proses_rkm_1' => $row[3],
            'final_status' => $row[4],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
