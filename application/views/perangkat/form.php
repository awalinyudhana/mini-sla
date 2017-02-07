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
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | <?php echo $title ?>
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
                                    <input name="part_number" <?php if ($mode == 'update') echo "value='$part_number'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Brand</label>
                                <div class="col-sm-6">
                                    <input name="brand" <?php if ($mode == 'update') echo "value='$brand'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama Perangkat</label>
                                <div class="col-sm-6">
                                    <input name="nama_perangkat" <?php if ($mode == 'update') echo "value='$nama_perangkat'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-6">
                                    <select name="type">
                                        <option value="Hardware" <?php  if ($mode == 'update' && $type == 'Hardware') echo "selected" ?>>Hardware</option>
                                        <option value="Software" <?php  if ($mode == 'update' && $type == 'Software') echo "selected" ?>>Software</option>
                                        <option value="License" <?php  if ($mode == 'update' && $type == 'License') echo "selected" ?>>License</option>
                                        <option value="Warranty" <?php  if ($mode == 'update' && $type == 'Warranty') echo "selected" ?>>Warranty</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status">
                                        <option value="Active" <?php  if ($mode == 'update' && $status == 'Active') echo "selected" ?>>Active</option>
                                        <option value="End of Sales" <?php  if ($mode == 'update' && $status == 'End of Sales') echo "selected" ?>>End of Sales</option>
                                        <option value="End of Support" <?php  if ($mode == 'update' && $status == 'End of Support') echo "selected" ?>>End of Support</option>
                                    </select>
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