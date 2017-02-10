
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Groups Pengguna Sistem</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Sipempo | Edit Group Pengguna Sistem
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if($message) {
                                ?>
                                <div class="alert alert-warning"><?php echo $message;?></div>
                                <?php
                            }?>
                            <p align="right">
                                <?php echo anchor('groups', 'Kembali', "class='btn btn-default'")?>
                            </p>

                            <?php echo form_open(current_url(), ['class' => 'form-horizontal']); ?>
                            <div class="form-group">
                                <label for="group_name" class="col-sm-2 control-label">Group Name</label>

                                <?php //echo lang('edit_group_name_label', 'group_name', "class='col-sm-2 control-label'"); ?>

                                <div class="col-sm-6">
                                    <?php //echo form_input($group_name);?>
                                    <input name="group_name" value="<?php echo $group_name['value'] ?>" id="group_name"
                                           readonly="readonly" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Description</label>
                                <?php //echo lang('edit_group_desc_label', 'description', "class='col-sm-2 control-label'"); ?>
                                <div class="col-sm-6">
                                    <?php //echo form_input($group_description); ?>
                                    <input name="group_description" value="<?php echo $group_description['value'] ?>"
                                           id="group_description" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <p>
                                    <input name="submit" value="Edit" class="btn btn-success pull-right" type="submit">
                                </p>
                                <p><?php //echo form_submit('submit', lang('edit_group_submit_btn'), ['class' => 'btn btn-success pull-right']); ?></p>
                            </div>
                            <?php echo form_close(); ?>
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