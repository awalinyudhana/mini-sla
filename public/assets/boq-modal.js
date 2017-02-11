var BoQModal = function() {
    return {
        init: function() {
            var perangkatModal = $('#modalPerangkat');
            var serialModal = $('#modalSerial');
            var boqDetail = $("#boqDetail");
            var boqDetailTable = $("#boqDetailTable tbody");
            var index = 0;
            var perangkatId = '';
            var partNumber = '';
            var serialNUmber = '';
            var deskripsi = '';

            perangkatModal.on('click', '.pilih', function() {
                var detail = $(this).data('detail');
                index++;
                perangkatId = detail['perangkat_id'];
                partNumber = detail['part_number'];
                perangkatModal.modal('toggle');
                serialModal.modal('toggle');
            });

            serialModal.on('hidden.bs.modal', function (event) {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();

                serialNumber = $('#serialNumber').val();
                deskripsi = $('#deskripsi').val();
                if (serialNumber != '' && deskripsi != '') {
                    boqDetailTable.append('<tr id="row-boq-detail-'+index+'"><td>'+index+'</td><td>'+partNumber+'</td><td>'+serialNumber+'</td><td>'+deskripsi+'</td><td><a href="javascript:;" class="btn btn-danger hapus-detail-boq" data-id="'+index+'">Hapus</a></td></tr>');
                    boqDetail.append('<input type="hidden" name="boq_detail[]" id="input-boq-detail-'+index+'" value="'+perangkatId+';'+serialNumber+';'+deskripsi+'">');
                }
            });

            $("#boqDetailTable tbody").on('click', '.hapus-detail-boq', function() {
                var selected_id = $(this).data('id');
                $("#row-boq-detail-"+selected_id).remove();
                $("#input-boq-detail-"+selected_id).remove();
            });
        }
    };
}();