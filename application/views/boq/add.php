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
                    <i class="fa fa-bar-chart-o fa-fw"></i> Sistem Pemeliharaan Produk | <?php echo $title ?>
                </div>

                <div class="panel-body">
                    <?php 
                        echo form_open(current_url(), ['class' => 'form-horizontal']);
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
                                <tr><td class="title"><strong>Nama Customer</strong></td><td><?php echo $customer_data->nama_customer; ?></td></tr>
                                <tr><td class="title"><strong>Alamat</strong></td><td><?php echo $customer_data->alamat; ?></td></tr>
                                <tr><td class="title"><strong>Kota - Provinsi</strong></td><td><?php echo $customer_data->kota.' - '.$customer_data->provinsi ; ?></td></tr>
                                <tr><td class="title"><strong>PIC - Kontak</strong></td><td><?php echo $customer_data->pic.' - '.$customer_data->kontak ; ?></td></tr>
                                <tr><td class="title"><strong>Email</strong></td><td><?php echo $customer_data->email; ?></td></tr>
                            </table>
                        </div>
                        <div class="col-lg-6 pull-right">
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Tanggal Mulai Support</label>
                                <div class="col-sm-6">
                                    <div class="input-group date datepicker" data-provide="datepicker">
                                        <input type="text" class="form-control"
                                               value="<?php echo set_value('start_date_of_support'); ?>"
                                               name="start_date_of_support">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Tanggal Akhir Support</label>
                                <div class="col-sm-6">
                                    <div class="input-group date datepicker" data-provide="datepicker">
                                        <input type="text" class="form-control"
                                               value="<?php echo set_value('end_date_of_support'); ?>"
                                               name="end_date_of_support">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                               <!-- <label class="col-sm-6 control-label">No Purchase</label> -->
                                <label class="col-sm-6 control-label">No. Pembayaran</label>
                                <div class="col-sm-6">
                                    <input name="purchase_order"
                                           value="<?php echo set_value('purchase_order'); ?>"
                                           type="text" class='form-control'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Service Level</label>
                                <div class="col-sm-6">
                                    <select name="service_level_id" class="form-control">
                                        <?php
                                            foreach ($service_level_data as $value) {
                                                echo "<option value='".$value->service_level_id."'". set_select(
                                                'service_level_id',$value->service_level_id) .">$value->service_level</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="boqDetail">
                            <?php
                                if(isset($boq_detail_form_data) && $boq_detail_form_data != false) {
                                    foreach ($boq_detail_form_data as $key => $value) {
                                        $boq_detail_item = explode(";", $value);
                                        $index = $key+1;
                                        echo "<input type='hidden' name='boq_detail[]' id='input-boq-detail-$index' value='$boq_detail_item[0];$boq_detail_item[1];$boq_detail_item[2];$boq_detail_item[3]'>";
                                    }
                                }
                            ?>
                            </div>
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
                                        <th>Nomor Perangkat</th>
                                        <th>Serial Number</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(isset($boq_detail_form_data) && $boq_detail_form_data != false) {
                                        foreach ($boq_detail_form_data as $key => $value) {
                                            $boq_detail_item = explode(";", $value);
                                            $index = $key+1;
                                            echo "<tr id='row-boq-detail-$index'><td>$index</td><td>$boq_detail_item[3]</td><td>$boq_detail_item[1]</td><td>$boq_detail_item[2]</td><td><a href='javascript:;' class='btn btn-danger hapus-detail-boq' data-id='$index'>Hapus</a></td></tr>";
                                        }
                                    }
                                ?>
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
      <div class="modal-dialog" role="document" style="width: 750px;">
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
                        <th>Nomor Perangkat</th>
                        <th>Merk</th>
                        <th>Nama Perangkat</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>Detail</th>
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalSerialLabel">Isi Keterangan</h4>
          </div>
          <div class="modal-body">
            <div id="modalSerialError"></div>
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
            <button type="button" class="btn btn-info" id="modalSerialCloseButton">Simpan</button>
          </div>
        </div>
      </div>
    </div>
</div>