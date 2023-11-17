<?php

namespace App\Imports\HoldSaf;

use App\Models\HoldSaf\HoldSafModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class ImportUpdateBulkHoldSaf implements ToModel, WithStartRow, WithCalculatedFormulas
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
            $tanggal_settlement = $this->transformDate($row[10]);
            $tanggal = $tanggal_settlement->toDateString();
            $matchingkey =  $tanggal.';'.$row[2].';'.$row[4].';'.$row[6].';'.$row[14].';';
            BniModel::where('id', $row[0])
                ->update([
                    'tanggal_tolakan' => $this->transformDate($row[1]),
                    'mid' => $row[2],
                    'nama_merchant' => $row[3],
                    'bank_name' => $row[4],
                    'cust_name' => $row[5],
                    'act_tolakan' => $row[6],
                    'tanggal_payment' => ($row[7] != NULL ? $this->transformDate($row[7]) : NULL),
                    'settled_amt' => $row[8],
                    'alasan_tolakan' => $row[9],
                    'tanggal_settlement' => ($row[10] != NULL ? $this->transformDate($row[10]):NULL),
                    'status' => $row[11],
                    'jenis_transaksi' => $row[12],
                    'jenis_tolakan' => $row[13],
                    'bank_name_release' => $row[18],
                    'cust_name_release' => $row[19],
                    'act_release' => $row[20],
                    'tanggal_reproses_payment' => ($row[21] != NULL ? $this->transformDate($row[21]):NULL),
                    'kode_wilayah' => substr($row[2], 0, 3),
                    'matchingkey' => $matchingkey, 
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
        
    }
}
