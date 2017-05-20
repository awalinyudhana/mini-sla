
<!-- /.panel-footer -->
</div>
<!-- /.panel .chat-panel -->
</div>
<!-- /.col-lg-4 -->
</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Konfirmasi Hapus Data
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-ok">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/jquery-1.11.1.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/js/bootstrap.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/admin/sb-admin.js"); ?>"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/boq-modal.js"); ?>"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<!-- Core Scripts - Include with every page -->
<script type="text/javascript">
jQuery(document).ready(function() {  
    BoQModal.init();
});

$('.datepicker').datepicker({
    format: 'yyyy-m-d',
    todayHighlight: true,
    autoclose: true,
    weekStart: 1,
});

var modalCloseTicketButton = $('#modalCloseTicketButton');
modalCloseTicketButton.on('click', function() {
    $("#ticket_response_submit_type").val("close_ticket");
    $("#ticket_add_progress").submit();
});

var modalDeclineTicketButton = $('#modalDeclineTicketButton');
modalDeclineTicketButton.on('click', function() {
    $("#ticket_decline_ticket").submit();
});

var table;
var datatable_url;
$(document).ready(function() {
    
    datatable_url = $("#datatable").data('url');
    //datatables
    table = $('#datatable').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": datatable_url,
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });

    
 
});

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

$('#confirm-approve').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>
</body>

</html>
