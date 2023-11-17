<!-- jQuery  -->
<script src="{{ asset('assets') }}/js/jquery.min.js"></script>
<script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets') }}/js/metisMenu.min.js"></script>
<script src="{{ asset('assets') }}/js/waves.min.js"></script>
<script src="{{ asset('assets') }}/js/jquery.slimscroll.min.js"></script>

<!-- Plugins js -->
<script src="{{ asset('assets') }}/plugins/moment/moment.js"></script>
<script src="{{ asset('assets') }}/plugins/apexcharts/apexcharts.min.js"></script>
<script src="{{ asset('assets') }}/pages/jquery.apexcharts.init.js"></script>

<script src="{{ asset('assets') }}/plugins/moment/moment.js"></script>
<script src="{{ asset('assets') }}/plugins/daterangepicker/daterangepicker.js"></script>
<script src="{{ asset('assets') }}/plugins/select2/select2.min.js"></script>
<script src="{{ asset('assets') }}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="{{ asset('assets') }}/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
<script src="{{ asset('assets') }}/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="{{ asset('assets') }}/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>

<!-- Required datatable js -->
<script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Buttons examples -->
<script src="{{ asset('assets') }}/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/jszip.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/pdfmake.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/vfs_fonts.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/buttons.html5.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/buttons.print.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="{{ asset('assets') }}/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/pages/jquery.datatable.init.js"></script>

<script src="{{ asset('assets') }}/pages/jquery.forms-advanced.js"></script>
<script src="{{ asset('assets') }}/plugins/metro/metro.js"></script>

<!-- Plugins upload-->
<script src="{{ asset('assets') }}/plugins/dropify/js/dropify.min.js"></script>
<script src="{{ asset('assets') }}/pages/jquery.form-upload.init.js"></script>

<!-- Highchart Javascript -->
<script src="{{ asset('assets') }}/highcharts/highcharts.js"></script>
<script src="{{ asset('assets') }}/highcharts/highcharts-3d.js"></script>
<script src="{{ asset('assets') }}/highcharts/modules/series-label.js"></script>
<script src="{{ asset('assets') }}/highcharts/modules/exporting.js"></script>
<script src="{{ asset('assets') }}/highcharts/modules/export-data.js"></script>
<script src="{{ asset('assets') }}/highcharts/modules/accessibility.js"></script>
<script src="{{ asset('assets') }}/highcharts/themes/high-contrast-light.js"></script>

{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
{{-- <script src="https://code.highcharts.com/highcharts-3d.js"></script> --}}
{{-- <script src="https://code.highcharts.com/modules/exporting.js"></script> --}}
{{-- <script src="https://code.highcharts.com/modules/export-data.js"></script> --}}
{{-- <script src="https://code.highcharts.com/modules/accessibility.js"></script> --}}

<!-- App js -->
<script src="{{ asset('assets') }}/js/jquery.core.js"></script>
<script src="{{ asset('assets') }}/js/app.js"></script>

@include('HoldPaymentMerchant.modal.formUploadReleaseBni')
@include('HoldPaymentMerchant.modal.formUploadReleaseNonBni')
@include('HoldPaymentMerchant.chart.chartHoldPaymentKredit')
@include('HoldPaymentMerchant.chart.chartHoldPaymentLink')
@include('HoldPaymentMerchant.chart.chartHoldPaymentDebit')
@include('HoldPaymentMerchant.chart.chartHoldPaymentTapcash')
@include('HoldPaymentMerchant.chart.chartHoldPaymentQris')
@include('HoldPaymentMerchant.modal.formAddRekening')
@include('HoldPaymentMerchant.modal.formAddWilayah')
@include('HoldPaymentMerchant.modal.formUploadRekening')
@include('HoldPaymentMerchant.modal.formUploadWilayah')
@include('HoldPaymentMerchant.modal.SearchBulkTolakanModal')

@include('HoldIncomingChargeback.modal.JenisTransaksi.formUpload')
@include('HoldIncomingChargeback.modal.JenisTransaksi.formAdd')
@include('HoldIncomingChargeback.modal.InfoStatus.formUpload')
@include('HoldIncomingChargeback.modal.InfoStatus.formAdd')
@include('HoldIncomingChargeback.modal.InfoIncoming.formUpload')
@include('HoldIncomingChargeback.modal.InfoIncoming.formAdd')
@include('HoldIncomingChargeback.modal.InfoAsisten.formUpload')
@include('HoldIncomingChargeback.modal.InfoAsisten.formAdd')
@include('HoldIncomingChargeback.modal.InfoAnalis.formUpload')
@include('HoldIncomingChargeback.modal.InfoAnalis.formAdd')
@include('HoldIncomingChargeback.modal.IncomingChargeback.formCekVoucher')

@include('HoldSaf.modal.formUploadReleaseHoldSafModal')
@include('HoldSaf.modal.SearchBulkHoldSafModal')