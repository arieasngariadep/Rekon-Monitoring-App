<?php

namespace App\Imports\HoldPaymentMerchant;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class NonBniTolakanImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas
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
            $tanggal_tolakan = $this->transformDate($row['tanggal_tolakan']);
            $tanggal = $tanggal_tolakan->toDateString();
            $matchingkey = $tanggal.';'.$row['mid'].';'.$row['net_amount'].';';
            DB::table('non_bni_temp_hold_'.$this->userId.'')->insert([
                'tanggal_tolakan' => $this->transformDate($row['tanggal_tolakan']),
                'nomor_refrensi' => $row['nomor_refrensi'],
                'rekening_debet' => $row['rekening_debet'],
                'nama_pengirim' => $row['nama_pengirim'],
                'residency_pengirim' => $row['residency_pengirim'],
                'net_amount' => $row['net_amount'],
                'pesan_pengirim' => $row['pesan_pengirim'],
                'kode_bank' => $row['kode_bank'],
                'rek_penerima' => $row['rek_penerima'],
                'nama_penerima' => $row['nama_penerima'],
                'jenis_nasabah_penerima' => $row['jenis_nasabah_penerima'],
                'residency_penerima' => $row['residency_penerima'],
                'nama_bank_penerima' => $row['nama_bank_penerima'],
                'tanggal_payment' => ($row['tanggal_payment'] != NULL ? $this->transformDate($row['tanggal_payment']) : $row['tanggal_payment']),
                'alasan_tolakan' => $row['alasan_tolakan'],
                'mid' => $row['mid'],
                'nama_merchant' => $row['nama_merchant'],
                'status' => 'OPEN',
                'jenis_transaksi' => $row['jenis_transaksi']. ' HOLD PAYMENT',
                'kode_wilayah' => substr($row['mid'], 0, 3),
                'matchingkey' => $matchingkey,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
