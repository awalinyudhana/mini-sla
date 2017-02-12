<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Ticket Detail</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | Ticket Detail
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
                        <div class="col-lg-6">
                            <table class="boq-customer pull-right">
                                <tr><td class="title"><strong>No. Ticket</strong></td><td><?php echo $ticket_data->ticket_id; ?></td></tr>
                                <tr><td class="title"><strong>Tanggal</strong></td><td><?php echo $ticket_data->tanggal; ?></td></tr>
                                <tr><td class="title"><strong>Staff</strong></td><td><?php echo $customer_data->pic; ?></td></tr>
                                <tr><td class="title"><strong>Category</strong></td><td><?php echo $ticket_data->category; ?></td></tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="boq-customer">
                                <tr><td class="title"><strong>Judul</strong></td><td><?php echo $ticket_data->judul; ?></td></tr>
                                <?php if ($ticket_data->ticket_by == 'by_device') { ?>
                                <tr><td class="title"><strong>No. BoQ</strong></td><td><?php echo $boq_data->boq_id; ?></td></tr>
                                <tr><td class="title"><strong>Serial Number</strong></td><td><?php echo $boq_detail_data->serial_number; ?></td></tr>
                                <tr><td class="title"><strong>Nama Perangkat</strong></td><td><?php echo $boq_detail_data->nama_perangkat; ?></td></tr>
                                <tr><td class="title"><strong>End Date of Support</strong></td><td><?php echo $boq_data->end_date_of_support; ?></td></tr>
                                <?php } else if ($ticket_data->ticket_by == 'by_customer') { ?>
                                <tr><td class="title"><strong>Request By</strong></td><td><?php echo $ticket_data->request_by; ?></td></tr>
                                <tr><td class="title"><strong>Technician</strong></td><td><?php echo str_replace(";",",", $ticket_data->technician); ?></td></tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="boq-customer pull-right">
                                <?php if ($ticket_data->ticket_by == 'by_device') { ?>
                                <tr><td class="title"><strong>Request By</strong></td><td><?php echo $ticket_data->request_by; ?></td></tr>
                                <tr><td class="title"><strong>Technician</strong></td><td><?php echo str_replace(";",",", $ticket_data->technician); ?></td></tr>
                                <tr><td class="title"><strong>Deskripsi</strong></td><td><?php echo $ticket_data->deskripsi; ?></td></tr>
                                <?php } else if ($ticket_data->ticket_by == 'by_customer') { ?>
                                <tr><td class="title"><strong>Deskripsi</strong></td><td><?php echo $ticket_data->deskripsi; ?></td></tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table cellpadding=0 cellspacing=10 class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Progress</th>
                                        <th>Result</th>
                                        <th>Description</th>
                                        <th>By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($progress_data as $value) {
                                      echo "<tr><td>$value->tanggal</td><td>$value->progress</td><td>$value->result</td><td>$value->description</td><td>$value->by</td></tr>";  
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <?php 
                                if (isset($type) && $type == 'approve') {
                                    echo anchor('ticket_list/view/'.$ticket_data->ticket_id, 'View Report', "class='btn btn-info'");
                                    echo anchor('ticket_list/approve_ticket/'.$ticket_data->ticket_id, 'Approve Ticket Closing', "class='btn btn-success margin-left-10'"); 
                                    echo anchor('ticket_list/closed', 'Kembali', "class='btn btn-default pull-right'");
                                } else {
                                    echo anchor('ticket_list', 'Kembali', "class='btn btn-default pull-right'");
                                }
                            ?>

                            <?php  ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.panel-heading -->
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>