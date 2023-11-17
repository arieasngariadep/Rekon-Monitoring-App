<?php

namespace App\Exports\HoldPaymentMerchant;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\HoldPaymentMerchant\BniModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class BniTolakanExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithCustomValueBinder, WithColumnFormatting
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
            'G' => '@',
            'I' => '#,##0',
            'O' => '@',
            'Q' => '@',
            'U' => '@'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = BniModel::getReportTolakanBni($this->mid, $this->status, $this->tanggal_tolakan, $this->tanggal_release, $this->jenis_transaksi);
        
        if(count($data) > 0)
        {
            foreach ($data as $d) {
                $export[] = array( 
                    'ID' => $d->id,
                    'TANGGAL_TOLAKAN' => $d->tanggal_tolakan,
                    'MID' => $d->mid,
                    'NAMA_MERCHANT' => $d->nama_merchant,
                    'BANK_NAME' => $d->bank_name,
                    'CUST_NAME' => $d->cust_name,
                    'ACT_TOLAKAN' => $d->act_tolakan,
                    'TANGGAL_PAYMENT' => $d->tanggal_payment,
                    'SETTLED_AMT ' => $d->settled_amt,
                    'ALASAN_TOLAKAN' => $d->alasan_tolakan,
                    'TANGGAL_SETTLEMENT' => $d->tanggal_settlement,
                    'STATUS' => $d->status,
                    'JENIS_TRANSAKSI ' => $d->jenis_transaksi,
                    'JENIS_TOLAKAN ' => $d->jenis_tolakan,
                    'REK_SIMPANAN' => $d->rek_simpanan,
                    'NAMA_REK_SIMPANAN' => $d->nama_rek_simpanan,
                    'KODE_WILAYAH' => $d->kode_wilayah,
                    'NAMA_WILAYAH' => $d->nama_wilayah,
                    'BANK_NAME_RELEASE' => $d->bank_name_release,
                    'CUST_NAME_RELEASE' => $d->cust_name_release,
                    'ACT_RELEASE' => $d->act_release,
                    'TANGGAL_REPROSES_PAYMENT' => $d->tanggal_reproses_payment,
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
            'MID',
            'NAMA_MERCHANT',
            'BANK_NAME',
            'CUST_NAME',
            'ACT_TOLAKAN',
            'TANGGAL_PAYMENT',
            'SETTLED_AMT ',
            'ALASAN_TOLAKAN',
            'TANGGAL_SETTLEMENT',
            'STATUS',
            'JENIS_TRANSAKSI ',
            'JENIS_TOLAKAN ',
            'REK_SIMPANAN',
            'NAMA_REK_SIMPANAN',
            'KODE_WILAYAH',
            'NAMA_WILAYAH',
            'BANK_NAME_RELEASE',
            'CUST_NAME_RELEASE',
            'ACT_RELEASE',
            'TANGGAL_REPROSES_PAYMENT',
            'MATCHINGKEY',
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'C' || $cell->getColumn() == 'G' || $cell->getColumn() == 'O' || $cell->getColumn() == 'Q' || $cell->getColumn() == 'U') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}
