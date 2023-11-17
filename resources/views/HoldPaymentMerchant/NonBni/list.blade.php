@extends('layout.index')
@section('TitleTab', 'List Tolakan Non BNI')
@section('Title', 'List Tolakan Non BNI')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="{{ route('dashboardHoldPayment') }}">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">List Tolakan Non BNI</li>
@endsection

@section('content')
<style>
    th, td {
        white-space: nowrap;
        overflow: hidden;
    }
    .table-wrapper {
        overflow-x: scroll;
        width: 1100px;
        margin: 0 auto;
        table-layout: fixed;
    }
</style>

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

@if(!empty($total))
<div class="row">
    <div class="col-lg-3">
        <div class="card card-eco">
            <div class="card-body">
                <h4 class="title-text mt-0">Total Item</h4>
                <div class="d-flex justify-content-between">
                    <h3 class="font-weight-bold"><?= number_format($total->total_item, 0, '', '.') ?></h3>
                    <i class="dripicons-cart card-eco-icon text-secondary  align-self-center"></i>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
    <div class="col-lg-3">
        <div class="card card-eco">
            <div class="card-body">
                <h4 class="title-text mt-0">Total Settled Amount</h4>
                <div class="d-flex justify-content-between">
                    <h3 class="font-weight-bold"><?= number_format($total->total_amount, 0, '', '.') ?></h3>
                    <i class="dripicons-wallet card-eco-icon text-success  align-self-center"></i>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= route('getListTolakanNonBni') ?>" method="GET">
                    <div class="form-material">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input autocomplete="off" type="text" class="form-control" id="mid" placeholder="MID" name="mid" value="<?= $mid ?>" />
                            </div>
                            <div class="col-md-4">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Please Select Option</option>
                                    <option value="OPEN" <?= $status == 'OPEN' ? 'selected' : '' ?>>OPEN</option>
                                    <option value="CLOSED-DONE" <?= $status == 'CLOSED-DONE' ? 'selected' : '' ?>>CLOSED-DONE</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input autocomplete="off" type="text" class="form-control" id="tanggal_tolakan" placeholder="Tanggal Tolakan" name="tanggal_tolakan" value="<?= $tanggal_tolakan ?>" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input autocomplete="off" type="text" class="form-control" id="tanggal_reproses_payment" placeholder="Tanggal Reproses Payment" name="tanggal_reproses_payment" value="<?= $tanggal_reproses_payment ?>" />
                            </div>
                            <div class="col-md-4">
                                <select name="jenis_transaksi" id="jenis_transaksi" class="form-control">
                                    <option value="">Please Select Option</option>
                                    @php
                                        foreach($rekening as $list)
                                        {
                                            if($list->jenis_transaksi == $jenis_transaksi)
                                            {
                                                $sel = 'selected';
                                            }else{
                                                $sel = '';
                                            }
                                            echo "<option value='$list->jenis_transaksi' $sel>$list->jenis_transaksi</option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary" style="width: 180px; height: 38px;"><i class="dripicons-search"></i>&nbsp;&nbsp;Cari</button>
                            </div>
                        </div>
                    </div>
                </form>

                @if($mid != NULL || $status != NULL || $tanggal_tolakan != NULL || $tanggal_reproses_payment != NULL || $jenis_transaksi != NULL)
                <div class="row">
                    <div class="col-md-3 text-center">
                        <form action="{{ route('deleteTolakanNonBni') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="text" class="form-control" id="mid" name="mid" value="<?= $mid ?>" hidden />
                            <input type="text" class="form-control" id="status" name="status" value="<?= $status ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_tolakan" name="tanggal_tolakan" value="<?= $tanggal_tolakan ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_reproses_payment" name="tanggal_reproses_payment" value="<?= $tanggal_reproses_payment ?>" hidden />
                            <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?= $jenis_transaksi ?>" hidden />
                            <div class="col-md-4 text-right">
                                <button type="submit" class="btn btn-danger" style="width: 180px; height: 38px;">
                                    <i class="dripicons-trash"></i>&nbsp;&nbsp;Delete Data
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3 text-center">
                        <form action="{{ route('prosesReportNonBniTolakanExport') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" id="mid" name="mid" value="<?= $mid ?>" hidden />
                            <input type="text" class="form-control" id="status" name="status" value="<?= $status ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_tolakan" name="tanggal_tolakan" value="<?= $tanggal_tolakan ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_reproses_payment" name="tanggal_reproses_payment" value="<?= $tanggal_reproses_payment ?>" hidden />
                            <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?= $jenis_transaksi ?>" hidden />
                            <button type="submit" class="btn btn-success" style="width: 180px; height: 38px;">
                                <i class="dripicons-cloud-download"></i>&nbsp;&nbsp;Download Report
                            </button>
                        </form>
                    </div>
                    @if($status == 'CLOSED-DONE' && count($listTolakan) > 0)
                    <div class="col-md-3 text-center">
                        <form action="{{ route('prosesBatalkanReleaseNonBni') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" id="mid" name="mid" value="<?= $mid ?>" hidden />
                            <input type="text" class="form-control" id="status" name="status" value="<?= $status ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_tolakan" name="tanggal_tolakan" value="<?= $tanggal_tolakan ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_reproses_payment" name="tanggal_reproses_payment" value="<?= $tanggal_reproses_payment ?>" hidden />
                            <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?= $jenis_transaksi ?>" hidden />
                            <button type="submit" class="btn btn-pink" style="width: 180px; height: 38px;">
                                <i class="dripicons-cross"></i>&nbsp;&nbsp;Batalkan Release
                            </button>
                        </form>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".formUploadReleaseNonBni" style="width: 180px; height: 38px;">Form Upload Release</button>
                    </div>
                </div>
                @endif

                <hr class="mt-4 mb-4">

                <div class="card-body scrollme">
                    <div class="table-wrapper">
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Aksi</th>
                                    <td>Status</td>
                                    <td>Tanggal Tolakan</td>
                                    <td>Nomor Referensi</td>
                                    <td>Rekening Debet</td>
                                    <td>Nama Pengirim</td>
                                    <td>Residency Pengirim </td>
                                    <td>Net Amount</td>
                                    <td>Pesan Pengirim</td>
                                    <td>Kode Bank</td>
                                    <td>Rekening Enerima</td>
                                    <td>Nama Penerima</td>
                                    <td>Cust. Name Release</td>
                                    <td>Act Release</td>
                                    <td>Jenis Nasabah Penerima</td>
                                    <td>Residency Penerima</td>
                                    <td>Nama Bank Penerima</td>
                                    <td>Tanggal Payment</td>
                                    <td>Tanggal Reproses Payment</td>
                                    <td>Alasan Tolakan</td>
                                    <td>Mid</td>
                                    <td>Nama Merchant</td>
                                    <td>Jenis Transaksi</td>
                                    <td>Rek Debet</td>
                                    <td>Nama Rekening Debet</td>
                                    <td>Kode Wilayah</td>
                                    <td>Nama Wilayah</td>
                                </tr>
                            </thead>

                            @if(isset($listTolakan))
                            <tbody>
                                @if(count($listTolakan) > 0)
                                    @foreach($listTolakan as $list)
                                        @php
                                            if($list->status == 'OPEN')
                                            {
                                                $status = '<span class="badge badge-soft-danger float-right">'.$list->status.'</span>';
                                            }else{
                                                $status = '<span class="badge badge-soft-success float-right">'.$list->status.'</span>';
                                            }
                                        @endphp
                                        <tr>
                                            <td>
                                                <a href='{{ route('formUpdateTolakanNonBni', ['id' => $list->id]) }}' class='btn btn-outline-success' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit'>
                                                    <i class='fas fa-pencil-alt'></i>
                                                </a> |
                                                <a href='#' class='btn btn-outline-danger' data-toggle='tooltip' data-placement='top' title='' data-original-title='Hapus'>
                                                    <i class='fas fa-trash-alt'></i>
                                                </a>
                                            </td>
                                            <td><?= $status ?></td>
                                            <td>{{ $list->tanggal_tolakan }}</td>
                                            <td>{{ $list->nomor_refrensi }}</td>
                                            <td>{{ $list->rekening_debet }}</td>
                                            <td>{{ $list->nama_pengirim }}</td>
                                            <td>{{ $list->residency_pengirim }}</td>
                                            <td>{{ number_format($list->net_amount, 0, '', '.') }}</td>
                                            <td>{{ $list->pesan_pengirim }}</td>
                                            <td>{{ $list->kode_bank }}</td>
                                            <td>{{ $list->rek_penerima }}</td>
                                            <td>{{ $list->nama_penerima }}</td>
                                            <td>{{ $list->cust_name_release }}</td>
                                            <td>{{ $list->act_release }}</td>
                                            <td>{{ $list->jenis_nasabah_penerima }}</td>
                                            <td>{{ $list->residency_penerima }}</td>
                                            <td>{{ $list->nama_bank_penerima }}</td>
                                            <td>{{ $list->tanggal_payment }}</td>
                                            <td>{{ $list->tanggal_reproses_payment }}</td>
                                            <td>{{ $list->alasan_tolakan }}</td>
                                            <td>{{ $list->mid }}</td>
                                            <td>{{ $list->nama_merchant }}</td>
                                            <td>{{ $list->jenis_transaksi }}</td>
                                            <td>{{ $list->rek_simpanan }}</td>
                                            <td>{{ $list->nama_rek_simpanan }}</td>
                                            <td>{{ $list->kode_wilayah }}</td>
                                            <td>{{ $list->nama_wilayah }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="17" class="text-center ">No Result Found</td></tr>
                                @endif
                            </tbody>
                            @endif
                        </table>

                        <br><br>
                        
                        @if(isset($listTolakan))
                        <div class="row">
                            <div class="col-md-5">
                                @if(count($listTolakan) > 0)
                                <div class="pull-left">
                                    Showing {{ $listTolakan->firstItem() }} to {{ $listTolakan->lastItem() }} of {{ number_format($listTolakan->total()) }} entries
                                </div>
                                @else
                                <div class="pull-left">
                                    Showing 0 to 0 of {{ $listTolakan->total() }} entries
                                </div>
                                @endif
                            </div>
                            <div class="col-md-7">
                                <div class="pull-right">
                                    {{ $listTolakan->links('layout.pagination') }}
                                </div>
                            </div>
                        </div>
                        @endif

                        @if((isset($errors) && $errors->any()) || (session()->has('failures')))
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        @if(isset($errors) && $errors->any())
                                            <div class="alert alert-danger">
                                                @foreach ($error->all() as $erorr)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif

                                        @if(session()->has('failures'))
                                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <tr>
                                                    <th>Baris</th>
                                                    <th>Tanggal Tolakan</th>
                                                    <th>MID</th>
                                                    <th>Settled Amount</th>
                                                    <th>Keterangan Error</th>
                                                </tr>
                                                @foreach (session()->get('failures') as $validation)
                                                    <tr style='background: #E07171;color: black;'>
                                                        <td>{{ $validation->row() }}</td>
                                                        <td>{{ $validation->values()['tanggal_tolakan'] }}</td>
                                                        <td>{{ $validation->values()['mid'] }}</td>
                                                        <td>{{ $validation->values()['net_amount'] }}</td>
                                                        <td>
                                                            <ul>
                                                                @foreach ($validation->errors() as $e)
                                                                    <li>{{ $e }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection