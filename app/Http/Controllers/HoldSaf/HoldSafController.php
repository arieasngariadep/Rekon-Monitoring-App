<?php

namespace App\Http\Controllers\HoldSaf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use App\Models\HoldSaf\HoldSafModel;
use App\Models\HoldPaymentMerchant\WilayahModel;
use App\Models\HoldPaymentMerchant\RekeningModel;
use App\Imports\Holdsaf\HoldSafImport;
use App\Imports\Holdsaf\HoldSafReleaseImport;
use App\Imports\Holdsaf\ImportUpdateBulkHoldSaf;
use App\Imports\Holdsaf\SearchBulkImportHoldSaf;
use App\Exports\Holdsaf\HoldSafExport;

class HoldSafController extends Controller
{
    public function getListHoldSaf(Request $request){
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
        $tanggal_hold = $request->tanggal_hold;
        $tanggal_release = $request->tanggal_release;
        $jenis_transaksi = $request->jenis_transaksi;
        $net_hold = $request->net_hold;
        $no_kartu = $request->no_kartu;

        $listHoldSaf = HoldSafModel::getListHoldSaf($mid, $status, $tanggal_hold, $tanggal_release, $jenis_transaksi, $net_hold, $no_kartu);
        $rekening = RekeningModel::where('jenis_hold','HOLD SAF')->get();

		$data = array(
            'alert' => $showalert,
            'listHoldSaf' => $listHoldSaf,
            'mid' => $mid,
            'status' => $status,
            'tanggal_hold' => $tanggal_hold,
            'tanggal_release' => $tanggal_release,
            'jenis_transaksi' => $jenis_transaksi,
            'net_hold' => $net_hold,
            'no_kartu' => $no_kartu,
            'rekening' => $rekening

        ); 

		return view('HoldSaf.holdSafList', $data);
    }

    public function formUploadHoldSaf(Request $request){
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

        if(Schema::hasTable('holdsaf_temp_hold_'.$userId.''))
        {
            $holdsaf_temp = HoldSafModel::getHoldSafTemp($userId);
            $matchingkeyHoldSaf = HoldSafModel::getHoldSafList();
            $count = HoldSafModel::countDuplicateHoldSaf($userId);
            $duplicate = HoldSafModel::countDuplicateHoldSafTemp($userId);
            $duplicateDataTemp = HoldSafModel::getMatchingKeyTemp($userId);
        }else{
            $holdsaf_temp = NULL;
            $matchingkeyHoldSaf = NULL;
            $count = NULL;
            $duplicate = NULL;
            $duplicateDataTemp = NULL;
        }
        
        $wilayah = WilayahModel::get();
        $rekening = RekeningModel::get();

        $data = array(
            'alert' => $showalert,
            'userId' => $userId,
            'holdsaf_temp' => $holdsaf_temp,
            'matchingkeyHoldSaf' => $matchingkeyHoldSaf,
            'count' => $count,
            'wilayah' => $wilayah,
            'rekening' => $rekening,
            'duplicate' => $duplicate,
            'duplicateDataTemp' => $duplicateDataTemp,
        );

        return view('HoldSaf.formUploadHoldSaf',$data);

    }

    public function prosesUploadHoldSaf(Request $request){

        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $userId = $request->session()->get('userId');
        $file = $request->file('file_import');
        $ekstensi_file = array($file->getClientOriginalExtension());
        $extensions = array("xlsx", "xls", "csv");

        if(!in_array($ekstensi_file[0], $extensions)){
            return redirect()->back()->with('alert', 'Format file yang anda upload bukan Excel');
        }else{
            $filename = $file->getClientOriginalName();
            $file->move(\base_path() ."/public/Import/HoldSaf/", $filename);
            
            DB::statement('drop table if exists holdsaf_temp_hold_'.$userId.'');
            DB::statement('create table holdsaf_temp_hold_'.$userId.' like holdsaf');
            DB::statement('alter table holdsaf_temp_hold_'.$userId.' drop index holdsaf_matchingkey_unique');
            Excel::import(new HoldSafImport($userId), public_path("/Import/HoldSaf/".$filename));
            HoldSafModel::updatePaidHoldSaf($userId);
            unlink(base_path('public/Import/HoldSaf/'.$filename));

            return redirect()->back()->with('alertInfo', 'Cek Detail Data Dibawah');
        }
    }

    public function insertDataHoldSaf(Request $request){
        $userId = $request->session()->get('userId');
        DB::statement('insert into holdsaf (tanggal_hold, mid, nama_merchant, no_kartu, nominal, apprvl, nama_bank, cust_name, act_hold, settled_amt, hold_amt, mdr, disc_amt, net_hold, paid_amt, alasan_hold, matchingkey, kode_wilayah, jenis_transaksi, status, created_at, updated_at)
        select 
            trim(tanggal_hold) as tanggal_hold,
            trim(mid) as mid,
            trim(nama_merchant) as nama_merchant,
            trim(no_kartu) as no_kartu,
            trim(nominal) as nominal,
            trim(apprvl) as apprvl,
            trim(nama_bank) as nama_bank,
            trim(cust_name) as cust_name,
            trim(act_hold) as act_hold,
            trim(settled_amt) as settled_amt,
            trim(hold_amt) as hold_amt,
            trim(mdr) as mdr,
            trim(disc_amt) as disc_amt,
            trim(net_hold) as net_hold,
            trim(paid_amt) as paid_amt,
            trim(alasan_hold) as alasan_hold,
            trim(matchingkey) as matchingkey,
            trim(kode_wilayah) as kode_wilayah,
            trim(jenis_transaksi) as jenis_transaksi,
            trim(status) as status,
            trim(created_at) as created_at,
            trim(updated_at) as updated_at
        from holdsaf_temp_hold_'.$userId.'');
        DB::statement('drop table if exists holdsaf_temp_hold_'.$userId.'');
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Di Import');
    }

    public function formUpdateBulkHoldSaf(Request $request){
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

        return view('HoldSaf.formUpdateBulkHoldSaf',$data);
    }

    public function prosesUpdateBulk(Request $request){
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $userId = $request->session()->get('userId');
        $ekstensi_file = array($request->file('file_import')->getClientOriginalExtension());
        $extensions = array("xlsx", "xls", "csv");

        if(!in_array($ekstensi_file[0], $extensions)){
            return redirect()->back()->with('alert', 'Format file yang anda upload bukan Excel');
        }else{
            $file = $request->file('file_import');
            $filename = $file->getClientOriginalName();
            $file->move(\base_path() ."/public/Import/HoldSaf/", $filename);

            Excel::import(new ImportUpdateBulkHoldSaf, public_path("/Import/HoldSaf/".$filename));
            unlink(base_path('public/Import/HoldSaf/'.$filename));

            return redirect('HoldSaf/getListHoldSaf')->with('alertSuccess', 'Data Hold Saf Berhasil Diupdate');
        }
    }

    public function prosesUploadReleaseHoldSaf(Request $request)
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
            $file->move(\base_path() ."/public/Import/HoldSaf/", $filename);

            $import = new HoldSafReleaseImport;
            Excel::import($import, public_path("/Import/HoldSaf/".$filename));

            unlink(base_path('public/Import/HoldSaf/'.$filename));
            
            if($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures())->with('alert', 'Ada Data Error. Cek Ulang Data Pada Excel');
            }

