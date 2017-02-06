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
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | Daftar Pengguna Sistem
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <p align="right"><?php echo anchor('users', 'Kembali', "class='btn btn-default'")?></p>

                            <p>Apakah anda ingin me-nonaktifkan user <?php echo $user->first_name.' '.$user->last_name ?> ? </p>
                            <?php echo form_open("users/deactivate/".$user->id);?>
                            <p>
                                <?php echo lang('deactivate_confirm_y_label', 'confirm', "class='radio-inline'");?>
                                <input type="radio" name="confirm" value="yes" checked="checked" class="radio-inline" />
                                <?php echo lang('deactivate_confirm_n_label', 'confirm',  "class='radio-inline'");?>
                                <input type="radio" name="confirm" value="no" class="radio-inline"/>
                            </p>
                            <?php echo form_hidden($csrf); ?>
                            <?php echo form_hidden(array('id'=>$user->id)); ?>

                            <div class="col-sm-3">
                                <p><?php echo form_submit('submit', lang('deactivate_submit_btn'), ['class' => 'btn btn-success pull-right']); ?></p>
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