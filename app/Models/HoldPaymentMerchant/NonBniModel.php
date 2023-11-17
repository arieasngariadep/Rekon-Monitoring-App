<?php

namespace App\Models\HoldPaymentMerchant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NonBniModel extends Model
{
    protected $table = 'non_bni';
    protected $guarded = [];

    public function getListTolakanNonBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi)
    {
        $nonBni = new NonBniModel;
        if(isset($mid) || isset($status) || isset($tanggal_tolakan) || isset($tanggal_reproses_payment) || isset($jenis_transaksi))
        {
            $query = $nonBni->select('non_bni.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
            ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'non_bni.kode_wilayah')
            ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'non_bni.jenis_transaksi');

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

            $listBni = $query->paginate(5);
            return $listBni->appends(\Request::all());
        }
    }

    public function deleteTolakanNonBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi)
    {
        $nonBni = new NonBniModel;
        if(isset($mid) || isset($status) || isset($tanggal_tolakan) || isset($tanggal_reproses_payment) || isset($jenis_transaksi))
        {
            $query = $nonBni->select('non_bni.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
            ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'non_bni.kode_wilayah')
            ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'non_bni.jenis_transaksi');

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

            $data = $query->delete();
            return $data;
        }
    }

    public static function getReportTolakanNonBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi)
    {
        $nonBni = new NonBniModel;
        if(isset($mid) || isset($status) || isset($tanggal_tolakan) || isset($tanggal_reproses_payment) || isset($jenis_transaksi))
        {
            $query = $nonBni->select('non_bni.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
            ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'non_bni.kode_wilayah')
            ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'non_bni.jenis_transaksi');

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

            $listBni = $query->get();
            return $listBni;
        }
    }

    public function getTolakanNonBniById($id)
    {
        $nonBni = new NonBniModel;
        $data = $nonBni->select('non_bni.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
        ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'non_bni.kode_wilayah')
        ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'non_bni.jenis_transaksi')
        ->where('non_bni.id', $id)->first();
        return $data;
    }

    public function getTotalAmountItemTolakanNonBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi)
    {
        $nonBni = new NonBniModel;
        if(isset($mid) || isset($status) || isset($tanggal_tolakan) || isset($tanggal_reproses_payment) || isset($jenis_transaksi))
        {
            $query = $nonBni->select(DB::raw('count(*) as total_item'), DB::raw('sum(net_amount) as total_amount'));

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

    public function getNonBniTemp($userId)
    {
        $non_bni = NonBniModel::select('matchingkey')->get();
        $not = DB::table('non_bni_temp_hold_'.$userId.'')
        ->select('tanggal_tolakan', 'mid', 'net_amount', DB::raw('"Data Belum Ada" as keterangan'), 'jenis_transaksi', 'kode_wilayah', 'matchingkey')
        ->whereNotIn('matchingkey', $non_bni);

        $data = DB::table('non_bni_temp_hold_'.$userId.'')
        ->select('tanggal_tolakan', 'mid', 'net_amount', DB::raw('"Data Sudah Ada" as keterangan'), 'jenis_transaksi', 'kode_wilayah', 'matchingkey')
        ->whereIn('matchingkey', $non_bni)
        ->unionAll($not)
        ->get();
        return $data;
    }

    public function countDuplicateNonBni($userId)
    {
        $non_bni = NonBniModel::select('matchingkey')->get();
        $data = DB::table('non_bni_temp_hold_'.$userId.'')
        ->select('tanggal_tolakan', 'mid', 'net_amount', DB::raw('"Data Sudah Ada" as keterangan'))
        ->whereIn('matchingkey', $non_bni)
        ->count();
        return $data;
    }

    public function countDuplicateNonBniTemp($userId)
    {
        $sub = DB::table('non_bni_temp_hold_'.$userId.'')->select('matchingkey')->groupBy('matchingkey')->having(DB::raw('count(matchingkey)'), '>', 1);

        $count = DB::table(DB::raw('('.$sub->toSql().') as o1'))
        ->mergeBindings($sub)
        ->count();

        return $count;
    }

    public function prosesBatalkanRelease($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi)
    {
        $nonBni = new NonBniModel;
        if(isset($mid) || isset($status) || isset($tanggal_tolakan) || isset($tanggal_reproses_payment) || isset($jenis_transaksi))
        {
            $query = $nonBni->select('non_bni.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
            ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'non_bni.kode_wilayah')
            ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'non_bni.jenis_transaksi');

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
                'cust_name_release' => NULL,
                'act_release' => NULL,
                'tanggal_reproses_payment' => NULL,
                'status' => 'OPEN',
            ]);
            return $data;
        }
    }
}
