<?php

namespace App\Http\Controllers\HoldIncomingChargeback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;

class DashboardController extends Controller
{
    public function dashboardIncomingChargeback(Request $request)
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

		$data = array(
            'alert' => $showalert,
        ); 

		return view('HoldIncomingChargeback.dashboard', $data);
	}
}
