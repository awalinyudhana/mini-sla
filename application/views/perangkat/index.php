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
                    <i class="fa fa-bar-chart-o fa-fw"></i> Sistem Pemeliharaan Produk | Daftar Data Perangkat
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if (isset($message)) {
                                ?>
                                <div class="alert alert-warning"><?php echo $message; ?></div>
                                <?php
                            } ?>

                            <p align="right">

                                <?php
                                if ($this->ion_auth->in_group(['admin', 'manager','technical'])){
                                ?>
                                    <?php echo anchor('perangkat/create', 'Tambah Perangkat Baru', "class='btn btn-success'") ?>
                                <?php
                                }
                                ?>
                            </p>
                            <table cellpadding=0 cellspacing=10 class="table" id="datatable" data-url="<?php echo $table_url; ?>">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Perangkat</th>
                                        <th>Merk</th>
                                        <th>Nama Perangkat</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
                                        <th>Url Tambahan</th>
                                        <?php
                                        if ($this->ion_auth->in_group(['admin', 'manager','technical'])){
                                        ?>
                                            <th>Aksi</th>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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