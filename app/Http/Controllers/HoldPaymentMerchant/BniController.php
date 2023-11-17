<?php

namespace App\Http\Controllers\HoldPaymentMerchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use App\Models\HoldPaymentMerchant\BniModel;
use App\Models\HoldPaymentMerchant\WilayahModel;
use App\Models\HoldPaymentMerchant\RekeningModel;
use App\Imports\HoldPaymentMerchant\BniTolakanImport;
use App\Exports\HoldPaymentMerchant\BniTolakanExport;
use App\Exports\HoldPaymentMerchant\BniSearchBulkTolakanExport;
use App\Imports\HoldPaymentMerchant\BniReleaseImport;
use App\Imports\HoldPaymentMerchant\SearchBulkImportTolakan;
use App\Imports\HoldPaymentMerchant\UpdateBulkBniTolakanImport;

class BniController extends Controller
{
    public function formUploadTolakanBni(Request $request)
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

        if(Schema::hasTable('bni_temp_hold_'.$userId.''))
        {
            $bni_temp = BniModel::getBniTemp($userId);
            $matchingkeyBni = BniModel::getBniList();
            $count = BniModel::countDuplicateBni($userId);
            $duplicate = BniModel::countDuplicateBniTemp($userId);
            $duplicateDataTemp = BniModel::getMatchingKeyTemp($userId);
        }else{
            $bni_temp = NULL;
            $matchingkeyBni = NULL;
            $count = NULL;
            $duplicate = NULL;
            $duplicateDataTemp = NULL;
        }
        
        $wilayah = WilayahModel::get();
        $rekening = RekeningModel::get();

		$data = array(
            'alert' => $showalert,
            'userId' => $userId,
            'bni_temp' => $bni_temp,
            'matchingkeyBni' => $matchingkeyBni,
            'count' => $count,
            'wilayah' => $wilayah,
            'rekening' => $rekening,
            'duplicate' => $duplicate,
            'duplicateDataTemp' => $duplicateDataTemp,
        ); 

