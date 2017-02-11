<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Data Layanan</h1>
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
                                <?php echo anchor('service_level', 'Kembali', "class='btn btn-default'")?>
                            </p>
                            <?php 
                                if ($mode == 'create') {
                                    echo form_open('service_level/create', ['class' => 'form-horizontal']); 
                                } else {
                                    echo form_open('service_level/update', ['class' => 'form-horizontal']); 
                                    echo "<input type='hidden' name='service_level_id' value='$service_level_id'>";
                                }
                            ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Service Level</label>
                                <div class="col-sm-6">
                                    <input name="service_level" <?php if ($mode == 'update') echo "value='$service_level'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">MoM</label>
                                <div class="col-sm-6">
                                    <input name="mom" <?php if ($mode == 'update') echo "value='$mom'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">BoM</label>
                                <div class="col-sm-6">
                                    <input name="bom" <?php if ($mode == 'update') echo "value='$bom'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Doc</label>
                                <div class="col-sm-6">
                                    <input name="doc" <?php if ($mode == 'update') echo "value='$doc'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Demo</label>
                                <div class="col-sm-6">
                                    <input name="demo" <?php if ($mode == 'update') echo "value='$demo'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Installation</label>
                                <div class="col-sm-6">
                                    <input name="installation" <?php if ($mode == 'update') echo "value='$installation'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Maintenance</label>
                                <div class="col-sm-6">
                                    <input name="maintenance" <?php if ($mode == 'update') echo "value='$maintenance'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Support</label>
                                <div class="col-sm-6">
                                    <input name="support" <?php if ($mode == 'update') echo "value='$support'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">SLA (Day)</label>
                                <div class="col-sm-6">
                                    <input name="sla" <?php if ($mode == 'update') echo "value='$sla'" ?>type="text" class='form-control'>
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