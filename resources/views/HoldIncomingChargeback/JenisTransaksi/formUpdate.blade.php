@extends('layout.index')
@section('TitleTab', 'Form Update Jenis Transaksi')
@section('Title', 'Form Update Jenis Transaksi')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Incoming Chargeback</a></li>
<li class="breadcrumb-item active">Form Update Jenis Transaksi</li>
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row ml-3 mb-3">
                    <h5 class="mt-0 header-title">Form Update Jenis Transaksi</h5>
                </div>
                <form class="form-horizontal auth-form my-4" action="{{ route('prosesUpdateJenisTransaksi') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-4 ml-4">
                            <div class="form-group row">
                                <label for="jenis_transaksi" class="">JENIS TRANSAKSI</label>
                                <input autocomplete="off" class="form-control" type="text" placeholder="JENIS TRANSAKSI" id="jenis_transaksi" name="jenis_transaksi" value="<?= $JenisTransaksi->jenis_transaksi ?>" />
                            </div>
                        </div>
                        <div class="col-lg-2 ml-4">
                            <div class="form-group row">
                                <label for="jenis_transaksi" class="" style="color: white;">JENIS TRANSAKSI</label>
                                <input class="form-control" type="text" id="id" name="id" value="<?= $JenisTransaksi->id ?>" hidden />
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection