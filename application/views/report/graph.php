<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Grafik Ticket</h1>
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
                            <?php if(isset($message)) { ?>
                                <div class="alert alert-warning"><?php echo $message;?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 pull-right">
                            <form class="form-horizontal">
                                <?php if (isset($type) && $type == 'category') { ?>
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Kategori</label>
                                    <div class="col-sm-6">
                                        <select name="category" id="category" class="form-control">
                                            <option value="Installation" <?php if ($category=='Installation') { ?>selected<?php } ?>>Installation</option>
                                            <option value="Maintenance" <?php if ($category=='Maintenance') { ?>selected<?php } ?>>Maintenance</option>
                                            <option value="Support" <?php if ($category=='Support') { ?>selected<?php } ?>>Support</option>
                                            <option value="MoM" <?php if ($category=='MoM') { ?>selected<?php } ?>>MoM</option>
                                            <option value="BoM" <?php if ($category=='BoM') { ?>selected<?php } ?>>BoM</option>
                                            <option value="Demo" <?php if ($category=='Demo') { ?>selected<?php } ?>>Demo</option>
                                            <option value="Doc" <?php if ($category=='Doc') { ?>selected<?php } ?>>Doc</option>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Tanggal Mulai</label>
                                    <div class="col-sm-6">
                                        <div class="input-group date datepicker" data-provide="datepicker">
                                            <input type="text" class="form-control"
                                                   value="<?php if ($this->session->userdata('report_start')) { echo $this->session->userdata('report_start'); } ?>"
                                                   name="start_date_of_support" id="start_date_of_support">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">Tanggal Akhir</label>
                                    <div class="col-sm-6">
                                        <div class="input-group date datepicker" data-provide="datepicker">
                                            <input type="text" class="form-control"
                                                   value="<?php if ($this->session->userdata('report_end')) { echo $this->session->userdata('report_end'); } ?>"
                                                   name="end_date_of_support" id="end_date_of_support">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button class="btn btn-default pull-right" style="margin-bottom: 15px;" id="buttonFilter">Filter Data</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="graph-container" style="min-width: 310px;height: 400px;margin: 0 auto"></div>
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
<script>
    document.getElementById("buttonFilter").addEventListener("click", function () {
        var start = $("#start_date_of_support").val();
        var end = $("#end_date_of_support").val();

        <?php if (isset($type) && $type == 'category') { ?>
        var category = $("#category").val();
        // var target = <?php echo base_url(); ?>+"report/ticket_graph_by_category/"+category+'/'+start+'/'+end
        <?php } ?>
        if (start && end) {
            var start_date = new Date(start);
            var end_date = new Date(end);
        } else {
            var start_date = '';
            var end_date = '';
        }
            
        <?php if (isset($type) && $type == 'category') { ?>
            window.location = "<?php echo base_url(); ?>report/ticket_graph_by_category/"+category+'/'+start+'/'+end;
        <?php } else { ?>
            window.location = "<?php echo base_url(); ?>report/ticket_graph/"+start+'/'+end;
        <?php } ?>
    }, false);

    Highcharts.chart('graph-container', {

        title: {
            text: 'Grafik Ticket'
        },

        yAxis: {
            title: {
                text: 'Jumlah Request'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        xAxis: {
            categories:[<?php foreach ($data as $key => $value) {echo "'".$value->tahun."-".$value->bulan."',";}?>]
        },

        series: [{
            name: 'Grafik Ticket',
            data: [<?php foreach ($data as $key => $value) {echo $value->jumlah.",";}?>]
        }]

    });
</script>