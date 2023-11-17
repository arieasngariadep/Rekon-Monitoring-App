<?php
    $segment1 = Request::segment(1);
    $segment2 = Request::segment(2);
    $segment3 = Request::segment(3);
    $role = Session::get('role_id')
?>

<div class="left-sidenav">
    <div class="main-icon-menu">
        <nav class="nav">
            <a href="#DashboardApp" class="nav-link <?= $segment1 == 'dashboardApp' ? 'active' : '' ?>" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Dashboard App">
                <svg class="nav-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
                        <path d="M184,448h48c4.4,0,8-3.6,8-8V72c0-4.4-3.6-8-8-8h-48c-4.4,0-8,3.6-8,8v368C176,444.4,179.6,448,184,448z"/>
                        <path class="svg-primary" d="M88,448H136c4.4,0,8-3.6,8-8V296c0-4.4-3.6-8-8-8H88c-4.4,0-8,3.6-8,8V440C80,444.4,83.6,448,88,448z"/>
                        <path class="svg-primary" d="M280.1,448h47.8c4.5,0,8.1-3.6,8.1-8.1V232.1c0-4.5-3.6-8.1-8.1-8.1h-47.8c-4.5,0-8.1,3.6-8.1,8.1v207.8C272,444.4,275.6,448,280.1,448z"/>
                        <path d="M368,136.1v303.8c0,4.5,3.6,8.1,8.1,8.1h47.8c4.5,0,8.1-3.6,8.1-8.1V136.1c0-4.5-3.6-8.1-8.1-8.1h-47.8C371.6,128,368,131.6,368,136.1z"/>
                    </g>
                </svg>
            </a><!--end DashboardApp-->

            <a href="#TolakanPaymentMerchant" class="nav-link <?= $segment1 == 'HoldPaymentMerchant' ? 'active' : '' ?>" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Hold Payment Merchant">
                <svg class="nav-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path class="svg-primary" d="M410.5 279.2c-5-11.5-12.7-21.6-28.1-30.1-8.2-4.5-16.1-7.8-25.4-10 5.4-2.5 10-5.4 16.3-11 7.5-6.6 13.1-15.7 15.6-23.3 2.6-7.5 4.1-18 3.5-28.2-1.1-16.8-4.4-33.1-13.2-44.8-8.8-11.7-21.2-20.7-37.6-27-12.6-4.8-25.5-7.8-45.5-8.9V32h-40v64h-32V32h-41v64H96v48h27.9c8.7 0 14.6.8 17.6 2.3 3.1 1.5 5.3 3.5 6.5 6 1.3 2.5 1.9 8.4 1.9 17.5V343c0 9-.6 14.8-1.9 17.4-1.3 2.6-2 4.9-5.1 6.3-3.1 1.4-3.2 1.3-11.8 1.3h-26.4L96 416h87v64h41v-64h32v64h40v-64.4c26-1.3 44.5-4.7 59.4-10.3 19.3-7.2 34.1-17.7 44.7-31.5 10.6-13.8 14.9-34.9 15.8-51.2.7-14.5-.9-33.2-5.4-43.4zM224 150h32v74h-32v-74zm0 212v-90h32v90h-32zm72-208.1c6 2.5 9.9 7.5 13.8 12.7 4.3 5.7 6.5 13.3 6.5 21.4 0 7.8-2.9 14.5-7.5 20.5-3.8 4.9-6.8 8.3-12.8 11.1v-65.7zm28.8 186.7c-7.8 6.9-12.3 10.1-22.1 13.8-2 .8-4.7 1.4-6.7 1.9v-82.8c5 .8 7.6 1.8 11.3 3.4 7.8 3.3 15.2 6.9 19.8 13.2 4.6 6.3 8 15.6 8 24.7 0 10.9-2.8 19.2-10.3 25.8z"/>
                </svg>
            </a><!--end TolakanPaymentMerchant-->

            <a href="#HoldIncomingChargeback" class="nav-link <?= $segment1 == 'HoldIncomingChargeback' ? 'active' : '' ?>" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Hold Incoming Chargeback">
                <svg class="nav-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M256 48C141.1 48 48 141.1 48 256s93.1 208 208 208 208-93.1 208-208S370.9 48 256 48zm61 356l-12.2-39.6c13-5.8 24.9-14 35.3-24.4 10.4-10.4 18.6-22.3 24.4-35.3l39.5 12.1c-7.9 19.3-19.7 37-34.9 52.2-15.1 15.3-32.8 27.1-52.1 35zM195 108l12.2 39.6c-13 5.8-24.9 14-35.3 24.4-10.4 10.4-18.6 22.3-24.4 35.3L108 195.2c7.9-19.3 19.7-37 34.9-52.2 15.1-15.3 32.8-27.1 52.1-35zm61 84c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zm113.1-49.1c15.2 15.2 26.9 32.9 34.9 52.1l-39.5 12.2c-5.9-13-14-24.9-24.4-35.3-10.4-10.4-22.3-18.6-35.3-24.4l12.1-39.5c19.3 7.9 37 19.7 52.2 34.9zM142.9 369.1c-15.2-15.1-27-32.8-34.9-52.1l39.5-12.2c5.9 13 14 24.9 24.4 35.3 10.4 10.4 22.3 18.6 35.3 24.4L195.1 404c-19.3-7.9-37-19.7-52.2-34.9z"/>
                </svg>
            </a><!--end HoldIncomingChargeback-->

            <a href="#HoldSaf" class="nav-link <?= $segment1 == 'HoldSaf' ? 'active' : '' ?>" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="HOLD SAF">
                <svg class="nav-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path class="svg-primary" d="M256 32C132.288 32 32 132.288 32 256s100.288 224 224 224 224-100.288 224-224S379.712 32 256 32zm135.765 359.765C355.5 428.028 307.285 448 256 448s-99.5-19.972-135.765-56.235C83.972 355.5 64 307.285 64 256s19.972-99.5 56.235-135.765C156.5 83.972 204.715 64 256 64s99.5 19.972 135.765 56.235C428.028 156.5 448 204.715 448 256s-19.972 99.5-56.235 135.765z"/>
                    <path d="M200.043 106.067c-40.631 15.171-73.434 46.382-90.717 85.933H256l-55.957-85.933zM412.797 288A160.723 160.723 0 0 0 416 256c0-36.624-12.314-70.367-33.016-97.334L311 288h101.797zM359.973 134.395C332.007 110.461 295.694 96 256 96c-7.966 0-15.794.591-23.448 1.715L310.852 224l49.121-89.605zM99.204 224A160.65 160.65 0 0 0 96 256c0 36.639 12.324 70.394 33.041 97.366L201 224H99.204zM311.959 405.932c40.631-15.171 73.433-46.382 90.715-85.932H256l55.959 85.932zM152.046 377.621C180.009 401.545 216.314 416 256 416c7.969 0 15.799-.592 23.456-1.716L201.164 288l-49.118 89.621z"/>
                </svg>
            </a><!--end BNDUI-->

            <a href="#BND013" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="BND013">
                <svg class="nav-svg" version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
                        <ellipse class="svg-primary" transform="matrix(0.9998 -1.842767e-02 1.842767e-02 0.9998 -7.7858 3.0205)" cx="160" cy="424" rx="24" ry="24"/>
                        <ellipse class="svg-primary" transform="matrix(2.381651e-02 -0.9997 0.9997 2.381651e-02 -48.5107 798.282)" cx="384.5" cy="424" rx="24" ry="24"/>
                        <path d="M463.8,132.2c-0.7-2.4-2.8-4-5.2-4.2L132.9,96.5c-2.8-0.3-6.2-2.1-7.5-4.7c-3.8-7.1-6.2-11.1-12.2-18.6
                            c-7.7-9.4-22.2-9.1-48.8-9.3c-9-0.1-16.3,5.2-16.3,14.1c0,8.7,6.9,14.1,15.6,14.1c8.7,0,21.3,0.5,26,1.9c4.7,1.4,8.5,9.1,9.9,15.8
                            c0,0.1,0,0.2,0.1,0.3c0.2,1.2,2,10.2,2,10.3l40,211.6c2.4,14.5,7.3,26.5,14.5,35.7c8.4,10.8,19.5,16.2,32.9,16.2h236.6
                            c7.6,0,14.1-5.8,14.4-13.4c0.4-8-6-14.6-14-14.6H189h-0.1c-2,0-4.9,0-8.3-2.8c-3.5-3-8.3-9.9-11.5-26l-4.3-23.7
                            c0-0.3,0.1-0.5,0.4-0.6l277.7-47c2.6-0.4,4.6-2.5,4.9-5.2l16-115.8C464,134,464,133.1,463.8,132.2z"/>
                    </g>
                </svg>
            </a> <!--end BND013-->   

            <a href="#Merchant" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Merchant">
                <svg class="nav-svg" version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
                        <g>
                            <path d="M276,68.1v219c0,3.7-2.5,6.8-6,7.7L81.1,343.4c-2.3,0.6-3.6,3.1-2.7,5.4C109.1,426,184.9,480.6,273.2,480
                                C387.8,479.3,480,386.5,480,272c0-112.1-88.6-203.5-199.8-207.8C277.9,64.1,276,65.9,276,68.1z"/>
                        </g>
                        <path class="svg-primary" d="M32,239.3c0,0,0.2,48.8,15.2,81.1c0.8,1.8,2.8,2.7,4.6,2.2l193.8-49.7c3.5-0.9,6.4-4.6,6.4-8.2V36c0-2.2-1.8-4-4-4
                            C91,33.9,32,149,32,239.3z"/>
                    </g>
                </svg>
            </a><!--end Merchant-->

            <a href="#Outgoing" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Outgoing">
                <svg class="nav-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M70.7 164.5l169.2 81.7c4.4 2.1 10.3 3.2 16.1 3.2s11.7-1.1 16.1-3.2l169.2-81.7c8.9-4.3 8.9-11.3 0-15.6L272.1 67.2c-4.4-2.1-10.3-3.2-16.1-3.2s-11.7 1.1-16.1 3.2L70.7 148.9c-8.9 4.3-8.9 11.3 0 15.6z"/>
                    <path class="svg-primary" d="M441.3 248.2s-30.9-14.9-35-16.9-5.2-1.9-9.5.1S272 291.6 272 291.6c-4.5 2.1-10.3 3.2-16.1 3.2s-11.7-1.1-16.1-3.2c0 0-117.3-56.6-122.8-59.3-6-2.9-7.7-2.9-13.1-.3l-33.4 16.1c-8.9 4.3-8.9 11.3 0 15.6l169.2 81.7c4.4 2.1 10.3 3.2 16.1 3.2s11.7-1.1 16.1-3.2l169.2-81.7c9.1-4.2 9.1-11.2.2-15.5z"/>
                    <path d="M441.3 347.5s-30.9-14.9-35-16.9-5.2-1.9-9.5.1S272.1 391 272.1 391c-4.5 2.1-10.3 3.2-16.1 3.2s-11.7-1.1-16.1-3.2c0 0-117.3-56.6-122.8-59.3-6-2.9-7.7-2.9-13.1-.3l-33.4 16.1c-8.9 4.3-8.9 11.3 0 15.6l169.2 81.7c4.4 2.2 10.3 3.2 16.1 3.2s11.7-1.1 16.1-3.2l169.2-81.7c9-4.3 9-11.3.1-15.6z"/>
                </svg>
            </a><!--end Outgoing-->

            <a href="#Users" class="nav-link <?= $segment1 == 'users' ? 'active' : '' ?>" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Users">
                <svg class="nav-svg" version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
                        <path d="M462.5,352.3c-1.9-5.5-5.6-11.5-11.4-18.3c-10.2-12-30.8-29.3-54.8-47.2c-2.6-2-6.4-0.8-7.5,2.3l-4.7,13.4
                            c-0.7,2,0,4.3,1.7,5.5c15.9,11.6,35.9,27.9,41.8,35.9c2,2.8-0.5,6.6-3.9,5.8c-10-2.3-29-7.3-44.2-12.8c-8.6-3.1-17.7-6.7-27.2-10.6
                            c16-20.8,24.7-46.3,24.7-72.6c0-32.8-13.2-63.6-37.1-86.4c-22.9-21.9-53.8-34.1-85.7-33.7c-25.7,0.3-50.1,8.4-70.7,23.5
                            c-18.3,13.4-32.2,31.3-40.6,52c-8.3-6-16.1-11.9-23.2-17.6c-13.7-10.9-28.4-22-38.7-34.7c-2.2-2.8,0.9-6.7,4.4-5.9
                            c11.3,2.6,35.4,10.9,56.4,18.9c1.5,0.6,3.2,0.3,4.5-0.8l11.1-10.1c2.4-2.1,1.7-6-1.3-7.2C121,137.4,89.2,128,73.2,128
                            c-11.5,0-19.3,3.5-23.3,10.4c-7.6,13.3,7.1,35.2,45.1,66.8c34.1,28.5,82.6,61.8,136.5,92c87.5,49.1,171.1,81,208,81
                            c11.2,0,18.7-3.1,22.1-9.1C464.4,364.4,464.7,358.7,462.5,352.3z"/>
                        <path  class="svg-primary" d="M312,354c-29.1-12.8-59.3-26-92.6-44.8c-30.1-16.9-59.4-36.5-84.4-53.6c-1-0.7-2.2-1.1-3.4-1.1c-0.9,0-1.9,0.2-2.8,0.7
                            c-2,1-3.3,3-3.3,5.2c0,1.2-0.1,2.4-0.1,3.5c0,32.1,12.6,62.3,35.5,84.9c22.9,22.7,53.4,35.2,85.8,35.2c23.6,0,46.5-6.7,66.2-19.5
                            c1.9-1.2,2.9-3.3,2.7-5.5C315.5,356.8,314.1,354.9,312,354z"/>
                    </g>
                </svg>                           
            </a><!--end Users-->

            <a href="#MasterRekonMerch" class="nav-link <?= $segment1 == 'MasterRekonMerch' ? 'active' : '' ?>" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Master Rekon Merchant">
                <svg class="nav-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M70.7 164.5l169.2 81.7c4.4 2.1 10.3 3.2 16.1 3.2s11.7-1.1 16.1-3.2l169.2-81.7c8.9-4.3 8.9-11.3 0-15.6L272.1 67.2c-4.4-2.1-10.3-3.2-16.1-3.2s-11.7 1.1-16.1 3.2L70.7 148.9c-8.9 4.3-8.9 11.3 0 15.6z"/>
                    <path class="svg-primary" d="M441.3 248.2s-30.9-14.9-35-16.9-5.2-1.9-9.5.1S272 291.6 272 291.6c-4.5 2.1-10.3 3.2-16.1 3.2s-11.7-1.1-16.1-3.2c0 0-117.3-56.6-122.8-59.3-6-2.9-7.7-2.9-13.1-.3l-33.4 16.1c-8.9 4.3-8.9 11.3 0 15.6l169.2 81.7c4.4 2.1 10.3 3.2 16.1 3.2s11.7-1.1 16.1-3.2l169.2-81.7c9.1-4.2 9.1-11.2.2-15.5z"/>
                    <path d="M441.3 347.5s-30.9-14.9-35-16.9-5.2-1.9-9.5.1S272.1 391 272.1 391c-4.5 2.1-10.3 3.2-16.1 3.2s-11.7-1.1-16.1-3.2c0 0-117.3-56.6-122.8-59.3-6-2.9-7.7-2.9-13.1-.3l-33.4 16.1c-8.9 4.3-8.9 11.3 0 15.6l169.2 81.7c4.4 2.2 10.3 3.2 16.1 3.2s11.7-1.1 16.1-3.2l169.2-81.7c9-4.3 9-11.3.1-15.6z"/>
                </svg>
            </a><!--end Master Rekon Merch-->

        </nav><!--end nav-->
    </div><!--end main-icon-menu-->

    <div class="main-menu-inner">
        <div class="menu-body slimscroll">
            <div id="DashboardApp" class="main-icon-menu-pane <?= $segment1 == 'dashboardApp' ? 'active' : '' ?>">
                <div class="title-box">
                    <h6 class="menu-title">Dashboard App</h6>       
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'dashboardApp' ? 'active' : '' ?>" href="{{ route('dashboardApp') }}">
                            <i class="dripicons-meter"></i>Dashboard
                        </a>
                    </li>
                </ul>
            </div><!-- end DashboardApp -->

            <div id="TolakanPaymentMerchant" class="main-icon-menu-pane <?= $segment1 == 'HoldPaymentMerchant' ? 'active' : '' ?>">
                <div class="title-box">
                    <h6 class="menu-title">Tolakan Payment Merchant</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'HoldPaymentMerchant' && $segment2 == 'dashboard' ? 'active' : '' ?>" href="{{ route('dashboardHoldPayment') }}">
                            <i class="dripicons-device-desktop"></i>Dashboard
                        </a>
                    </li>

                    <!-- TOLAKAN BNI -->
                    @if($role != 6)
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'Bni' && $segment3 == 'formUploadTolakan' ? 'active' : '' ?>" href="{{ route('formUploadTolakanBni') }}">
                            <i class="dripicons-wallet"></i>Upload Tolakan BNI
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'Bni' && $segment3 == 'list' ? 'active' : '' ?>" href="{{ route('getListTolakanBni') }}">
                            <i class="dripicons-blog"></i>List Tolakan BNI
                        </a>
                    </li>
                    @if( $role != 6)
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'Bni' && $segment3 == 'formUpdateBulk' ? 'active' : '' ?>" href="{{ route('formUpdateBulkTolakan') }}">
                            <i class="dripicons-blog"></i>Form Update Bulk Tolakan
                        </a>
                    </li>

                    @endif
                    
                    <!-- TOLAKAN NON BNI -->
                    {{-- <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'NonBni' && $segment3 == 'formUploadTolakan' ? 'active' : '' ?>" href="{{ route('formUploadTolakanNonBni') }}">
                            <i class="dripicons-calendar"></i>Upload Tolakan Non BNI
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'NonBni' && $segment3 == 'list' ? 'active' : '' ?>" href="{{ route('getListTolakanNonBni') }}">
                            <i class="dripicons-stack"></i>List Tolakan Non BNI
                        </a>
                    </li> --}}
                </ul>

                <div class="title-box mt-4">
                    <h8 class="menu-title">Master</h8>
                </div>
                <ul class="nav">                
                    <!-- MASTER -->
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'Rekening' ? 'active' : '' ?>" href="{{ route('getListRekening') }}">
                            <i class="dripicons-list"></i>List Rekening
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment2 == 'Wilayah' ? 'active' : '' ?>" href="{{ route('getListWilayah') }}">
                            <i class="dripicons-checklist"></i>List Wilayah
                        </a>
                    </li>
                </ul>
            </div><!-- end TolakanPaymentMerchant -->

            <div id="HoldIncomingChargeback" class="main-icon-menu-pane <?= $segment1 == 'HoldIncomingChargeback' ? 'active' : '' ?>">
                <div class="title-box">
                    <h6 class="menu-title">Hold Incoming Chargeback</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'HoldIncomingChargeback' && $segment2 == 'dashboard' ? 'active' : '' ?>" href="{{ route('dashboardIncomingChargeback') }}">
                            <i class="dripicons-store"></i>Dashboard
                        </a>
                    </li>

                    <!-- INCOMING CHARGEBACK -->
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'HoldIncomingChargeback' && $segment2 == 'formUpload' ? 'active' : '' ?>" href="{{ route('formUploadIncomingChargeback') }}">
                            <i class="dripicons-rocket"></i>Upload Incoming Chargeback
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'HoldIncomingChargeback' && $segment2 == 'list' ? 'active' : '' ?>" href="{{ route('getListIncomingChargeback') }}">
                            <i class="dripicons-basketball"></i>List Antrian Hold Incoming
                        </a>
                    </li>

                    <!-- INCOMING CHARGEBACK ASISTEN -->
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'HoldIncomingChargeback' && $segment2 == 'formUpload' ? 'active' : '' ?>" href="{{ route('formUploadAsisten') }}">
                            <i class="dripicons-rocket"></i>Upload Hasil Asisten ITR
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'HoldIncomingChargeback' && $segment2 == 'formUpload' ? 'active' : '' ?>" href="{{ route('formUploadAsisten') }}">
                            <i class="dripicons-rocket"></i>Upload Hasil Analis ITR
                        </a>
                    </li>
                </ul>

                <div class="title-box mt-4">
                    <h8 class="menu-title">Master</h8>
                </div>
                <ul class="nav">
                    <!-- MASTER -->
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment2 == 'JenisTransaksi' && ($segment3 == 'list' || $segment3 == 'formUpdate')) ? 'active' : '' ?>" href="#">
                            <i class="dripicons-menu"></i>List Jenis Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment2 == 'InfoStatus' && ($segment3 == 'list' || $segment3 == 'formUpdate')) ? 'active' : '' ?>" href="{{ route('getListInfoStatus') }}">
                            <i class="dripicons-checklist"></i>List Status Final
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment2 == 'InfoIncoming' && ($segment3 == 'list' || $segment3 == 'formUpdate')) ? 'active' : '' ?>" href="{{ route('getListInfoIncoming') }}">
                            <i class="dripicons-stack"></i>List Info Incoming
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment2 == 'InfoAsisten' && ($segment3 == 'list' || $segment3 == 'formUpdate')) ? 'active' : '' ?>" href="{{ route('getListInfoAsisten') }}">
                            <i class="dripicons-to-do"></i>List Info Asisten
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment2 == 'InfoAnalis' && ($segment3 == 'list' || $segment3 == 'formUpdate')) ? 'active' : '' ?>" href="{{ route('getListInfoAnalis') }}">
                            <i class="dripicons-web"></i>List Info Analis
                        </a>
                    </li>
                </ul>
            </div><!-- end HoldIncomingChargeback -->
            
            {{-- Hold SAF --}}
            <div id="HoldSaf" class="main-icon-menu-pane <?= $segment1 == 'HoldSaf' ? 'active' : '' ?>">
                <div class="title-box">
                    <h6 class="menu-title">Hold SAF</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'HoldSaf' && $segment2 == 'dashboard' ? 'active' : '' ?>" href="#">
                            <i class="dripicons-device-desktop"></i>Dashboard
                        </a>
                    </li>

                    <!-- Hold Saf -->
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'HoldSaf' && $segment2 == 'formUploadHoldSaf' ? 'active' : '' ?>" href="<?= route('formUploadHoldSaf')?>">
                            <i class="dripicons-wallet"></i>Upload Hold Saf
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'HoldSaf' && $segment2 == 'getListHoldSaf' ? 'active' : '' ?>" href="{{ route('getListHoldSaf') }}">
                            <i class="dripicons-blog"></i>List Hold Saf
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'Holdsaf' && $segment2 == 'formUpdateBulk' ? 'active' : '' ?>" href="<?=route('formUpdateBulkHoldSaf')?>">
                            <i class="dripicons-blog"></i>Form Update Bulk <br> Hold Saf
                        </a>
                    </li>
                </ul>

            </div><!-- end Hold SAF -->

            <div id="BNDUI" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Projects</h6>        
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="../projects/projects-index.html"><i class="dripicons-view-thumb"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="../projects/projects-clients.html"><i class="dripicons-user-id"></i>Clients</a></li>
                    <li class="nav-item"><a class="nav-link" href="../projects/projects-calendar.html"><i class="dripicons-calendar"></i>Calendar</a></li>
                    <li class="nav-item"><a class="nav-link" href="../projects/projects-team.html"><i class="dripicons-trophy"></i>Team</a></li>
                    <li class="nav-item"><a class="nav-link" href="../projects/projects-project.html"><i class="dripicons-jewel"></i>Project</a></li>
                    <li class="nav-item"><a class="nav-link" href="../projects/projects-task.html"><i class="dripicons-checklist"></i>Task</a></li>
                    <li class="nav-item"><a class="nav-link" href="../projects/projects-kanban-board.html"><i class="dripicons-move"></i>Kanban Board</a></li>
                    <li class="nav-item"><a class="nav-link" href="../projects/projects-invoice.html"><i class="dripicons-document"></i>Invoice</a></li>
                    <li class="nav-item"><a class="nav-link" href="../projects/projects-chat.html"><i class="dripicons-conversation"></i>Chat</a></li>
                    <li class="nav-item"><a class="nav-link" href="../projects/projects-users.html"><i class="dripicons-user-group"></i>Users</a></li>
                </ul>
            </div><!-- end  BNDUI-->

            <div id="BND013" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Ecommerce</h6>           
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="../ecommerce/ecommerce-index.html"><i class="dripicons-device-desktop"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="../ecommerce/ecommerce-products.html"><i class="dripicons-view-apps"></i>Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="../ecommerce/ecommerce-product-list.html"><i class="dripicons-list"></i>Product List</a></li>
                    <li class="nav-item"><a class="nav-link" href="../ecommerce/ecommerce-product-detail.html"><i class="dripicons-article"></i>Product Detail</a></li>
                    <li class="nav-item"><a class="nav-link" href="../ecommerce/ecommerce-cart.html"><i class="dripicons-cart"></i>Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="../ecommerce/ecommerce-checkout.html"><i class="dripicons-card"></i>Checkout</a></li>
                </ul>
            </div><!-- end BND013 -->

            <div id="Merchant" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">CRM</h6>          
                </div>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="../crm/crm-index.html"><i class="dripicons-monitor"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="../crm/crm-contacts.html"><i class="dripicons-user-id"></i>Contacts</a></li>
                    <li class="nav-item"><a class="nav-link" href="../crm/crm-opportunities.html"><i class="dripicons-lightbulb"></i>Opportunities</a></li>
                    <li class="nav-item"><a class="nav-link" href="../crm/crm-leads.html"><i class="dripicons-toggles"></i>Leads</a></li>
                    <li class="nav-item"><a class="nav-link" href="../crm/crm-customers.html"><i class="dripicons-user-group"></i>Customers</a></li>
                </ul>
            </div><!-- end Merchant -->

            <div id="Outgoing" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Others</h6>      
                </div>
                <ul class="nav metismenu" id="main_menu_side_nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-mail"></i><span class="w-100">Email</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="../others/email-inbox.html">Inbox</a></li>
                            <li><a href="../others/email-read.html">Read Email</a></li>            
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-view-thumb"></i><span class="w-100">UI Elements</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="../others/ui-bootstrap.html">Bootstrap</a></li>
                            <li><a href="../others/ui-animation.html">Animation</a></li>
                            <li><a href="../others/ui-avatar.html">Avatar</a></li>
                            <li><a href="../others/ui-clipboard.html">Clip Board</a></li>
                            <li><a href="../others/ui-files.html">File Manager</a></li>
                            <li><a href="../others/ui-ribbons.html">Ribbons</a></li>
                            <li><a href="../others/ui-dragula.html"><span>Dragula</span></a></li>
                            <li><a href="../others/ui-check-radio.html"><span>Check & Radio</span></a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-anchor"></i><span class="w-100">Advanced UI</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="../others/advanced-rangeslider.html">Range Slider</a></li>
                            <li><a href="../others/advanced-sweetalerts.html">Sweet Alerts</a></li>
                            <li><a href="../others/advanced-nestable.html">Nestable List</a></li>
                            <li><a href="../others/advanced-ratings.html">Ratings</a></li>
                            <li><a href="../others/advanced-highlight.html">Highlight</a></li>
                            <li><a href="../others/advanced-session.html">Session Timeout</a></li>
                            <li><a href="../others/advanced-idle-timer.html">Idle Timer</a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-document"></i><span class="w-100">Forms</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="../others/forms-elements.html">Basic Elements</a></li>
                            <li><a href="../others/forms-advanced.html">Advance Elements</a></li>
                            <li><a href="../others/forms-validation.html">Validation</a></li>
                            <li><a href="../others/forms-wizard.html">Wizard</a></li>
                            <li><a href="../others/forms-editors.html">Editors</a></li>
                            <li><a href="../others/forms-repeater.html">Repeater</a></li>
                            <li><a href="../others/forms-x-editable.html">X Editable</a></li>
                            <li><a href="../others/forms-uploads.html">File Upload</a></li>
                            <li><a href="../others/forms-img-crop.html">Image Crop</a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-graph-line"></i><span class="w-100">Charts</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="../others/charts-apex.html">Apex</a></li>
                            <li><a href="../others/charts-morris.html">Morris</a></li>
                            <li><a href="../others/charts-chartist.html">Chartist</a></li>
                            <li><a href="../others/charts-flot.html">Flot</a></li>
                            <li><a href="../others/charts-peity.html">Peity</a></li>
                            <li><a href="../others/charts-chartjs.html">Chartjs</a></li>
                            <li><a href="../others/charts-sparkline.html">Sparkline</a></li>
                            <li><a href="../others/charts-knob.html">Jquery Knob</a></li>
                            <li><a href="../others/charts-justgage.html">JustGage</a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-view-list-large"></i><span class="w-100">Tables</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="../others/tables-basic.html">Basic</a></li>
                            <li><a href="../others/tables-datatable.html">Datatables</a></li>
                            <li><a href="../others/tables-responsive.html">Responsive</a></li>
                            <li><a href="../others/tables-footable.html">Footable</a></li>
                            <li><a href="../others/tables-jsgrid.html">Jsgrid</a></li>
                            <li><a href="../others/tables-editable.html">Editable</a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-headset"></i><span class="w-100">Icons</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="../others/icons-materialdesign.html">Material Design</a></li>
                            <li><a href="../others/icons-dripicons.html">Dripicons</a></li>
                            <li><a href="../others/icons-fontawesome.html">Font awesome</a></li>
                            <li><a href="../others/icons-themify.html">Themify</a></li>
                            <li><a href="../others/icons-typicons.html">Typicons</a></li>
                            <li><a href="../others/icons-emoji.html">Emoji <i class="em em-ok_hand"></i></a></li>
                            <li><a href="../others/icons-svg.html">SVG</a></li>
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-map"></i><span class="w-100">Maps</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="../others/maps-google.html">Google Maps</a></li>
                            <li><a href="../others/maps-vector.html">Vector Maps</a></li>        
                        </ul>            
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="dripicons-article"></i><span class="w-100">Email Templates</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="../others/email-templates-basic.html">Basic Action Email</a></li>
                            <li><a href="../others/email-templates-alert.html">Alert Email</a></li>
                            <li><a href="../others/email-templates-billing.html">Billing Email</a></li>               
                        </ul>            
                    </li><!--end nav-item-->
                </ul><!--end nav-->
            </div><!-- end Outgoing -->

            <div id="Users" class="main-icon-menu-pane <?= $segment1 == 'users' ? 'active' : '' ?>">
                <div class="title-box">
                    <h6 class="menu-title">Users</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment1 == 'users' && $segment2 == 'list' ? 'active' : '') ?>" href="{{ route('getListUsers') }}">
                            <i class="dripicons-user-group"></i>List Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment1 == 'users' && $segment2 == 'formAdd' ? 'active' : '') ?>" href="{{ route('formAddUser') }}">
                            <i class="dripicons-plus"></i>Form Add Users
                        </a>
                    </li>
                </ul>
              </div><!-- end Users -->

            {{-- Master --}}
            <div id="MasterRekonMerch" class="main-icon-menu-pane <?= $segment1 == 'MasterRekonMerch' ? 'active' : '' ?>">
                <div class="title-box">
                    <h6 class="menu-title">Master Rekon Merchant</h6>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'MasterRekonMerch' && $segment2 == 'releasedby' ? 'active' : '' ?>" href="#">
                            <i class="dripicons-list"></i>Released By
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'MasterRekonMerch' && $segment2 == 'wilayah' ? 'active' : '' ?>" href="#">
                            <i class="dripicons-list"></i>List Wilayah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $segment1 == 'MasterRekonMerch' && $segment2 == 'rekening' ? 'active' : '' ?>" href="#">
                            <i class="dripicons-list"></i>List Rekening
                        </a>
                    </li>
                </ul>
            </div><!-- end Master Rekon Merchant -->  
        </div><!--end menu-body-->
    </div><!-- end main-menu-inner-->
</div>