<div class="modal fade formAddJenisTransaksi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Form Add Jenis Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal auth-form my-4" action="{{ route('prosesAddJenisTransaksi') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label for="jenis_transaksi" class="">JENIS TRANSAKSI</label>
                                                <input autocomplete="off" class="form-control" type="text" placeholder="JENIS TRANSAKSI" id="jenis_transaksi" name="jenis_transaksi" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label for="jenis_transaksi" class="" style="color: white;">JENIS TRANSAKSI</label>
                                                <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->