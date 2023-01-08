// orders-scripts
function OrderStatusUpdate(id, status, myurl) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: 'warning',
        title: are_you_sure,
        showCancelButton: true,
allowOutsideClick: false,
allowEscapeKey: false,
        confirmButtonText: yes,
        cancelButtonText: no,
        reverseButtons: true,
showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: myurl,
                    data: { id: id, status: status },
                    method: 'POST',
                    success: function (response) {
                        if (response == 1) {
                            location.reload();
                        } else {
                            swal_cancelled()
                        }
                    },
                    error: function (e) {
                        swal_cancelled()
                    }
                });
            });
        },
    }).then((result) => {
        if (!result.isConfirmed) {
            result.dismiss === Swal.DismissReason.cancel
        }
    })
}
$(document).on("click", ".open-AddBookDialog", function () {
    $(".modal-body #order_id").val($(this).data('id'));
    $(".modal-body #order_number").val($(this).attr('data-number'));
});
function assigndriver() {
    $('#preloader').show();
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: $('#driverurl').val(),
        method: 'POST',
        data: { id: $("#order_id").val(), driver_id: $('#driver_id').val() },
        dataType: "json",
        success: function (data) {
            if (data.status == 1) {
                location.reload();
            } else {
                $('#preloader').hide();
                $('#myModal').modal().show();
                $('.driver_error').show().html(data.errors.driver_id);
                $('.id_error').show().html(data.errors.id);
                $('.modal-body #order_id').val(id);
                $('.modal-body #order_number').val($('#order_number').val());
            }
        },
        error: function (data) {
            $('#preloader').hide();
            return false;
        }
    });
}