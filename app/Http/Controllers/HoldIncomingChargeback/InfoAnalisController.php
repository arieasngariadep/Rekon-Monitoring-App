<?php

namespace App\Http\Controllers\HoldIncomingChargeback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\HoldIncomingChargeback\InfoAnalisModel;
use App\Imports\HoldIncomingChargeback\InfoAnalisImport;

class InfoAnalisController extends Controller
{
    public function getListInfoAnalis(Request $request)
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

        $InfoAnalis = InfoAnalisModel::get();

		$data = array(
            'alert' => $showalert,
            'InfoAnalis' => $InfoAnalis,
        ); 

		return view('HoldIncomingChargeback.InfoAnalis.list', $data);
	}

    public function prosesAddInfoAnalis(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'proses_incoming' => $request->proses_incoming,
            'info_status' => $request->info_status,
            'proses_rkm_final' => $request->proses_rkm_final,
            'final_status' => $request->final_status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        InfoAnalisModel::insert($data);
        return redirect('HoldIncomingChargeback/InfoAnalis/list')->with('alertSuccess', 'Data Berhasil Ditambahkan');
    }

    public function formUpdateInfoAnalis(Request $request)
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

        $InfoAnalis = InfoAnalisModel::where('id', $request->id)->first();

		$data = array(
            'alert' => $showalert,
            'InfoAnalis' => $InfoAnalis,
        ); 

		return view('HoldIncomingChargeback.InfoAnalis.formUpdate', $data);
	}

    public function prosesUpdateInfoAnalis(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'proses_incoming' => $request->proses_incoming,
            'info_status' => $request->info_status,
            'proses_rkm_final' => $request->proses_rkm_final,
            'final_status' => $request->final_status,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        InfoAnalisModel::where('id', $request->id)->update($data);
        return redirect('HoldIncomingChargeback/InfoAnalis/list')->with('alertSuccess', 'Data Berhasil Diupdate');
    }

    public function deleteInfoAnalisById(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        InfoAnalisModel::where('id', $request->id)->delete();

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function deleteInfoAnalis(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $status = InfoAnalisModel::get();
        foreach ($status as $post) {
            $post->delete();
        }
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesUploadInfoAnalis(Request $request)
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

            $import = new InfoAnalisImport;
            Excel::import($import, public_path("/Import/HoldIncomingChargeback/".$filename));

            unlink(base_path('public/Import/HoldIncomingChargeback/'.$filename));

            return redirect('HoldIncomingChargeback/InfoAnalis/list')->with('alertSuccess', 'Data Berhasil Diupload');
        }
    }
}
