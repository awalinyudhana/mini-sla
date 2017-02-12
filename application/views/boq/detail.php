<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> BoQ Detail</h1>
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
                            <?php if(isset($message)) { ?>
                                <div class="alert alert-warning"><?php echo $message;?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="boq-customer">
                                <tr><td class="title"><strong>Customer Name</strong></td><td><?php echo $customer_data->nama_customer; ?></td></tr>
                                <tr><td class="title"><strong>Alamat</strong></td><td><?php echo $customer_data->alamat; ?></td></tr>
                                <tr><td class="title"><strong>Kota - Provinsi</strong></td><td><?php echo $customer_data->kota.' - '.$customer_data->provinsi ; ?></td></tr>
                                <tr><td class="title"><strong>PIC - Kontak</strong></td><td><?php echo $customer_data->pic.' - '.$customer_data->kontak ; ?></td></tr>
                                <tr><td class="title"><strong>Email</strong></td><td><?php echo $customer_data->email; ?></td></tr>
                            </table>
                        </div>
                        <div class="col-lg-6 ">
                            <table class="boq-customer pull-right">
                                <tr><td class="title"><strong>No. BoQ</strong></td><td><?php echo $boq_data->boq_id; ?></td></tr>
                                <tr><td class="title"><strong>Tanggal Trans.</strong></td><td><?php echo $boq_data->tanggal_add; ?></td></tr>
                                <tr><td class="title"><strong>Staff</strong></td><td><?php echo $customer_data->pic; ?></td></tr>
                                <tr><td class="title"><strong>Service Level</strong></td><td><?php echo $boq_data->service_level; ?></td></tr>
                                <tr><td class="title"><strong>Start Date of Support</strong></td><td><?php echo $boq_data->start_date_of_support; ?></td></tr>
                                <tr><td class="title"><strong>End Date of Support</strong></td><td><?php echo $boq_data->end_date_of_support; ?></td></tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo anchor('boq/lists', 'Kembali', "class='btn btn-default pull-right'")?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table cellpadding=0 cellspacing=10 class="table" id="datatable" data-url="<?php echo $table_url; ?>">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Part Number</th>
                                        <th>Serial Number</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
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