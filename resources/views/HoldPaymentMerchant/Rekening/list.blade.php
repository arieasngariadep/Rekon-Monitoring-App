@extends('layout.index')
@section('TitleTab', 'List Rekening')
@section('Title', 'List Rekening')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="{{ route('dashboardHoldPayment') }}">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">List Rekening</li>
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
                <div class="form-material">
                    <div class="row mb-4">
                        <div class="col-md-3 text-right">
                            <button href="#" class="btn btn-primary" data-toggle="modal" data-animation="bounce" data-target=".formAddRekening">
                                <i class="dripicons-plus"></i>&nbsp;&nbsp;Form Add Rekening
                            </button>
                        </div>
                        <div class="col-md-2 text-left">
                            <form action="{{ route('deleteRekening') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" style="width: 180px; height: 38px;">
                                    <i class="dripicons-trash"></i>&nbsp;&nbsp;Delete Data
                                </button>
                            </form>
                        </div>
                        <div class="col-md-4 text-right">
                            <a type="button" class="btn btn-dark btn-square btn-outline-dashed waves-effect waves-light" href="../../Excel/HoldPaymentMerchant/Format Rekening.xlsx"><i class="dripicons-cloud-download mr-2"></i>Download Format</a>
                        </div>
                        <div class="col-md-3 text-left">
                            <button href="#" class="btn btn-primary" data-toggle="modal" data-animation="bounce" data-target=".formUploadRekening">
                                <i class="dripicons-cloud-upload"></i>&nbsp;&nbsp;Form Upload Rekening
                            </button>
                        </div>
                    </div>
                </div>

                <hr class="mt-4 mb-4">

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Jenis Transaksi</th>
                                <th>Rekening Simpanan</th>
                                <th>Nama Rekening Simpanan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $no = 1;
                                foreach($rekening as $list){
                                    $button = "
                                    <a href='".route('formUpdateRekening', ['id' => $list->id])."' class='btn btn-outline-success' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit'>
                                        <i class='fas fa-pencil-alt'></i>
                                    </a> |
                                    <a href='".route('deleteRekeningById', ['id' => $list->id])."' class='btn btn-outline-danger' data-toggle='tooltip' data-placement='top' title='' data-original-title='Hapus'>
                                        <i class='fas fa-trash-alt'></i>
                                    </a>";
                                    echo "
                                        <tr>
                                            <td class='text-center'>$no</td>
                                            <td>$list->jenis_transaksi</td>
                                            <td>$list->rek_simpanan</td>
                                            <td>$list->nama_rek_simpanan</td>
                                            <td class='text-center'>$button</td>
                                        </tr>
                                    ";
                                    $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection