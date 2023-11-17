<?php

namespace App\Http\Controllers\HoldIncomingChargeback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\HoldIncomingChargeback\InfoIncomingModel;
use App\Imports\HoldIncomingChargeback\InfoIncomingImport;

class InfoIncomingController extends Controller
{
    public function getListInfoIncoming(Request $request)
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

        $InfoIncoming = InfoIncomingModel::get();

		$data = array(
            'alert' => $showalert,
            'InfoIncoming' => $InfoIncoming,
        ); 

		return view('HoldIncomingChargeback.InfoIncoming.list', $data);
	}

    public function prosesAddInfoIncoming(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'cek_bnd' => $request->cek_bnd,
            'request_incoming' => $request->request_incoming,
            'proses_incoming' => $request->proses_incoming,
            'final_status' => $request->final_status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        InfoIncomingModel::insert($data);
        return redirect('HoldIncomingChargeback/InfoIncoming/list')->with('alertSuccess', 'Data Berhasil Ditambahkan');
    }

    public function formUpdateInfoIncoming(Request $request)
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

        $InfoIncoming = InfoIncomingModel::where('id', $request->id)->first();

		$data = array(
            'alert' => $showalert,
            'InfoIncoming' => $InfoIncoming,
        ); 

		return view('HoldIncomingChargeback.InfoIncoming.formUpdate', $data);
	}

    public function prosesUpdateInfoIncoming(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'cek_bnd' => $request->cek_bnd,
            'request_incoming' => $request->request_incoming,
            'proses_incoming' => $request->proses_incoming,
            'final_status' => $request->final_status,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        InfoIncomingModel::where('id', $request->id)->update($data);
        return redirect('HoldIncomingChargeback/InfoIncoming/list')->with('alertSuccess', 'Data Berhasil Diupdate');
    }

    public function deleteInfoIncomingById(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        InfoIncomingModel::where('id', $request->id)->delete();

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function deleteInfoIncoming(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $status = InfoIncomingModel::get();
        foreach ($status as $post) {
            $post->delete();
        }
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesUploadInfoIncoming(Request $request)
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

            $import = new InfoIncomingImport;
            Excel::import($import, public_path("/Import/HoldIncomingChargeback/".$filename));

            unlink(base_path('public/Import/HoldIncomingChargeback/'.$filename));

            return redirect('HoldIncomingChargeback/InfoIncoming/list')->with('alertSuccess', 'Data Berhasil Diupload');
        }
    }
}
