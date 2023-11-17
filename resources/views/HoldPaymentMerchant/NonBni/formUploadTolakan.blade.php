@extends('layout.index')
@section('TitleTab', 'Form Upload Tolakan Non BNI')
@section('Title', 'Form Upload Tolakan Non BNI')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">Form Upload Tolakan Non BNI</li>
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
                <h4 class="mt-0 header-title">Form Upload Tolakan Non BNI</h4>
                <p class="text-muted mb-3"><span style="color: red;">Format file upload .xlsx</span></p>
                <form action="{{ route('prosesUploadTolakanNonBni') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="button-items mb-2">
                        <a type="button" class="btn btn-dark btn-square btn-outline-dashed waves-effect waves-light" href="../../Excel/HoldPaymentMerchant/Format Tolakan Non BNI.xlsx"><i class="dripicons-cloud-download mr-2"></i>Download Format</a>
                    </div>
                    <input type="file" name="file_import" id="input-file-now" class="dropify" />
                    <div class="button-items mt-3 text-center">
                        <button type="submit" class="btn btn-blue btn-square waves-effect waves-light"><i class="dripicons-cloud-upload mr-2"></i>Upload</button>
                    </div>
                </form>

                @php
                    foreach ($wilayah as $w) {
                        $listW[] = $w->kode_wilayah;
                    }
                    
                    foreach ($rekening as $r) {
                        $listR[] = $r->jenis_transaksi;
                    }

                    if($duplicate != 0)
                    {
                        $double = "<div style='color: red;'>* Ada Data Double di Excel. Mohon Periksa Kembali.</div>";
                    }else{
                        $double = NULL;
                    }

                    if(!empty($nonBni_temp) && count($nonBni_temp) > 0)
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
                                                    <th>Net Amount</th>
                                                    <th>Jenis Transaksi</th>
                                                    <th>Kode Wilayah</th>
                                                    <th>Keterangan Error</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                                foreach ($nonBni_temp as $temp) {
                                                    $rekening_td = (in_array($temp->jenis_transaksi, $listR)) ? "" : " style='background: #E07171;color: black;'";
                                                    $wilayah_td = (in_array($temp->kode_wilayah, $listW)) ? "" : " style='background: #E07171;color: black;'";
                                                    $keterangan_td = ($temp->keterangan != 'Data Sudah Ada' ? "" : "style='background: #E07171;color: black;'");

                                                    if(!in_array($temp->jenis_transaksi, $listR) || !in_array($temp->kode_wilayah, $listW))
                                                    {
                                                        $kosong++; // Tambah 1 variabel $kosong
                                                        $notif_kosong = "<div style='color: red;'>* Jenis Transaksi atau Kode Wilayah Tidak Terdaftar.</div>";
                                                    }else{
                                                        $notif_kosong = NULL;
                                                    }

                                                    $table .= '
                                                        <tr>
                                                            <td class="text-center">'.$no.'</td>
                                                            <td>'.$temp->tanggal_tolakan.'</td>
                                                            <td>'.$temp->mid.'</td>
                                                            <td>'.number_format($temp->net_amount, 0, '', '.').'</td>
                                                            <td '.$rekening_td.'>'.$temp->jenis_transaksi.'</td>
                                                            <td '.$wilayah_td.'>'.$temp->kode_wilayah.'</td>
                                                            <td '.$keterangan_td.'>'.$temp->keterangan.'</td>
                                                        </tr>';
                                                    $no++;
                                                }
                                        $table .= '
                                            </tbody>
                                        </table>
                                        '.$notif_kosong.'
                                        '.$double.'';

                                        if($count == 0 && $kosong == 0)
                                        {
                                            $table .= ' 
                                            <form action="'.route('prosesInsertTolakanNonBni').'" method="POST">
                                                '.csrf_field().'
                                                <div class="button-items mt-3 text-center">
                                                    <button type="submit" class="btn btn-success btn-square waves-effect waves-light"><i class="dripicons-cloud-upload mr-2"></i>Import</button>
                                                </div>
                                            </form>';
                                        }else{
                                            $table .= ' 
                                            <form action="'.route('prosesClearNonBniTemp').'" method="POST">
                                                '.csrf_field().'
                                                <div class="button-items mt-3 text-center">
                                                    <button type="submit" class="btn btn-danger btn-square waves-effect waves-light"><i class="dripicons-trash mr-2"></i>Clear</button>
                                                </div>
                                            </form>';
                                        }
                                        $table .= '
                                    </div>
                                </div>
                            </div>
                        </div>';
                        echo $table;
                    }
                @endphp
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection