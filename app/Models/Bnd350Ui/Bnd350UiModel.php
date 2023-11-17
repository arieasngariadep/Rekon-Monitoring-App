<?php

namespace App\Models\Bnd350Ui;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bnd350UiModel extends Model
{
    protected $table = 'bnd350ui';
    protected $guarded = [];
    public $timestamps = false;
    protected $fillable = ['id', 'mid', 'mname', 'alamat', 'account_number', 'proc_date', 'oo_batch', 'batch', 'seqnum', 'type', 'txn_date', 'auth', 'cardnum', 'amount', 'rate', 'disc_amount', 'created_at', 'updated_at'];


    public function getListBND350UI($txn_date, $proc_date, $mid, $cardnum, $auth, $amount)
    {
        if(isset($txn_date) || isset($proc_date) || isset($mid) || isset($cardnum) || isset($auth) || isset($amount))
        {
            $query = BND350UIModel::select('*');
            if(isset($txn_date))
            {
                $query->where('txn_date', $txn_date);
            }

            if(isset($proc_date))
            {
                $query->where('proc_date', $proc_date);
            }

            if(isset($mid))
            {
                $query->where('mid', $mid);
            }

            if(isset($cardnum))
            {
                $query->where('cardnum', $cardnum);
            }

            if(isset($auth))
            {
                $query->where('auth', $auth);
            }

            if(isset($amount))
            {
                $query->where('amount', $amount);
            }

            $listBND = $query->paginate(5);
            return $listBND->appends(Request::all());
        }
    }

    public function getDataReport($txn_date, $proc_date, $txn_date2, $proc_date2)
    {
        $bnd = new BND350UIModel;
        if($txn_date != NULL || $proc_date != NULL || $txn_date2 != NULL || $proc_date2 != NULL)
        {
            $query = $bnd->select('*');

            if($txn_date != NULL && $txn_date2 != NULL)
            {
                $query->whereBetween('txn_date', [$txn_date, $txn_date2]);
            }

            if($proc_date != NULL && $proc_date2 != NULL)
            {
                $query->whereBetween('proc_date', [$proc_date, $proc_date2]);
            }

            $data = $query->get();
            return $data;
        }
    }

    public static function getDataReportExport($txn_date, $proc_date, $txn_date2, $proc_date2)
    {
        $bnd = new BND350UIModel;
        $query = $bnd->select('*');

        if($txn_date != NULL && $txn_date2 != NULL)
        {
            $query->whereBetween('txn_date', [$txn_date, $txn_date2]);
        }

        if($proc_date != NULL && $proc_date2 != NULL)
        {
            $query->whereBetween('proc_date', [$proc_date, $proc_date2]);
        }

        $data = $query->get();
        return $data;
    }

    public static function getReportSearch($txn_date, $proc_date, $mid, $cardnum, $auth, $amount)
    {
        $bnd = new BND350UIModel;
        $query = $bnd->select('*');

        if($txn_date != NULL)
        {
            $query->where('txn_date', $txn_date);
        }

        if($proc_date != NULL)
        {
            $query->where('proc_date', $proc_date);
        }

        if($mid != NULL)
        {
            $query->where('mid', $mid);
        }

        if($cardnum != NULL)
        {
            $query->where('cardnum', $cardnum);
        }

        if($auth != NULL)
        {
            $query->where('auth', $auth);
        }

        if($amount != NULL)
        {
            $query->where('amount', $amount);
        }

        $data = $query->get();
        return $data;
    }
}
