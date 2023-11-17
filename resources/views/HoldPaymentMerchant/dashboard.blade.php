@extends('layout.index')
@section('TitleTab', 'Dashboard')
@section('Title', 'Dashboard')

@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body align-self-center">
                                <div class="table-responsive browser_users">
                                    <table class="table mb-0">
                                        <thead class="thead-light">
                                            <h5 class="text-center">Data Jumlah Transaksi Tolakan</h5>
                                            <tr>
                                                <th class="border-top-0" style='text-align:center'>JENIS TRX</th>
                                                <th class="border-top-0" style='text-align:center'>JUMLAH MID</th>
                                                <th class="border-top-0" style='text-align:center'>JUMLAH TRX</th>
                                                <th class="border-top-0" style='text-align:center'>TOTAL AMOUNT</th>
                                            </tr><!--end tr-->
                                        </thead>
                                        <tbody>
                                            <?php

                                                $totalMid = 0;
                                                $totalTrx = 0;
                                                $totalAmtTrx = 0;
                                                foreach($listTransaksi as $list){
                                                    $totalMid += $list->jumlah_mid;
                                                    $totalTrx += $list->jumlah_transaksi;
                                                    if($list->total_amount == null){
                                                        $list->total_amount = 0;
                                                    }
                                                    $formatAmt = number_format($list->total_amount,0,'','.');
                                                    $totalAmtTrx += $list->total_amount;
                                                echo"
                                                        <tr>
                                                            <td style='text-align:center'>$list->jenis_transaksi</td>
                                                            <td style='text-align:center'>$list->jumlah_mid</td>
                                                            <td style='text-align:center'>$list->jumlah_transaksi</td>
                                                            <td style='text-align:right'>$formatAmt</td>
                                                        </tr>
                                                    ";
                                                }
                                            ?>   
                                            <tr>
                                                <td style='text-align:center'>TOTAL</td>
                                                <td style='text-align:center'>{{$totalMid  }}</td>
                                                <td style='text-align:center'>{{ $totalTrx }}</td>
                                                <td style='text-align:right'>{{number_format($totalAmtTrx,0,'','.') }}</td>    
                                            </tr>                                         
                                        </tbody>
                                    </table> <!--end table-->                                               
                                </div><!--end /div-->
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body align-self-center">
                                <div id="chartHoldPaymentDeb"></div>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body align-self-center">
                                <div id="chartHoldPaymentKre"></div>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body align-self-center">
                                <div id="chartHoldPaymentLink"></div>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body align-self-center">
                                <div id="chartHoldPaymentQris"></div>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body align-self-center">
                                <div id="chartHoldPaymentTap"></div>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->


</div>
@endsection('content')