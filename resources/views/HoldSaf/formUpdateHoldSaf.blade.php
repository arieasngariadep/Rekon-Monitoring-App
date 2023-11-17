@extends('layout.index')
@section('TitleTab', 'Form Update Tolakan Hold Saf')
@section('Title', 'Form Update Tolakan Hold Saf')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Saf</a></li>
<li class="breadcrumb-item active">Form Update Hold Saf</li>
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
                    <h5 class="mt-0 header-title">Form Update Hold Saf</h5>
                </div>
                <hr>
                <form class="form-horizontal auth-form my-4" action="#" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="tanggal_tolakan" class="">TANGGAL HOLD</label>
                                <input class="form-control" type="text" placeholder="TANGGAL HOLD" id="tanggal_hold" name="tanggal_hold" value="<?= $holdSaf->tanggal_hold ?>">
                            </div>
                            <div class="form-group row">
                                <label for="mid" class="">MID</label>
                                <input class="form-control" type="text" placeholder="MID" id="mid" name="mid" value="<?= $holdSaf->mid ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nama_merchant" class="">NAMA MERCHANT</label>
                                <input class="form-control" type="text" placeholder="NAMA MERCHANT" id="nama_merchant" name="nama_merchant" value="<?= $holdSaf->nama_merchant ?>">
                            </div>
                            <div class="form-group row">
                                <label for="no_kartu" class="">NO KARTU</label>
                                <input class="form-control" type="text" placeholder="NO KARTU" id="no_kartu" name="no_kartu" value="<?= $holdSaf->no_kartu ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nominal" class="">NOMINAL</label>
                                <input class="form-control" type="text" placeholder="NOMINAL" id="nominal" name="nominal" value="<?= $holdSaf->nominal ?>">
                            </div>
                            <div class="form-group row">
                                <label for="apprvl" class="">APPROVAL</label>
                                <input class="form-control" type="text" placeholder="APPROVAL" id="apprvl" name="apprvl" value="<?= $holdSaf->apprvl ?>">
                            </div>
                            <div class="form-group row">
                                <label for="bank_name" class="">BANK NAME</label>
                                <input class="form-control" type="text" placeholder="BANK NAME" id="nama_bank" name="nama_bank" value="<?= $holdSaf->nama_bank ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME</label>
                                <input class="form-control" type="text" placeholder="CUST NAME" id="cust_name" name="cust_name" value="<?= $holdSaf->cust_name ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_hold" class="">ACT</label>
                                <input class="form-control" type="text" placeholder="ACT" id="act_hold" name="act_hold" value="<?= $holdSaf->act_hold ?>">
                            </div>
                            <div class="form-group row">
                                <label for="settled_amt" class="">SETTLED AMOUNT</label>
                                <input class="form-control" type="text" placeholder="SETTLED AMOUNT" id="settled_amt" name="settled_amt" value="<?= $holdSaf->settled_amt ?>">
                            </div>
                            <div class="form-group row">
                                <label for="hold_amt" class="">HOLD AMOUNT</label>
                                <input class="form-control" type="text" placeholder="HOLD AMOUNT" id="hold_amt" name="hold_amt" value="<?= $holdSaf->hold_amt ?>">
                            </div>
                            <div class="form-group row">
                                <label for="mdr" class="">MDR</label>
                                <input class="form-control" type="text" placeholder="MDR" id="mdr" name="mdr" value="<?= $holdSaf->mdr ?>">
                            </div>
                            <div class="form-group row">
                                <label for="disc_amt" class="">DISC. AMOUNT</label>
                                <input class="form-control" type="text" placeholder="DISC. AMOUNT" id="disc_amt" name="disc_amt" value="<?= $holdSaf->disc_amt ?>">
                            </div>
                            <div class="form-group row">
                                <label for="net_hold" class="">NET HOLD</label>
                                <input class="form-control" type="text" placeholder="NET HOLD" id="net_hold" name="net_hold" value="<?= $holdSaf->net_hold ?>">
                            </div>
                        </div>

                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="paid_amt" class="">YANG DIBAYARKAN</label>
                                <input class="form-control" type="text" placeholder="YANG DIBAYARKAN" id="paid_amt" name="paid_amt" value="<?= $holdSaf->paid_amt ?>">
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_release" class="">TANGGAL RELEASE</label>
                                <input class="form-control" type="text" placeholder="TANGGAL RELEASE" id="tanggal_release" name="tanggal_release" value="<?= $holdSaf->tanggal_release ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="released_by" class="">RELEASED BY</label>
                                <input class="form-control" type="text" placeholder="RELEASED BY" id="released_by" name="released_by" value="<?= $holdSaf->released_by ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="alasan_hold" class="">ALASAN HOLD</label>
                                <input class="form-control" type="text" placeholder="ALASAN HOLD" id="alasan_hold" name="alasan_hold" value="<?= $holdSaf->alasan_hold ?>">
                            </div>
                            <div class="form-group row">
                                <label for="alasan_hold" class="">ALASAN RELEASE</label>
                                <input class="form-control" type="text" placeholder="ALASAN RELEASE" id="alasan_release" name="alasan_release" value="<?= $holdSaf->alasan_release ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="">STATUS</label>
                                <select name="status" class="form-control">
                                    <option value="">Please Select Option</option>
                                    <option value="OPEN" <?php if($holdSaf->status == "OPEN") echo 'selected="selected"'; ?>>OPEN</option>
                                    <option value="CLOSED-DONE" <?php if($holdSaf->status == "CLOSED-DONE") echo 'selected="selected"'; ?>>CLOSED-DONE</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_transaksi" class="">JENIS TRANSAKSI</label>
                                <select name="jenis_transaksi" class="form-control">
                                    <option value="">Please Select Option</option>
                                    @php
                                        foreach($rekening as $rek)
                                        {
                                            if($rek->jenis_transaksi == $holdSaf->jenis_transaksi)
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
                                <input class="form-control" type="text" placeholder="REKENING SIMPANAN" id="rek_simpanan" name="rek_simpanan" value="<?= $holdSaf->rek_simpanan ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="nama_rek_simpanan" class="">NAMA REKENING SIMPANAN</label>
                                <input class="form-control" type="text" placeholder="NAMA REKENING SIMPANAN" id="nama_rek_simpanan" name="nama_rek_simpanan" value="<?= $holdSaf->nama_rek_simpanan ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="kode_wilayah" class="">KODE WILAYAH</label>
                                <select name="kode_wilayah" class="form-control">
                                    <option value="">Please Select Option</option>
                                    @php
                                        foreach ($wilayah as $wil) {
                                            if($wil->kode_wilayah == $holdSaf->kode_wilayah)
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
                                <input class="form-control form-control-lg" type="text" name="id" value="<?= $holdSaf->id ?>" hidden>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                                </div>
                                <div class="col-sm-3">
                                    <a href="#" type="button" class="btn btn-danger" style="width: 100%;">Back</a>
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