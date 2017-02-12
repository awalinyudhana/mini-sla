<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> New Ticket Detail</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | <?php echo $title ?>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(isset($message)) { ?>
                                <div class="alert alert-warning"><?php echo $message;?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="boq-customer">
                                <tr><td class="title"><strong>Customer Name</strong></td><td><?php echo $customer_data->nama_customer; ?></td></tr>
                                <tr><td class="title"><strong>Alamat</strong></td><td><?php echo $customer_data->alamat; ?></td></tr>
                                <tr><td class="title"><strong>Kota - Provinsi</strong></td><td><?php echo $customer_data->kota.' - '.$customer_data->provinsi ; ?></td></tr>
                                <tr><td class="title"><strong>PIC - Kontak</strong></td><td><?php echo $customer_data->pic.' - '.$customer_data->kontak ; ?></td></tr>
                                <tr><td class="title"><strong>Email</strong></td><td><?php echo $customer_data->email; ?></td></tr>
                            </table>
                        </div>
                        <?php if ($type == 'by_device') { ?>
                        <div class="col-lg-6">
                            <table class="boq-customer pull-right">
                                <tr><td class="title"><strong>Serial Number</strong></td><td><?php echo $boq_detail_data->serial_number; ?></td></tr>
                                <tr><td class="title"><strong>Nama Perangkat</strong></td><td><?php echo $boq_detail_data->nama_perangkat; ?></td></tr>
                                <tr><td class="title"><strong>End Date of Support</strong></td><td><?php echo $boq_data->end_date_of_support; ?></td></tr>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
                    <?php echo form_open_multipart('ticket/create/'.$type, ['class' => 'form-horizontal']); ?>
                    <div class="row">
                        <?php
                            if ($type == 'by_device') {
                                echo "<input type='hidden' name='boq_detail_id' value='$boq_detail_data->boq_detail_id'>";
                            } else if ($type == 'by_customer') {
                                echo "<input type='hidden' name='customer_id' value='$customer_data->customer_id'>";
                            }
                        ?>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="judul">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Request By</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="request_by">
                                </div>
                            </div>
                            <?php if ($type == 'by_device') { ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category">
                                        <option value="Installation">Installation</option>
                                        <option value="Maintenance">Maintenance</option>
                                        <option value="Support">Support</option>
                                    </select>
                                </div>
                            </div>
                            <?php } else if ($type == 'by_customer') { ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category">
                                        <option value="MoM">MoM</option>
                                        <option value="BoM">BoM</option>
                                        <option value="Demo">Demo</option>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Upload Supporting Document</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="documents[]" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Technician 1</label>
                                <div class="col-sm-9">
                                    <select name="technician[]">
                                        <option value="none">Not Set</option>
                                        <option value="lorem11">tech 1 lorem 1</option>
                                        <option value="lorem12">tech 1 lorem 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Technician 2</label>
                                <div class="col-sm-9">
                                    <select name="technician[]">
                                        <option value="none">Not Set</option>
                                        <option value="lorem21">tech 2 lorem 1</option>
                                        <option value="lorem22">tech 2 lorem 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Technician 3</label>
                                <div class="col-sm-9">
                                    <select name="technician[]">
                                        <option value="none">Not Set</option>
                                        <option value="lorem31">tech 3 lorem 1</option>
                                        <option value="lorem32">tech 3 lorem 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Technician 4</label>
                                <div class="col-sm-9">
                                    <select name="technician[]">
                                        <option value="none">Not Set</option>
                                        <option value="lorem">tech 4 lorem 1</option>
                                        <option value="lorem">tech 4 lorem 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea name="deskripsi" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <?php echo form_submit('submit', 'Open Ticket', ['class' => 'btn btn-success pull-right margin-left-10']); ?>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
            <!-- /.panel-heading -->
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>