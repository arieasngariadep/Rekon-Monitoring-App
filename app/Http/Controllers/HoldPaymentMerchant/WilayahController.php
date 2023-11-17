<?php

namespace App\Http\Controllers\HoldPaymentMerchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\HoldPaymentMerchant\WilayahModel;
use App\Imports\HoldPaymentMerchant\WilayahImport;

class WilayahController extends Controller
{
    public function getListWilayah(Request $request)
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

        $wilayah = WilayahModel::orderBy('kode_wilayah', 'ASC')->get();

		$data = array(
            'alert' => $showalert,
            'wilayah' => $wilayah,
        ); 

		return view('HoldPaymentMerchant.Wilayah.list', $data);
	}

    public function formUpdateWilayah(Request $request)
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

        $wilayah = WilayahModel::where('id', $request->id)->first();

		$data = array(
            'alert' => $showalert,
            'wilayah' => $wilayah,
        ); 

		return view('HoldPaymentMerchant.Wilayah.formUpdate', $data);
	}

    public function prosesUpdateWilayah(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'kode_wilayah' => $request->kode_wilayah,
            'nama_wilayah' => $request->nama_wilayah,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        WilayahModel::where('id', $request->id)->update($data);
        return redirect('HoldPaymentMerchant/Wilayah/list')->with('alertSuccess', 'Data Berhasil Diupdate');
    }

    public function deleteWilayahById(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        WilayahModel::where('id', $request->id)->delete();

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesAddWilayah(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'kode_wilayah' => $request->kode_wilayah,
            'nama_wilayah' => $request->nama_wilayah,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        WilayahModel::insert($data);
        return redirect('HoldPaymentMerchant/Wilayah/list')->with('alertSuccess', 'Data Berhasil Ditambahkan');
    }

    public function deleteWilayah(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $wilayah = WilayahModel::get();
        foreach ($wilayah as $post) {
            $post->delete();
        }
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesUploadWilayah(Request $request)
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
            $file->move(\base_path() ."/public/Import/HoldPaymentMerchant/", $filename);

            $import = new WilayahImport;
            Excel::import($import, public_path("/Import/HoldPaymentMerchant/".$filename));

            unlink(base_path('public/Import/HoldPaymentMerchant/'.$filename));

            return redirect('HoldPaymentMerchant/Wilayah/list')->with('alertSuccess', 'Data Berhasil Diupload');
        }
    }
}
