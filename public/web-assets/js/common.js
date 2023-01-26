// const { result } = require("lodash");

// for-page-loader
$(window).on('load', function() {
    "use strict";
    $("#preload").delay(600).fadeOut(500);
    $(".pre-loader").delay(600).fadeOut(500);
})

// for-header-sticky
$(window).scroll(function() {
    "use strict";
    if ($(this).scrollTop() > 80) {
        $('#header1').addClass('fixed-top');
    } else {
        $('#header1').removeClass('fixed-top');
    }
});
// for-disable-input-characters
$('#card_number, #card_cvc, #amount').keyup(function() {
    "use strict";
    var val = $(this).val();
    if(isNaN(val)){
        val = val.replace(/[^0-9\.]/g,'');
        if(val.split('.').length>2){
            val = val.replace(/\.+$/,"");
        }
    }
    $(this).val(val);
});

// Back to Top Button JS
$(window).scroll(function() {
    "use strict";
    if ($(window).scrollTop() > 300) {
        $('#back-to-top').addClass('show');
    } else {
        $('#back-to-top').removeClass('show');
    }
});
$('#back-to-top').on('click', function(e) {
    "use strict";
    e.preventDefault();
    $('html, body').animate({
        scrollTop: 0
    }, '300');
});

$("img[data-enlargable]").addClass("img-enlargable").click(function() {
    "use strict";
    var src = $(this).attr("src");
    $("<div>").css({
            background: "RGBA(0,0,0,.5) url(" + src + ") no-repeat center",
            backgroundSize: "contain",
            width: "100%",
            height: "100%",
            position: "fixed",
            zIndex: "10000",
            top: "0",
            left: "0",
            cursor: "zoom-out"
        })
        .click(function() {
            $(this).remove();
        })
        .appendTo("body");
});

function myFunction() {
    "use strict";
    toastr.error("This operation was not performed due to demo mode");
}

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

function ordersuccess(trackurl,order_id,continueurl) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: 'success',
        title: order_placed,
        text: order_placed_note,
        showCancelButton: true,
        confirmButtonText: track_order,
        cancelButtonText: continue_shopping,
        closeOnConfirm: false,
        closeOnCancel: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = trackurl+'-'+order_id;
        } else {
            window.location = continueurl;
        }
    })
}

//to delete item from cart page
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

//to redirect to cart when quantity is decreased from the home page
function removefromcart(nexturl,note,goto_cart) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: "warning",
        title: are_you_sure,
        text: note,
        showCancelButton: true,
        confirmButtonText: goto_cart,
        cancelButtonText: no,
        closeOnConfirm: false,
        closeOnCancel: false,
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = nexturl;
        } else {
            result.dismiss === Swal.DismissReason.cancel
        }
    });
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

function logout(nexturl,are_you_sure_logout,logout) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: "warning",
        title: are_you_sure_logout,
        showCancelButton: true,
        confirmButtonText: logout,
        cancelButtonText: no,
        closeOnConfirm: false,
        closeOnCancel: false,
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = nexturl;
        } else {
            result.dismiss === Swal.DismissReason.cancel
        }
    });
}

function managefavorite(slug, type, manageurl) {
    "use strict";
    $("#preload").show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: manageurl,
        data: {
            slug: slug,
            type: type,
            favurl: manageurl
        },
        method: 'POST',
        success: function(response) {
            if (window.location.href.includes("item-") || window.location.href.includes("favouritelist")) {
                location.reload();
            } else {
                $("#preload").hide();
                $('.set-fav-' + slug).html(response.data);
            }
        },
        error: function(e) {
            $("#preload").hide();
            return false;
        }
    });
}

function addtocart(addcarturl) {
    "use strict";
    var slug = $('#slug').val();
    console.log("slug addtocart: " +slug);

    if($('#item_name').val() != "") {
        var item_name = $('#item_name').val();
    } else {
        var item_name = $('#subscription_name').val();
    }

    if($('#item_type').val() != "") {
        var item_type = $('#item_type').val();
    } else {
        var item_type = $('#subscription_type').val();
    }

    var item_type = $('#item_type').val();
    var image_name = $('#image_name').val();
    var item_price = $('#item_price').val();
    var addons_id = $('.addons-checkbox:checked').map(function() {
        return $(this).attr('data-addons-id');
    }).get().join(',');
    var addons_name = ($('.addons-checkbox:checked').map(function() {
        return $(this).attr('data-addons-name');
    }).get().join(','));
    var addons_price = ($('.addons-checkbox:checked').map(function() {
        return $(this).attr('data-addons-price');
    }).get().join(','));
    calladdtocart(slug, item_name, item_type, image_name, item_price,
        addons_id, addons_name, addons_price, addcarturl);
};

function addtocartsub(addcarturl) {
    "use strict";
    var slug = $('#slug').val();
    if($('#item_name').val() != "") {
        var item_name = $('#item_name').val();
    } else {
        var item_name = $('#subscription_name').val();
    }

    if($('#item_type').val() != "") {
        var item_type = $('#item_type').val();
    } else {
        var item_type = $('#subscription_type').val();
    }

    // var item_name = $('#item_name').val();
    var item_type = $('#item_type').val();

    var image_name = $('#image_name').val();

    var item_price = $('#item_price').val();

    var addons_id = $('.x-addons-checkbox .addons-checkbox:checked').map(function() {
        return $(this).attr('data-addons-id');
    }).get().join(',');
    var addons_name = ($('.x-addons-checkbox .addons-checkbox:checked').map(function() {
        return $(this).attr('data-addons-name');
    }).get().join(','));
    var addons_price = ($('.x-addons-checkbox .addons-checkbox:checked').map(function() {
        return $(this).attr('data-addons-price');
    }).get().join(','));
    localStorage.clear();
    calladdtocart(slug, item_name, item_type, image_name, item_price,
        addons_id, addons_name, addons_price, addcarturl);
};

function calladdtocart(slug, item_name, item_type, image_name, item_price,addons_id, addons_name, addons_price, addcarturl) {
    "use strict";
    console.log('slug: ' +slug);
    console.log('item_name: ' +item_name);
    console.log('image_name: ' +image_name);
    console.log('item_price: ' +item_price);
    console.log('addons_id: ' +addons_id);
    console.log('addons_name: ' +addons_name);
    console.log('addons_price: ' +addons_price);
    console.log('addcarturl: ' +addcarturl);
    $("#preload").show();
    console.log(addcarturl);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: addcarturl,
        // url: "addtocart.php",
        data: {
            slug: slug,
            item_name: item_name,
            item_type: item_type,
            image_name: image_name,
            item_price: item_price,
            addons_id: addons_id,
            addons_name: addons_name,
            addons_price: addons_price,
        },
        method: 'POST',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // console.log(response.total_item_count)
            if (response.total_item_count == 1) {
                location.reload();
            } else {
                $("#preload").hide();
                $('.cart-badge').html(response.data);
                console.log(response.item_data);
                $('.item-total-qty-' + slug).val(response.total_item_count);
                // console.log(testing);
                toastr.success(response.message);
                $("input:checkbox").prop('checked', false);
                $("#modalitemdetails").modal('hide');
            }

            if(response.status == 0){
                $("#preload").hide();
                toastr.error(wrong);
                $("input:checkbox").prop('checked', false);
                $("#modalitemdetails").modal('hide');
            }
        },
        error: function(error) {
            $("#preload").hide();
            toastr.error(wrong);
            $("input:checkbox").prop('checked', false);
            $("#modalitemdetails").modal('hide');
        }
    })
}
function showaddons(name,price){
    $('#modal_selected_addons').find('.list-group-flush').html('<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
    var response = '';
    $.each( name.split(',') , function( key, value ) {
        response += '<li class="list-group-item"> <b> ' + value + ' </b> <p class="mb-0">' + currency_format(price.split(',')[key]) + '</p> </li>';
    });
    $('#modal_selected_addons').find('.list-group-flush').html(response);
}

function showitem(slug, showurl, urladdcart) {
    "use strict";
    $("#preload").show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: showurl,
        data: {
            slug: slug
        },
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            $("#preload").hide();
            $("input:checkbox").prop('checked', false);
            // $("#modalitemdetails").modal('show');
            $('#slug').val(response.itemdata.slug);
            $('#item_name').val(response.itemdata.item_name);
            $('#item_type').val(response.itemdata.item_type);
            $('#image_name').val(response.itemdata.image_name);
            $('.attribute').text(response.itemdata.attribute);
            $('.item_name').text(response.itemdata.item_name);
            $('#item_type_image').html("<img class='item-type-image mt-1' src=" + response.itemdata
                .item_type_image + ">");
            $('.varition-listing').html('');
            $('.addons-listing').html('');

            var sessionValue= $("#hdnsession").val();
            var classforview = "";
            if (sessionValue == "rtl") {
                var classforview = "d-flex";
                var classforcheckbox = "ms-0";
            }

            if (response.itemdata.addons != "") {
                $('#addons').show();
                let freehtml = '';
                for (let j in response.itemdata.addons) {
                    freehtml +=
                        '<div class="form-check '+classforview+'"><input class="form-check-input cursor-pointer addons-checkbox '+classforcheckbox+'" type="checkbox" value="' +
                        response.itemdata.addons[j].id + '" data-addons-id="' + response.itemdata
                        .addons[j].id + '" data-addons-price="' + response.itemdata.addons[j].price +
                        '" data-addons-name="' + response.itemdata.addons[j].name +
                        '" onclick="getaddons(this)" id="addons' + response.itemdata.addons[j].id +
                        '"><label class="form-check-label cursor-pointer me-2" for="addons' + response
                        .itemdata.addons[j].id + '">' + response.itemdata.addons[j].name + '</label><label class="form-check-label cursor-pointer me-2" for="addons' + response
                        .itemdata.addons[j].id + '"> :- ' + currency_format(response.itemdata.addons[j].price) + '</label></div>';
                }
                $('.addons-listing').html(freehtml);
            } else {
                $('#addons').hide();
            }
            var itemprice = response.itemdata.price;
            $('#item_price').val(itemprice);
            $('#subtotal').val(itemprice);
            $('.item_price').html(currency_format(itemprice)).addClass('mb-0');
            $('.subtotal').html(currency_format(itemprice));
            addtocart(urladdcart);
        },
        error: function(error) {
            $("#preload").hide();
            toastr.error(wrong);
            return false;
        }
    })
}

function getaddons(x) {
    "use strict";
    var price = parseFloat($(x).attr('data-addons-price'));
    var addonstotal = parseFloat($('#addonstotal').val());
    var item_price = parseFloat($('#item_price').val());
    var subtotal = parseFloat($('#subtotal').val());
    console.log($(x).attr('id'));
    if ($(x).is(':checked')) {
        $(x).attr("checked", "checked");
        addonstotal += price;
        subtotal = item_price + addonstotal;
    } else {
        $(x).attr("checked", false);
        addonstotal -= price;
        subtotal = item_price + addonstotal;
    }
    $('#addonstotal').val(addonstotal);
    $('#subtotal').val(subtotal);
    $('.subtotal').text(currency_format(subtotal));

}

function checkaddons(){
    // var itemName = $('#item-name').html();
    // var addons = $('#addons1').is(':checked');
    // if(addons){
    //     $('#addons1').prop('checked', false);
    // }
console.log('test');
    $("input:checkbox").prop('checked', false);
}

