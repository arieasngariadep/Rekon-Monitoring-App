@extends('layout.index')
@section('TitleTab', 'Form Update Wilayah')
@section('Title', 'Form Update Wilayah')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">Form Update Wilayah</li>
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
                    <h5 class="mt-0 header-title">Form Update Wilayah</h5>
                </div> 
                <form class="form-horizontal auth-form my-4" action="{{ route('prosesUpdateWilayah') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="kode_wilayah" class="">KODE WILAYAH</label>
                                <input autocomplete="off" class="form-control" type="text" placeholder="KODE WILAYAH" id="kode_wilayah" name="kode_wilayah" value="<?= $wilayah->kode_wilayah ?>">
                            </div>
                        </div>

                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="nama_wilayah" class="">NAMA WILAYAH</label>
                                <input autocomplete="off" class="form-control" type="text" placeholder="NAMA WILAYAH" id="nama_wilayah" name="nama_wilayah" value="<?= $wilayah->nama_wilayah ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 ml-5">
                            <div class="form-group row">
                                <input class="form-control form-control-lg" type="text" name="id" value="<?= $wilayah->id ?>" hidden>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                                </div>
                                <div class="col-sm-3">
                                    <a href="<?= route('getListWilayah') ?>" type="button" class="btn btn-danger" style="width: 100%;">Back</a>
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