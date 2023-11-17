<?php

namespace App\Models\HoldIncomingChargeback;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IncomingChargebackModel extends Model
{
    protected $table = 'incoming_chargeback';
    protected $guarded = [];

    public function getIncomingChargebackTemp($userId)
    {
        $ic = IncomingChargebackModel::select('matchingkey')->get();
        $not = DB::table('ic_temp_'.$userId.'')
        ->select('mch_number', 'approval', 'amount', 'arn', DB::raw('"Data Belum Ada" as keterangan'))
        ->whereNotIn('matchingkey', $ic);

        $data = DB::table('ic_temp_'.$userId.'')
        ->select('mch_number', 'approval', 'amount', 'arn', DB::raw('"Data Sudah Ada" as keterangan'))
        ->whereIn('matchingkey', $ic)
        ->unionAll($not)
        ->get();
        return $data;
    }

    public function countDuplicateIncomingChargeback($userId)
    {
        $ic = IncomingChargebackModel::select('matchingkey')->get();
        $data = DB::table('ic_temp_'.$userId.'')
        ->select('mch_number', 'approval', 'amount', 'arn', DB::raw('"Data Sudah Ada" as keterangan'))
        ->whereIn('matchingkey', $ic)
        ->count();
        return $data;
    }

    public function updateKodeJenisTrx($userId)
    {
        $data = DB::table('ic_temp_'.$userId.'')
        ->update(
            [
                'kode_jenis_trx' => DB::raw('CASE WHEN ic_temp_1.cek_bnd = "Ada di BND" THEN 0 ELSE CASE WHEN jenis_transaksi = "NPG OFF US" OR jenis_transaksi = "QRIS OFF US" THEN 2 ELSE 1 END END'),
            ]
        );
        return $data;
    }

    public function getInsertTempIncomingChargeback($userId)
    {
        $query = DB::table('ic_temp_'.$userId.'')
        ->select('matchingkey', 'wilayah', 'id_', 'tgl_req_itr', 'nomor_kartu', 'arn', 'trx_date', 'amount', 'mdr', 'net_amount', 'merchant_name', 'mch_number', 'approval', 'history', 'jenis_transaksi', DB::raw('ic_temp_1.kode_jenis_trx'), 'npg_cc', DB::raw('ic_temp_1.cek_bnd'), DB::raw('ic_temp_1.request_incoming'), 'tgl_incoming', DB::raw('info_incoming.proses_incoming'), DB::raw('info_incoming.final_status'), DB::raw('info_incoming.created_at'), DB::raw('info_incoming.updated_at'))
        ->join('info_incoming', function($join) use ($userId)
        {
            $join->on('info_incoming.cek_bnd', '=', 'ic_temp_'.$userId.'.cek_bnd');
            $join->on('info_incoming.request_incoming', '=', 'ic_temp_'.$userId.'.request_incoming');
            $join->on('info_incoming.kode_jenis_trx', '=', 'ic_temp_'.$userId.'.kode_jenis_trx');
        });

        $bindings = $query->getBindings();
        $insertQuery = 'INSERT into incoming_chargeback (matchingkey, wilayah, id_, tgl_req_itr, nomor_kartu, arn, trx_date, amount, mdr, net_amount, merchant_name, mch_number, approval, history, jenis_transaksi, kode_jenis_trx, npg_cc, cek_bnd, request_incoming, tgl_incoming, proses_incoming, final_status, created_at, updated_at) '. $query->toSql();
    
        return DB::insert($insertQuery, $bindings);
    }

