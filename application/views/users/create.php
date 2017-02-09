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
                    <i class="fa fa-bar-chart-o fa-fw"></i> Sipempo | Tambah Pengguna Sistem
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

                            <?php //if($identity_column!=='email') { ?>
                            <div class="form-group">
                                <label for="nip" class="col-sm-2 control-label">nip</label>
                                <div class="col-sm-6">
                                    <input name="nip" value="<?php echo $nip['value'] ;?>" id="nip" type="text" class='form-control'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username:</label>
                                <div class="col-sm-6">
                                    <input name="username" value="<?php echo $username['value'] ;?>" id="username" type="text" class='form-control'>
                                </div>
                            </div>
                            <?php// }
                            ?>
                            <div class="form-group">
                                <label for="first_name" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-6">
                                    <input name="first_name" value="<?php echo $first_name['value'] ;?>" id="first_name" type="text" class='form-control'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-6">
                                    <input name="last_name" value="<?php echo $last_name['value'] ;?>" id="last_name" type="text" class='form-control'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-sm-2 control-label">E-mail</label>
                                <div class="col-sm-6">
                                    <input name="email" value="<?php echo $email['value'] ;?>" id="email" type="text" class='form-control'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="label_grup_name" class="col-sm-2 control-label">Grup</label>
                                <div class="col-sm-6">
                                    <select name="group_id" id="select-group-id" required>
                                        <option value="disabled selected">Pilih Grup</option>;
                                        <?php foreach ($groups_name as $row_group_name) : ?>
                                        <option value="<?php echo $row_group_name->id ; ?>"> <?php echo $row_group_name->name;   ?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <p><?php //echo print_r($groups_name) ?></p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-6">
                                    <input name="password" value="<?php echo $password['value'] ;?>" id="password" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirm" class="col-sm-2 control-label">Password Confirmation</label>
                                <div class="col-sm-6">
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