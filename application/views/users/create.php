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
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | Tambah Pengguna Sistem
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
                                <?php echo anchor('users', 'Kembali', "class='btn btn-default'")?>
                            </p>
                            <?php echo form_open('users/create', ['class' => 'form-horizontal']); ?>

                            <?php if($identity_column!=='email') { ?>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username:</label>
                                <div class="col-sm-6">
                                    <?php //echo form_input($last_name); ?>
                                    <input name="username" value="<?php echo $username['value'] ;?>" id="username" type="text" class='form-control'>
                                </div>
                            </div>
                            <?php }
                            ?>
                            <div class="form-group">
                                <?php echo lang('create_user_fname_label', 'first_name', "class='col-sm-2 control-label'"); ?>
                                <div class="col-sm-6">
                                    <?php //echo form_input($first_name); ?>
                                    <input name="first_name" value="<?php echo $first_name['value'] ;?>" id="first_name" type="text" class='form-control'>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo lang('create_user_lname_label', 'last_name', "class='col-sm-2 control-label'"); ?>
                                <div class="col-sm-6">
                                    <?php //echo form_input($last_name); ?>
                                    <input name="last_name" value="<?php echo $last_name['value'] ;?>" id="last_name" type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo lang('create_user_password_label', 'password', "class='col-sm-2 control-label'");?>
                                <div class="col-sm-6">
                                    <?php //echo form_input($password);?>
                                    <input name="password" value="<?php echo $password['value'] ;?>" id="password" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo lang('create_user_password_confirm_label', 'password_confirm', "class='col-sm-2 control-label'");?>
                                <div class="col-sm-6">
                                    <?php // echo form_input($password_confirm);?>
                                    <input name="password_confirm" value="<?php echo $password_confirm['value'] ;?>" id="password_confirm" type="password", class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <p><?php echo form_submit('submit', 'Tambah User', ['class' => 'btn btn-success pull-right']); ?></p>
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