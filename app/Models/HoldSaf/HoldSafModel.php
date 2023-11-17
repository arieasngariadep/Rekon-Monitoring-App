<?php

namespace App\Models\HoldSaf;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HoldSafModel extends Model
{
    protected $table = 'holdsaf';
    protected $guarded = [];


    public function getListHoldSaf($mid, $status, $tanggal_hold, $tanggal_release, $jenis_transaksi, $net_hold,$no_kartu){ 
    
    $holdSaf = new HoldSafModel;
    $query = $holdSaf->select('holdsaf.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
    ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'holdsaf.kode_wilayah')
    ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'holdsaf.jenis_transaksi')
    ->orderBy('holdsaf.tanggal_hold','DESC');

        if(isset($mid)){
            $query->where('mid',$mid);
        }
        
        if(isset($status)){
            $query->where('status',$status);
        }
        
        if(isset($tanggal_hold)){
            $query->where('tanggal_hold',$tanggal_hold);
        }
    
        if(isset($tanggal_release)){
            $query->where('tanggal_release',$tanggal_release);
        }
    
        if(isset($jenis_transaksi)){
            $query->where('holdsaf.jenis_transaksi',$jenis_transaksi);
        }
        
        if(isset($net_hold)){
            $query->where('net_hold',$net_hold);
        }
    
        if(isset($no_kartu)){
            $query->where('no_kartu');
        }

        $listHoldSaf = $query->get();
    
