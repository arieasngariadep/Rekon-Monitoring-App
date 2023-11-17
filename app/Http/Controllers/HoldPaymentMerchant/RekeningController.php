<?php

namespace App\Http\Controllers\HoldPaymentMerchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\HoldPaymentMerchant\RekeningModel;
use App\Imports\HoldPaymentMerchant\RekeningImport;

class RekeningController extends Controller
{
    public function getListRekening(Request $request)
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

        $rekening = RekeningModel::get();

		$data = array(
            'alert' => $showalert,
            'rekening' => $rekening,
        ); 

		return view('HoldPaymentMerchant.Rekening.list', $data);
	}

    public function formUpdateRekening(Request $request)
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

        $rekening = RekeningModel::where('id', $request->id)->first();

		$data = array(
            'alert' => $showalert,
            'rekening' => $rekening,
        ); 

		return view('HoldPaymentMerchant.Rekening.formUpdate', $data);
	}

    public function prosesUpdateRekening(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'jenis_transaksi' => $request->jenis_transaksi,
            'rek_simpanan' => $request->rek_simpanan,
            'nama_rek_simpanan' => $request->nama_rek_simpanan,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        RekeningModel::where('id', $request->id)->update($data);
        return redirect('HoldPaymentMerchant/Rekening/list')->with('alertSuccess', 'Data Berhasil Diupdate');
    }

    public function deleteRekeningById(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        RekeningModel::where('id', $request->id)->delete();

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesAddRekening(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'jenis_transaksi' => $request->jenis_transaksi,
            'rek_simpanan' => $request->rek_simpanan,
            'nama_rek_simpanan' => $request->nama_rek_simpanan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        RekeningModel::insert($data);
        return redirect('HoldPaymentMerchant/Rekening/list')->with('alertSuccess', 'Data Berhasil Ditambahkan');
    }

    public function deleteRekening(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $rekening = RekeningModel::get();
        foreach ($rekening as $post) {
            $post->delete();
        }
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesUploadRekening(Request $request)
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

            $import = new RekeningImport;
            Excel::import($import, public_path("/Import/HoldPaymentMerchant/".$filename));

            unlink(base_path('public/Import/HoldPaymentMerchant/'.$filename));

            return redirect('HoldPaymentMerchant/Rekening/list')->with('alertSuccess', 'Data Berhasil Diupload');
        }
    }
}
