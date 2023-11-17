<?php

namespace App\Http\Controllers\HoldIncomingChargeback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\HoldIncomingChargeback\InfoAsistenModel;
use App\Imports\HoldIncomingChargeback\InfoAsistenImport;

class InfoAsistenController extends Controller
{
    public function getListInfoAsisten(Request $request)
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

        $InfoAsisten = InfoAsistenModel::get();

		$data = array(
            'alert' => $showalert,
            'InfoAsisten' => $InfoAsisten,
        ); 

		return view('HoldIncomingChargeback.InfoAsisten.list', $data);
	}

    public function prosesAddInfoAsisten(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'proses_incoming' => $request->proses_incoming,
            'info_status' => $request->info_status,
            'proses_rkm_1' => $request->proses_rkm_1,
            'final_status' => $request->final_status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        InfoAsistenModel::insert($data);
        return redirect('HoldIncomingChargeback/InfoAsisten/list')->with('alertSuccess', 'Data Berhasil Ditambahkan');
    }

    public function formUpdateInfoAsisten(Request $request)
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

        $InfoAsisten = InfoAsistenModel::where('id', $request->id)->first();

		$data = array(
            'alert' => $showalert,
            'InfoAsisten' => $InfoAsisten,
        ); 

		return view('HoldIncomingChargeback.InfoAsisten.formUpdate', $data);
	}

    public function prosesUpdateInfoAsisten(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'proses_incoming' => $request->proses_incoming,
            'info_status' => $request->info_status,
            'proses_rkm_1' => $request->proses_rkm_1,
            'final_status' => $request->final_status,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        InfoAsistenModel::where('id', $request->id)->update($data);
        return redirect('HoldIncomingChargeback/InfoAsisten/list')->with('alertSuccess', 'Data Berhasil Diupdate');
    }

    public function deleteInfoAsistenById(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        InfoAsistenModel::where('id', $request->id)->delete();

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function deleteInfoAsisten(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $status = InfoAsistenModel::get();
        foreach ($status as $post) {
            $post->delete();
        }
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesUploadInfoAsisten(Request $request)
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

            $import = new InfoAsistenImport;
            Excel::import($import, public_path("/Import/HoldIncomingChargeback/".$filename));

            unlink(base_path('public/Import/HoldIncomingChargeback/'.$filename));

            return redirect('HoldIncomingChargeback/InfoAsisten/list')->with('alertSuccess', 'Data Berhasil Diupload');
        }
    }
}
