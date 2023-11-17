<div class="modal fade formAddInfoAnalis" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Form Add Info Analis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal auth-form my-4" action="{{ route('prosesAddInfoAnalis') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label for="proses_incoming" class="">PROSES INCOMING</label>
                                                <input autocomplete="off" class="form-control" type="text" placeholder="PROSES INCOMING" id="proses_incoming" name="proses_incoming" />
                                            </div>
                                            <div class="form-group row">
                                                <label for="info_status" class="">STATUS FINAL</label>
                                                <input autocomplete="off" class="form-control" type="text" placeholder="STATUS FINAL" id="info_status" name="info_status" />
                                            </div>
                                        </div>
                
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label for="proses_rkm_final" class="">PROSES RKM FINAL</label>
                                                <input autocomplete="off" class="form-control" type="text" placeholder="PROSES RKM FINAL" id="proses_rkm_final" name="proses_rkm_final" />
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