            return redirect('HoldSaf/getListHoldSaf')->with('alertSuccess', 'Data Berhasil Di Release');
        }
    }

    public function batalReleaseHoldSaf(Request $request){
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $mid = $request->mid;
        $tanggal_hold = $request->tanggal_hold;
        $tanggal_release = $request->tanggal_release;
        $status = $request->status;
        $jenis_transaksi = $request->jenis_transaksi;
        $net_hold = $request->net_hold;
        $no_kartu = $request->no_kartu;
        HoldSafModel::cancelReleaseHoldSaf($mid, $tanggal_hold, $tanggal_release, $status, $jenis_transaksi, $net_hold, $no_kartu);

        return redirect()->back()->with('alertSuccess', 'Berhasil Batalkan Release');
    }

    public function formUpdateHoldSaf(Request $request){
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

        $holdSaf = HoldSafModel::find($request->id);
        $wilayah = WilayahModel::get();
        $rekening = RekeningModel::get();

		$data = array(
            'alert' => $showalert,
            'holdSaf' => $holdSaf,
            'wilayah' => $wilayah,
            'rekening' => $rekening,
        ); 

        return view('HoldSaf.formUpdateHoldSaf',$data);
    }

    public function prosesUpdateHoldSaf(Request $request){

    }

    public function prosesSearchBulkHoldSaf(Request $request){
        $userId = $request->session()->get('userId');

        DB::statement('drop table if exists data_bulk_holdsaf_'.$userId.', result_searchbulk_holdsaf_'.$userId.'');
        DB::statement('create table data_bulk_holdsaf_'.$userId.'
        (
            nama_merchant varchar(200),  
            mid varchar(100),  
            no_kartu varchar(20),  
            nominal varchar(100),  
            apprvl varchar(10),  
            nama_bank varchar(100),  
            cust_name varchar(100),  
            act_hold varchar(20),  
            settled_amt varchar(100),  
            hold_amt varchar(20),  
            mdr varchar(20),  
            disc_amt varchar(100),  
            net_hold varchar(100),  
            paid_amt varchar(100),  
            tanggal_hold date,  
            tanggal_release date  
        )engine myisam');

        $file_import = $request->file('file_import');
        $nama_file_import = 'data_bulk_holdsaf_'.$userId.''.'.'.$file_import->getClientOriginalExtension();
        $file_import->move(\base_path() . "/public/Import/HoldPaymentMerchant",$nama_file_import);

        Excel::import(new SearchBulkImportHoldSaf($userId), public_path("/Import/HoldPaymentMerchant/".$nama_file_import));

        DB::statement('alter table data_bulk_holdsaf_'.$userId.' add column no int auto_increment primary key first');
        DB::statement('alter table data_bulk_holdsaf_'.$userId.' convert to character set utf8mb4 collate utf8mb4_unicode_ci');
        unlink(public_path("Import/HoldPaymentMerchant/$nama_file_import"));

        DB::statement('create table result_searchbulk_holdsaf_'.$userId.' like holdsaf');

        DB::statement('alter table result_searchbulk_holdsaf_'.$userId.' add column nama_wilayah varchar(200),
        add column rek_simpanan varchar(100),
        add column nama_rek_simpanan varchar(200)
        ');

        $subquery1 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('nama_merchant');
        $subquery2 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('mid');
        $subquery3 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('no_kartu');
        $subquery4 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('nominal');
        $subquery5 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('apprvl');
        $subquery6 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('nama_bank');
        $subquery7 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('cust_name');
        $subquery8 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('act_hold');
        $subquery9 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('settled_amt');
        $subquery10 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('hold_amt');
        $subquery11 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('mdr');
        $subquery12 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('disc_amt');
        $subquery13 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('net_hold');
        $subquery14 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('paid_amt');
        $subquery15 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('tanggal_hold');
        $subquery16 = DB::table('data_bulk_holdsaf_'.$userId.'')->select('tanggal_release');

        // insert select query dari tabel bni, rekening, dan wilayah
        $query = HoldSafModel::select('holdsaf.*', 'wilayah.nama_wilayah', 'rekening.rek_simpanan', 'rekening.nama_rek_simpanan')
        ->leftJoin('wilayah', 'wilayah.kode_wilayah', '=', 'holdsaf.kode_wilayah')
        ->leftJoin('rekening', 'rekening.jenis_transaksi', '=', 'holdsaf.jenis_transaksi')
        ->orderBy('holdsaf.tanggal_hold','desc');

        
        // $query = BniModel::select('*');

        if(in_array('nama_merchant',$request->kolom)){
            $query->whereIn('nama_merchant', $subquery1);
        }

        if(in_array('mid',$request->kolom)){
            $query->whereIn('mid', $subquery);
        }

        $bindings = $query->getBindings();
        $insertQuery = 'INSERT into result_searchbulk_holdsaf_'.$userId.' '. $query->toSql();
        DB::insert($insertQuery, $bindings);

        return redirect('HoldSaf/getListHoldSaf'.$userId.'')->with('alertSuccess', 'Data Berhasil Dicari');
    }

    public function getListResultHoldSaf(Request $request){
        $alert = $request->session()->get('alert');
        $alertSuccess = $request->session()->get('alertSuccess');
        $alertInfo = $request->session()->get('alertInfo');
    }

    public function deleteHoldSafById(Request $request){
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        HoldSafModel::where('id', $request->id)->delete();

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function deleteHoldSaf(Request $request){

        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $mid = $request->mid;
        $tanggal_hold = $request->tanggal_hold;
        $tanggal_release = $request->tanggal_release;
        $status = $request->status;
        $jenis_transaksi = $request->jenis_transaksi;
        $net_hold = $request->net_hold;
        $no_kartu = $request->no_kartu;
        HoldSafModel::deleteHoldSaf($mid, $tanggal_hold, $tanggal_release, $status, $jenis_transaksi, $net_hold, $no_kartu);

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function clearHoldSafTemp(Request $request)
    {
        $userId = $request->session()->get('userId');
        DB::statement('drop table if exists holdsaf_temp_hold_'.$userId.'');
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Di Clear');
    }

    public function getReportHoldSaf(Request $request){
        $mid = $request->mid;
        $tanggal_hold = $request->tanggal_hold;
        $tanggal_release = $request->tanggal_release;
        $status = $request->status;
        $jenis_transaksi = $request->jenis_transaksi;
        $net_hold = $request->net_hold;
        $no_kartu = $request->no_kartu;
        return Excel::download(new HoldSafExport($mid, $tanggal_hold, $tanggal_release, $status, $jenis_transaksi, $net_hold, $no_kartu), "Report Hold Saf.xlsx");
    }
}
