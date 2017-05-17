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
                        <div class="col-lg-6" style="margin-top: 20px !important;">
                            <table class="boq-customer" style="margin-bottom: 10px !important;">
                                <tr>
                                    <td><strong>Daftar Teknikal Support</strong></td>
                                </tr>
                            </table>
                            <form class="form-horizontal">
                            <?php

                            $i = 1;
                            foreach ($list_support as $value)
                            {
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Teknisi <?php echo $i; ?></label>
                                    <div class="col-sm-9">
                                        <select name="teknisi[0]" class="form-control" >
                                            <option value="<?php echo $value->id ?>">
                                                <?php echo $value->first_name. ' ' .$value->last_name; ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            <?php
                                $i++;
                            }
                            echo form_close();

                            echo form_open(current_url(), ['class' => 'form-horizontal']);

                            if ($this->ion_auth->in_group(['manager'])) :
                            while($i <= 4)
                            {
                                ?>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Teknisi <?php echo $i; ?></label>
                                    <div class="col-sm-9">
                                        <select name="teknisi[]" class="form-control">
                                            <option value="0">Pilih</option>
                                            <?php
                                            foreach ($available_support as $value) {
                                                echo "<option value='".$value->id."'". set_select(
                                                        'teknisi[0]',$value->id) .">
                                                    $value->first_name $value->last_name</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            <?php
                                $i++;
                            }

                            endif;
                            ?>

                                <?php
                                if ($this->ion_auth->in_group(['support', 'manager']))
                                {
                                    ?>
                                    <input type="submit" value="Edit Support" class="btn btn-success pull-right">
                                    <?php
                                }
                                ?>

                            <?php
                                echo form_close();
                            ?>
                        </div>

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
                                    <?php
                                    if($progress_data)
                                    {
                                        foreach ($progress_data as $value) {
                                            echo "<tr>
<td>$value->tanggal</td><td>$value->progress</td><td>$value->result</td><td>$value->description</td><td>$value->first_name $value->last_name</td></tr>";
                                        }

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                        if ($this->ion_auth->in_group(['support', 'manager']))
                        {
                            ?>

                            <div class="col-lg-12">
                                <a href="<?php echo base_url('ticket_list/add_progress/'.$ticket_data->ticket_id) ?>"
                                   class="btn btn-success pull-right"> Add Progress</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                </div>
            </div>
            <!-- /.panel-heading -->
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>