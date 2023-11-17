<div class="modal fade formAddInfoIncoming" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Form Add Info Incoming</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal auth-form my-4" action="{{ route('prosesAddInfoIncoming') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label for="cek_bnd" class="">CEK BND</label>
                                                <input autocomplete="off" class="form-control" type="text" placeholder="CEK BND" id="cek_bnd" name="cek_bnd" />
                                            </div>
                                            <div class="form-group row">
                                                <label for="request_incoming" class="">REQUEST INCOMING</label>
                                                <input autocomplete="off" class="form-control" type="text" placeholder="REQUEST INCOMING" id="request_incoming" name="request_incoming" />
                                            </div>
                                        </div>
                
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label for="proses_incoming" class="">PROSES INCOMING</label>
                                                <input autocomplete="off" class="form-control" type="text" placeholder="PROSES INCOMING" id="proses_incoming" name="proses_incoming" />
                                            </div>
                                            <div class="form-group row">
                                                <label for="final_status" class="">FINAL STATUS</label>
                                                <input autocomplete="off" class="form-control" type="text" placeholder="FINAL STATUS" id="final_status" name="final_status" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                                                </div>
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