<div class="modal fade search-bulk-holdsaf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Form Upload Search bulk&nbsp;&nbsp;<span style="color:red;">(Data dalam file Excel)</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="general-label">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-right">Kolom to Search</label>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-1saf" type="checkbox" name="kolom[]" value="nama_merchant">
                                            <label for="checkbox-1saf">Nama Merchant</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-2saf" type="checkbox" name="kolom[]" value="mid">
                                            <label for="checkbox-2saf">Mid</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-3saf" type="checkbox" name="kolom[]" value="no_kartu">
                                            <label for="checkbox-3saf">No. Kartu</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-4saf" type="checkbox" name="kolom[]" value="nominal">
                                            <label for="checkbox-4saf">Nominal</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-5saf" type="checkbox" name="kolom[]" value="apprvl">
                                            <label for="checkbox-5saf">Approval</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-6saf" type="checkbox" name="kolom[]" value="nama_bank">
                                            <label for="checkbox-6saf">Nama Bank</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-7saf" type="checkbox" name="kolom[]" value="cust_name">
                                            <label for="checkbox-7saf">Nama Cust.</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-8saf" type="checkbox" name="kolom[]" value="act_hold">
                                            <label for="checkbox-8saf">Act</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-9saf" type="checkbox" name="kolom[]" value="settled_amt">
                                            <label for="checkbox-9saf">Settled Amount</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-10saf" type="checkbox" name="kolom[]" value="hold_amt">
                                            <label for="checkbox-10saf">Hold Amount</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-11saf" type="checkbox" name="kolom[]" value="mdr">
                                            <label for="checkbox-12saf">MDR</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-13saf" type="checkbox" name="kolom[]" value="disc_amt">
                                            <label for="checkbox-13saf">Amount Disc</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-14saf" type="checkbox" name="kolom[]" value="net_hold">
                                            <label for="checkbox-14saf">Net Hold</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-15saf" type="checkbox" name="kolom[]" value="paid_amt">
                                            <label for="checkbox-15saf">Yang Dibayarkan</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-16saf" type="checkbox" name="kolom[]" value="tanggal_hold">
                                            <label for="checkbox-16saf">Tanggal Hold</label>
                                        </div>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-17saf" type="checkbox" name="kolom[]" value="tanggal_release">
                                            <label for="checkbox-17saf">Tanggal Release</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="file" id="input-file-now" class="dropify" name="file_import" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div> 
                            </form>           
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->