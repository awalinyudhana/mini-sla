<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Data Customer</h1>
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
                            <?php if(isset($message)) {
                                ?>
                                <div class="alert alert-warning"><?php echo $message;?></div>
                                <?php
                            }?>
                            <p align="right">
                                <?php echo anchor('customer', 'Kembali', "class='btn btn-default'")?>
                            </p>
                            <?php 
                                if ($mode == 'create') {
                                    echo form_open('customer/create', ['class' => 'form-horizontal']); 
                                } else {
                                    echo form_open('customer/update', ['class' => 'form-horizontal']); 
                                    echo "<input type='hidden' name='customer_id' value='$customer_id'>";
                                }
                            ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama Customer</label>
                                <div class="col-sm-6">
                                    <input name="nama_customer" <?php if ($mode == 'update') echo "value='$nama_customer'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-6">
                                    <input name="alamat" <?php if ($mode == 'update') echo "value='$alamat'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kota</label>
                                <div class="col-sm-6">
                                    <input name="kota" <?php if ($mode == 'update') echo "value='$kota'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Provinsi</label>
                                <div class="col-sm-6">
                                    <input name="provinsi" <?php if ($mode == 'update') echo "value='$provinsi'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kode Pos</label>
                                <div class="col-sm-6">
                                    <input name="kode_pos" <?php if ($mode == 'update') echo "value='$kode_pos'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">PIC</label>
                                <div class="col-sm-6">
                                    <input name="pic" <?php if ($mode == 'update') echo "value='$pic'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kontak</label>
                                <div class="col-sm-6">
                                    <input name="kontak" <?php if ($mode == 'update') echo "value='$kontak'" ?>type="text" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input name="email" <?php if ($mode == 'update') echo "value='$email'" ?>type="email" class='form-control'>
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