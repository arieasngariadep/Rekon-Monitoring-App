@extends('layout.index')
@section('TitleTab', 'List Hold SAF')
@section('Title', 'List Hold SAF')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">List Hold SAF</a></li>
<li class="breadcrumb-item active">List Hold SAF</li>
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

                <form action="<?= route('getListHoldSaf') ?>" method="GET">
                    <div class="form-material">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input autocomplete="off" type="text" class="form-control" id="mid" placeholder="MID" name="mid" value="<?= $mid ?>" />
                            </div>
                            <div class="col-md-4">
                                <input autocomplete="off" type="text" class="form-control" id="tanggal_hold" placeholder="Tanggal Hold" name="tanggal_hold" value="<?= $tanggal_hold ?>" />
                            </div>
                            <div class="col-md-4">
                                <input autocomplete="off" type="text" class="form-control" id="tanggal_release" placeholder="Tanggal Release" name="tanggal_release" value="<?= $tanggal_release?>" />
                            </div>
                        </div>   
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Status</option>
                                    <option value="OPEN" <?= $status == 'OPEN' ? 'selected' : '' ?>>OPEN</option>
                                    <option value="CLOSED-DONE" <?= $status == 'CLOSED-DONE' ? 'selected' : '' ?>>CLOSED-DONE</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="jenis_transaksi" id="jenis_transaksi" class="form-control">
                                    <option value="">Jenis Transaksi</option>
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
                            <div class="col-md-3">
                                <input autocomplete="off" type="text" class="form-control" id="net_hold" placeholder="Amount" name="net_hold" value="<?= $net_hold ?>" />
                            </div>
                            <div class="col-md-3">
                                <input autocomplete="off" type="text" class="form-control" id="no_kartu" placeholder="No. Kartu" name="no_kartu" value="<?= $no_kartu ?>" />
                            </div>
                            
                        </div> 
                    </div>
                    <div class="row mb-4" style="justify-content: center">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary" style="width: 360px; height: 38px;"><i class="dripicons-search"></i>&nbsp;&nbsp;Cari</button>
                        </div>
                    </div>
                </form>

                <div class="row mb-4">
                    <div class="col-md-4 text-right">
                        <a type="button" class="btn btn-success btn-square btn-outline-dashed waves-effect waves-light" href="../Excel/HoldSaf/SearchBulk HoldSaf.xlsx"><i class="dripicons-cloud-download mr-2"></i>&nbsp;Download Format Bulk</a>
                    </div>
                    <div class="col-3 text-center">
                        <button class="btn btn-dark" style="width: 200px; height: 38px;" href="#" data-toggle="modal" data-animation="bounce" data-target=".search-bulk-holdsaf"><i class="dripicons-search"></i>&nbsp;&nbsp;Search Bulk</button>
                    </div>    
                </div>

                @if($mid != NULL || $tanggal_hold != NULL || $tanggal_release != NULL || $status != NULL || $jenis_transaksi != NULL || $net_hold != NULL || $no_kartu != NULL)
                <div class="row">
                    <div class="col-md-4 text-right">
                        <form action="{{ route('deleteHoldSaf') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="text" class="form-control" id="mid" name="mid" value="<?= $mid ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_hold" name="tanggal_hold" value="<?= $tanggal_hold ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_release" name="tanggal_release" value="<?= $tanggal_release ?>" hidden />
                            <input type="text" class="form-control" id="status" name="status" value="<?= $status ?>" hidden />
                            <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?= $jenis_transaksi ?>" hidden />
                            <input type="text" class="form-control" id="net_hold" name="net_hold" value="<?= $net_hold ?>" hidden />
                            <input type="text" class="form-control" id="no_kartu" name="no_kartu" value="<?= $no_kartu ?>" hidden />
                            <button type="submit" class="btn btn-danger" style="width: 180px; height: 38px;">
                                <i class="dripicons-trash"></i>&nbsp;&nbsp;Delete Data
                            </button>
                        </form>
                    </div>
                    <div class="col-md-2 text-center">
                        <form action="<?=route('getReportHoldSaf')?>" method="POST">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" id="mid" name="mid" value="<?= $mid ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_hold" name="tanggal_hold" value="<?= $tanggal_hold ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_release" name="tanggal_release" value="<?= $tanggal_release ?>" hidden />
                            <input type="text" class="form-control" id="status" name="status" value="<?= $status ?>" hidden />
                            <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?= $jenis_transaksi ?>" hidden />
                            <input type="text" class="form-control" id="net_hold" name="net_hold" value="<?= $net_hold ?>" hidden />
                            <input type="text" class="form-control" id="no_kartu" name="no_kartu" value="<?= $no_kartu ?>" hidden />
                            <button type="submit" class="btn btn-success" style="width: 180px; height: 38px;">
                                <i class="dripicons-cloud-download"></i>&nbsp;&nbsp;Download Report
                            </button>
                        </form>
                    </div>
                    @if($status == 'CLOSED-DONE' && count($listHoldSaf) > 0)
                    <div class="col-md-2 text-center">
                        <form action="<?=route('batalReleaseHoldSaf') ?>" method="POST">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" id="mid" name="mid" value="<?= $mid ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_hold" name="tanggal_hold" value="<?= $tanggal_hold ?>" hidden />
                            <input type="text" class="form-control" id="tanggal_release" name="tanggal_release" value="<?= $tanggal_release ?>" hidden />
                            <input type="text" class="form-control" id="status" name="status" value="<?= $status ?>" hidden />
                            <input type="text" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="<?= $jenis_transaksi ?>" hidden />
                            <input type="text" class="form-control" id="net_hold" name="net_hold" value="<?= $net_hold ?>" hidden />
                            <input type="text" class="form-control" id="no_kartu" name="no_kartu" value="<?= $no_kartu ?>" hidden />
                            <button type="submit" class="btn btn-pink" style="width: 180px; height: 38px;">
                                <i class="dripicons-cross"></i>&nbsp;&nbsp;Batalkan Release
                            </button>
                        </form>
                    </div>
                    @endif
                    <div class="col-md-4">
                        <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".formUploadReleaseHoldSaf" style="width: 180px; height: 38px;">Form Upload Release</button>
                    </div>
                </div>
                @endif

                <hr class="mt-4 mb-4">

                <div class="card-body">
                    <div class="table-wrapper" style="margin: 55px;">
                        <table class="table table-bordered dt-responsive nowrap" style="width:100%;border-collapse: collapse; border-spacing: 0;">
                            <thead>
                                <tr>
                                    <th class="text-center">Aksi</th>
                                    <td>Status</td>
                                    <td>Tanggal Hold</td>
                                    <td>MID</td>
                                    <td>Nama Merchant</td>
                                    <td>No. Kartu</td>
                                    <td>Nominal</td>
                                    <td>Approval</td>
                                    <td>Bank Name</td>
                                    <td>Cust. Name </td>
                                    <td>Act</td>
                                    <td>Settled Amount</td>
                                    <td>Amount Hold</td>
                                    <td>MDR</td>
                                    <td>Amt. Disc</td>
                                    <td>Net Hold</td>
                                    <td>Yang Dibayarkan</td>
                                    <td>Tanggal Release</td>
                                    <td>Released By</td>
                                    <td>Alasan Hold</td>
                                    <td>Alasan Release</td>
                                    <td>Kode Wilayah</td>
                                    <td>Nama Wilayah</td>
                                    <td>Jenis Transaksi</td>
                                    <td>Rekening Simpanan</td>
                                    <td>Nama Rekening Simpanan</td>
                                </tr>
                            </thead>

                            <tbody>
                                @if(count($listHoldSaf) > 0)
                                    @foreach($listHoldSaf as $list)
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
                                                <a href='{{ route('formUpdateHoldSaf', ['id' => $list->id]) }}' class='btn btn-outline-success' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit'>
                                                    <i class='fas fa-pencil-alt'></i>
                                                </a> |
                                                <a href='{{ route('deleteHoldSafById', ['id' => $list->id]) }}' class='btn btn-outline-danger' data-toggle='tooltip' data-placement='top' title='' data-original-title='Hapus'>
                                                    <i class='fas fa-trash-alt'></i>
                                                </a>
                                            </td>
                                            <td><?= $status ?></td>
                                            <td>{{ $list->tanggal_hold }}</td>
                                            <td>{{ $list->mid }}</td>
                                            <td>{{ $list->nama_merchant }}</td>
                                            <td>{{ $list->no_kartu }}</td>
                                            <td>{{ number_format($list->nominal, 0, '','.') }}</td>
                                            <td>{{ $list->apprvl }}</td>
                                            <td>{{ $list->nama_bank }}</td>
                                            <td>{{ $list->cust_name }}</td>
                                            <td>{{ $list->act_hold }}</td>
                                            <td style="text-align:right">{{ number_format($list->settled_amt, 0, '', '.') }}</td>
                                            <td style="text-align:right">{{ number_format($list->hold_amt, 0, '', '.') }}</td>
                                            <td style="text-align:right">{{ number_format($list->mdr * 100, 2, ',','') }} %</td>
                                            <td style="text-align:right">{{ number_format($list->disc_amt, 0,'','.') }}</td>
                                            <td style="text-align:right">{{ number_format($list->net_hold, 0, '', '.') }}</td>
                                            <td style="text-align:right">{{ number_format($list->paid_amt, 0, '', '.') }}</td>
                                            <td>{{ $list->tanggal_release }}</td>
                                            <td>{{ $list->released_by }}</td>
                                            <td>{{ $list->alasan_hold }}</td>
                                            <td>{{ $list->alasan_release }}</td>
                                            <td>{{ $list->kode_wilayah }}</td>
                                            <td>{{ $list->nama_wilayah }}</td>
                                            <td>{{ $list->jenis_transaksi }}</td>
                                            <td>{{ $list->rek_simpanan }}</td>
                                            <td>{{ $list->nama_rek_simpanan }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="18" class="text-center ">No Result Found</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection