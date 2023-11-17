<?php

namespace App\Http\Controllers\HoldPaymentMerchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use App\Models\HoldPaymentMerchant\NonBniModel;
use App\Models\HoldPaymentMerchant\WilayahModel;
use App\Models\HoldPaymentMerchant\RekeningModel;
use App\Imports\HoldPaymentMerchant\NonBniTolakanImport;
use App\Exports\HoldPaymentMerchant\NonBniTolakanExport;
use App\Imports\HoldPaymentMerchant\NonBniReleaseImport;

class NonBniController extends Controller
{
    public function formUploadTolakanNonBni(Request $request)
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

        if(Schema::hasTable('non_bni_temp_hold_'.$userId.''))
        {
            $nonBni_temp = NonBniModel::getNonBniTemp($userId);
            $count = NonBniModel::countDuplicateNonBni($userId);
            $duplicate = NonBniModel::countDuplicateNonBniTemp($userId);
        }else{
            $nonBni_temp = NULL;
            $count = NULL;
            $duplicate = NULL;
        }
        
        $wilayah = WilayahModel::get();
        $rekening = RekeningModel::get();
        
		$data = array(
            'alert' => $showalert,
            'userId' => $userId,
            'nonBni_temp' => $nonBni_temp,
            'count' => $count,
            'wilayah' => $wilayah,
            'rekening' => $rekening,
            'duplicate' => $duplicate,
        ); 

