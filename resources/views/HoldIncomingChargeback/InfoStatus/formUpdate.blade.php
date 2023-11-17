@extends('layout.index')
@section('TitleTab', 'Form Update Status Final')
@section('Title', 'Form Update Status Final')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Incoming Chargeback</a></li>
<li class="breadcrumb-item active">Form Update Status Final</li>
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
                    <h5 class="mt-0 header-title">Form Update Status Final</h5>
                </div>
                <form class="form-horizontal auth-form my-4" action="{{ route('prosesUpdateInfoStatus') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-4 ml-4">
                            <div class="form-group row">
                                <label for="info_status" class="">Status Final</label>
                                <input autocomplete="off" class="form-control" type="text" placeholder="Status Final" id="info_status" name="info_status" value="<?= $InfoStatus->info_status ?>" />
                            </div>
                        </div>
                        <div class="col-lg-2 ml-4">
                            <div class="form-group row">
                                <label for="info_status" class="" style="color: white;">Status Final</label>
                                <input class="form-control" type="text" id="id" name="id" value="<?= $InfoStatus->id ?>" hidden />
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