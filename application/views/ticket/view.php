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
                    <i class="fa fa-bar-chart-o fa-fw"></i> Sistem Pemeliharaan Produk | Ticket Detail
                </div>

                <div class="panel-body">
                    <div class="col-lg-12">
                        <?php
                            echo anchor('ticket_list', 'Kembali', "class='btn btn-default pull-right'");
                        ?>

                        <?php ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if (isset($message)) { ?>
                                <div class="alert alert-warning"><?php echo $message; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="boq-customer">
                                <tr>
                                    <td><strong>No. Ticket</strong></td>
                                    <td><?php echo $ticket_data->ticket_id; ?></td>
                                </tr>

                                <tr>
                                    <td><strong>Customer Name</strong></td>
                                    <td><?php echo $customer_data->nama_customer; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal</strong></td>
                                    <td><?php echo $ticket_data->tanggal; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Staff</strong></td>
                                    <td><?php echo $ticket_data->first_name . ' ' . $ticket_data->last_name; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Category</strong>
                                    </td>
                                    <td><?php echo $ticket_data->category; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Judul</strong>
                                    </td>
                                    <td><?php echo $ticket_data->judul; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Request By</strong>
                                    </td>
                                    <td><?php echo $ticket_data->request_by; ?></td>
                                </tr>

                                <?php if ($ticket_data->ticket_by == 'by_device') { ?>
                                    <tr>
                                        <td><strong>Perangkat</strong></td>
                                        <td><?php echo $boq_detail_data->part_number.' '.$boq_detail_data->nama_perangkat;; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Serial Number</strong></td>
                                        <td><?php echo $boq_detail_data->serial_number; ?></td>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td><strong>Deskripsi By</strong>
                                    </td>
                                    <td><?php echo $ticket_data->deskripsi; ?></td>
                                </tr>
                            </table>
                        </div>

                        <?php echo form_open_multipart(current_url(), ['class' => 'form-horizontal']); ?>
                        <div class="col-lg-6" style="margin-top: 20px !important;">
                            <table class="boq-customer">
                                <tr>
                                    <td><strong>N</strong></td>
                                    <td><?php echo $ticket_data->ticket_id; ?></td>
                                </tr>
                            </table>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Teknisi 1</label>
                                <div class="col-sm-9">
                                    <select name="teknisi[0]" class="form-control">
                                        <option value="0">Pilih</option>
                                        <?php
                                        foreach ($list_support as $value) {
                                            echo "<option value='".$value->id."'". set_select(
                                                    'teknisi[0]',$value->id) .">
                                                    $value->first_name $value->last_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Teknisi 2</label>
                                <div class="col-sm-9">
                                    <select name="teknisi[1]" class="form-control">
                                        <option value="0">Pilih</option>
                                        <?php
                                        foreach ($list_support as $value) {
                                            echo "<option value='".$value->id."'". set_select(
                                                    'teknisi[1]',$value->id) .">
                                                    $value->first_name $value->last_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Teknisi 3</label>
                                <div class="col-sm-9">
                                    <select name="teknisi[2]" class="form-control">
                                        <option value="0" >Pilih</option>
                                        <?php
                                        foreach ($list_support as $value) {
                                            echo "<option value='".$value->id."'". set_select(
                                                    'teknisi[2]',$value->id) .">
                                                    $value->first_name $value->last_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Teknisi 4</label>
                                <div class="col-sm-9">
                                    <select name="teknisi[3]" class="form-control">
                                        <option value="0">Pilih</option>
                                        <?php
                                        foreach ($list_support as $value) {
                                            echo "<option value='".$value->id."'". set_select(
                                                    'teknisi[3]',$value->id) .">
                                                    $value->first_name $value->last_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close();?>

<!--                        --><?php //if ($ticket_data->ticket_by == 'by_device') { ?>
<!--                        <div class="col-lg-4">-->
<!--                            <table class="boq-customer">-->
<!--                                <tr>-->
<!--                                    <td><strong>No BoQ</strong></td>-->
<!--                                    <td>--><?php //echo $boq_data->boq_id; ?><!--</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td><strong>Tanggal BoQ</strong></td>-->
<!--                                    <td>--><?php //echo $boq_data->tanggal_add; ?><!--</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td><strong>Staff BoQ</strong></td>-->
<!--                                    <td>--><?php //echo $boq_data->first_name . ' ' . $boq_data->last_name; ?><!--</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td><strong>Service Level</strong></td>-->
<!--                                    <td>--><?php //echo $boq_data->service_level; ?><!--</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td><strong>Nomor PO</strong></td>-->
<!--                                    <td>--><?php //echo $boq_data->purchase_order; ?><!--</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td><strong>Tanggal Awal Support</strong></td>-->
<!--                                    <td>--><?php //echo $boq_data->end_date_of_support; ?><!--</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td><strong>Tanggal Awal Support</strong></td>-->
<!--                                    <td>--><?php //echo $boq_data->start_date_of_support; ?><!--</td>-->
<!--                                </tr>-->
<!--                            </table>-->
<!--                        </div>-->
<!--                        --><?php //} ?>
<!--                        <div class="col-lg-4">-->
<!--                            <table class="boq-customer">-->
<!--                                <tr>-->
<!--                                    <td><strong>Customer Name</strong></td>-->
<!--                                    <td>--><?php //echo $customer_data->nama_customer; ?><!--</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td><strong>Alamat</strong></td>-->
<!--                                    <td>--><?php //echo $customer_data->alamat; ?><!--</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td><strong>Kota - Provinsi</strong></td>-->
<!--                                    <td>--><?php //echo $customer_data->kota . ' - ' . $customer_data->provinsi; ?><!--</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td><strong>PIC - Kontak</strong></td>-->
<!--                                    <td>--><?php //echo $customer_data->pic . ' - ' . $customer_data->kontak; ?><!--</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td><strong>Email</strong></td>-->
<!--                                    <td>--><?php //echo $customer_data->email; ?><!--</td>-->
<!--                                </tr>-->
<!--                            </table>-->
<!--                        </div>-->

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
                                <!--                                    --><?php //foreach ($progress_data as $value) {
                                //                                      echo "<tr><td>$value->tanggal</td><td>$value->progress</td><td>$value->result</td><td>$value->description</td><td>$value->by</td></tr>";
                                //                                    }
                                //                                    ?>
                                </tbody>
                            </table>
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