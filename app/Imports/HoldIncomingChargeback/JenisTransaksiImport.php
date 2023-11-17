<?php

namespace App\Imports\HoldIncomingChargeback;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\HoldIncomingChargeback\JenisTransaksiModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class JenisTransaksiImport implements ToModel, WithStartRow
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
        return new JenisTransaksiModel([
            'jenis_transaksi' => $row[1],
            'kode_jenis_trx' => $row[2],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