    public function getListIncomingChargeback($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status)
    {
        $ic = new IncomingChargebackModel;
        if(isset($mch_number) || isset($approval) || isset($amount) || isset($arn) || isset($jenis_transaksi) || isset($info_status) || isset($proses_incoming) || isset($final_status))
        {
            $query = $ic
            ->join('info_incoming', function($join)
            {
                $join->on('info_incoming.cek_bnd', '=', 'incoming_chargeback.cek_bnd');
                $join->on('info_incoming.request_incoming', '=', 'incoming_chargeback.request_incoming');
                $join->on('info_incoming.kode_jenis_trx', '=', 'incoming_chargeback.kode_jenis_trx');
            });

            if(isset($mch_number))
            {
                $query->where('mch_number', $mch_number);
            }

            if(isset($approval))
            {
                $query->where('approval', $approval);
            }

            if(isset($amount))
            {
                $query->where('amount', $amount);
            }

            if(isset($arn))
            {
                $query->where('arn', $arn);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('incoming_chargeback.jenis_transaksi', $jenis_transaksi);
            }

            if(isset($info_status))
            {
                $query->where('info_status', $info_status);
            }

            if(isset($proses_incoming))
            {
                $query->where('incoming_chargeback.proses_incoming', $proses_incoming);
            }

            if(isset($final_status))
            {
                $query->where('incoming_chargeback.final_status', $final_status);
            }

            $listBni = $query->paginate(5);
            return $listBni->appends(\Request::all());
        }else{
            $query = $ic
            ->join('info_incoming', function($join)
            {
                $join->on('info_incoming.cek_bnd', '=', 'incoming_chargeback.cek_bnd');
                $join->on('info_incoming.request_incoming', '=', 'incoming_chargeback.request_incoming');
                $join->on('info_incoming.kode_jenis_trx', '=', 'incoming_chargeback.kode_jenis_trx');
            });
            $listBni = $query->whereDate('incoming_chargeback.created_at', Carbon::now()->format('Y-m-d'))->paginate(5);
            return $listBni->appends(\Request::all());
        }
    }

    public function getTotalItemAmount($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status)
    {
        $ic = new IncomingChargebackModel;
        if(isset($mch_number) || isset($approval) || isset($amount) || isset($arn) || isset($jenis_transaksi) || isset($info_status) || isset($proses_incoming) || isset($final_status))
        {
            $query = $ic::select(DB::raw('count(id) as total_item'), DB::raw('sum(amount) as total_amount'), DB::raw('sum(net_amount) as total_net_amount'));

            if(isset($mch_number))
            {
                $query->where('mch_number', $mch_number);
            }

            if(isset($approval))
            {
                $query->where('approval', $approval);
            }

            if(isset($amount))
            {
                $query->where('amount', $amount);
            }

            if(isset($arn))
            {
                $query->where('arn', $arn);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('jenis_transaksi', $jenis_transaksi);
            }

            if(isset($info_status))
            {
                $query->where('info_status', $info_status);
            }

            if(isset($proses_incoming))
            {
                $query->where('proses_incoming', $proses_incoming);
            }

            if(isset($final_status))
            {
                $query->where('final_status', $final_status);
            }

            $listBni = $query->first();
            return $listBni;
        }else{
            $query = $ic::select(DB::raw('count(id) as total_item'), DB::raw('sum(amount) as total_amount'), DB::raw('sum(net_amount) as total_net_amount'));
            $listBni = $query->whereDate('incoming_chargeback.created_at', Carbon::now()->format('Y-m-d'))->first();
            return $listBni;
        }
    }

    public static function getReportIncomingChargeback($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status)
    {
        $ic = new IncomingChargebackModel;
        if(isset($mch_number) || isset($approval) || isset($amount) || isset($arn) || isset($jenis_transaksi) || isset($info_status) || isset($proses_incoming) || isset($final_status))
        {
            $query = $ic
            ->join('info_incoming', function($join)
            {
                $join->on('info_incoming.cek_bnd', '=', 'incoming_chargeback.cek_bnd');
                $join->on('info_incoming.request_incoming', '=', 'incoming_chargeback.request_incoming');
                $join->on('info_incoming.kode_jenis_trx', '=', 'incoming_chargeback.kode_jenis_trx');
            });

            if(isset($mch_number))
            {
                $query->where('mch_number', $mch_number);
            }

            if(isset($approval))
            {
                $query->where('approval', $approval);
            }

            if(isset($amount))
            {
                $query->where('amount', $amount);
            }

            if(isset($arn))
            {
                $query->where('arn', $arn);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('incoming_chargeback.jenis_transaksi', $jenis_transaksi);
            }

            if(isset($info_status))
            {
                $query->where('info_status', $info_status);
            }

            if(isset($proses_incoming))
            {
                $query->where('incoming_chargeback.proses_incoming', $proses_incoming);
            }

            if(isset($final_status))
            {
                $query->where('incoming_chargeback.final_status', $final_status);
            }

            $listBni = $query->get();
            return $listBni;
        }
    }

