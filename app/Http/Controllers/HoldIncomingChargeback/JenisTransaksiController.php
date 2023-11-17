<?php

namespace App\Http\Controllers\HoldIncomingChargeback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\HoldIncomingChargeback\JenisTransaksiModel;
use App\Imports\HoldIncomingChargeback\JenisTransaksiImport;

class JenisTransaksiController extends Controller
{
    public function getListJenisTransaksi(Request $request)
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

        $JenisTransaksi = JenisTransaksiModel::get();

		$data = array(
            'alert' => $showalert,
            'JenisTransaksi' => $JenisTransaksi,
        ); 

		return view('HoldIncomingChargeback.JenisTransaksi.list', $data);
	}

    public function prosesAddJenisTransaksi(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'jenis_transaksi' => $request->jenis_transaksi,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        JenisTransaksiModel::insert($data);
        return redirect('HoldIncomingChargeback/JenisTransaksi/list')->with('alertSuccess', 'Data Berhasil Ditambahkan');
    }

    public function formUpdateJenisTransaksi(Request $request)
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

        $JenisTransaksi = JenisTransaksiModel::where('id', $request->id)->first();

		$data = array(
            'alert' => $showalert,
            'JenisTransaksi' => $JenisTransaksi,
        ); 

		return view('HoldIncomingChargeback.JenisTransaksi.formUpdate', $data);
	}

    public function prosesUpdateJenisTransaksi(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'jenis_transaksi' => $request->jenis_transaksi,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        JenisTransaksiModel::where('id', $request->id)->update($data);
        return redirect('HoldIncomingChargeback/JenisTransaksi/list')->with('alertSuccess', 'Data Berhasil Diupdate');
    }

    public function deleteJenisTransaksiById(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        JenisTransaksiModel::where('id', $request->id)->delete();

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function deleteJenisTransaksi(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $JenisTransaksi = JenisTransaksiModel::get();
        foreach ($JenisTransaksi as $post) {
            $post->delete();
        }
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesUploadJenisTransaksi(Request $request)
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

            $import = new JenisTransaksiImport;
            Excel::import($import, public_path("/Import/HoldIncomingChargeback/".$filename));

            unlink(base_path('public/Import/HoldIncomingChargeback/'.$filename));

            return redirect('HoldIncomingChargeback/JenisTransaksi/list')->with('alertSuccess', 'Data Berhasil Diupload');
        }
    }
}
