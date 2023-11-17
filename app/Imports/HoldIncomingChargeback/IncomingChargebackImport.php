<?php

namespace App\Imports\HoldIncomingChargeback;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class IncomingChargebackImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{
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
        foreach ($rows as $row) {
            $matchingkey = $row['arn'].$row['amount'].$row['mch_number'].$row['approval'];
            DB::table('ic_temp_'.$this->userId.'')->insert([
                'wilayah' => $row['wilayah'],
                'id_' => $row['id'],
                'tgl_req_itr' => $this->transformDate($row['tgl_req_itr']),
                'nomor_kartu' => $row['nomor_kartu'],
                'arn' => $row['arn'],
                'trx_date' => $this->transformDate($row['trx_date']),
                'amount' => $row['amount'],
                'mdr' => $row['mdr'],
                'net_amount' => $row['net_amount'],
                'merchant_name' => $row['merchant_name'],
                'mch_number' => $row['mch_number'],
                'approval' => $row['approval'],
                'history' => $row['history'],
                'jenis_transaksi' => $row['jenis_transaksi'],
                'npg_cc' => $row['npg_cc'],
                'cek_bnd' => $row['cek_bnd'],
                'request_incoming' => $row['request_incoming'],
                'tgl_incoming' => $this->transformDate($row['tgl_incoming']),
                'matchingkey' => $matchingkey,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