    public function getIncomingChargebackById($id)
    {
        $ic = new IncomingChargebackModel;
        $data = $ic
        ->join('info_incoming', function($join)
        {
            $join->on('info_incoming.jenis_transaksi', '=', 'incoming_chargeback.jenis_transaksi');
            $join->on('info_incoming.cek_bnd', '=', 'incoming_chargeback.cek_bnd');
            $join->on('info_incoming.request_incoming', '=', 'incoming_chargeback.request_incoming');
        })
        ->where('incoming_chargeback.id', $id)->first();
        return $data;
    }

    public function deleteIncomingChargeback($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status)
    {
        $ic = new IncomingChargebackModel;
        if(isset($mch_number) || isset($approval) || isset($amount) || isset($arn) || isset($jenis_transaksi) || isset($info_status) || isset($proses_incoming) || isset($final_status))
        {
            $query = $ic
            ->join('info_incoming', function($join)
            {
                $join->on('info_incoming.cek_bnd', '=', 'incoming_chargeback.cek_bnd');
                $join->on('info_incoming.request_incoming', '=', 'incoming_chargeback.request_incoming');
                $join->on('info_incoming.kode_jenis_trx', '=', 'incoming_chargeback.kode_jenis_trx');
            });

            if(isset($mch_number))
            {
                $query->where('mch_number', $mch_number);
            }

            if(isset($approval))
            {
                $query->where('approval', $approval);
            }

            if(isset($amount))
            {
                $query->where('amount', $amount);
            }

            if(isset($arn))
            {
                $query->where('arn', $arn);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('incoming_chargeback.jenis_transaksi', $jenis_transaksi);
            }

            if(isset($info_status))
            {
                $query->where('info_status', $info_status);
            }

            if(isset($proses_incoming))
            {
                $query->where('incoming_chargeback.proses_incoming', $proses_incoming);
            }

            if(isset($final_status))
            {
                $query->where('incoming_chargeback.final_status', $final_status);
            }

            $data = $query->delete();
            return $data;
        }
    }

    public function prosesApproval($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status)
    {
        $ic = new IncomingChargebackModel;
        if(isset($mch_number) || isset($approval) || isset($amount) || isset($arn) || isset($jenis_transaksi) || isset($info_status) || isset($proses_incoming) || isset($final_status))
        {
            $query = $ic
            ->join('info_incoming', function($join)
            {
                $join->on('info_incoming.cek_bnd', '=', 'incoming_chargeback.cek_bnd');
                $join->on('info_incoming.request_incoming', '=', 'incoming_chargeback.request_incoming');
                $join->on('info_incoming.kode_jenis_trx', '=', 'incoming_chargeback.kode_jenis_trx');
            });

            if(isset($mch_number))
            {
                $query->where('mch_number', $mch_number);
            }

            if(isset($approval))
            {
                $query->where('approval', $approval);
            }

            if(isset($amount))
            {
                $query->where('amount', $amount);
            }

            if(isset($arn))
            {
                $query->where('arn', $arn);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('incoming_chargeback.jenis_transaksi', $jenis_transaksi);
            }

            if(isset($info_status))
            {
                $query->where('info_status', $info_status);
            }

            if(isset($proses_incoming))
            {
                $query->where('incoming_chargeback.proses_incoming', $proses_incoming);
            }

            if(isset($final_status))
            {
                $query->where('incoming_chargeback.final_status', $final_status);
            }

            if($proses_incoming == 'Debet Merchant kredit ke Rek Hold')
            {
                $data = $query->update([
                    'status_hold_incoming' => 'BERHASIL DEBET INCOMING CB',
                    'incoming_chargeback.final_status' => 'ON PROCESS',
                    'total_nominal_hold_incoming' => DB::raw('net_amount'),
                ]);
            }else{
                $data = $query->update([
                    'status_hold_incoming' =>  'BERHASIL DEBET INCOMING CB',
                    'incoming_chargeback.final_status' => 'ON PROCESS',
                    'total_nominal_hold_incoming' => DB::raw('amount'),
                ]);
            }

            return $data;
        }
    }

