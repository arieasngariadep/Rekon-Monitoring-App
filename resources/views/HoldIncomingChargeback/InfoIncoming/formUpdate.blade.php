@extends('layout.index')
@section('TitleTab', 'Form Update Info Incoming')
@section('Title', 'Form Update Info Incoming')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">Form Update Info Incoming</li>
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
                    <h5 class="mt-0 header-title">Form Update Info Incoming</h5>
                </div>
                <form class="form-horizontal auth-form my-4" action="{{ route('prosesUpdateInfoIncoming') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-5 ml-4">
                            <div class="form-group row">
                                <label for="cek_bnd" class="">CEK BND</label>
                                <input autocomplete="off" class="form-control" type="text" placeholder="CEK BND" id="cek_bnd" name="cek_bnd" value="<?= $InfoIncoming->cek_bnd ?>" />
                            </div>
                            <div class="form-group row">
                                <label for="request_incoming" class="">REQUEST INCOMING</label>
                                <input autocomplete="off" class="form-control" type="text" placeholder="REQUEST INCOMING" id="request_incoming" name="request_incoming" value="<?= $InfoIncoming->request_incoming ?>" />
                            </div>
                        </div>

                        <div class="col-lg-5 ml-4">
                            <div class="form-group row">
                                <label for="proses_incoming" class="">PROSES INCOMING</label>
                                <input autocomplete="off" class="form-control" type="text" placeholder="PROSES INCOMING" id="proses_incoming" name="proses_incoming" value="<?= $InfoIncoming->proses_incoming ?>" />
                            </div>
                            <div class="form-group row">
                                <label for="final_status" class="">FINAL STATUS</label>
                                <input autocomplete="off" class="form-control" type="text" placeholder="FINAL STATUS" id="final_status" name="final_status" value="<?= $InfoIncoming->final_status ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 ml-4">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" id="id" name="id" value="<?= $InfoIncoming->id ?>" hidden />
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
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