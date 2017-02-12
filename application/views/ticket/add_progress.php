<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Ticket Detail</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | Ticket Detail
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
                        <div class="col-lg-6">
                            <table class="boq-customer pull-right">
                                <tr><td class="title"><strong>No. Ticket</strong></td><td><?php echo $ticket_data->ticket_id; ?></td></tr>
                                <tr><td class="title"><strong>Tanggal</strong></td><td><?php echo $ticket_data->tanggal; ?></td></tr>
                                <tr><td class="title"><strong>Staff</strong></td><td><?php echo $customer_data->pic; ?></td></tr>
                                <tr><td class="title"><strong>Category</strong></td><td><?php echo $ticket_data->category; ?></td></tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="boq-customer">
                                <tr><td class="title"><strong>Judul</strong></td><td><?php echo $ticket_data->judul; ?></td></tr>
                                <?php if ($ticket_data->ticket_by == 'by_device') { ?>
                                <tr><td class="title"><strong>No. BoQ</strong></td><td><?php echo $boq_data->boq_id; ?></td></tr>
                                <tr><td class="title"><strong>Serial Number</strong></td><td><?php echo $boq_detail_data->serial_number; ?></td></tr>
                                <tr><td class="title"><strong>Nama Perangkat</strong></td><td><?php echo $boq_detail_data->nama_perangkat; ?></td></tr>
                                <tr><td class="title"><strong>End Date of Support</strong></td><td><?php echo $boq_data->end_date_of_support; ?></td></tr>
                                <?php } else if ($ticket_data->ticket_by == 'by_customer') { ?>
                                <tr><td class="title"><strong>Request By</strong></td><td><?php echo $ticket_data->request_by; ?></td></tr>
                                <tr><td class="title"><strong>Technician</strong></td><td><?php echo str_replace(";",",", $ticket_data->technician); ?></td></tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="boq-customer pull-right">
                                <?php if ($ticket_data->ticket_by == 'by_device') { ?>
                                <tr><td class="title"><strong>Request By</strong></td><td><?php echo $ticket_data->request_by; ?></td></tr>
                                <tr><td class="title"><strong>Technician</strong></td><td><?php echo str_replace(";",",", $ticket_data->technician); ?></td></tr>
                                <tr><td class="title"><strong>Deskripsi</strong></td><td><?php echo $ticket_data->deskripsi; ?></td></tr>
                                <?php } else if ($ticket_data->ticket_by == 'by_customer') { ?>
                                <tr><td class="title"><strong>Deskripsi</strong></td><td><?php echo $ticket_data->deskripsi; ?></td></tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                    <?php echo form_open_multipart('ticket_list/save_progress', ['class' => 'form-horizontal', 'id' => 'ticket_add_progress']); ?>
                    <input type="hidden" name="ticket_id" value="<?php echo $ticket_data->ticket_id; ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Progress</label>
                                <div class="col-sm-9">
                                    <div class="input-group date datepicker" data-provide="datepicker">
                                        <input type="text" class="form-control" name="tanggal">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Progress</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="progress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Result</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="result"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                        <button type="button" class="btn btn-danger pull-right margin-left-10" data-toggle="modal" data-target="#modalClose">Close Ticket</button>
                        <input type="hidden" name="submit_type" value="add_progress" id="ticket_response_submit_type">
                        <input type="submit" name="add_progress" value="Add Progress" class="btn btn-success pull-right">
                        </div>
                    </div>

                    <div class="modal" id="modalClose" tabindex="-1" role="dialog" aria-labelledby="modalCloseLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modalCloseLabel">Ticket Closing Report</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label for="recipient-name" class="control-label">Attachment:</label>
                                    <input type="file" class="form-control" name="response_documents[]" multiple>
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="modalCloseTicketButton">Close Ticket</button>
                          </div>
                        </div>
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