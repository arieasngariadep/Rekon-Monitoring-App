<?php

namespace App\Http\Controllers\HoldPaymentMerchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use App\Models\HoldPaymentMerchant\BniModel;

class DashboardController extends Controller
{
    public function dashboardHoldPayment(Request $request)
	{
        $alert = $request->session()->get('alert');
        $alertSuccess = $request->session()->get('alertSuccess');
        $alertInfo = $request->session()->get('alertInfo');
        if($alertSuccess){
            $showalert = Alerts::alertSuccess($alertSuccess);
        }else if($alertInfo){
            $showalert = Alerts::alertinfo($alertInfo);
        }else{
            $showalert = Alerts::alertDanger($alert);
        }
        $transaksiWilKre = BniModel::getTransaksiByWilayahKredit();
        $transaksiWilLink = BniModel::getTransaksiByWilayahLink();
        $transaksiWilDeb = BniModel::getTransaksiByWilayahDebit();
        $transaksiWilQris = BniModel::getTransaksiByWilayahQris();
        $transaksiWilTap = BniModel::getTransaksiByWilayahTap();
        $listTransaksi = BniModel::getTransaksiByJumlahTrx();
		$data = array(
            'alert' =>  $showalert,
            'transaksiWilKre' => $transaksiWilKre ?? NULL,
            'transaksiWilLink' => $transaksiWilLink ?? NULL,
            'transaksiWilDeb' => $transaksiWilDeb ?? NULL,
            'transaksiWilQris' => $transaksiWilQris ?? NULL,
            'transaksiWilTap' => $transaksiWilTap ?? NULL,
            'listTransaksi' => $listTransaksi ?? NULL
        ); 

		return view('HoldPaymentMerchant.dashboard', $data);
	}
}
