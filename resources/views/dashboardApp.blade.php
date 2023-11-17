@extends('layout.index')
@section('TitleTab', 'Dashboard')
@section('Title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <span class="badge badge-soft-success float-right">Active</span>
                        <div class="media">
                            <img src="{{ asset('assets') }}/images/bni-logo.webp" class="mr-3 thumb-md rounded-circle" alt="...">
                            <div class="media-body align-self-center">
                                <h5 class="mb-4 font-16">Tolakan Payment Merchant</h5>
                                <p class="text-muted mb-4">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <a href="{{ route('dashboardHoldPayment') }}" class="btn btn-sm btn-outline-primary d-sm-inline-block">Masuk Ke Aplikasi</a>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <span class="badge badge-soft-success float-right">Active</span>
                        <div class="media">
                            <img src="{{ asset('assets') }}/images/bni-logo.webp" class="mr-3 thumb-md rounded-circle" alt="...">
                            <div class="media-body align-self-center">
                                <h5 class="mb-4 font-16">Hold Incoming Chargeback</h5>
                                <p class="text-muted mb-4">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <a href="{{ route('dashboardIncomingChargeback') }}" class="btn btn-sm btn-outline-primary d-sm-inline-block">Masuk Ke Aplikasi</a>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <span class="badge badge-soft-success float-right">Active</span>
                        <div class="media">
                            <img src="{{ asset('assets') }}/images/bni-logo.webp" class="mr-3 thumb-md rounded-circle" alt="...">
                            <div class="media-body align-self-center">
                                <h5 class="mb-4 font-16">Hold SAF</h5>
                                <p class="text-muted mb-4">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <a href="<?=route('getListHoldSaf')?>" class="btn btn-sm btn-outline-primary d-sm-inline-block">Masuk Ke Aplikasi</a>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <span class="badge badge-soft-success float-right">Active</span>
                        <div class="media">
                            <img src="{{ asset('assets') }}/images/bni-logo.webp" class="mr-3 thumb-md rounded-circle" alt="...">
                            <div class="media-body align-self-center">
                                <h5 class="mb-4 font-16">BND UI</h5>
                                <p class="text-muted mb-4">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <a href="#" class="btn btn-sm btn-outline-primary d-sm-inline-block">Masuk Ke Aplikasi</a>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <span class="badge badge-soft-success float-right">Active</span>
                        <div class="media">
                            <img src="{{ asset('assets') }}/images/bni-logo.webp" class="mr-3 thumb-md rounded-circle" alt="...">
                            <div class="media-body align-self-center">
                                <h5 class="mb-4 font-16">BND013</h5>
                                <p class="text-muted mb-4">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <a href="#" class="btn btn-sm btn-outline-primary d-sm-inline-block">Masuk Ke Aplikasi</a>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <span class="badge badge-soft-success float-right">Active</span>
                        <div class="media">
                            <img src="{{ asset('assets') }}/images/bni-logo.webp" class="mr-3 thumb-md rounded-circle" alt="...">
                            <div class="media-body align-self-center">
                                <h5 class="mb-4 font-16">Merchant</h5>
                                <p class="text-muted mb-4">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <a href="#" class="btn btn-sm btn-outline-primary d-sm-inline-block">Masuk Ke Aplikasi</a>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <span class="badge badge-soft-success float-right">Active</span>
                        <div class="media">
                            <img src="{{ asset('assets') }}/images/bni-logo.webp" class="mr-3 thumb-md rounded-circle" alt="...">
                            <div class="media-body align-self-center">
                                <h5 class="mb-4 font-16">Outgoing</h5>
                                <p class="text-muted mb-4">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <a href="#" class="btn btn-sm btn-outline-primary d-sm-inline-block">Masuk Ke Aplikasi</a>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <span class="badge badge-soft-success float-right">Active</span>
                        <div class="media">
                            <img src="{{ asset('assets') }}/images/bni-logo.webp" class="mr-3 thumb-md rounded-circle" alt="...">
                            <div class="media-body align-self-center">
                                <h5 class="mb-4 font-16">Users</h5>
                                <p class="text-muted mb-4">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <a href="{{ route('getListUsers') }}" class="btn btn-sm btn-outline-primary d-sm-inline-block">Masuk Ke Aplikasi</a>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card ico-card">
                    <div class="card-body">
                        <span class="badge badge-soft-success float-right">Active</span>
                        <div class="media">
                            <img src="{{ asset('assets') }}/images/bni-logo.webp" class="mr-3 thumb-md rounded-circle" alt="...">
                            <div class="media-body align-self-center">
                                <h5 class="mb-4 font-16">Master Rekon Merchant</h5>
                                <p class="text-muted mb-4">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <a href="#" class="btn btn-sm btn-outline-primary d-sm-inline-block">Masuk Ke Aplikasi</a>
                            </div><!--end media body-->
                        </div><!--end media-->
                    </div><!--end card-body-->
                </div>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>
@endsection