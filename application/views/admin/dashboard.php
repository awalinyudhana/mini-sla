<script src="<?php echo base_url('assets/chart/highcharts.js') ; ?>"></script>
<script src="<?php echo base_url('assets/chart/exporting.js') ; ?>"></script>
<!--<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>-->

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | Prosentase pemilih yang telah menggunakan hak pilihnya
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-5">
                                    <h2 class="text-center">Prosentase Pemilih</h2>
                                    <div id="container" style="min-width: 310px; height: 600px; max-width: 900px; margin: 0 auto"></div>
                                </div>
                                <div class="col-lg-7">
                                    <h3 class="text-center">Antrian Pemilih di dalam Bilik</h3>

                                    <div class="row">
                                        <?php foreach($booths as $booth):?>
                                            <div class="col-lg-6" style="margin-top: 30px;">
                                                <div class="panel panel-default text-center">
                                                    <h1 class="text-danger"><?php echo $booth->title ?></h1>
                                                    <h2 id="booth-name-<?php echo $booth->booth_id ?>"></h2>
                                                    <h3 id="booth-identity-<?php echo $booth->booth_id ?>"></h3>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Prosentase pemilih yang telah menggunakan hak pilihnya'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data:
                <?php echo $graph ?>
            }]
        });

    });

    setInterval(function() {
        $.getJSON( "<?php echo base_url("dashboard/graph"); ?>", function( data ) {
            var chart = $('#container').highcharts();
            chart.series[0].setData(data, false);
            chart.redraw();
        });

    }, 300000);


    <?php foreach($booths as $booth):?>
        setInterval(function() {
            $.getJSON( "<?php echo base_url("dashboard/booth/".$booth->booth_id); ?>", function( data ) {
                if(data.name) {
                    $("#booth-name-<?php echo $booth->booth_id ?>").html(data.name);
                    $("#booth-identity-<?php echo $booth->booth_id ?>").html(data.identity);
                }
            });

        }, 3000);
    <?php endforeach; ?>
</script>