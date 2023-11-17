<?php

namespace App\Exports\HoldPaymentMerchant;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\HoldPaymentMerchant\NonBniModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class NonBniTolakanExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithCustomValueBinder, WithColumnFormatting
{
    function __construct($mid, $status, $tanggal_tolakan, $tanggal_release, $jenis_transaksi)
    {
        $this->mid = $mid;
        $this->status = $status;
        $this->tanggal_tolakan = $tanggal_tolakan;
        $this->tanggal_release = $tanggal_release;
        $this->jenis_transaksi = $jenis_transaksi;
    }

    public function columnFormats(): array
    {
        return [
            'C' => '@',
            'D' => '@',
            'G' => '#,##0',
            'H' => '@',
            'J' => '@',
            'T' => '@',
            'X' => '@',
            'Z' => '@'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = NonBniModel::getReportTolakanNonBni($this->mid, $this->status, $this->tanggal_tolakan, $this->tanggal_release, $this->jenis_transaksi);

        if(count($data) > 0)
        {
            foreach ($data as $d) {
                $export[] = array(
                    'ID' => $d->id,
                    'TANGGAL_TOLAKAN' => $d->tanggal_tolakan,
                    'NOMOR_REFRENSI' => $d->nomor_refrensi,
                    'REKENING_DEBET' => $d->rekening_debet,
                    'NAMA_PENGIRIM' => $d->nama_pengirim,
                    'RESIDENCY_PENGIRIM ' => $d->residency_pengirim,
                    'NET_AMOUNT' => $d->net_amount,
                    'PESAN_PENGIRIM' => $d->pesan_pengirim,
                    'KODE_BANK' => $d->kode_bank,
                    'REK_PENERIMA' => $d->rek_penerima,
                    'NAMA_PENERIMA' => $d->nama_penerima,
                    'CUST_NAME_RELEASE' => $d->cust_name_release,
                    'ACT_RELEASE' => $d->act_release,
                    'JENIS_NASABAH_PENERIMA' => $d->jenis_nasabah_penerima,
                    'RESIDENCY_PENERIMA' => $d->residency_penerima,
                    'NAMA_BANK_PENERIMA' => $d->nama_bank_penerima,
                    'TANGGAL_PAYMENT' => $d->tanggal_payment,
                    'TANGGAL_REPROSES_PAYMENT' => $d->tanggal_reproses_payment,
                    'ALASAN_TOLAKAN' => $d->alasan_tolakan,
                    'MID' => $d->mid,
                    'NAMA_MERCHANT' => $d->nama_merchant,
                    'STATUS' => $d->status,
                    'JENIS_TRANSAKSI' => $d->jenis_transaksi,
                    'REK_SIMPANAN' => $d->rek_simpanan,
                    'NAMA_REK_SIMPANAN' => $d->nama_rek_simpanan,
                    'KODE_WILAYAH' => $d->kode_wilayah,
                    'NAMA_WILAYAH' => $d->nama_wilayah,
                    'MATCHINGKEY' => $d->matchingkey,
                );
            }
            return collect($export);
        }else{
            return collect($data);
        }
    }

    public function headings(): array
    {
        return [
            'ID',
            'TANGGAL_TOLAKAN',
            'NOMOR_REFRENSI',
            'REKENING_DEBET',
            'NAMA_PENGIRIM',
            'RESIDENCY_PENGIRIM ',
            'NET_AMOUNT',
            'PESAN_PENGIRIM',
            'KODE_BANK',
            'REK_PENERIMA',
            'NAMA_PENERIMA',
            'CUST_NAME_RELEASE',
            'ACT_RELEASE',
            'JENIS_NASABAH_PENERIMA',
            'RESIDENCY_PENERIMA',
            'NAMA_BANK_PENERIMA',
            'TANGGAL_PAYMENT',
            'TANGGAL_REPROSES_PAYMENT',
            'ALASAN_TOLAKAN',
            'MID',
            'NAMA_MERCHANT',
            'STATUS',
            'JENIS_TRANSAKSI',
            'REK_SIMPANAN',
            'NAMA_REK_SIMPANAN',
            'KODE_WILAYAH',
            'NAMA_WILAYAH',
            'MATCHINGKEY',
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'C' || $cell->getColumn() == 'D' || $cell->getColumn() == 'H' || $cell->getColumn() == 'J' || $cell->getColumn() == 'T' || $cell->getColumn() == 'X' || $cell->getColumn() == 'Z') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}
