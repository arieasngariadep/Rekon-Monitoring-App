<?php

namespace App\Http\Controllers\HoldIncomingChargeback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\HoldIncomingChargeback\InfoStatusModel;
use App\Imports\HoldIncomingChargeback\InfoStatusImport;

class InfoStatusController extends Controller
{
    public function getListInfoStatus(Request $request)
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

        $InfoStatus = InfoStatusModel::get();

		$data = array(
            'alert' => $showalert,
            'InfoStatus' => $InfoStatus,
        ); 

		return view('HoldIncomingChargeback.InfoStatus.list', $data);
	}

    public function prosesAddInfoStatus(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'info_status' => $request->info_status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        InfoStatusModel::insert($data);
        return redirect('HoldIncomingChargeback/InfoStatus/list')->with('alertSuccess', 'Data Berhasil Ditambahkan');
    }

    public function formUpdateInfoStatus(Request $request)
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

        $InfoStatus = InfoStatusModel::where('id', $request->id)->first();

		$data = array(
            'alert' => $showalert,
            'InfoStatus' => $InfoStatus,
        ); 

		return view('HoldIncomingChargeback.InfoStatus.formUpdate', $data);
	}

    public function prosesUpdateInfoStatus(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'info_status' => $request->info_status,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        InfoStatusModel::where('id', $request->id)->update($data);
        return redirect('HoldIncomingChargeback/InfoStatus/list')->with('alertSuccess', 'Data Berhasil Diupdate');
    }

    public function deleteInfoStatusById(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        InfoStatusModel::where('id', $request->id)->delete();

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function deleteInfoStatus(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $InfoStatus = InfoStatusModel::get();
        foreach ($InfoStatus as $post) {
            $post->delete();
        }
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesUploadInfoStatus(Request $request)
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

            $import = new InfoStatusImport;
            Excel::import($import, public_path("/Import/HoldIncomingChargeback/".$filename));

            unlink(base_path('public/Import/HoldIncomingChargeback/'.$filename));

            return redirect('HoldIncomingChargeback/InfoStatus/list')->with('alertSuccess', 'Data Berhasil Diupload');
        }
    }
}
