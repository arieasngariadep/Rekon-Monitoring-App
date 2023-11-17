@extends('layout.index')
@section('TitleTab', 'Form Update Rekening')
@section('Title', 'Form Update Rekening')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">Form Update Rekening</li>
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
                    <h5 class="mt-0 header-title">Form Update Rekening</h5>
                </div>
                <form class="form-horizontal auth-form my-4" action="{{ route('prosesUpdateRekening') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="jenis_transaksi" class="">JENIS TRANSAKSI</label>
                                <input class="form-control" type="text" placeholder="JENIS TRANSAKSI" id="jenis_transaksi" name="jenis_transaksi" value="<?= $rekening->jenis_transaksi ?>">
                            </div>
                            <div class="form-group row">
                                <label for="rek_simpanan" class="">REKENING SIMPANAN</label>
                                <input class="form-control" type="text" placeholder="REKENING SIMPANAN" id="rek_simpanan" name="rek_simpanan" value="<?= $rekening->rek_simpanan ?>">
                            </div>
                        </div>

                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="nama_rek_simpanan" class="">NAMA REKENING SIMPANAN</label>
                                <input class="form-control" type="text" placeholder="NAMA REKENING SIMPANAN" id="nama_rek_simpanan" name="nama_rek_simpanan" value="<?= $rekening->nama_rek_simpanan ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 ml-5">
                            <div class="form-group row">
                                <input class="form-control form-control-lg" type="text" name="id" value="<?= $rekening->id ?>" hidden>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                                </div>
                                <div class="col-sm-3">
                                    <a href="<?= route('getListRekening') ?>" type="button" class="btn btn-danger" style="width: 100%;">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection