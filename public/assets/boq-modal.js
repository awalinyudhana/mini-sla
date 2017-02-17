var BoQModal = function() {
    return {
        init: function() {
            var perangkatModal = $('#modalPerangkat');
            var serialModal = $('#modalSerial');
            var serialModalCloseButton = $('#modalSerialCloseButton');
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

            serialModalCloseButton.on('click', function() {
                var modalSerialError = $('#modalSerialError');
                modalSerialError.html('');
                
                serialNumber = $('#serialNumber').val();
                deskripsi = $('#deskripsi').val();
                if (serialNumber != '' && deskripsi != '') {
                    // Check Serial Number
                    var baseurl = window.location.origin+'/public/';
                    var formData = {
                        'serial_number' : serialNumber
                    };

                    $.ajax({
                        type        : 'POST',
                        url         : baseurl+'boq/check_serial_number',
                        data        : formData,
                        dataType    : 'json',
                        encode      : true
                    })
                    .done(function(data) {
                        if (data == false) {
                            boqDetailTable.append('<tr id="row-boq-detail-'+index+'"><td>'+index+'</td><td>'+partNumber+'</td><td>'+serialNumber+'</td><td>'+deskripsi+'</td><td><a href="javascript:;" class="btn btn-danger hapus-detail-boq" data-id="'+index+'">Hapus</a></td></tr>');
                            boqDetail.append('<input type="hidden" name="boq_detail[]" id="input-boq-detail-'+index+'" value="'+perangkatId+';'+serialNumber+';'+deskripsi+';'+partNumber+'">');
                            $('#serialNumber').val('');
                            $('#deskripsi').val('');
                            serialModal.modal('toggle');
                        } else {
                            modalSerialError.html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> Serial number yang diinputkan telah ada, harap menggunakan serial number lain yang berbeda.</div>');
                        }
                    });
                }
            });

            serialModal.on('hidden.bs.modal', function (event) {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });

            $("#boqDetailTable tbody").on('click', '.hapus-detail-boq', function() {
                var selected_id = $(this).data('id');
                $("#row-boq-detail-"+selected_id).remove();
                $("#input-boq-detail-"+selected_id).remove();
            });
        }
    };
}();