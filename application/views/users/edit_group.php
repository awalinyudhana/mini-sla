<?php
/**
 * Created by PhpStorm.
 * User: Hasyim
 * Date: 15/11/2016
 * Time: 14.27
 */
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Pengguna Sistem</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Sipempo | Daftar Pengguna Sistem
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <p align="right">
                                <?php echo anchor('users', 'Kembali', "class='btn btn-default'")?>
                            </p>
                            <div id="infoMessage"><?php echo $message;?></div>
                            <?php echo form_open(uri_string(), ['class' => 'form-horizontal']); ?>
                            <h1><?php echo lang('edit_group_heading');?></h1>
                            <p><?php echo lang('edit_group_subheading');?></p>
                            <div class="form-group">
                                <label for="label_group_name" class="col-sm-2 control-label">Group Name : </label>
                                <div class="col-sm-6">
                                    <input name="group_name" value="<?php echo $group_name['value']; ?>" id="group-name" type="text"
                                           class='form-control' readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="label_group_description" class="col-sm-2 control-label">Group Description :</label>
                                <div class="col-sm-6">
                                    <input name="group_description" value="<?php echo $group_description['value']; ?>" id="group-description"
                                           type="text" class='form-control'>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <p><?php echo form_submit('submit', 'Edit User', ['class' => 'btn btn-success pull-right']); ?></p>
                                </div>
                            </div>
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