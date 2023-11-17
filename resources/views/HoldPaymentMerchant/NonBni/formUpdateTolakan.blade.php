@extends('layout.index')
@section('TitleTab', 'Form Update Tolakan Non BNI')
@section('Title', 'Form Update Tolakan Non BNI')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">Form Update Tolakan Non BNI</li>
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
                    <h5 class="mt-0 header-title">Form Update Tolakan Non BNI</h5>
                </div>
                <hr>
                <form class="form-horizontal auth-form my-4" action="{{ route('prosesUpdateTolakanNonBni') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="tanggal_tolakan" class="">TANGGAL TOLAKAN</label>
                                <input class="form-control" type="text" placeholder="TANGGAL TOLAKAN" id="tanggal_tolakan" name="tanggal_tolakan" value="<?= $nonBni->tanggal_tolakan ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nomor_refrensi" class="">NOMOR REFRENSI</label>
                                <input class="form-control" type="text" placeholder="NOMOR REFRENSI" id="nomor_refrensi" name="nomor_refrensi" value="<?= $nonBni->nomor_refrensi ?>">
                            </div>
                            <div class="form-group row">
                                <label for="rekening_debet" class="">REKENING DEBET</label>
                                <input class="form-control" type="text" placeholder="REKENING DEBET" id="rekening_debet" name="rekening_debet" value="<?= $nonBni->rekening_debet ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nama_pengirim" class="">NAMA PENGIRIM</label>
                                <input class="form-control" type="text" placeholder="NAMA PENGIRIM" id="nama_pengirim" name="nama_pengirim" value="<?= $nonBni->nama_pengirim ?>">
                            </div>
                            <div class="form-group row">
                                <label for="residency_pengirim" class="">RESIDENCY PENGIRIM</label>
                                <input class="form-control" type="text" placeholder="RESIDENCY PENGIRIM" id="residency_pengirim" name="residency_pengirim" value="<?= $nonBni->residency_pengirim ?>">
                            </div>
                            <div class="form-group row">
                                <label for="net_amount" class="">NET AMOUNT</label>
                                <input class="form-control" type="text" placeholder="NET AMOUNT" id="net_amount" name="net_amount" value="<?= $nonBni->net_amount ?>">
                            </div>
                            <div class="form-group row">
                                <label for="pesan_pengirim" class="">PESAN PENGIRIM</label>
                                <input class="form-control" type="text" placeholder="PESAN PENGIRIM" id="pesan_pengirim" name="pesan_pengirim" value="<?= $nonBni->pesan_pengirim ?>">
                            </div>
                            <div class="form-group row">
                                <label for="kode_bank" class="">KDOE BANK</label>
                                <input class="form-control" type="text" placeholder="KDOE BANK" id="kode_bank" name="kode_bank" value="<?= $nonBni->kode_bank ?>">
                            </div>
                            <div class="form-group row">
                                <label for="rek_penerima" class="">REKENING PENERIMA</label>
                                <input class="form-control" type="text" placeholder="REKENING PENERIMA" id="rek_penerima" name="rek_penerima" value="<?= $nonBni->rek_penerima ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nama_penerima" class="">NAMA PENERIMA</label>
                                <input class="form-control" type="text" placeholder="NAMA PENERIMA" id="nama_penerima" name="nama_penerima" value="<?= $nonBni->nama_penerima ?>">
                            </div>
                            <div class="form-group row">
                                <label for="cust_name" class="">CUST. NAME RELEASE</label>
                                <input class="form-control" type="text" placeholder="CUST NAME RELEASE" id="cust_name_release" name="cust_name_release" value="<?= $bni->cust_name_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="act_release" class="">ACT RELEASE</label>
                                <input class="form-control" type="text" placeholder="ACT RELEASE" id="act_release" name="act_release" value="<?= $nonBni->act_release ?>">
                            </div>
                            <div class="form-group row">
                                <label for="jenis_nasabah_penerima" class="">JENIS NASABAH PENERIMA</label>
                                <input class="form-control" type="text" placeholder="ACT RELEASE" id="jenis_nasabah_penerima" name="jenis_nasabah_penerima" value="<?= $nonBni->jenis_nasabah_penerima ?>">
                            </div>
                        </div>

                        <div class="col-lg-5 ml-5">
                            <div class="form-group row">
                                <label for="residency_penerima" class="">RESIDENCY PENERIMA</label>
                                <input class="form-control" type="text" placeholder="NOMOR REFRENSI" id="residency_penerima" name="residency_penerima" value="<?= $nonBni->residency_penerima ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nama_bank_penerima" class="">NAMA BANK PENERIMA</label>
                                <input class="form-control" type="text" placeholder="NAMA BANK PENERIMA" id="nama_bank_penerima" name="nama_bank_penerima" value="<?= $nonBni->nama_bank_penerima ?>">
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_payment" class="">TANGGAL PAYMENT</label>
                                <input class="form-control" type="text" placeholder="TANGGAL PAYMENT" id="tanggal_payment" name="tanggal_payment" value="<?= $nonBni->tanggal_payment ?>">
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_reproses_payment" class="">TANGGAL REPROSES PAYMENT</label>
                                <input class="form-control" type="text" placeholder="TANGGAL REPROSES PAYMENT" id="tanggal_reproses_payment" name="tanggal_reproses_payment" value="<?= $nonBni->tanggal_reproses_payment ?>">
                            </div>
                            <div class="form-group row">
                                <label for="alasan_tolakan" class="">ALASAN TOLAKAN</label>
                                <input class="form-control" type="text" placeholder="ALASAN TOLAKAN" id="alasan_tolakan" name="alasan_tolakan" value="<?= $nonBni->alasan_tolakan ?>">
                            </div>
                            <div class="form-group row">
                                <label for="mid" class="">MID</label>
                                <input class="form-control" type="text" placeholder="MID" id="mid" name="mid" value="<?= $nonBni->mid ?>">
                            </div>
                            <div class="form-group row">
                                <label for="nama_merchant" class="">NAMA MERCHANT</label>
                                <input class="form-control" type="text" placeholder="NAMA MERCHANT" id="nama_merchant" name="nama_merchant" value="<?= $nonBni->nama_merchant ?>">
                            </div>
                            <div class="form-group row">
                                <label for="status" class="">STATUS</label>
                                <select name="status" class="form-control">
                                    <option value="">Please Select Option</option>
                                    <option value="OPEN" <?php if($nonBni->status == "OPEN") echo 'selected="selected"'; ?>>OPEN</option>
                                    <option value="CLOSED-DONE" <?php if($nonBni->status == "CLOSED-DONE") echo 'selected="selected"'; ?>>CLOSED-DONE</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_transaksi" class="">JENIS TRANSAKSI</label>
                                <select name="jenis_transaksi" class="form-control">
                                    <option value="">Please Select Option</option>
                                    @php
                                        foreach($rekening as $rek)
                                        {
                                            if($rek->jenis_transaksi == $nonBni->jenis_transaksi)
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
                                <input class="form-control" type="text" placeholder="REKENING SIMPANAN" id="rek_simpanan" name="rek_simpanan" value="<?= $nonBni->rek_simpanan ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="nama_rek_simpanan" class="">NAMA REKENING SIMPANAN</label>
                                <input class="form-control" type="text" placeholder="NAMA REKENING SIMPANAN" id="nama_rek_simpanan" name="nama_rek_simpanan" value="<?= $nonBni->nama_rek_simpanan ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="kode_wilayah" class="">KODE WILAYAH</label>
                                <select name="kode_wilayah" class="form-control">
                                    <option value="">Please Select Option</option>
                                    @php
                                        foreach ($wilayah as $wil) {
                                            if($wil->kode_wilayah == $nonBni->kode_wilayah)
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
                                <input class="form-control form-control-lg" type="text" name="id" value="<?= $nonBni->id ?>" hidden>
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