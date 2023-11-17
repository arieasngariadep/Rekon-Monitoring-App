@extends('layout.index')
@section('TitleTab', 'Form Update Tolakan BNI')
@section('Title', 'Form Update Tolakan BNI')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">Form Update Tolakan BNI</li>
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
                    <h5 class="mt-0 header-title">Form Update Tolakan BNI</h5>
                </div>
                <hr>
                <form class="form-horizontal auth-form my-4" action="{{ route('prosesUpdateTolakanBni') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="tanggal_tolakan" class="">TANGGAL TOLAKAN</label>
                                <input class="form-control" type="text" placeholder="TANGGAL TOLAKAN" id="tanggal_tolakan" name="tanggal_tolakan" value="<?= $bni->tanggal_tolakan ?>">
                            </div>
                            <div class="form-group row">
                                <label for="mid" class="">MID</label>
                                <input class="form-control" type="text" placeholder="MID" id="mid" name="mid" value="<?= $bni->mid ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nama_merchant" class="">NAMA MERCHANT</label>
                                <input class="form-control" type="text" placeholder="NAMA MERCHANT" id="nama_merchant" name="nama_merchant" value="<?= $bni->nama_merchant ?>">
                            </div>
                            <div class="form-group row">
                                <label for="bank_name" class="">BANK NAME</label>
                                <input class="form-control" type="text" placeholder="BANK NAME" id="bank_name" name="bank_name" value="<?= $bni->bank_name ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME</label>
                                <input class="form-control" type="text" placeholder="CUST NAME" id="cust_name" name="cust_name" value="<?= $bni->cust_name ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_tolakan" class="">ACT TOLAKAN</label>
                                <input class="form-control" type="text" placeholder="ACT TOLAKAN" id="act_tolakan" name="act_tolakan" value="<?= $bni->act_tolakan ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME RELEASE</label>
                                <input class="form-control" type="text" placeholder="CUST NAME RELEASE" id="cust_name_release" name="cust_name_release" value="<?= $bni->cust_name_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_release" class="">ACT RELEASE</label>
                                <input class="form-control" type="text" placeholder="ACT RELEASE" id="act_release" name="act_release" value="<?= $bni->act_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="settled_amt" class="">SETTLED AMOUNT</label>
                                <input class="form-control" type="text" placeholder="SETTLED AMOUNT" id="settled_amt" name="settled_amt" value="<?= $bni->settled_amt ?>">
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_settlement" class="">TANGGAL SETTLEMENT</label>
                                <input class="form-control" type="text" placeholder="tanggal_settlement" id="tanggal_settlement" name="tanggal_settlement" value="<?= $bni->tanggal_settlement ?>" readonly>
                            </div>
                        </div>

                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="tanggal_payment" class="">TANGGAL PAYMENT</label>
                                <input class="form-control" type="text" placeholder="TANGGAL PAYMENT" id="tanggal_payment" name="tanggal_payment" value="<?= $bni->tanggal_payment ?>">
                            </div>
                            <div class="form-group row">
                                <label for="alasan_tolakan" class="">ALASAN TOLAKAN</label>
                                <input class="form-control" type="text" placeholder="ALASAN TOLAKAN" id="alasan_tolakan" name="alasan_tolakan" value="<?= $bni->alasan_tolakan ?>">
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_reproses_payment" class="">TANGGAL REPROSES PAYMENT</label>
                                <input class="form-control" type="text" placeholder="TANGGAL REPROSES PAYMENT" id="tanggal_reproses_payment" name="tanggal_reproses_payment" value="<?= $bni->tanggal_reproses_payment ?>">
                            </div>
                            <div class="form-group row">
                                <label for="status" class="">STATUS</label>
                                <select name="status" class="form-control">
                                    <option value="">Please Select Option</option>
                                    <option value="OPEN" <?php if($bni->status == "OPEN") echo 'selected="selected"'; ?>>OPEN</option>
                                    <option value="CLOSED-DONE" <?php if($bni->status == "CLOSED-DONE") echo 'selected="selected"'; ?>>CLOSED-DONE</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_transaksi" class="">JENIS TRANSAKSI</label>
                                <select name="jenis_transaksi" class="form-control">
                                    <option value="">Please Select Option</option>
                                    @php
                                        foreach($rekening as $rek)
                                        {
                                            if($rek->jenis_transaksi == $bni->jenis_transaksi)
                                            {
                                                $sel = 'selected';
                                            }else{
                                                $sel = '';
                                            }
                                            echo "<option value='$rek->jenis_transaksi' $sel>$rek->jenis_transaksi</option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="rek_simpanan" class="">REKENING SIMPANAN</label>
                                <input class="form-control" type="text" placeholder="REKENING SIMPANAN" id="rek_simpanan" name="rek_simpanan" value="<?= $bni->rek_simpanan ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="nama_rek_simpanan" class="">NAMA REKENING SIMPANAN</label>
                                <input class="form-control" type="text" placeholder="NAMA REKENING SIMPANAN" id="nama_rek_simpanan" name="nama_rek_simpanan" value="<?= $bni->nama_rek_simpanan ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="kode_wilayah" class="">KODE WILAYAH</label>
                                <select name="kode_wilayah" class="form-control">
                                    <option value="">Please Select Option</option>
                                    @php
                                        foreach ($wilayah as $wil) {
                                            if($wil->kode_wilayah == $bni->kode_wilayah)
                                            {
                                                $sel = 'selected';
                                            }else{
                                                $sel = '';
                                            }
                                            echo "<option value='$wil->kode_wilayah' $sel>$wil->kode_wilayah - $wil->nama_wilayah</option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 ml-5">
                            <div class="form-group row">
                                <input class="form-control form-control-lg" type="text" name="id" value="<?= $bni->id ?>" hidden>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                                </div>
                                <div class="col-sm-3">
                                    <a href="<?= route('getListTolakanBni') ?>" type="button" class="btn btn-danger" style="width: 100%;">Back</a>
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