    public function prosesBatalkanApproval($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status)
    {
        $ic = new IncomingChargebackModel;
        if(isset($mch_number) || isset($approval) || isset($amount) || isset($arn) || isset($jenis_transaksi) || isset($info_status) || isset($proses_incoming) || isset($final_status))
        {
            $query = $ic
            ->join('info_incoming', function($join)
            {
                $join->on('info_incoming.cek_bnd', '=', 'incoming_chargeback.cek_bnd');
                $join->on('info_incoming.request_incoming', '=', 'incoming_chargeback.request_incoming');
                $join->on('info_incoming.kode_jenis_trx', '=', 'incoming_chargeback.kode_jenis_trx');
            });

            if(isset($mch_number))
            {
                $query->where('mch_number', $mch_number);
            }

            if(isset($approval))
            {
                $query->where('approval', $approval);
            }

            if(isset($amount))
            {
                $query->where('amount', $amount);
            }

            if(isset($arn))
            {
                $query->where('arn', $arn);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('incoming_chargeback.jenis_transaksi', $jenis_transaksi);
            }

            if(isset($info_status))
            {
                $query->where('info_status', $info_status);
            }

            if(isset($proses_incoming))
            {
                $query->where('incoming_chargeback.proses_incoming', $proses_incoming);
            }

            if(isset($final_status))
            {
                $query->where('incoming_chargeback.final_status', $final_status);
            }

            if($proses_incoming == 'Debet Merchant kredit ke Rek Hold')
            {
                $data = $query->update([
                    'status_hold_incoming' => NULL,
                    'total_nominal_hold_incoming' => NULL,
                ]);
            }else{
                $data = $query->update([
                    'status_hold_incoming' =>  NULL,
                    'total_nominal_hold_incoming' => NULL,
                ]);
            }

            return $data;
        }
    }

    public function prosesApprovalAsisten($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status)
    {
        $ic = new IncomingChargebackModel;
        if(isset($mch_number) || isset($approval) || isset($amount) || isset($arn) || isset($jenis_transaksi) || isset($info_status) || isset($proses_incoming) || isset($final_status))
        {
            $query = $ic
            ->join('info_incoming', function($join)
            {
                $join->on('info_incoming.cek_bnd', '=', 'incoming_chargeback.cek_bnd');
                $join->on('info_incoming.request_incoming', '=', 'incoming_chargeback.request_incoming');
                $join->on('info_incoming.kode_jenis_trx', '=', 'incoming_chargeback.kode_jenis_trx');
            });

            if(isset($mch_number))
            {
                $query->where('mch_number', $mch_number);
            }

            if(isset($approval))
            {
                $query->where('approval', $approval);
            }

            if(isset($amount))
            {
                $query->where('amount', $amount);
            }

            if(isset($arn))
            {
                $query->where('arn', $arn);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('incoming_chargeback.jenis_transaksi', $jenis_transaksi);
            }

            if(isset($info_status))
            {
                $query->where('info_status', $info_status);
            }

            if(isset($proses_incoming))
            {
                $query->where('incoming_chargeback.proses_incoming', $proses_incoming);
            }

            if(isset($final_status))
            {
                $query->where('incoming_chargeback.final_status', $final_status);
            }

            $data = $query->update([
                'request_incoming' =>  'Tidak Hold Incoming',
                'incoming_chargeback.prose_incoming' => 'Debet Merchant kredit ke Rek Hold',
                'total_nominal_hold_incoming' => DB::raw('net_amount'),
                'incoming_chargeback.final_status' => 'ON PROCESS',
            ]);

            return $data;
        }
    }
}
