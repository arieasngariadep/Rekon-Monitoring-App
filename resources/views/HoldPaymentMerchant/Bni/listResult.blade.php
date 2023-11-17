@extends('layout.index')
@section('TitleTab', 'List Tolakan BNI')
@section('Title', 'List Tolakan BNI')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="{{ route('dashboardHoldPayment') }}">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">List Tolakan BNI</li>
@endsection

@section('content')
<style>
    th, td {
        white-space: nowrap;
        overflow: hidden;
    }
    .table-wrapper {
        overflow-x: scroll;
        width: 1370px;
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= route('getListTolakanBni') ?>" method="GET">
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
                                            echo "<option value='$list->jenis_transaksi' $sel>$list->nama_transaksi</option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary" style="width: 360px; height: 38px;"><i class="dripicons-search"></i>&nbsp;&nbsp;Cari</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row mb-4">
                    <div class="col-md-4 text-right">
                        <a type="button" class="btn btn-success btn-square btn-outline-dashed waves-effect waves-light" href="../../Excel/HoldPaymentMerchant/SearchBulk Holdpayment.xlsx"><i class="dripicons-cloud-download mr-2"></i>&nbsp;Download Format</a>
                    </div>
                    <div class="col-3 text-center">
                        <button class="btn btn-dark" style="width: 200px; height: 38px;" href="#" data-toggle="modal" data-animation="bounce" data-target=".search-bulk-tolakan"><i class="dripicons-search"></i>&nbsp;&nbsp;Search Bulk</button>
                    </div> 
                    <div class="col-md-5 text-left">
                        <form action="<?= route('prosesReportSearchBulkBniTolakanExport') ?>" method="POST">
                            @csrf
                            <div class="col-md-4 mb-3 text-right">
                                <input type="submit" class="btn btn-secondary waves-effect waves-light" style="width: 200px" name="submit" value="Download Report">
                            </div>
                        </form>
                    </div>   
                </div>

                

                <hr class="mt-4 mb-4">

                <div class="card-body scrollme">
                    <div class="table-wrapper">
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Aksi</th>
                                    <td>Status</td>
                                    <td>Tanggal Tolakan</td>
                                    <td>MID</td>
                                    <td>Nama Merchant</td>
                                    <td>Bank Name</td>
                                    <td>Cust. Name</td>
                                    <td>Act Tolakan</td>
                                    <td>Tanggal Payment</td>
                                    <td>Bank Name Release</td>
                                    <td>Cust. Name Release</td>
                                    <td>Act Relase</td>
                                    <td>Tanggal Reproses Payment</td>
                                    <td>Settled Amount</td>
                                    <td>Alasan Tolakan</td>
                                    <td>Jenis Tolakan </td>
                                    <td>Jenis Transaksi </td>
                                    <td>Rekening Simpanan</td>
                                    <td>Nama Rekening Simpanan</td>
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
                                                <a href='{{ route('formUpdateTolakanBni', ['id' => $list->id]) }}' class='btn btn-outline-success' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit'>
                                                    <i class='fas fa-pencil-alt'></i>
                                                </a> |
                                                <a href='{{ route('deleteTolakanBniById', ['id' => $list->id]) }}' class='btn btn-outline-danger' data-toggle='tooltip' data-placement='top' title='' data-original-title='Hapus'>
                                                    <i class='fas fa-trash-alt'></i>
                                                </a>
                                            </td>
                                            <td><?= $status ?></td>
                                            <td>{{ $list->tanggal_tolakan }}</td>
                                            <td>{{ $list->mid }}</td>
                                            <td>{{ $list->nama_merchant }}</td>
                                            <td>{{ $list->bank_name }}</td>
                                            <td>{{ $list->cust_name }}</td>
                                            <td>{{ $list->act_tolakan }}</td>
                                            <td>{{ $list->tanggal_payment }}</td>
                                            <td>{{ $list->bank_name_release }}</td>
                                            <td>{{ $list->cust_name_release }}</td>
                                            <td>{{ $list->act_release }}</td>
                                            <td>{{ $list->tanggal_reproses_payment }}</td>
                                            <td>{{ number_format($list->settled_amt, 0, '', '.') }}</td>
                                            <td>{{ $list->alasan_tolakan }}</td>
                                            <td>{{ $list->jenis_tolakan }}</td>
                                            <td>{{ $list->jenis_transaksi }}</td>
                                            <td>{{ $list->rek_simpanan }}</td>
                                            <td>{{ $list->nama_rek_simpanan }}</td>
                                            <td>{{ $list->kode_wilayah }}</td>
                                            <td>{{ $list->nama_wilayah }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="18" class="text-center ">No Result Found</td></tr>
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
                    </div>
                </div>

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
                                                <td>{{ $validation->values()['settled_amt'] }}</td>
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
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection