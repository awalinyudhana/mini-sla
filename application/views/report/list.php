<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Technical Score</h1>
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
                            <button class="btn btn-default pull-right" style="margin-bottom: 15px;" id="buttonFilter">Filter Technical Score</button>
                            <a href="<?php echo base_url();?>report/print_technical_score" target="_blank" class="btn btn-default pull-right" style="margin-right: 10px;">Cetak Technical Score</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table cellpadding=0 cellspacing=10 class="table" id="datatable" data-url="<?php echo $table_url; ?>">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Teknisi</th>
                                        <th>Point By Device</th>
                                        <th>Point By Customer</th>
                                        <th>Total Point</th>
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
<script>
    document.getElementById("buttonFilter").addEventListener("click", function () {
        var start = $("#start_date_of_support").val();
        var end = $("#end_date_of_support").val();
        if (start && end) {
            var start_date = new Date(start);
            var end_date = new Date(end);
            if (start_date < end_date) {
                window.location = "<?php echo base_url(); ?>report/technical_score/"+start+'/'+end;
            }
        }
    }, false);
</script>