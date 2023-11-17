<?php

namespace App\Http\Controllers\HoldIncomingChargeback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;

class UploadAsistenController extends Controller
{
    public function formUploadAsisten(Request $request)
	{
        $userId = $request->session()->get('userId');
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

        if(Schema::hasTable('ic_asisten_temp_'.$userId.''))
        {
            $ic_temp = IncomingChargebackModel::getIncomingChargebackTemp($userId);
            $count = IncomingChargebackModel::countDuplicateIncomingChargeback($userId);
        }else{
            $ic_temp = NULL;
            $count = NULL;
        }

		$data = array(
            'alert' => $showalert,
            'userId' => $userId,
            'ic_temp' => $ic_temp,
            'count' => $count,
        ); 

		return view('HoldIncomingChargeback.IncomingChargebackAsisten.formUpload', $data);
	}

    public function prosesUploadIncomingChargebackAsisten(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $userId = $request->session()->get('userId');
        $file = $request->file('file_import');
        $ekstensi_file = array($file->getClientOriginalExtension());
        $extensions = array("xlsx", "xls", "csv");

        if(!in_array($ekstensi_file[0], $extensions)){
            return redirect()->back()->with('alert', 'Format file yang anda upload bukan Excel');
        }else{
            $filename = $file->getClientOriginalName();
            $file->move(\base_path() ."/public/Import/HoldIncomingChargeback/", $filename);
            
            DB::statement('drop table if exists ic_asisten_temp_'.$userId.'');
            DB::statement('create table ic_asisten_temp_'.$userId.' like incoming_chargeback');
            DB::statement('ALTER TABLE ic_asisten_temp_'.$userId.' ADD CONSTRAINT cek_bnd FOREIGN KEY (cek_bnd) REFERENCES info_incoming(cek_bnd) ON DELETE NO ACTION ON UPDATE CASCADE');
            DB::statement('ALTER TABLE ic_asisten_temp_'.$userId.' ADD CONSTRAINT request_incoming FOREIGN KEY (request_incoming) REFERENCES info_incoming(request_incoming) ON DELETE NO ACTION ON UPDATE CASCADE');
            Excel::import(new IncomingChargebackImport($userId), public_path("/Import/HoldIncomingChargeback/".$filename));
            unlink(base_path('public/Import/HoldIncomingChargeback/'.$filename));
            IncomingChargebackModel::updateKodeJenisTrx($userId);

            return redirect()->back()->with('alertInfo', 'Cek Detail Data Dibawah');
        }
    }
}
