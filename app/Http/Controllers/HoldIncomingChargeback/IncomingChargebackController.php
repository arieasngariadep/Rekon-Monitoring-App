<?php

namespace App\Http\Controllers\HoldIncomingChargeback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Alerts;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use App\Models\HoldIncomingChargeback\IncomingChargebackModel;
use App\Models\HoldIncomingChargeback\InfoStatusModel;
use App\Models\HoldIncomingChargeback\InfoIncomingModel;
use App\Models\HoldIncomingChargeback\JenisTransaksiModel;
use App\Imports\HoldIncomingChargeback\IncomingChargebackImport;
use App\Exports\HoldIncomingChargeback\IncomingChargebackExport;

class IncomingChargebackController extends Controller
{
    public function formUploadIncomingChargeback(Request $request)
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

        if(Schema::hasTable('ic_temp_'.$userId.''))
        {
            $ic_temp = IncomingChargebackModel::getIncomingChargebackTemp($userId);
            $count = IncomingChargebackModel::countDuplicateIncomingChargeback($userId);
        }else{
            $ic_temp = NULL;
            $count = NULL;
        }

		$data = array(
            'alert' => $showalert,
            'userId' => $userId,
            'ic_temp' => $ic_temp,
            'count' => $count,
        ); 

		return view('HoldIncomingChargeback.IncomingChargeback.formUpload', $data);
	}

    public function prosesUploadIncomingChargeback(Request $request)
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
            
            DB::statement('drop table if exists ic_temp_'.$userId.'');
            DB::statement('create table ic_temp_'.$userId.' like incoming_chargeback');
            DB::statement('ALTER TABLE ic_temp_'.$userId.' ADD CONSTRAINT cek_bnd FOREIGN KEY (cek_bnd) REFERENCES info_incoming(cek_bnd) ON DELETE NO ACTION ON UPDATE CASCADE');
            DB::statement('ALTER TABLE ic_temp_'.$userId.' ADD CONSTRAINT request_incoming FOREIGN KEY (request_incoming) REFERENCES info_incoming(request_incoming) ON DELETE NO ACTION ON UPDATE CASCADE');
            Excel::import(new IncomingChargebackImport($userId), public_path("/Import/HoldIncomingChargeback/".$filename));
            unlink(base_path('public/Import/HoldIncomingChargeback/'.$filename));
            IncomingChargebackModel::updateKodeJenisTrx($userId);

            return redirect()->back()->with('alertInfo', 'Cek Detail Data Dibawah');
        }
    }

    public function prosesInsertIncomingChargeback(Request $request)
    {
        $userId = $request->session()->get('userId');
        IncomingChargebackModel::getInsertTempIncomingChargeback($userId);
        DB::statement('drop table if exists ic_temp_'.$userId.'');
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Di Import');
    }

    public function prosesClearIncomingChargebackTemp(Request $request)
    {
        $userId = $request->session()->get('userId');
        DB::statement('drop table if exists ic_temp_'.$userId.'');
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Di Clear');
    }

    public function getListIncomingChargeback(Request $request)
	{
        $alert = $request->session()->get('alert');
        $userId = $request->session()->get('userId');
        $roleId = $request->session()->get('role_id');
        $alertSuccess = $request->session()->get('alertSuccess');
        $alertInfo = $request->session()->get('alertInfo');
        if($alertSuccess){
            $showalert = Alerts::alertSuccess($alertSuccess);
        }else if($alertInfo){
            $showalert = Alerts::alertinfo($alertInfo);
        }else{
            $showalert = Alerts::alertDanger($alert);
        }

		$mch_number = $request->mch_number;
        $approval = $request->approval;
        $amount = $request->amount;
        $arn = $request->arn;
        $jenis_transaksi = $request->jenis_transaksi;
        $info_status = $request->info_status;
        $proses_incoming = $request->proses_incoming;
        $final_status = $request->final_status;
        $listIC = IncomingChargebackModel::getListIncomingChargeback($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status);
        $listInfoStatus = InfoStatusModel::get();
        $listJenisTrx = JenisTransaksiModel::get();
        $listProsesIncoming = InfoIncomingModel::select('proses_incoming')->groupBy('proses_incoming')->orderBy('proses_incoming', 'ASC')->get();
        $total = IncomingChargebackModel::getTotalItemAmount($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status);

		$data = array(
            'alert' => $showalert,
            'userId' => $userId,
            'roleId' => $roleId,
            'mch_number' => $mch_number,
            'approval' => $approval,
            'amount' => $amount,
            'arn' => $arn,
            'jenis_transaksi' => $jenis_transaksi,
            'info_status' => $info_status,
            'proses_incoming' => $proses_incoming,
            'final_status' => $final_status,
            'listIC' => $listIC,
            'listInfoStatus' => $listInfoStatus,
            'listJenisTrx' => $listJenisTrx,
            'listProsesIncoming' => $listProsesIncoming,
            'total' => $total,
        ); 

		return view('HoldIncomingChargeback.IncomingChargeback.list', $data);
	}

    public function prosesReportIncomingChargebackExport(Request $request)
    {
        $mch_number = $request->mch_number;
        $approval = $request->approval;
        $amount = $request->amount;
        $arn = $request->arn;
        $jenis_transaksi = $request->jenis_transaksi;
        $info_status = $request->info_status;
        $proses_incoming = $request->proses_incoming;
        $final_status = $request->final_status;
        return Excel::download(new IncomingChargebackExport($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status), "Report Incoming Chargeback.xlsx");
    }

    public function formUpdateIncomingChargeback(Request $request)
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

        $Ic = IncomingChargebackModel::getIncomingChargebackById($request->id);

		$data = array(
            'alert' => $showalert,
            'Ic' => $Ic,
        ); 

		return view('HoldIncomingChargeback.IncomingChargeback.formUpdate', $data);
	}

    public function prosesUpdateIncomingChargeback(Request $request)
    {
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
            'tanggal_reproses_payment' => $request->tanggal_reproses_payment,
            'status' => $request->status,
            'jenis_transaksi' => $request->jenis_transaksi,
            'kode_wilayah' => $request->kode_wilayah,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        ChargebackModel::where('id', $request->id)->update($data);
        return redirect('HoldIncomingChargeback/Bni/list')->with('alertSuccess', 'Data Berhasil Diupdate');
    }

    public function deleteIncomingChargeback(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $mch_number = $request->mch_number;
        $approval = $request->approval;
        $amount = $request->amount;
        $arn = $request->arn;
        $jenis_transaksi = $request->jenis_transaksi;
        $info_status = $request->info_status;
        $proses_incoming = $request->proses_incoming;
        $final_status = $request->final_status;
        IncomingChargebackModel::deleteIncomingChargeback($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status);

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Dihapus');
    }

    public function deleteIncomingChargebackById(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        IncomingChargebackModel::where('id', $request->id)->delete();

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
            $file->move(\base_path() ."/public/Import/HoldIncomingChargeback/", $filename);

            $import = new BniReleaseImport;
            Excel::import($import, public_path("/Import/HoldIncomingChargeback/".$filename));

            unlink(base_path('public/Import/HoldIncomingChargeback/'.$filename));
            
            if($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }

            return redirect('HoldIncomingChargeback/list')->with('alertSuccess', 'Data Berhasil Diupload');
        }
    }

    public function prosesApproval(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $userId = $request->session()->get('userId');
        $mch_number = $request->mch_number;
        $approval = $request->approval;
        $amount = $request->amount;
        $arn = $request->arn;
        $jenis_transaksi = $request->jenis_transaksi;
        $info_status = $request->info_status;
        $proses_incoming = $request->proses_incoming;
        $final_status = $request->final_status;
        IncomingChargebackModel::prosesApproval($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status);
        return redirect()->back()->with('alertSuccess', 'Data Berhasil Di Approve');
    }

    public function prosesBatalkanApproval(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); // Set your country name from below timezone list
        $userId = $request->session()->get('userId');
        $mch_number = $request->mch_number;
        $approval = $request->approval;
        $amount = $request->amount;
        $arn = $request->arn;
        $jenis_transaksi = $request->jenis_transaksi;
        $info_status = $request->info_status;
        $proses_incoming = $request->proses_incoming;
        $final_status = $request->final_status;
        IncomingChargebackModel::prosesBatalkanApproval($mch_number, $approval, $amount, $arn, $jenis_transaksi, $info_status, $proses_incoming, $final_status);
        return redirect()->back()->with('alertSuccess', 'Approval Dibatalkan');
    }
}
