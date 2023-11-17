@extends('layout.index')
@section('TitleTab', 'Form Update Bulk Hold SAF')
@section('Title', 'Form Update Bulk Hold SAF')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold SAF</a></li>
<li class="breadcrumb-item active">Form Update Bulk Hold SAF</li>
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
                <h4 class="mt-0 header-title">Form Update Bulk Hold SAF</h4>
                <p class="text-muted mb-3"><span style="color: red;">Format file upload .xlsx</span></p>
                <p class="text-muted mb-3"><span style="color: blue;">Silahkan download report dan ubah data pada field yang ingin diupdate terlebih dahulu</span></p>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file_import" id="input-file-now" class="dropify" />
                    <div class="button-items mt-3 text-center">
                        <button type="submit" class="btn btn-blue btn-square waves-effect waves-light"><i class="dripicons-cloud-upload mr-2"></i>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection