<?php

namespace App\Imports\HoldSaf;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class HoldSafImport implements ToCollection, WithStartRow, WithCalculatedFormulas
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
            $tanggal_hold = $this->transformDate($row[1]);
            $tanggal = $tanggal_hold->toDateString();
            // $discAmt = $row[12] * $row[11];
            // $netHold = $row[11] - $discAmt;
            $matchingkey = $tanggal.';'.$row[2].';'.$row[4].';'.$row[6].';'.$row[14].';';
            DB::table('holdsaf_temp_hold_'.$this->userId.'')->insert([
                'tanggal_hold' => $this->transformDate($row[1]),
                'mid' => $row[2],
                'nama_merchant' => $row[3],
                'no_kartu' => $row[4],
                'nominal' => $row[5],
                'apprvl' => $row[6],
                'nama_bank' => $row[7],
                'cust_name' => $row[8],
                'act_hold' => $row[9],
                'settled_amt' => $row[10],
                'hold_amt' => $row[11],
                'mdr' => $row[12],
                'disc_amt' => $row[13],
                'net_hold' => $row[14],
                'kode_wilayah' => substr($row[2],0,3),
                'jenis_transaksi' => $row[15].' HOLD SAF',
                'alasan_hold' => $row[16],
                'matchingkey' => $matchingkey,
                'status' => 'OPEN',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
