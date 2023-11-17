<?php

namespace App\Imports\HoldPaymentMerchant;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\HoldPaymentMerchant\RekeningModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RekeningImport implements ToModel, WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * Transform a date value into a Carbon object.
     *
     * @return \Carbon\Carbon|null
     */
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        date_default_timezone_set("Asia/Jakarta");
        return new RekeningModel([
            'jenis_transaksi' => $row[1],
            'rek_simpanan' => $row[2],
            'nama_rek_simpanan' => $row[3],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