		return view('HoldPaymentMerchant.NonBni.formUploadTolakan', $data);
	}

    public function prosesUploadTolakanNonBni(Request $request)
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

            DB::statement('drop table if exists non_bni_temp_hold_'.$userId.'');
            DB::statement('create table non_bni_temp_hold_'.$userId.' like non_bni');
            DB::statement('alter table non_bni_temp_hold_'.$userId.' drop index non_bni_matchingkey_unique');
            Excel::import(new NonBniTolakanImport($userId), public_path("/Import/HoldPaymentMerchant/".$filename));
            unlink(base_path('public/Import/HoldPaymentMerchant/'.$filename));

            return redirect()->back()->with('alertInfo', 'Cek Detail Data Dibawah');
        }
    }

    public function prosesInsertTolakanNonBni(Request $request)
    {
        $userId = $request->session()->get('userId');
        DB::statement('insert into non_bni (tanggal_tolakan, nomor_refrensi, rekening_debet, nama_pengirim, residency_pengirim, net_amount, pesan_pengirim, kode_bank, rek_penerima, nama_penerima, act_release, jenis_nasabah_penerima, residency_penerima, nama_bank_penerima, tanggal_payment, alasan_tolakan, mid, nama_merchant, status, jenis_transaksi, kode_wilayah, matchingkey, created_at, updated_at)
        select 
            trim(tanggal_tolakan) as tanggal_tolakan,
            trim(nomor_refrensi) as nomor_refrensi,
            trim(rekening_debet) as rekening_debet,
            trim(nama_pengirim) as nama_pengirim,
            trim(residency_pengirim) as residency_pengirim,
            trim(net_amount) as net_amount,
            trim(pesan_pengirim) as pesan_pengirim,
            trim(kode_bank) as kode_bank,
            trim(rek_penerima) as rek_penerima,
            trim(nama_penerima) as nama_penerima,
            trim(act_release) as act_release,
            trim(jenis_nasabah_penerima) as jenis_nasabah_penerima,
            trim(residency_penerima) as residency_penerima,
            trim(nama_bank_penerima) as nama_bank_penerima,
            trim(tanggal_payment) as tanggal_payment,
            trim(alasan_tolakan) as alasan_tolakan,
            trim(mid) as mid,
            trim(nama_merchant) as nama_merchant,
            trim(status) as status,
            trim(jenis_transaksi) as jenis_transaksi,
            trim(kode_wilayah) as kode_wilayah,
            trim(matchingkey) as matchingkey,
            trim(created_at) as created_at,
            trim(updated_at) as updated_at
        from non_bni_temp_hold_'.$userId.'');
        DB::statement('drop table if exists non_bni_temp_hold_'.$userId.'');
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Di Import');
    }

    public function getListTolakanNonBni(Request $request)
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

		$mid = $request->mid;
        $status = $request->status;
        $tanggal_tolakan = $request->tanggal_tolakan;
        $tanggal_reproses_payment = $request->tanggal_reproses_payment;
        $jenis_transaksi = $request->jenis_transaksi;
        $listTolakan = NonBniModel::getListTolakanNonBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi);
        $rekening = RekeningModel::get();
        $total = NonBniModel::getTotalAmountItemTolakanNonBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi);

		$data = array(
            'alert' => $showalert,
            'mid' => $mid,
            'status' => $status,
            'tanggal_tolakan' => $tanggal_tolakan,
            'tanggal_reproses_payment' => $tanggal_reproses_payment,
            'jenis_transaksi' => $jenis_transaksi,
            'listTolakan' => $listTolakan,
            'rekening' => $rekening,
            'total' => $total,
        ); 

		return view('HoldPaymentMerchant.NonBni.list', $data);
	}

    public function deleteTolakanNonBni(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $mid = $request->mid;
        $status = $request->status;
        $tanggal_tolakan = $request->tanggal_tolakan;
        $tanggal_reproses_payment = $request->tanggal_reproses_payment;
        $jenis_transaksi = $request->jenis_transaksi;
        NonBniModel::deleteTolakanNonBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi);

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesReportNonBniTolakanExport(Request $request)
    {
        $mid = $request->mid;
        $status = $request->status;
        $tanggal_tolakan = $request->tanggal_tolakan;
        $tanggal_reproses_payment = $request->tanggal_reproses_payment;
        $jenis_transaksi = $request->jenis_transaksi;
        return Excel::download(new NonBniTolakanExport($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi), "Report Non BNI Tolakan.xlsx");
    }

    public function deleteTolakanNonBniById(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        NonBniModel::where('id', $request->id)->delete();

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesUploadReleaseNonBni(Request $request)
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

            $import = new NonBniReleaseImport;
            Excel::import($import, public_path("/Import/HoldPaymentMerchant/".$filename));

            unlink(base_path('public/Import/HoldPaymentMerchant/'.$filename));
            
            if($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures())->with('alert', 'Ada Data Error. Cek Detail Data Dibawah');
            }

            return redirect('HoldPaymentMerchant/NonBni/list')->with('alertSuccess', 'Data Berhasil Diupload');
        }
    }

    public function formUpdateTolakanNonBni(Request $request)
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

        $nonBni = NonBniModel::getTolakanNonBniById($request->id);
        $wilayah = WilayahModel::get();
        $rekening = RekeningModel::get();

		$data = array(
            'alert' => $showalert,
            'nonBni' => $nonBni,
            'wilayah' => $wilayah,
            'rekening' => $rekening,
        ); 

		return view('HoldPaymentMerchant.NonBni.formUpdateTolakan', $data);
	}

    public function prosesUpdateTolakanNonBni(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'tanggal_tolakan' => $request->tanggal_tolakan,
            'nomor_refrensi' => $request->nomor_refrensi,
            'rekening_debet' => $request->rekening_debet,
            'nama_pengirim' => $request->nama_pengirim,
            'residency_pengirim' => $request->residency_pengirim,
            'net_amount' => $request->net_amount,
            'pesan_pengirim' => $request->pesan_pengirim,
            'kode_bank' => $request->kode_bank,
            'rek_penerima' => $request->rek_penerima,
            'nama_penerima' => $request->nama_penerima,
            'cust_name_release' => $request->cust_name_release,
            'act_release' => $request->act_release,
            'jenis_nasabah_penerima' => $request->jenis_nasabah_penerima,
            'residency_penerima' => $request->residency_penerima,
            'nama_bank_penerima' => $request->nama_bank_penerima,
            'tanggal_payment' => $request->tanggal_payment,
            'tanggal_reproses_payment' => $request->tanggal_reproses_payment,
            'alasan_tolakan' => $request->alasan_tolakan,
            'mid' => $request->mid,
            'nama_merchant' => $request->nama_merchant,
            'status' => $request->status,
            'jenis_transaksi' => $request->jenis_transaksi,
            'kode_wilayah' => $request->kode_wilayah,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        NonBniModel::where('id', $request->id)->update($data);
        return redirect('HoldPaymentMerchant/NonBni/list')->with('alertSuccess', 'Data Berhasil Diupdate');
    }

    public function prosesClearNonBniTemp(Request $request)
    {
        $userId = $request->session()->get('userId');
        DB::statement('drop table if exists non_bni_temp_hold_'.$userId.'');
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Di Clear');
    }
    
    public function prosesBatalkanReleaseNonBni(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $mid = $request->mid;
        $status = $request->status;
        $tanggal_tolakan = $request->tanggal_tolakan;
        $tanggal_reproses_payment = $request->tanggal_reproses_payment;
        $jenis_transaksi = $request->jenis_transaksi;
        NonBniModel::prosesBatalkanRelease($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi);
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Di Clear');
    }
}
