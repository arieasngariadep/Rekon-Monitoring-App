<?php

namespace App\Imports\HoldIncomingChargeback;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\HoldIncomingChargeback\InfoIncomingModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InfoIncomingImport implements ToModel, WithStartRow
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
        return new InfoIncomingModel([
            'cek_bnd' => $row[1],
            'request_incoming' => $row[2],
            'proses_incoming' => $row[3],
            'kode_jenis_trx' => $row[4],
            'final_status' => $row[5],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
