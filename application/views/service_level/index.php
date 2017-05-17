<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Daftar Service Level</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Sistem Pemeliharaan Produk | Daftar Data Layanan
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if (isset($message)) {
                                ?>
                                <div class="alert alert-warning"><?php echo $message; ?></div>
                                <?php
                            } ?>

                            <?php
                            if ($this->ion_auth->in_group(['manager']))
                            {
                                ?>
                                <p align="right">
                                    <?php echo anchor('service_level/create', 'Tambah Layanan Baru', "class='btn btn-success'") ?>
                                </p>
                                <?php
                            }
                            ?>

                            <table cellpadding=0 cellspacing=10 class="table" id="datatable" data-url="<?php echo $table_url; ?>">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Service Level</th>
                                        <th>MoM</th>
                                        <th>BoM</th>
                                        <th>Doc</th>
                                        <th>Demo</th>
                                        <th>Installation</th>
                                        <th>Maintenance</th>
                                        <th>Support</th>
                                        <th>SLA (Day)</th>

                                        <?php
                                        if ($this->ion_auth->in_group(['manager']))
                                        {
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