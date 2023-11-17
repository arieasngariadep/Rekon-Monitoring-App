@extends('layout.index')
@section('TitleTab', 'Form Upload Tolakan BNI')
@section('Title', 'Form Upload Tolakan BNI')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">Form Upload Tolakan BNI</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <?php if($alert): ?>
        <div class="card m-b-30">
            <div class="card-body">
                <?= $alert ?>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Form Upload Tolakan BNI</h4>
                <p class="text-muted mb-3"><span style="color: red;">Format file upload .xlsx</span></p>
                <form action="{{ route('prosesUploadTolakanBni') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="button-items mb-2">
                        <a type="button" class="btn btn-dark btn-square btn-outline-dashed waves-effect waves-light" href="../../Excel/HoldPaymentMerchant/Format Tolakan BNI.xlsx"><i class="dripicons-cloud-download mr-2"></i>Download Format</a>
                    </div>
                    <input type="file" name="file_import" id="input-file-now" class="dropify" />
                    <div class="button-items mt-3 text-center">
                        <button type="submit" class="btn btn-blue btn-square waves-effect waves-light"><i class="dripicons-cloud-upload mr-2"></i>Upload</button>
                    </div>
                </form>
                <?php
                    foreach ($wilayah as $w) {
                        $listW[] = $w->kode_wilayah;
                    }
                    
                    foreach ($rekening as $r) {
                        $listR[] = $r->jenis_transaksi;
                    }

                    $listMatchingKey = array();
                    
                    if (is_array($matchingkeyBni) || is_object($matchingkeyBni))
                    {
                        foreach($matchingkeyBni as $m => $val)
                        {
                            $listMatchingKey[] = $val->matchingkey;
                        }
                    }

                    $duplicates = array();
                    if (is_array($duplicateDataTemp) || is_object($duplicateDataTemp))
                    {
                        foreach ($duplicateDataTemp as $tempD=>$val)
                        {
                            $duplicates[] = $val->matchingkey;
                        }
                    }

                        $dups = array();
                        foreach(array_count_values($duplicates) as $key => $val)
                        {
                            if($val > 1){
                                $dups[] = $key;  
                                $vals[] = $val;
                            }           
                        }
                    
                    if($duplicate != 0)
                    {
                    // validasi untuk mengecek data duplikat pada file excel
                        $double = "<div style='color: red;'>* Ada Data Double di Excel. Mohon Periksa Kembali.</div>";
                    }else{
                        $double = NULL;
                    }

                    $jenisTolakan = ['BNI', 'Non BNI', 'NON BNI'];
                    
                    if(!empty($bni_temp) && count($bni_temp) > 0)
                    {
                        $no = 1;
                        $kosong = 0;
                        $table = '
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>Tanggal Tolakan</th>
                                                    <th>MID</th>
                                                    <th>Settled Amount</th>
                                                    <th>Jenis Transaksi</th>
                                                    <th>Kode Wilayah</th>
                                                    <th>Jenis Tolakan</th>
                                                    <th>Ket. Duplikat Database </th>
                                                    <th>Ket. Duplikat Excel</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            
                                                // Tambah pengecekan data duplikat excel di sini
                                                foreach ($bni_temp as $temp) {
                                                    $rekening_td = (in_array($temp->jenis_transaksi, $listR)) ? "" : " style='background: #E07171;color: black;'";
                                                    $wilayah_td = (in_array($temp->kode_wilayah, $listW)) ? "" : " style='background: #E07171;color: black;'";
                                                    $keterangan_td = (!in_array($temp->matchingkey, $listMatchingKey) ? "" : "style='background: #E07171;color: black;'");
                                                    $jenisTolakan_td = (in_array($temp->jenis_tolakan, $jenisTolakan)) ? "" : " style='background: #E07171;color: black;'";
                                                    $settledAmt_td = (is_numeric($temp->settled_amt))?"":" style='background: #E07171;color: black;'";
                                                    
                                                    if(!in_array($temp->jenis_transaksi, $listR) || !in_array($temp->kode_wilayah, $listW) || !in_array($temp->jenis_tolakan, $jenisTolakan) || !is_numeric($temp->settled_amt))
                                                    {
                                                        $kosong++; // Tambah 1 variabel $kosong
                                                        $notif_kosong = "<div style='color: red;'>* Jenis Transaksi atau Kode Wilayah Tidak Terdaftar.</div>";
                                                        $jenisTolakanAlert = "<div style='color: red;'>* Perhatikan Spasi Dalam Penulisan.</div>";
                                                        $formatSalah = 1;
                                                    }else{
                                                        $notif_kosong = NULL;
                                                        $jenisTolakanAlert = NULL;
                                                        $formatSalah = NULL;
                                                    }

                                                    if(in_array($temp->matchingkey,$listMatchingKey,true)){
                                                        $keterangan = 'Data Sudah Ada';
                                                    }else{
                                                        $keterangan = 'Data Belum Ada';
                                                    }

                                                    if(is_numeric($temp->settled_amt)){
                                                        $setAmount = number_format($temp->settled_amt, 0, '', '.');
                                                    }else{     
                                                        $setAmount = 'Format Data Salah "'.$temp->settled_amt.'"' ;
                                                    }
       
                                                    $notifDupli = "-";
                                                    foreach ($dups as $k) {
                                                        if($temp->matchingkey == $k){
                                                            $notifDupli = "Terdapat data yang sama";
                                                        }
                                                    }

                                                    $table .= '
                                                        <tr>
                                                            <td class="text-center">'.$temp->id.'</td>
                                                            <td>'.$temp->tanggal_tolakan.'</td>
                                                            <td>'.$temp->mid.'</td>
                                                            <td '.$settledAmt_td.'>'.$setAmount.'</td>
                                                            <td '.$rekening_td.'>'.$temp->jenis_transaksi.'</td>
                                                            <td '.$wilayah_td.'>'.$temp->kode_wilayah.'</td>
                                                            <td '.$jenisTolakan_td.'>'.$temp->jenis_tolakan.'</td>
                                                            <td '.$keterangan_td.'>'.$keterangan.'</td>
                                                            <td>'.$notifDupli.'</td> 
                                                        </tr>';
                                                    $no++;
                                                }
                                        $table .= '
                                            </tbody>
                                        </table>
                                        '.$notif_kosong.'
                                        '.$double.'
                                        '.$jenisTolakanAlert.'';

                                        if($notif_kosong == NULL && $double == NULL && $jenisTolakanAlert == NULL && $formatSalah == NULL && $count == 0 && $kosong == 0 )
                                        {
                                            $table .= ' 
                                            <form action="'.route('prosesInsertTolakanBni').'" method="POST">
                                                '.csrf_field().'
                                                <div class="button-items mt-3 text-center">
                                                    <button type="submit" class="btn btn-success btn-square waves-effect waves-light"><i class="dripicons-cloud-upload mr-2"></i>Import</button>
                                                </div>
                                            </form>';
                                        }else{
                                            $table .= ' 
                                            <form action="'.route('prosesClearBniTemp').'" method="POST">
                                                '.csrf_field().'
                                                <div class="button-items mt-3 text-center">
                                                    <button type="submit" class="btn btn-danger btn-square waves-effect waves-light"><i class="dripicons-trash mr-2"></i>Clear</button>
                                                </div>
                                            </form>
                                    </div>
                                </div>';
                                        }
                                        $table .= '
                            </div>
                        </div>';
                        echo $table;
                    }
                ?>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection