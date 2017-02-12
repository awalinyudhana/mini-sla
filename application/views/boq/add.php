<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> New BoQ Detail</h1>
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
                    <?php 
                        echo form_open('boq/add', ['class' => 'form-horizontal']);
                    ?>
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
                                <input type="hidden" name="customer_id" value="<?php echo $customer_data->customer_id; ?>">
                                <tr><td class="title"><strong>Customer Name</strong></td><td><?php echo $customer_data->nama_customer; ?></td></tr>
                                <tr><td class="title"><strong>Alamat</strong></td><td><?php echo $customer_data->alamat; ?></td></tr>
                                <tr><td class="title"><strong>Kota - Provinsi</strong></td><td><?php echo $customer_data->kota.' - '.$customer_data->provinsi ; ?></td></tr>
                                <tr><td class="title"><strong>PIC - Kontak</strong></td><td><?php echo $customer_data->pic.' - '.$customer_data->kontak ; ?></td></tr>
                                <tr><td class="title"><strong>Email</strong></td><td><?php echo $customer_data->email; ?></td></tr>
                            </table>
                        </div>
                        <div class="col-lg-6 pull-right">
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Start Date of Support</label>
                                <div class="col-sm-6">
                                    <div class="input-group date datepicker" data-provide="datepicker">
                                        <input type="text" class="form-control" name="start_date_of_support">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">End Date of Support</label>
                                <div class="col-sm-6">
                                    <div class="input-group date datepicker" data-provide="datepicker">
                                        <input type="text" class="form-control" name="end_date_of_support">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Service Level</label>
                                <div class="col-sm-6">
                                    <select name="service_level_id">
                                        <?php
                                            foreach ($service_level_data as $value) {
                                                echo "<option value='".$value->service_level_id."'>$value->service_level</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="boqDetail"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalPerangkat">Tambah Perangkat</button>
                        </div>
                        <div class="col-lg-6">
                            <?php echo form_submit('submit', 'Tambah BoQ', ['class' => 'btn btn-success pull-right margin-left-10']); ?>
                            <?php echo anchor('boq', 'Cancel', "class='btn btn-default pull-right'")?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table cellpadding=0 cellspacing=10 class="table" id="boqDetailTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Part Number</th>
                                        <th>Serial Number</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.row -->
                    <?php echo form_close();?>
                </div>
            </div>
            <!-- /.panel-heading -->
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

    <div class="modal" id="modalPerangkat" tabindex="-1" role="dialog" aria-labelledby="modalPerangkatLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalPerangkatLabel">Data Perangkat</h4>
          </div>
          <div class="modal-body">
            <table cellpadding=0 cellspacing=10 class="table" id="datatable" data-url="<?php echo $perangkat_table_url; ?>">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Part Number</th>
                        <th>Brand</th>
                        <th>Nama Perangkat</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="modalPerangkatCloseButton">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" id="modalSerial" tabindex="-1" role="dialog" aria-labelledby="modalSerialLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalSerialLabel">Isi Keterangan</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
            <label for="recipient-name" class="control-label">Serial Number:</label>
            <input type="text" class="form-control" id="serialNumber">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi"></textarea>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal" id="modalSerialCloseButton">Simpan</button>
          </div>
        </div>
      </div>
    </div>
</div>