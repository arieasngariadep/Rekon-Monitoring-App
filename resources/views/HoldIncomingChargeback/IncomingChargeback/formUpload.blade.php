@extends('layout.index')
@section('TitleTab', 'Form Upload Incoming Chargeback')
@section('Title', 'Form Upload Incoming Chargeback')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboardApp') }}">Dashboard App</a></li>
<li class="breadcrumb-item"><a href="#">Hold Incoming Chargeback</a></li>
<li class="breadcrumb-item active">Form Upload Incoming Chargeback</li>
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Form Upload Incoming Chargeback</h4>
                <p class="text-muted mb-3"><span style="color: red;">Format file upload .xlsx</span></p>
                <form action="{{ route('prosesUploadIncomingChargeback') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="button-items mb-2">
                        <a type="button" class="btn btn-dark btn-square btn-outline-dashed waves-effect waves-light" href="../Excel/HoldIncomingChargeback/Format Incoming Chargeback.xlsx">
                            <i class="dripicons-cloud-download mr-2"></i>Download Format
                        </a>
                    </div>
                    <input type="file" name="file_import" id="input-file-now" class="dropify" />
                    <div class="button-items mt-3 text-center">
                        <button type="submit" class="btn btn-blue btn-square waves-effect waves-light"><i class="dripicons-cloud-upload mr-2"></i>Upload</button>
                    </div>
                </form>

                @php
                    if(!empty($ic_temp))
                    {
                        $no = 1;
                        $table = '
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>ARN</th>
                                                    <th>Amount</th>
                                                    <th>Mch Number</th>
                                                    <th>Approval</th>
                                                    <th>Keterangan Error</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                        foreach ($ic_temp as $temp) {
                                            if($temp->keterangan == 'Data Sudah Ada')
                                            {
                                                $style = "style='background: #E07171;color: black;'";
                                            }else{
                                                $style = '';
                                            }
                                            $table .= '
                                                <tr '.$style.'>
                                                    <td class="text-center">'.$no.'</td>
                                                    <td>'.$temp->arn.'</td>
                                                    <td>'.number_format($temp->amount, 0, '', '.').'</td>
                                                    <td>'.$temp->mch_number.'</td>
                                                    <td>'.$temp->approval.'</td>
                                                    <td>'.$temp->keterangan.'</td>
                                                </tr>';
                                            $no++;
                                        }
                                        $table .= '
                                            </tbody>
                                        </table>';

                                        if($count == 0)
                                        {
                                            $table .= ' 
                                            <form action="'.route('prosesInsertIncomingChargeback').'" method="POST">
                                                '.csrf_field().'
                                                <div class="button-items mt-3 text-center">
                                                    <button type="submit" class="btn btn-success btn-square waves-effect waves-light"><i class="dripicons-cloud-upload mr-2"></i>Import</button>
                                                </div>
                                            </form>';
                                        }else{
                                            $table .= ' 
                                            <form action="'.route('prosesClearIncomingChargebackTemp').'" method="POST">
                                                '.csrf_field().'
                                                <div class="button-items mt-3 text-center">
                                                    <button type="submit" class="btn btn-danger btn-square waves-effect waves-light"><i class="dripicons-trash mr-2"></i>Clear</button>
                                                </div>
                                            </form>';
                                        }
                                        $table .= '
                                    </div>
                                </div>
                            </div>
                        </div>';
                        echo $table;
                    }
                @endphp
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection