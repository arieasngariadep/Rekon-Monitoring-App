<?php

namespace App\Imports\HoldPaymentMerchant;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class BniTolakanImport implements ToCollection, WithStartRow, WithCalculatedFormulas
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

    function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        date_default_timezone_set("Asia/Jakarta");
        foreach ($rows as $row) {
            $tanggal_settlement = $this->transformDate($row[10]);
            $tanggal = $tanggal_settlement->toDateString();
            $matchingkey = $row[2].';'.$row[7].';'.$tanggal.';'.$row[12].';';
            DB::table('bni_temp_hold_'.$this->userId.'')->insert([
                'tanggal_tolakan' => $this->transformDate($row[1]),
                'mid' => $row[2],
                'nama_merchant' => $row[3],
                'bank_name' => $row[4],
                'cust_name' => $row[5],
                'act_tolakan' => $row[6],
                'settled_amt' => $row[7],
                'tanggal_payment' => ($row[8] != NULL ? $this->transformDate($row[8]) : NULL),
                'alasan_tolakan' => $row[9],
                'tanggal_settlement' => ($row[10] != NULL ? $this->transformDate($row[10]) : NULL),
                'status' => 'OPEN',
                'jenis_tolakan' => $row[11],
                'jenis_transaksi' => $row[12]. ' HOLD PAYMENT',
                'kode_wilayah' => substr($row[2], 0, 3),
                'matchingkey' => $matchingkey,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