		return view('HoldPaymentMerchant.Bni.formUploadTolakan', $data);
	}

    public function prosesUploadTolakanBni(Request $request)
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
            
            DB::statement('drop table if exists bni_temp_hold_'.$userId.'');
            DB::statement('create table bni_temp_hold_'.$userId.' like bni');
            DB::statement('alter table bni_temp_hold_'.$userId.' drop index bni_matchingkey_unique');
            Excel::import(new BniTolakanImport($userId), public_path("/Import/HoldPaymentMerchant/".$filename));
            BniModel::updateTrimBni($userId);
            unlink(base_path('public/Import/HoldPaymentMerchant/'.$filename));

            return redirect()->back()->with('alertInfo', 'Cek Detail Data Dibawah');
        }
    }

    public function prosesInsertTolakanBni(Request $request)
    {
        $userId = $request->session()->get('userId');
        DB::statement('insert into bni (tanggal_tolakan, mid, nama_merchant, bank_name, cust_name, act_tolakan, settled_amt, tanggal_payment, tanggal_settlement, alasan_tolakan, status, jenis_transaksi, jenis_tolakan, kode_wilayah, matchingkey, created_at, updated_at)
        select 
            trim(tanggal_tolakan) as tanggal_tolakan,
            trim(mid) as mid,
            trim(nama_merchant) as nama_merchant,
            trim(bank_name) as bank_name,
            trim(cust_name) as cust_name,
            trim(act_tolakan) as act_tolakan,
            trim(settled_amt) as settled_amt,
            trim(tanggal_payment) as tanggal_payment,
            trim(tanggal_settlement) as tanggal_settlement,
            trim(alasan_tolakan) as alasan_tolakan,
            trim(status) as status,
            trim(jenis_transaksi) as jenis_transaksi,
            trim(jenis_tolakan) as jenis_tolakan,
            trim(kode_wilayah) as kode_wilayah,
            trim(matchingkey) as matchingkey,
            trim(created_at) as created_at,
            trim(updated_at) as updated_at
        from bni_temp_hold_'.$userId.'');
        DB::statement('drop table if exists bni_temp_hold_'.$userId.'');
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Di Import');
    }

    public function getListTolakanBni(Request $request)
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
        $settled_amt = $request->settled_amt;
        $status = $request->status;
        $tanggal_tolakan = $request->tanggal_tolakan;
        $tanggal_reproses_payment = $request->tanggal_reproses_payment;
        $jenis_transaksi = $request->jenis_transaksi;
        $listTolakan = BniModel::getListTolakanBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi,$settled_amt);
        $rekening = RekeningModel::where('jenis_hold','HOLD PAYMENT')->get();
        $total = BniModel::getTotalAmountItemTolakanBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi);

		$data = array(
            'alert' => $showalert,
            'mid' => $mid,
            'settled_amt' => $settled_amt,
            'status' => $status,
            'tanggal_tolakan' => $tanggal_tolakan,
            'tanggal_reproses_payment' => $tanggal_reproses_payment,
            'jenis_transaksi' => $jenis_transaksi,
            'listTolakan' => $listTolakan,
            'rekening' => $rekening,
            'total' => $total,
        ); 

		return view('HoldPaymentMerchant.Bni.list', $data);
	}

    public function deleteTolakanBni(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $mid = $request->mid;
        $status = $request->status;
        $tanggal_tolakan = $request->tanggal_tolakan;
        $tanggal_reproses_payment = $request->tanggal_reproses_payment;
        $jenis_transaksi = $request->jenis_transaksi;
        BniModel::deleteTolakanBni($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi);

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesReportBniTolakanExport(Request $request)
    {
        $mid = $request->mid;
        $status = $request->status;
        $tanggal_tolakan = $request->tanggal_tolakan;
        $tanggal_reproses_payment = $request->tanggal_reproses_payment;
        $jenis_transaksi = $request->jenis_transaksi;
        return Excel::download(new BniTolakanExport($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi), "Report BNI Tolakan.xlsx");
    }

    public function prosesReportSearchBulkBniTolakanExport(Request $request){
        $userId = $request->session()->get('userId');
        return Excel::download(new BniSearchBulkTolakanExport($userId), "Report BNI Tolakan.xlsx");
    }

    public function deleteTolakanBniById(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        BniModel::where('id', $request->id)->delete();

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function prosesUploadRelaseBni(Request $request)
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

            $import = new BniReleaseImport;
            Excel::import($import, public_path("/Import/HoldPaymentMerchant/".$filename));

            unlink(base_path('public/Import/HoldPaymentMerchant/'.$filename));
            
            if($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures())->with('alert', 'Ada Data Error. Cek Detail Data Dibawah');
            }

            return redirect('HoldPaymentMerchant/Bni/list')->with('alertSuccess', 'Data Berhasil Di Release');
        }
    }

    public function formUpdateTolakanBni(Request $request)
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

        $bni = BniModel::getTolakanBniById($request->id);
        $wilayah = WilayahModel::get();
        $rekening = RekeningModel::get();

		$data = array(
            'alert' => $showalert,
            'bni' => $bni,
            'wilayah' => $wilayah,
            'rekening' => $rekening,
        ); 

		return view('HoldPaymentMerchant.Bni.formUpdateTolakan', $data);
	}

    public function prosesUpdateTolakanBni(Request $request)
    {
        $matchingkey = $request->mid.';'.$request->settled_amt.';'.$request->tanggal_settlement.';'.$request->jenis_transaksi.';';
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $data = array(
            'tanggal_tolakan' => $request->tanggal_tolakan,
            'mid' => $request->mid,
            'nama_merchant' => $request->nama_merchant,
            'bank_name' => $request->bank_name,
            'cust_name' => $request->cust_name,
            'act_tolakan' => $request->act_tolakan,
            'cust_name_release' => $request->cust_name_release,
            'act_release' => $request->act_release,
            'settled_amt' => $request->settled_amt,
            'tanggal_payment' => $request->tanggal_payment,
            'alasan_tolakan' => $request->alasan_tolakan,
            'tanggal_settlement' => $request->tanggal_settlement,
            'tanggal_reproses_payment' => $request->tanggal_reproses_payment,
            'status' => $request->status,
            'jenis_transaksi' => $request->jenis_transaksi,
            'kode_wilayah' => $request->kode_wilayah,
            'matchingkey' => $matchingkey,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        BniModel::where('id', $request->id)->update($data);
        return redirect('HoldPaymentMerchant/Bni/list')->with('alertSuccess', 'Data Berhasil Diupdate');
    }

    public function formUpdateBulkBniTolakan(Request $request){
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

		return view('HoldPaymentMerchant.Bni.formUpdateBulkTolakan', $data);
    }

    public function prosesUpdateBulkTolakan(Request $request){
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $userId = $request->session()->get('userId');
        $ekstensi_file = array($request->file('file_import')->getClientOriginalExtension());
        $extensions = array("xlsx", "xls", "csv");

        if(!in_array($ekstensi_file[0], $extensions)){
            return redirect()->back()->with('alert', 'Format file yang anda upload bukan Excel');
        }else{
            $file = $request->file('file_import');
            $filename = $file->getClientOriginalName();
            $file->move(\base_path() ."/public/Import/HoldPaymentMerchant/", $filename);

            Excel::import(new UpdateBulkBniTolakanImport, public_path("/Import/HoldPaymentMerchant/".$filename));
            unlink(base_path('public/Import/HoldPaymentMerchant/'.$filename));

            return redirect('HoldPaymentMerchant/Bni/list')->with('alertSuccess', 'Data Hold Payment Merchant Berhasil Diupdate');
        }
    }
    
    public function prosesClearBniTemp(Request $request)
    {
        $userId = $request->session()->get('userId');
        DB::statement('drop table if exists bni_temp_hold_'.$userId.'');
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Di Clear');
    }

    public function prosesBatalkanReleaseBni(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $mid = $request->mid;
        $status = $request->status;
        $tanggal_tolakan = $request->tanggal_tolakan;
        $tanggal_reproses_payment = $request->tanggal_reproses_payment;
        $jenis_transaksi = $request->jenis_transaksi;
        BniModel::prosesBatalkanRelease($mid, $status, $tanggal_tolakan, $tanggal_reproses_payment, $jenis_transaksi);

        return redirect()->back()->with('alertSuccess', 'Berhasil Batalkan Release');
    }


    public function prosesUploadSearchBulkTolakan(Request $request){
        $userId = $request->session()->get('userId');

        DB::statement('drop table if exists data_bulk_tolakan_'.$userId.', result_searchbulk_tolakan_'.$userId.'');
        DB::statement('create table data_bulk_tolakan_'.$userId.'
        (
            mid varchar(100)  
        )engine myisam');

        $file_import = $request->file('file_import');
        $nama_file_import = 'data_bulk_tolakan_'.$userId.''.'.'.$file_import->getClientOriginalExtension();
        $file_import->move(\base_path() . "/public/Import/HoldPaymentMerchant",$nama_file_import);

        Excel::import(new SearchBulkImportTolakan($userId), public_path("/Import/HoldPaymentMerchant/".$nama_file_import));

        DB::statement('alter table data_bulk_tolakan_'.$userId.' add column no int auto_increment primary key first');
        DB::statement('alter table data_bulk_tolakan_'.$userId.' convert to character set utf8mb4 collate utf8mb4_unicode_ci');
        unlink(public_path("Import/HoldPaymentMerchant/$nama_file_import"));

        DB::statement('create table result_searchbulk_tolakan_'.$userId.' like bni');

        DB::statement('alter table result_searchbulk_tolakan_'.$userId.' add column nama_wilayah varchar(200),
        add column rek_simpanan varchar(100),
        add column nama_rek_simpanan varchar(200)
        ');

        $subquery = DB::table('data_bulk_tolakan_'.$userId.'')->select('mid');

        // insert select query dari tabel bni, rekening, dan wilayah
        $query = BniModel::select('bni.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
        ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'bni.kode_wilayah')
        ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'bni.jenis_transaksi')
        ->orderBy('bni.tanggal_tolakan','desc');

        
        // $query = BniModel::select('*');

        if(in_array('mid',$request->kolom)){
            $query->whereIn('mid', $subquery);
        }

        $bindings = $query->getBindings();
        $insertQuery = 'INSERT into result_searchbulk_tolakan_'.$userId.' '. $query->toSql();
        DB::insert($insertQuery, $bindings);

        return redirect('HoldPaymentMerchant/Bni/listResult/'.$userId.'')->with('alertSuccess', 'Data Berhasil Dicari');
    }

    public function getListResultTolakanBni(Request $request){
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

        
        $mid = $request->mid;
        $status = $request->status;
        $tanggal_tolakan = $request->tanggal_tolakan;
        $tanggal_reproses_payment = $request->tanggal_reproses_payment;
        $jenis_transaksi = $request->jenis_transaksi;
        $rekening = RekeningModel::get();

        $listTolakan = DB::table('result_searchbulk_tolakan_'.$userId.'')->paginate();

        $listTolakan->appends($request->all());

        $data = array(
            'listTolakan' => $listTolakan,
            'status' => $status,
            'tanggal_tolakan' => $tanggal_tolakan,
            'tanggal_reproses_payment' => $tanggal_reproses_payment,
            'jenis_transaksi' => $jenis_transaksi,
            'rekening' => $rekening,
            'mid' => $mid,
            'alert' => $showalert,
        );

        return view('HoldPaymentMerchant.Bni.listResult', $data);
    }
}
