@extends('layout.index')
@section('TitleTab', 'Form Update Incoming Chargeback')
@section('Title', 'Form Update Incoming Chargeback')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">Form Update Incoming Chargeback</li>
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
                <div class="row ml-3">
                    <h5 class="mt-0 header-title">Form Update Incoming Chargeback</h5>
                </div>
                <hr>
                <form class="form-horizontal auth-form my-4" action="{{ route('prosesUpdateIncomingChargeback') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="tanggal_tolakan" class="">TANGGAL TOLAKAN</label>
                                <input class="form-control" type="text" placeholder="TANGGAL TOLAKAN" id="tanggal_tolakan" name="tanggal_tolakan" value="<?= $Ic->tanggal_tolakan ?>">
                            </div>
                            <div class="form-group row">
                                <label for="mid" class="">MID</label>
                                <input class="form-control" type="text" placeholder="MID" id="mid" name="mid" value="<?= $Ic->mid ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nama_merchant" class="">NAMA MERCHANT</label>
                                <input class="form-control" type="text" placeholder="NAMA MERCHANT" id="nama_merchant" name="nama_merchant" value="<?= $Ic->nama_merchant ?>">
                            </div>
                            <div class="form-group row">
                                <label for="bank_name" class="">BANK NAME</label>
                                <input class="form-control" type="text" placeholder="BANK NAME" id="bank_name" name="bank_name" value="<?= $Ic->bank_name ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME</label>
                                <input class="form-control" type="text" placeholder="CUST NAME" id="cust_name" name="cust_name" value="<?= $Ic->cust_name ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_tolakan" class="">ACT TOLAKAN</label>
                                <input class="form-control" type="text" placeholder="ACT TOLAKAN" id="act_tolakan" name="act_tolakan" value="<?= $Ic->act_tolakan ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME RELEASE</label>
                                <input class="form-control" type="text" placeholder="CUST NAME RELEASE" id="cust_name_release" name="cust_name_release" value="<?= $Ic->cust_name_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_release" class="">ACT RELEASE</label>
                                <input class="form-control" type="text" placeholder="ACT RELEASE" id="act_release" name="act_release" value="<?= $Ic->act_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="settled_amt" class="">SETTLED AMOUNT</label>
                                <input class="form-control" type="text" placeholder="SETTLED AMOUNT" id="settled_amt" name="settled_amt" value="<?= $Ic->settled_amt ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nama_merchant" class="">NAMA MERCHANT</label>
                                <input class="form-control" type="text" placeholder="NAMA MERCHANT" id="nama_merchant" name="nama_merchant" value="<?= $Ic->nama_merchant ?>">
                            </div>
                            <div class="form-group row">
                                <label for="bank_name" class="">BANK NAME</label>
                                <input class="form-control" type="text" placeholder="BANK NAME" id="bank_name" name="bank_name" value="<?= $Ic->bank_name ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME</label>
                                <input class="form-control" type="text" placeholder="CUST NAME" id="cust_name" name="cust_name" value="<?= $Ic->cust_name ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_tolakan" class="">ACT TOLAKAN</label>
                                <input class="form-control" type="text" placeholder="ACT TOLAKAN" id="act_tolakan" name="act_tolakan" value="<?= $Ic->act_tolakan ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME RELEASE</label>
                                <input class="form-control" type="text" placeholder="CUST NAME RELEASE" id="cust_name_release" name="cust_name_release" value="<?= $Ic->cust_name_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_release" class="">ACT RELEASE</label>
                                <input class="form-control" type="text" placeholder="ACT RELEASE" id="act_release" name="act_release" value="<?= $Ic->act_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="settled_amt" class="">SETTLED AMOUNT</label>
                                <input class="form-control" type="text" placeholder="SETTLED AMOUNT" id="settled_amt" name="settled_amt" value="<?= $Ic->settled_amt ?>">
                            </div>
                        </div>

                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="tanggal_tolakan" class="">TANGGAL TOLAKAN</label>
                                <input class="form-control" type="text" placeholder="TANGGAL TOLAKAN" id="tanggal_tolakan" name="tanggal_tolakan" value="<?= $Ic->tanggal_tolakan ?>">
                            </div>
                            <div class="form-group row">
                                <label for="mid" class="">MID</label>
                                <input class="form-control" type="text" placeholder="MID" id="mid" name="mid" value="<?= $Ic->mid ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nama_merchant" class="">NAMA MERCHANT</label>
                                <input class="form-control" type="text" placeholder="NAMA MERCHANT" id="nama_merchant" name="nama_merchant" value="<?= $Ic->nama_merchant ?>">
                            </div>
                            <div class="form-group row">
                                <label for="bank_name" class="">BANK NAME</label>
                                <input class="form-control" type="text" placeholder="BANK NAME" id="bank_name" name="bank_name" value="<?= $Ic->bank_name ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME</label>
                                <input class="form-control" type="text" placeholder="CUST NAME" id="cust_name" name="cust_name" value="<?= $Ic->cust_name ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_tolakan" class="">ACT TOLAKAN</label>
                                <input class="form-control" type="text" placeholder="ACT TOLAKAN" id="act_tolakan" name="act_tolakan" value="<?= $Ic->act_tolakan ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME RELEASE</label>
                                <input class="form-control" type="text" placeholder="CUST NAME RELEASE" id="cust_name_release" name="cust_name_release" value="<?= $Ic->cust_name_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_release" class="">ACT RELEASE</label>
                                <input class="form-control" type="text" placeholder="ACT RELEASE" id="act_release" name="act_release" value="<?= $Ic->act_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="settled_amt" class="">SETTLED AMOUNT</label>
                                <input class="form-control" type="text" placeholder="SETTLED AMOUNT" id="settled_amt" name="settled_amt" value="<?= $Ic->settled_amt ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nama_merchant" class="">NAMA MERCHANT</label>
                                <input class="form-control" type="text" placeholder="NAMA MERCHANT" id="nama_merchant" name="nama_merchant" value="<?= $Ic->nama_merchant ?>">
                            </div>
                            <div class="form-group row">
                                <label for="bank_name" class="">BANK NAME</label>
                                <input class="form-control" type="text" placeholder="BANK NAME" id="bank_name" name="bank_name" value="<?= $Ic->bank_name ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME</label>
                                <input class="form-control" type="text" placeholder="CUST NAME" id="cust_name" name="cust_name" value="<?= $Ic->cust_name ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_tolakan" class="">ACT TOLAKAN</label>
                                <input class="form-control" type="text" placeholder="ACT TOLAKAN" id="act_tolakan" name="act_tolakan" value="<?= $Ic->act_tolakan ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME RELEASE</label>
                                <input class="form-control" type="text" placeholder="CUST NAME RELEASE" id="cust_name_release" name="cust_name_release" value="<?= $Ic->cust_name_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_release" class="">ACT RELEASE</label>
                                <input class="form-control" type="text" placeholder="ACT RELEASE" id="act_release" name="act_release" value="<?= $Ic->act_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="settled_amt" class="">SETTLED AMOUNT</label>
                                <input class="form-control" type="text" placeholder="SETTLED AMOUNT" id="settled_amt" name="settled_amt" value="<?= $Ic->settled_amt ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 ml-5">
                            <div class="form-group row">
                                <input class="form-control form-control-lg" type="text" name="id" value="<?= $Ic->id ?>" hidden>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                                </div>
                                <div class="col-sm-3">
                                    <a href="<?= route('getListIncomingChargeback') ?>" type="button" class="btn btn-danger" style="width: 100%;">Back</a>
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