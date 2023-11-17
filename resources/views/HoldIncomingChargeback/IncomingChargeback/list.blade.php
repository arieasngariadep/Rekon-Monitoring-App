@extends('layout.index')
@section('TitleTab', 'List Incoming Chargeback')
@section('Title', 'List Incoming Chargeback')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="{{ route('dashboardHoldPayment') }}">Hold Payment Merchant</a></li>
<li class="breadcrumb-item active">List Incoming Chargeback</li>
@endsection

@section('content')
<style>
    th, td {
        white-space: nowrap;
        overflow: hidden;
    }
    .table-wrapper {
        overflow-x: scroll;
        width: 1000px;
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
    <div class="col-lg-4">
        <div class="card card-eco">
            <div class="card-body">
                <h4 class="title-text mt-0">Total Item</h4>
                <div class="d-flex justify-content-between">
                    <h3 class="font-weight-bold"><?= number_format($total->total_item, 0, '', '.') ?></h3>
                    <i class="dripicons-cart card-eco-icon text-secondary align-self-center"></i>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
    <div class="col-lg-4">
        <div class="card card-eco">
            <div class="card-body">
                <h4 class="title-text mt-0">Total Amount</h4>
                <div class="d-flex justify-content-between">
                    <h3 class="font-weight-bold"><?= number_format($total->total_amount, 0, '', '.') ?></h3>
                    <i class="dripicons-wallet card-eco-icon text-success align-self-center"></i>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
    <div class="col-lg-4">
        <div class="card card-eco">
            <div class="card-body">
                <h4 class="title-text mt-0">Total Net Amount</h4>
                <div class="d-flex justify-content-between">
                    <h3 class="font-weight-bold"><?= number_format($total->total_net_amount, 0, '', '.') ?></h3>
                    <i class="dripicons-camera card-eco-icon text-pink align-self-center"></i>
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
                <form action="<?= route('getListIncomingChargeback') ?>" method="GET">
                    <div class="form-material">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <input autocomplete="off" type="text" class="form-control" id="mch_number" placeholder="MID" name="mch_number" value="<?= $mch_number ?>" />
                            </div>
                            <div class="col-md-3">
                                <input autocomplete="off" type="text" class="form-control" id="approval" placeholder="Approval Code" name="approval" value="<?= $approval ?>" />
                            </div>
                            <div class="col-md-3">
                                <input autocomplete="off" type="text" class="form-control" id="amount" placeholder="Amount" name="amount" value="<?= $amount ?>" />
                            </div>
                            <div class="col-md-3">
                                <input autocomplete="off" type="text" class="form-control" id="arn" placeholder="ARN" name="arn" value="<?= $arn ?>" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <select name="jenis_transaksi" id="jenis_transaksi" class="form-control">
                                    <option value="">Please Select Jenis Transaksi</option>
                                    @php
                                        foreach ($listJenisTrx as $list) {
                                            if($list->jenis_transaksi == $jenis_transaksi)
                                            {
                                                $sel = 'selected';
                                            }else{
                                                $sel = '';
                                            }

                                            echo "
                                            <option value='$list->jenis_transaksi' $sel>$list->jenis_transaksi</option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="info_status" id="info_status" class="form-control">
                                    <option value="">Please Select Info Status</option>
                                    @php
                                        foreach ($listInfoStatus as $list) {
                                            if($list->info_status == $info_status)
                                            {
                                                $sel = 'selected';
                                            }else{
                                                $sel = '';
                                            }

                                            echo "
                                            <option value='$list->info_status' $sel>$list->info_status</option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="proses_incoming" id="proses_incoming" class="form-control">
                                    <option value="">Please Select Final Status</option>
                                    @php
                                        foreach ($listProsesIncoming as $list) {
                                            if($list->proses_incoming == $proses_incoming)
                                            {
                                                $sel = 'selected';
                                            }else{
                                                $sel = '';
                                            }

                                            echo "
                                            <option value='$list->proses_incoming' $sel>$list->proses_incoming</option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="final_status" id="final_status" class="form-control">
                                    <option value="">Please Select Final Status</option>
                                    <option value="ON PROCESS" <?= $final_status == 'ON PROCESS' ? 'selected' : "" ?>>ON PROCESS</option>
                                    <option value="CASE CLOSED" <?= $final_status == 'CASE CLOSED' ? 'selected' : "" ?>>CASE CLOSED</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-right">
                                <button type="submit" class="btn btn-primary" style="width: 180px; height: 38px;"><i class="dripicons-search"></i>&nbsp;&nbsp;Cari</button>
                            </div>
                </form>

                @if($mch_number != NULL || $approval != NULL || $amount != NULL || $arn != NULL || $jenis_transaksi != NULL || $info_status != NULL || $proses_incoming != NULL || $final_status != NULL)
                            <div class="col-md-2 text-center">
                                <form action="{{ route('prosesReportIncomingChargebackExport') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="text" class="form-control" id="mch_number" name="mch_number" value="<?= $mch_number ?>" hidden />
                                    <input type="text" class="form-control" id="approval" name="approval" value="<?= $approval ?>" hidden />
                                    <input type="text" class="form-control" id="amount" name="amount" value="<?= $amount ?>" hidden />
                                    <input type="text" class="form-control" id="arn" name="arn" value="<?= $arn ?>" hidden />
                                    <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?= $jenis_transaksi ?>" hidden />
                                    <input type="text" class="form-control" id="info_status" name="info_status" value="<?= $info_status ?>" hidden />
                                    <input type="text" class="form-control" id="proses_incoming" name="proses_incoming" value="<?= $proses_incoming ?>" hidden />
                                    <input type="text" class="form-control" id="final_status" name="final_status" value="<?= $final_status ?>" hidden />
                                    <button type="submit" class="btn btn-success" style="width: 180px; height: 38px;">
                                        <i class="dripicons-cloud-download"></i>&nbsp;&nbsp;Download Report
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-2 text-center">
                                <form action="{{ route('deleteIncomingChargeback') }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="text" class="form-control" id="mch_number" name="mch_number" value="<?= $mch_number ?>" hidden />
                                    <input type="text" class="form-control" id="approval" name="approval" value="<?= $approval ?>" hidden />
                                    <input type="text" class="form-control" id="amount" name="amount" value="<?= $amount ?>" hidden />
                                    <input type="text" class="form-control" id="arn" name="arn" value="<?= $arn ?>" hidden />
                                    <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?= $jenis_transaksi ?>" hidden />
                                    <input type="text" class="form-control" id="info_status" name="info_status" value="<?= $info_status ?>" hidden />
                                    <input type="text" class="form-control" id="proses_incoming" name="proses_incoming" value="<?= $proses_incoming ?>" hidden />
                                    <input type="text" class="form-control" id="final_status" name="final_status" value="<?= $final_status ?>" hidden />
                                    <button type="submit" class="btn btn-danger" style="width: 180px; height: 38px;">
                                        <i class="dripicons-trash"></i>&nbsp;&nbsp;Delete Data
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-4 text-left">
                                <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".formUploadCekVoucher" style="width: 180px; height: 38px;">Form Cek Voucher</button>
                            </div>
                        </div>
                    </div>


                @if($roleId == 4 || $roleId == 5 || $roleId == 7)
                @if($proses_incoming == 'Debet Merchant kredit ke Rek Hold' || $proses_incoming == 'Debet SOF kredit ke Rek Hold')
                <div class="row mt-4 mb-4">
                    <div class="col-md-4 text-right">
                        <form action="{{ route('prosesApproval') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" id="mch_number" name="mch_number" value="<?= $mch_number ?>" hidden />
                            <input type="text" class="form-control" id="approval" name="approval" value="<?= $approval ?>" hidden />
                            <input type="text" class="form-control" id="amount" name="amount" value="<?= $amount ?>" hidden />
                            <input type="text" class="form-control" id="arn" name="arn" value="<?= $arn ?>" hidden />
                            <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?= $jenis_transaksi ?>" hidden />
                            <input type="text" class="form-control" id="info_status" name="info_status" value="<?= $info_status ?>" hidden />
                            <input type="text" class="form-control" id="proses_incoming" name="proses_incoming" value="<?= $proses_incoming ?>" hidden />
                            <input type="text" class="form-control" id="final_status" name="final_status" value="<?= $final_status ?>" hidden />
                            <button type="submit" class="btn btn-purple" style="width: 180px; height: 38px;">
                                <i class="dripicons-checkmark"></i>&nbsp;&nbsp;Approve
                            </button>
                        </form>
                    </div>
                    <div class="col-md-2 text-center">
                        <form action="{{ route('prosesBatalkanApproval') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" id="mch_number" name="mch_number" value="<?= $mch_number ?>" hidden />
                            <input type="text" class="form-control" id="approval" name="approval" value="<?= $approval ?>" hidden />
                            <input type="text" class="form-control" id="amount" name="amount" value="<?= $amount ?>" hidden />
                            <input type="text" class="form-control" id="arn" name="arn" value="<?= $arn ?>" hidden />
                            <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?= $jenis_transaksi ?>" hidden />
                            <input type="text" class="form-control" id="info_status" name="info_status" value="<?= $info_status ?>" hidden />
                            <input type="text" class="form-control" id="proses_incoming" name="proses_incoming" value="<?= $proses_incoming ?>" hidden />
                            <input type="text" class="form-control" id="final_status" name="final_status" value="<?= $final_status ?>" hidden />
                            <button type="submit" class="btn btn-pink" style="width: 180px; height: 38px;">
                                <i class="dripicons-cross"></i>&nbsp;&nbsp; Batalkan Approve
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row mt-4 mb-4">
                    <div class="col-md-4 text-right">
                        <form action="{{ route('prosesApprovalAsisten') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" id="mch_number" name="mch_number" value="<?= $mch_number ?>" hidden />
                            <input type="text" class="form-control" id="approval" name="approval" value="<?= $approval ?>" hidden />
                            <input type="text" class="form-control" id="amount" name="amount" value="<?= $amount ?>" hidden />
                            <input type="text" class="form-control" id="arn" name="arn" value="<?= $arn ?>" hidden />
                            <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?= $jenis_transaksi ?>" hidden />
                            <input type="text" class="form-control" id="info_status" name="info_status" value="<?= $info_status ?>" hidden />
                            <input type="text" class="form-control" id="proses_incoming" name="proses_incoming" value="<?= $proses_incoming ?>" hidden />
                            <input type="text" class="form-control" id="final_status" name="final_status" value="<?= $final_status ?>" hidden />
                            <button type="submit" class="btn btn-succses" style="width: 180px; height: 38px;">
                                <i class="dripicons-checkmark"></i>&nbsp;&nbsp;Approve Asisten
                            </button>
                        </form>
                    </div>
                </div>
                @endif
                @endif
                @endif

                <hr class="mt-4 mb-4">

                <div class="card-body scrollme">
                    <div class="table-wrapper">
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Aksi</th>
                                    <td>Wilayah</td>
                                    <td>ID</td>
                                    <td>Tgl Req ITR</td>
                                    <td>Nomor Kartu</td>
                                    <td>ARN</td>
                                    <td>TRX Date</td>
                                    <td>Amount</td>
                                    <td>MDR</td>
                                    <td>Net Amount</td>
                                    <td>Merchant Name</td>
                                    <td>Merchant Number</td>
                                    <td>Approval</td>
                                    <td>History</td>
                                    <td>Jenis Transaksi</td>
                                    <td>NPG / CC</td>
                                    <td>Cek BND</td>
                                    <td>Request Incoming</td>
                                    <td>Tgl Incoming</td>
                                    <td>Proses Incoming</td>
                                    <td>Total Nominal Hold Incoming</td>
                                    <td>Status Hold Incoming</td>
                                    <td>Tgl Info Status Chargeback</td>
                                    <td>Status Chargeback</td>
                                    <td>Proses RKM 1</td>
                                    <td>Status Debet Merchant</td>
                                    <td>Tgl Info Hasil Finak</td>
                                    <td>Proses RKM 2</td>
                                    <td>Final Status</td>
                                </tr>
                            </thead>

                            @if(isset($listIC))
                            <tbody>
                                @if(count($listIC) > 0)
                                    @foreach($listIC as $list)
                                        <tr>
                                            <td>
                                                <a href='{{ route('formUpdateIncomingChargeback', ['id' => $list->id]) }}' class='btn btn-outline-success' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit'>
                                                    <i class='fas fa-pencil-alt'></i>
                                                </a> |
                                                <a href='#' class='btn btn-outline-danger' data-toggle='tooltip' data-placement='top' title='' data-original-title='Hapus'>
                                                    <i class='fas fa-trash-alt'></i>
                                                </a>
                                            </td>
                                            <td>{{ $list->wilayah }}</td>
                                            <td>{{ $list->id_ }}</td>
                                            <td>{{ $list->tgl_req_itr }}</td>
                                            <td>{{ $list->nomor_kartu }}</td>
                                            <td>{{ $list->arn }}</td>
                                            <td>{{ $list->trx_date }}</td>
                                            <td>{{ number_format($list->amount, 0, '', '.') }}</td>
                                            <td>{{ $list->mdr }}</td>
                                            <td>{{ number_format($list->net_amount, 0, '', '.') }}</td>
                                            <td>{{ $list->merchant_name }}</td>
                                            <td>{{ $list->mch_number }}</td>
                                            <td>{{ $list->approval }}</td>
                                            <td>{{ $list->history }}</td>
                                            <td>{{ $list->jenis_transaksi }}</td>
                                            <td>{{ $list->npg_cc }}</td>
                                            <td>{{ $list->cek_bnd }}</td>
                                            <td>{{ $list->request_incoming }}</td>
                                            <td>{{ $list->tgl_incoming }}</td>
                                            <td>{{ $list->proses_incoming }}</td>
                                            <td>{{ number_format($list->total_nominal_hold_incoming, 0, '', '.') }}</td>
                                            <td>{{ $list->status_hold_incoming }}</td>
                                            <td>{{ $list->tgl_info_status_cb }}</td>
                                            <td>{{ $list->status_cb }}</td>
                                            <td>{{ $list->proses_rkm_1 }}</td>
                                            <td>{{ $list->status_debet_merchant }}</td>
                                            <td>{{ $list->tanggal_info_hasil_final }}</td>
                                            <td>{{ $list->proses_rkm_2 }}</td>
                                            <td>{{ $list->final_status }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="18" class="text-center ">No Result Found</td></tr>
                                @endif
                            </tbody>
                            @endif
                        </table>

                        <br><br>
                        
                        @if(isset($listIC))
                        <div class="row">
                            <div class="col-md-5">
                                @if(count($listIC) > 0)
                                <div class="pull-left">
                                    Showing {{ $listIC->firstItem() }} to {{ $listIC->lastItem() }} of {{ number_format($listIC->total()) }} entries
                                </div>
                                @else
                                <div class="pull-left">
                                    Showing 0 to 0 of {{ $listIC->total() }} entries
                                </div>
                                @endif
                            </div>
                            <div class="col-md-7">
                                <div class="pull-right">
                                    {{ $listIC->links('layout.pagination') }}
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
                                    <table class="table table-danger">
                                        <tr>
                                            <th>Baris</th>
                                            <th>Tanggal Tolakan</th>
                                            <th>mch_number</th>
                                            <th>Settled Amount</th>
                                        </tr>

                                        @foreach (session()->get('failures') as $validation)
                                            <tr>
                                                <td>{{ $validation->row() }}</td>
                                                @php
                                                    $validationErrors = explode(';', $validation->values()[$validation->attribute()]);
                                                    array_pop($validationErrors);
                                                    foreach ($validationErrors as $e)
                                                    {
                                                        echo "<td>$e</td>";
                                                    }
                                                @endphp
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