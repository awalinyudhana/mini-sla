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
                    <i class="fa fa-bar-chart-o fa-fw"></i> Sistem Pemeliharaan Produk | <?php echo $title ?>
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
                                <tr><td class="title"><strong>Nama Staff</strong></td><td><?php echo $user_data->first_name.' '.$user_data->last_name; ?></td></tr>
                                <tr><td class="title"><strong>Serial Number</strong></td><td><?php echo $boq_detail_data->serial_number; ?></td></tr>
                                <tr><td class="title"><strong>Nama Perangkat</strong></td><td><?php echo $boq_detail_data->nama_perangkat; ?></td></tr>
                                <tr><td class="title"><strong>Tanggal Mulai Support</strong></td><td><?php echo $boq_data->start_date_of_support; ?></td></tr>
                                <tr><td class="title"><strong>Tanggal Akhir Support</strong></td><td><?php echo $boq_data->end_date_of_support; ?></td></tr>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
                    <?php echo form_open_multipart(current_url(), ['class' => 'form-horizontal']); ?>
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
                                    <input type="text"
                                           value="<?php echo set_value('judul'); ?>" class="form-control" name="judul">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Request By</label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo set_value('request_by'); ?>"
                                           class="form-control" name="request_by">
                                </div>
                            </div>
                            <?php if ($type == 'by_device') { ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kategori</label>
                                <div class="col-sm-9">
                                    <select name="category" class="form-control">
                                        <option value="Installation"
                                            <?php echo set_select('category', 'Installation') ?>>
                                            Installation
                                        </option>
                                        <option value="Maintenance"
                                            <?php echo set_select('category', 'Maintenance') ?>>
                                            Maintenance</option>
                                        <option value="Support"
                                            <?php echo set_select('category', 'Support') ?>>
                                            Support</option>
                                    </select>
                                </div>
                            </div>
                            <?php } else if ($type == 'by_customer') { ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kategori</label>
                                <div class="col-sm-9">
                                    <select name="category" class="form-control">
                                        <option value="MoM"
                                            <?php echo set_select('category', 'MoM') ?>>
                                            MoM</option>
                                        <option value="BoM"
                                            <?php echo set_select('category', 'BoM') ?>>
                                            BoM</option>
                                        <option value="Demo"
                                            <?php echo set_select('category', 'Demo') ?>>
                                            Demo</option>
                                        <option value="Doc"
                                            <?php echo set_select('category', 'Doc') ?>>
                                            Doc</option>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Upload Dokumen Pendukung</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="document" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Teknisi 1</label>
                                <div class="col-sm-9">
                                    <select name="teknisi[0]" class="form-control">
                                        <option value="0">Pilih</option>
                                        <?php
                                        foreach ($list_support as $value) {
                                            echo "<option value='".$value->id."'". set_select(
                                                    'teknisi[0]',$value->id) .">
                                                    $value->first_name $value->last_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Teknisi 2</label>
                                <div class="col-sm-9">
                                    <select name="teknisi[1]" class="form-control">
                                        <option value="0">Pilih</option>
                                        <?php
                                        foreach ($list_support as $value) {
                                            echo "<option value='".$value->id."'". set_select(
                                                    'teknisi[1]',$value->id) .">
                                                    $value->first_name $value->last_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Teknisi 3</label>
                                <div class="col-sm-9">
                                    <select name="teknisi[2]" class="form-control">
                                        <option value="0" >Pilih</option>
                                        <?php
                                        foreach ($list_support as $value) {
                                            echo "<option value='".$value->id."'". set_select(
                                                    'teknisi[2]',$value->id) .">
                                                    $value->first_name $value->last_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Teknisi 4</label>
                                <div class="col-sm-9">
                                    <select name="teknisi[3]" class="form-control">
                                        <option value="0">Pilih</option>
                                        <?php
                                        foreach ($list_support as $value) {
                                            echo "<option value='".$value->id."'". set_select(
                                                    'teknisi[3]',$value->id) .">
                                                    $value->first_name $value->last_name</option>";
                                        }
                                        ?>
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
                                    <textarea name="deskripsi" class="form-control"><?php echo set_value('deskripsi',''); ?></textarea>
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