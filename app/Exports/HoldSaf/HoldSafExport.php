<?php

namespace App\Exports\HoldSaf;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\HoldSaf\HoldSafModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class HoldSafExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithCustomValueBinder, WithColumnFormatting
{
    function __construct($mid, $tanggal_hold, $tanggal_release, $status, $jenis_transaksi, $net_hold, $no_kartu)
    {
        $this->mid = $mid;
        $this->tanggal_hold = $tanggal_hold;
        $this->tanggal_release = $tanggal_release;
        $this->status = $status;
        $this->jenis_transaksi = $jenis_transaksi;
        $this->net_hold = $net_hold;
        $this->no_kartu = $no_kartu;
    }

    public function columnFormats(): array
    {
        return [
            'C' => '@',
            'E' => '@',
            'G' => '@',
            'J' => '@',
            'M' => '0.00%',
            'O' => '@',
            'T' => '@',
            'U' => '@',
            'Z' => '@'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = HoldSafModel::getReportHoldSaf($this->mid, $this->tanggal_hold, $this->tanggal_release,  $this->status, $this->jenis_transaksi, $this->net_hold, $this->no_kartu);
        
        if(count($data) > 0)
        {
            foreach ($data as $d) {
                $export[] = array( 
                    'ID' => $d->id,
                    'TANGGAL_HOLD' => $d->tanggal_hold,
                    'MID' => $d->mid,
                    'NAMA_MERCHANT' => $d->nama_merchant,
                    'NO_KARTU' => $d->no_kartu,
                    'NOMINAL' => $d->nominal,
                    'APPROVAL' => $d->apprvl,
                    'BANK_NAME' => $d->nama_bank,
                    'CUST_NAME' => $d->cust_name,
                    'ACT' => $d->act_hold,
                    'SETTLED_AMT ' => $d->settled_amt,
                    'AMOUNT_HOLD ' => $d->hold_amt,
                    'MDR ' => $d->mdr,
                    'AMOUNT_DISC ' => $d->disc_amt,
                    'NET_HOLD ' => $d->net_hold,
                    'YANG_DIBAYARKAN ' => $d->paid_amt,
                    'TANGGAL_RELEASE' => $d->tanggal_release,
                    'RELEASED_BY' => $d->released_by,
                    'ALASAN_HOLD' => $d->alasan_hold,
                    'ALASAN_RELEASE' => $d->alasan_release,
                    'KODE_WILAYAH' => $d->kode_wilayah,
                    'NAMA_WILAYAH' => $d->nama_wilayah,
                    'JENIS_TRANSAKSI' => $d->jenis_transaksi,
                    'REK_SIMPANAN' => $d->rek_simpanan,
                    'NAMA_REK_SIMPANAN' => $d->nama_rek_simpanan,
                    'MATCHINGKEY' => $d->matchingkey,
                    'STATUS' => $d->status,
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
            'TANGGAL_HOLD',
            'MID',
            'NAMA_MERCHANT',
            'NO_KARTU',
            'NOMINAL',
            'APPROVAL',
            'BANK_NAME',
            'CUST_NAME',
            'ACT',
            'SETTLED_AMT',
            'AMOUNT_HOLD',
            'MDR',
            'AMOUNT_DISC',
            'NET_HOLD',
            'YANG_DIBAYARKAN',
            'TANGGAL_RELEASE',
            'RELEASED_BY',
            'ALASAN_HOLD',
            'ALASAN_RELEASE',
            'KODE_WILAYAH',
            'NAMA_WILAYAH',
            'JENIS_TRANSAKSI ',
            'REK_SIMPANAN',
            'NAMA_REK_SIMPANAN',
            'MATCHINGKEY',
            'STATUS',

        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'C' || $cell->getColumn() == 'E' || $cell->getColumn() == 'G' || $cell->getColumn() == 'J' || $cell->getColumn() == 'O' || $cell->getColumn() == 'T' || $cell->getColumn() == 'U' || $cell->getColumn() == 'Z' ) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}
