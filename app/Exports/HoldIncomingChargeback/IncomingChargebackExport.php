<?php

namespace App\Exports\HoldIncomingChargeback;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\HoldIncomingChargeback\IncomingChargebackModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class IncomingChargebackExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithCustomValueBinder, WithColumnFormatting
{
    function __construct($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status)
    {
        $this->mch_number = $mch_number;
        $this->approval = $approval;
        $this->amount = $amount;
        $this->arn = $arn;
        $this->jenis_transaksi = $jenis_transaksi;
        $this->info_status = $info_status;
        $this->proses_incoming = $proses_incoming;
        $this->final_status = $final_status;
    }

    public function columnFormats(): array
    {
        return [
            'C' => '@',
            'E' => '@',
            'F' => '@',
            'H' => '#,##0',
            'I' => '#,##0',
            'J' => '#,##0',
            'L' => '@',
            'M' => '@',
            'AD' => '#,##0',
        ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = IncomingChargebackModel::getReportIncomingChargeback($this->mch_number, $this->approval, $this->amount, $this->arn, $this->jenis_transaksi, $this->info_status, $this->proses_incoming, $this->final_status);
        
        if(count($data) > 0)
        {
            foreach ($data as $d) {
                $export[] = array( 
                    'ID INCOMING CHARGEBACK' => $d->id,
                    'WILAYAH' => $d->wilayah,
                    'ID' => $d->id_,
                    'TGL REQ ITR' => $d->tgl_req_itr,
                    'NOMOR KARTU' => $d->nomor_kartu,
                    'ARN' => $d->arn,
                    'TRX DATE' => $d->trx_date,
                    'AMOUNT' => $d->amount,
                    'MDR' => $d->mdr,
                    'NET AMOUNT ' => $d->net_amount,
                    'MERCHANT NAME' => $d->merchant_name,
                    'MERCHANT NUMBER' => $d->mch_number,
                    'APPROVAL' => $d->approval,
                    'HISTORY' => $d->history,
                    'JENIS TRANSAKSI ' => $d->jenis_transaksi,
                    'KODE JENIS TRANSAKSI' => $d->kode_jenis_trx,
                    'NPG CC' => $d->npg_cc,
                    'CEK BND' => $d->cek_bnd,
                    'REQUEST INCOMING' => $d->request_incoming,
                    'TGL INCOMING' => $d->tgl_incoming,
                    'PROSES INCOMING' => $d->proses_incoming,
                    'TOTAL NOMINAL HOLD INCOMING ' => $d->total_nominal_hold_incoming,
                    'STATUS HOLD INCOMING' => $d->status_hold_incoming,
                    'TGL INFO STATUS CHARGEBACK' => $d->tgl_info_status_cb,
                    'STATUS CHARGEBACK' => $d->status_cb,
                    'PROSES RKM 1' => $d->proses_rkm_1,
                    'STATUS DEBET MERCHANT ' => $d->status_debet_merchant,
                    'TGL INFO HASIL FINAL' => $d->tgl_info_hasil_final,
                    'PROSES RKM 2' => $d->proses_rkm_2,
                    'FINAL STATUS' => $d->final_status,
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
            'ID INCOMING CHARGEBACK',
            'WILAYAH',
            'ID',
            'TGL REQ ITR',
            'NOMOR KARTU',
            'ARN',
            'TRX DATE',
            'AMOUNT',
            'MDR',
            'NET AMOUNT ',
            'MERCHANT NAME',
            'MERCHANT NUMBER',
            'APPROVAL',
            'HISTORY',
            'JENIS TRANSAKSI ',
            'KODE JENIS TRANSAKSI',
            'NPG CC',
            'CEK BND',
            'REQUEST INCOMING',
            'TGL INCOMING',
            'PROSES INCOMING',
            'TOTAL NOMINAL HOLD INCOMING ',
            'STATUS HOLD INCOMING',
            'TGL INFO STATUS CHARGEBACK',
            'STATUS CHARGEBACK',
            'PROSES RKM 1',
            'STATUS DEBET MERCHANT ',
            'TGL INFO HASIL FINAL',
            'PROSES RKM 2',
            'FINAL STATUS',
            'MATCHINGKEY',
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'C' || $cell->getColumn() == 'E' || $cell->getColumn() == 'F' || $cell->getColumn() == 'L' || $cell->getColumn() == 'M' || $cell->getColumn() == 'AD') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}
