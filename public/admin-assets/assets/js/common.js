$(window).on("load", function () {
    "use strict";
    $('#preloader').fadeOut('slow')
    if ($(".multimenu").find(".active")) {
        $(".multimenu").find(".active").parent().parent().addClass("show");
        $(".multimenu").find(".active").parent().parent().parent().attr("aria-expanded", true);
    }
});

$(function () {
    for (var nk = window.location,
        o = $("ul#sidebar-mainmenu a").filter(function () {
            return this.href == nk;
        })
            .addClass("active")
            .parent()
            .addClass("active"); ;) {
        if (!o.is("li")) break;
        o = o.parent()
            .addClass("in")
            .parent()
            .addClass("active");
    }
});



$(document).ready(function () {
    "use strict";
    $('#oldpassword').val('');
    $('.zero-configuration').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ]
    });
});
function myFunction() {
    "use strict";
    toastr.error("This operation was not performed due to demo mode");
}
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
$('#amount, #min_order_amount, #max_order_qty, #max_order_amount, #lat, #lang, #referral_amount, #price, #product_price, #sale_price, #delivery_charge, #mobile').keyup(function () {
    "use strict";
    var val = $(this).val();
    if (isNaN(val)) {
        val = val.replace(/[^0-9\.]/g, '');
        if (val.split('.').length > 2) {
            val = val.replace(/\.+$/, "");
        }
    }
    $(this).val(val);
});

// For all sweet-alerts
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success mx-1',
        cancelButton: 'btn btn-danger mx-1'
    },
    buttonsStyling: false
})
function swal_cancelled(issettitle) {
    "use strict";
    var title = wrong;
    if (issettitle) {
        title = "" + issettitle + "";
    }
    swalWithBootstrapButtons.fire('Cancelled', title, 'error')
};
function logout(nexturl) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: 'warning',
        title: are_you_sure,
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        confirmButtonText: yes,
        cancelButtonText: no,
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = nexturl;
        } else {
            result.dismiss === Swal.DismissReason.cancel
        }
    })
}
function changeStatus(status, surl) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: 'warning',
        title: are_you_sure,
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        confirmButtonText: yes,
        cancelButtonText: no,
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = surl;
        } else {
            if($('#maintenance_mode-switch').is(':checked')){
                $('#maintenance_mode-switch').prop('checked',false);
            }else{
                $('#maintenance_mode-switch').prop('checked',true);
            }
            result.dismiss === Swal.DismissReason.cancel
        }
    })
}