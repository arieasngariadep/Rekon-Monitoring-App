<?php

namespace App\Models\HoldPaymentMerchant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BniModel extends Model
{
    protected $table = 'bni';
    protected $guarded = [];

    public function getListTolakanBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi, $settled_amt)
    {
        $bni = new BniModel;
        $query = $bni->select('bni.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
        ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'bni.kode_wilayah')
        ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'bni.jenis_transaksi')
        ->orderBy('bni.tanggal_tolakan','desc');

        if(isset($mid) || isset($status) || isset($tanggal_tolakan) || isset($tanggal_reproses_payment) || isset($jenis_transaksi) || isset($settled_amt))
        {

            if(isset($mid))
            {
                $query->where('mid', $mid);
            }

            if(isset($status))
            {
                $query->where('status', $status);
            }

            if(isset($tanggal_tolakan))
            {
                $query->where('tanggal_tolakan', $tanggal_tolakan);
            }

            if(isset($tanggal_reproses_payment))
            {
                $query->where('tanggal_reproses_payment', $tanggal_reproses_payment);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('bni.jenis_transaksi', $jenis_transaksi);
            }

            if(isset($settled_amt))
            {
                $query->where('bni.settled_amt', $settled_amt);
            }
        }
        $listBni = $query->paginate(25);
        return $listBni->appends(\Request::all());
    }
    
    public function getTransaksiByWilayahKredit(){
        $bni = new BniModel;

        $data = $bni->select("bni.kode_wilayah","wilayah.nama_wilayah",
        DB::raw("COUNT(CASE WHEN bni.status = 'OPEN' THEN 1 END) AS jumlah_open"),
        DB::raw("COUNT(CASE WHEN bni.status = 'CLOSED-DONE' THEN 1 END) AS jumlah_closed"))
        ->join('wilayah','wilayah.kode_wilayah', '=', 'bni.kode_wilayah')
        ->where('bni.jenis_transaksi','=','KREDIT')
        ->groupBy('wilayah.nama_wilayah')->get();
        return $data;
    }

    public function getTransaksiByWilayahLink(){
        $bni = new BniModel;

        $data = $bni->select("bni.kode_wilayah","wilayah.nama_wilayah",
        DB::raw("COUNT(CASE WHEN bni.status = 'OPEN' THEN 1 END) AS jumlah_open"),
        DB::raw("COUNT(CASE WHEN bni.status = 'CLOSED-DONE' THEN 1 END) AS jumlah_closed"))
        ->join('wilayah','wilayah.kode_wilayah', '=', 'bni.kode_wilayah')
        ->where('bni.jenis_transaksi','=','LINK AJA')
        ->groupBy('wilayah.nama_wilayah')->get();
        return $data;
    }

    public function getTransaksiByWilayahDebit(){
        $bni = new BniModel;

        $data = $bni->select("bni.kode_wilayah","wilayah.nama_wilayah",
        DB::raw("COUNT(CASE WHEN bni.status = 'OPEN' THEN 1 END) AS jumlah_open"),
        DB::raw("COUNT(CASE WHEN bni.status = 'CLOSED-DONE' THEN 1 END) AS jumlah_closed"))
        ->join('wilayah','wilayah.kode_wilayah', '=', 'bni.kode_wilayah')
        ->where('bni.jenis_transaksi','=','DEBIT')
        ->groupBy('wilayah.nama_wilayah')->get();
        return $data;
    }

    public function getTransaksiByWilayahTap(){
        $bni = new BniModel;

        $data = $bni->select("bni.kode_wilayah","wilayah.nama_wilayah",
        DB::raw("COUNT(CASE WHEN bni.status = 'OPEN' THEN 1 END) AS jumlah_open"),
        DB::raw("COUNT(CASE WHEN bni.status = 'CLOSED-DONE' THEN 1 END) AS jumlah_closed"))
        ->join('wilayah','wilayah.kode_wilayah', '=', 'bni.kode_wilayah')
        ->where('bni.jenis_transaksi','=','TAPCASH')
        ->groupBy('wilayah.nama_wilayah')->get();
        return $data;
    }

    public function getTransaksiByWilayahQris(){
        $bni = new BniModel;

        $data = $bni->select("bni.kode_wilayah","wilayah.nama_wilayah",
        DB::raw("COUNT(CASE WHEN bni.status = 'OPEN' THEN 1 END) AS jumlah_open"),
        DB::raw("COUNT(CASE WHEN bni.status = 'CLOSED-DONE' THEN 1 END) AS jumlah_closed"))
        ->join('wilayah','wilayah.kode_wilayah', '=', 'bni.kode_wilayah')
        ->where('bni.jenis_transaksi','=','QRIS')
        ->groupBy('wilayah.nama_wilayah')->get();
        return $data;
    }

    public function getTransaksiByJumlahTrx(){
        $bni = new BniModel;

        $data = $bni->select('rekening.jenis_transaksi',DB::raw('count(distinct(mid)) as jumlah_mid'),DB::raw('count(settled_amt) as jumlah_transaksi'), DB::raw('sum(settled_amt) as total_amount'))
            ->rightJoin('rekening','rekening.jenis_transaksi','=','bni.jenis_transaksi')
            ->whereNull('bni.status')
            ->orWhere('bni.status','=','OPEN')
            ->groupBy('rekening.jenis_transaksi')->get();
        return $data;
    }

    public function deleteTolakanBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi)
    {
        $bni = new BniModel;
        if(isset($mid) || isset($status) || isset($tanggal_tolakan) || isset($tanggal_reproses_payment) || isset($jenis_transaksi))
        {
            $query = $bni->select('bni.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
            ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'bni.kode_wilayah')
            ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'bni.jenis_transaksi');

            if(isset($mid))
            {
                $query->where('mid', $mid);
            }

            if(isset($status))
            {
                $query->where('status', $status);
            }

            if(isset($tanggal_tolakan))
            {
                $query->where('tanggal_tolakan', $tanggal_tolakan);
            }

            if(isset($tanggal_reproses_payment))
            {
                $query->where('tanggal_reproses_payment', $tanggal_reproses_payment);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('bni.jenis_transaksi', $jenis_transaksi);
            }

            $data = $query->delete();
            return $data;
        }
    }

    public static function getReportTolakanBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi)
    {
        $bni = new BniModel;
        if(isset($mid) || isset($status) || isset($tanggal_tolakan) || isset($tanggal_reproses_payment) || isset($jenis_transaksi))
        {
            $query = $bni->select('bni.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
            ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'bni.kode_wilayah')
            ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'bni.jenis_transaksi');

            if(isset($mid))
            {
                $query->where('mid', $mid);
            }

            if(isset($status))
            {
                $query->where('status', $status);
            }

            if(isset($tanggal_tolakan))
            {
                $query->where('tanggal_tolakan', $tanggal_tolakan);
            }

            if(isset($tanggal_reproses_payment))
            {
                $query->where('tanggal_reproses_payment', $tanggal_reproses_payment);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('bni.jenis_transaksi', $jenis_transaksi);
            }

            $listBni = $query->get();
            return $listBni;
        }
    }

    public static function getReportSearchBulkExportTolakan($userId)
    {
        $data = DB::table('result_searchbulk_tolakan_'.$userId.'')->get();
        return $data;
    }
    
    public function getTolakanBniById($id)
    {
        $bni = new BniModel;
        $data = $bni->select('bni.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
        ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'bni.kode_wilayah')
        ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'bni.jenis_transaksi')
        ->where('bni.id', $id)->first();
        return $data;
    }

    public function getTotalAmountItemTolakanBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi)
    {
        $bni = new BniModel;
        if(isset($mid) || isset($status) || isset($tanggal_tolakan) || isset($tanggal_reproses_payment) || isset($jenis_transaksi))
        {
            $query = $bni->select(DB::raw('count(*) as total_item'), DB::raw('sum(settled_amt) as total_amount'));

            if(isset($mid))
            {
                $query->where('mid', $mid);
            }

            if(isset($status))
            {
                $query->where('status', $status);
            }

            if(isset($tanggal_tolakan))
            {
                $query->where('tanggal_tolakan', $tanggal_tolakan);
            }

            if(isset($tanggal_reproses_payment))
            {
                $query->where('tanggal_reproses_payment', $tanggal_reproses_payment);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('jenis_transaksi', $jenis_transaksi);
            }

            $listBni = $query->first();
            return $listBni;
        }
    }

    public function getBniList(){
        $bni = new BniModel;
        $data = $bni->select('bni.matchingkey')->get();
        return $data;
    }

    public function getBniTemp($userId)
    {

        // $bni = BniModel::select('matchingkey')->get();
        // $not = DB::table('bni_temp_'.$userId.'')
        // ->select('id', 'tanggal_tolakan', 'mid', 'settled_amt', DB::raw('"Data Belum Ada" as keterangan'), 'jenis_transaksi', 'kode_wilayah', 'matchingkey', 'jenis_tolakan')
        // ->whereNotIn('matchingkey', $bni);

        // // select matchingkey from bni where exist in bni_temp table
        // $data = DB::table('bni_temp_'.$userId.'')
        // ->select('id', 'tanggal_tolakan', 'mid','settled_amt', 'jenis_transaksi', 'kode_wilayah', 'matchingkey', 'jenis_tolakan')
        // ->whereIn('matchingkey', $bni)
        // ->unionAll($not)
        // ->get();

        // select matchingkey from bni where exist in bni_temp table
        $data = DB::table('bni_temp_hold_'.$userId.'')
        ->select('id', 'tanggal_tolakan', 'mid','settled_amt', 'jenis_transaksi', 'kode_wilayah', 'matchingkey', 'jenis_tolakan')->get();
        return $data;
    }

    public function getMatchingKeyTemp($userId){
        $data = DB::table('bni_temp_hold_'.$userId.'')->select('matchingkey')->get();
        return $data;
    }

    public function countDuplicateBni($userId)
    {
        $bni = BniModel::select('matchingkey')->get();
        $data = DB::table('bni_temp_hold_'.$userId.'')
        ->select('tanggal_tolakan', 'mid', 'settled_amt', DB::raw('"Data Sudah Ada" as keterangan'))
        ->whereIn('matchingkey', $bni)
        ->count();
        return $data;
    }

    public function countDuplicateBniTemp($userId)
    {
        $sub = DB::table('bni_temp_hold_'.$userId.'')->select('matchingkey')->groupBy('matchingkey')->having(DB::raw('count(matchingkey)'), '>', 1);

        $count = DB::table(DB::raw('('.$sub->toSql().') as o1'))
        ->mergeBindings($sub)
        ->count();

        return $count;
    }

    public function prosesBatalkanRelease($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi)
    {
        $bni = new BniModel;
        if(isset($mid) || isset($status) || isset($tanggal_tolakan) || isset($tanggal_reproses_payment) || isset($jenis_transaksi))
        {
            $query = $bni->select('bni.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
            ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'bni.kode_wilayah')
            ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'bni.jenis_transaksi');

            if(isset($mid))
            {
                $query->where('mid', $mid);
            }

            if(isset($status))
            {
                $query->where('status', $status);
            }

            if(isset($tanggal_tolakan))
            {
                $query->where('tanggal_tolakan', $tanggal_tolakan);
            }

            if(isset($tanggal_reproses_payment))
            {
                $query->where('tanggal_reproses_payment', $tanggal_reproses_payment);
            }

            if(isset($jenis_transaksi))
            {
                $query->where('bni.jenis_transaksi', $jenis_transaksi);
            }

            $data = $query->update([
                'bank_name_release' => NULL,
                'cust_name_release' => NULL,
                'act_release' => NULL,
                'tanggal_reproses_payment' => NULL,
                'status' => 'OPEN',
            ]);
            
            return $data;
        }
    }

    public function updateTrimBni($userId)
    {
        $query = DB::table('bni_temp_hold_'.$userId.'')
        ->update([
            'jenis_tolakan' => DB::raw('trim(jenis_tolakan)')
        ]);
        return $query;
    }
}
