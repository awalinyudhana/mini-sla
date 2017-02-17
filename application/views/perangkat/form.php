<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Data Perangkat</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-apple fa-fw"></i> Sistem Pemeliharaan Produk | <?php echo $title ?>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(isset($message)) {
                                ?>
                                <div class="alert alert-warning"><?php echo $message;?></div>
                                <?php
                            }?>
                            <p align="right">
                                <?php echo anchor('perangkat', 'Kembali', "class='btn btn-default'")?>
                            </p>
                            <?php 
                                if ($mode == 'create') {
                                    echo form_open('perangkat/create', ['class' => 'form-horizontal']); 
                                } else {
                                    echo form_open('perangkat/update', ['class' => 'form-horizontal']); 
                                    echo "<input type='hidden' name='perangkat_id' value='$perangkat_id'>";
                                }
                            ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Part Number</label>
                                <div class="col-sm-6">
                                    <input name="part_number"
                                           value="<?php echo set_value('part_number',
                                               $mode == 'update' ? $part_number : null); ?>"
                                           type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Brand</label>
                                <div class="col-sm-6">
                                    <input name="brand"
                                           value="<?php echo set_value('brand',
                                               $mode == 'update' ? $brand : null); ?>"
                                           type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama Perangkat</label>
                                <div class="col-sm-6">
                                    <input name="nama_perangkat"
                                           value="<?php echo set_value('nama_perangkat',
                                               $mode == 'update' ? $nama_perangkat : null); ?>"
                                           type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-6">
                                    <select name="type">
                                        <option value="Hardware"
                                            <?php echo  set_select(
                                                'type', 'Hardware',
                                                ($mode == 'update' && $type == 'Hardware') ?  TRUE : FALSE
                                            ); ?> >
                                            Hardware
                                        </option>
                                        <option value="Software" <?php echo set_select(
                                            'type', 'Software',
                                            ($mode == 'update' && $type == 'Software') ?  TRUE : FALSE
                                        ); ?> >
                                            Software
                                        </option>
                                        <option value="License"  <?php echo set_select(
                                            'type', 'License',
                                            ($mode == 'update' && $type == 'License') ?  TRUE : FALSE
                                        ); ?> >
                                            License
                                        </option>
                                        <option value="Warranty"  <?php echo  set_select(
                                            'type', 'Warranty',
                                            ($mode == 'update' && $type == 'Warranty') ?  TRUE : FALSE
                                        ); ?> >
                                            Warranty
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status">
                                        <option value="Active" <?php echo set_select(
                                            'status', 'Active',
                                            ($mode == 'update' && $status == 'Active') ?  TRUE : FALSE
                                        ); ?> >
                                            Active
                                        </option>
                                        <option value="End of Sales"  <?php echo set_select(
                                            'status', 'End of Sales',
                                            ($mode == 'update' && $status == 'End of Sales') ?  TRUE : FALSE
                                        ); ?> >
                                            End of Sales
                                        </option>
                                        <option value="End of Support"  <?php echo  set_select(
                                            'status', 'End of Support',
                                            ($mode == 'update' && $status == 'End of Support') ?  TRUE : FALSE
                                        ); ?> >
                                            End of Support
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Url Tambahan</label>
                                <div class="col-sm-6">
                                    <input name="hyperlink"
                                           value="<?php echo set_value('hyperlink',
                                               $mode == 'update' ? $hyperlink : null); ?>"
                                           type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8">
                                    <p><?php echo form_submit('submit', $title, ['class' => 'btn btn-success pull-right']); ?></p>
                                </div>
                            </div>

                            <?php echo form_close();?>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.panel-heading -->
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>