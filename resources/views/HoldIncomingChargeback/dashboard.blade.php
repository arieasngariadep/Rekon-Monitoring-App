@extends('layout.index')
@section('TitleTab', 'Dashboard')
@section('Title', 'Dashboard')

@section('content')
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body align-self-center">
                                <div class="table-responsive browser_users">
                                    <table class="table mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="border-top-0">JENIS TRX</th>
                                                <th class="border-top-0">NOMOR REKENING</th>
                                                <th class="border-top-0">NAMA REKENING</th>
                                                <th class="border-top-0">NOMINAL DPT</th>
                                            </tr><!--end tr-->
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-top-0">BNI</th>
                                                <td class="border-top-0">BNI</th>
                                                <td class="border-top-0">BNI</th>
                                                <td class="border-top-0">BNI</th>
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
</div>
@endsection('content')