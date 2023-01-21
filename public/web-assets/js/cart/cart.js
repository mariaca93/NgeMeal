
function deletecartitem(id, deleteurl) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: 'warning',
        title: are_you_sure,
        showCancelButton: true,
        confirmButtonText: yes,
        cancelButtonText: no,
        reverseButtons: true,
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: deleteurl,
                    data: { id: id },
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
function qtyupdate(id, type, qtyurl) {
    "use strict";
    $('#preload').show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: qtyurl,
        data: {
            id: id,
            type: type
        },
        method: 'POST',
        success: function (response) {
            if (response.status == 1) {
                location.reload();
            } else if (response.status == 2) {
                $('#preload').hide();
                toastr.error(response.message);
            } else {
                $('#preload').hide();
                $('.err' + id).html(response.message);
                return false;
            }
        },
        error: function (e) {
            $('#preload').hide();
            $('.err' + id).html(e.message);
            return false;
        }
    });
}

function getoffercode(code) {
    "use strict";
    $('#offer_code').val(code);
}
function showaddons(name,price){
    $('#modal_selected_addons').find('.list-group-flush').html('<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
    var response = '';
    $.each( name.split(',') , function( key, value ) {
        response += '<li class="list-group-item"> <b> ' + value + ' </b> <p class="mb-0">' + currency_format(price.split(',')[key]) + '</p> </li>';
    });
    $('#modal_selected_addons').find('.list-group-flush').html(response);
}