        return $listHoldSaf;

    }

    public function getHoldSafList(){
        $holdsaf = new HoldSafModel;
        $data = $holdsaf->select('holdsaf.matchingkey')->get();
        return $data;
    }

    public function countDuplicateHoldSaf($userId)
    {
        $holdSaf = HoldSafModel::select('matchingkey')->get();
        $data = DB::table('holdsaf_temp_hold_'.$userId.'')
        ->select('tanggal_hold', 'mid', 'net_hold', DB::raw('"Data Sudah Ada" as keterangan'))
        ->whereIn('matchingkey', $holdSaf)
        ->count();
        return $data;
    }

    public function countDuplicateHoldSafTemp($userId)
    {
        $sub = DB::table('holdsaf_temp_hold_'.$userId.'')->select('matchingkey')->groupBy('matchingkey')->having(DB::raw('count(matchingkey)'), '>', 1);

        $count = DB::table(DB::raw('('.$sub->toSql().') as o1'))
        ->mergeBindings($sub)
        ->count();

        return $count;
    }

    public function getHoldSafTemp($userId){
        $data = DB::table('holdsaf_temp_hold_'.$userId.'')
        ->select('id', 'tanggal_hold', 'mid','no_kartu', 'apprvl', 'net_hold', 'jenis_transaksi', 'kode_wilayah', 'matchingkey')->get();
        return $data;
    }

    public function getMatchingKeyTemp($userId){
        $data = DB::table('holdsaf_temp_hold_'.$userId.'')->select('matchingkey')->get();
        return $data;
    }

    public function updatePaidHoldSaf($userId){
        $results = DB::table('holdsaf_temp_hold_'.$userId.' as q2')
        ->select('q2.mid', 'q2.tanggal_hold', DB::raw('q2.settled_amt - q1.sum_net_hold as result'))
        ->join(DB::raw('(SELECT id, mid, tanggal_hold, SUM(net_hold) AS sum_net_hold FROM holdsaf_temp_hold_'.$userId.' GROUP BY mid, tanggal_hold) as q1'), function ($join) {
            $join->on('q1.mid', '=', 'q2.mid');
            $join->on('q1.tanggal_hold', '=', 'q2.tanggal_hold');
        })
        ->get();

        // Insert the results into the 'holdsaf' table
        foreach ($results as $result) {
            DB::table('holdsaf_temp_hold_'.$userId.'')
                ->where('mid', $result->mid)
                ->where('tanggal_hold', $result->tanggal_hold)
                ->update(['paid_amt' => $result->result]);
        }

        return $result;
    }

    public function getReportHoldSaf($mid, $tanggal_hold, $tanggal_release, $status, $jenis_transaksi, $net_hold, $no_kartu){
        
        $holdSaf = new HoldSafModel;
        if(isset($mid) || isset($tanggal_hold) || isset($tanggal_release) || isset($status) || isset($jenis_transaksi) || isset($net_hold) || isset($no_kartu)){
        
        $query = $holdSaf->select('holdsaf.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
        ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'holdsaf.kode_wilayah')
        ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'holdsaf.jenis_transaksi');

        if(isset($mid)){
            $query->where('mid',$mid);
        }
        
        if(isset($tanggal_hold)){
            $query->where('tanggal_hold',$tanggal_hold);
        }
    
        if(isset($tanggal_release)){
            $query->where('tanggal_release',$tanggal_release);
        }

        if(isset($status)){
            $query->where('status',$status);
        }
    
        if(isset($jenis_transaksi)){
            $query->where('holdsaf.jenis_transaksi',$jenis_transaksi);
        }
        
        if(isset($net_hold)){
            $query->where('net_hold',$net_hold);
        }
    
        if(isset($no_kartu)){
            $query->where('no_kartu');
        }

        $data = $query->get();
        return $data;
        }
        
    }

    public function deleteHoldSaf($mid, $tanggal_hold, $tanggal_release, $status, $jenis_transaksi, $net_hold, $no_kartu){
        $holdSaf = new HoldSafModel;
        if(isset($mid) || isset($tanggal_hold) || isset($tanggal_release) || isset($status) || isset($jenis_transaksi) || isset($net_hold) || isset($no_kartu))
        {
            $query = $holdSaf->select('holdsaf.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
            ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'holdsaf.kode_wilayah')
            ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'holdsaf.jenis_transaksi');

            if(isset($mid))
            {
                $query->where('mid', $mid);
            }

            if(isset($tanggal_hold))
            {
                $query->where('tanggal_hold', $tanggal_hold);
            }

            if(isset($tanggal_release))
            {
                $query->where('tanggal_release', $tanggal_release);
            }

            if(isset($status))
            {
                $query->where('status', $status);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('holdsaf.jenis_transaksi', $jenis_transaksi);
            }
            
            if(isset($net_hold))
            {
                $query->where('net_hold', $net_hold);
            }

            if(isset($no_kartu))
            {
                $query->where('no_kartu', $no_kartu);
            }

            $data = $query->delete();
            return $data;
        }
    }

    public function cancelReleaseHoldSaf($mid, $tanggal_hold, $tanggal_release, $status, $jenis_transaksi, $net_hold, $no_kartu){
        $holdSaf = new HoldSafModel;
        if(isset($mid) || isset($tanggal_hold) || isset($tanggal_release) || isset($status) || isset($jenis_transaksi) || isset($net_hold) || isset($no_kartu))
        {
            $query = $holdSaf->select('holdsaf.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
            ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'holdsaf.kode_wilayah')
            ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'holdsaf.jenis_transaksi');

            if(isset($mid))
            {
                $query->where('mid', $mid);
            }

            if(isset($tanggal_hold))
            {
                $query->where('tanggal_hold', $tanggal_hold);
            }

            if(isset($tanggal_release))
            {
                $query->where('tanggal_release', $tanggal_release);
            }

            if(isset($status))
            {
                $query->where('status', $status);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('holdsaf.jenis_transaksi', $jenis_transaksi);
            }

            if(isset($net_hold))
            {
                $query->where('holdsaf.net_hold', $net_hold);
            }

            if(isset($no_kartu))
            {
                $query->where('holdsaf.no_kartu', $no_kartu);
            }

            $data = $query->update([
                'released_by' => NULL,
                'alasan_release' => NULL,
                'tanggal_release' => NULL,
                'status' => 'OPEN',
            ]);
            
            return $data;
        }
    }

}
