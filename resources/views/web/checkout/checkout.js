if ($('#stripekey').val() !== "") {
    var stripe = Stripe($('#stripekey').val());
    var card = stripe.elements().create('card', {
        style: {
            base: {
                // Add your base input styles here. For example:
                fontSize: '16px',
                color: '#32325D',
            },
        }
    });
    card.mount('#card-element');
    $('.__PrivateStripeElement iframe').removeAttr('style');
}
// common-variables
var user_name = $('#user_name').val();
var user_email = $('#user_email').val();
var user_mobile = $('#user_mobile').val();
var orderurl = $('#orderurl').val();
var successurl = $('#successurl').val();
var continueurl = $('#continueurl').val();
var rest_lat = parseFloat($('#rest_lat').val());
var rest_lang = parseFloat($('#rest_lang').val());
var delivery_charge_per_km = parseFloat($('#delivery_charge_per_km').val());
var order_type = $('#order_type').val();
var delivery_charge = parseFloat($('#delivery_charge').val());
var grand_total = parseFloat($('#grand_total').val());
var tax_amount = parseFloat($('#totaltaxamount').val());
var address_type = "";
var address = "";
var house_no = "";
var lat = "";
var lang = "";
// TO-HIDE-ADDRESS-ERROR
$('input:radio[name=myaddress]').click(function (event) {
    "use strict";
    validate_myaddress();
});
$('input:radio[name=myaddress]:checked').click(function (event) {
    "use strict";
    validate_myaddress();
}).click();
function validate_myaddress() {
    $('.addresserror').addClass('d-none');
    address_type = $("input:radio[name=myaddress]:checked").attr('data-address-type');
    address = $("input:radio[name=myaddress]:checked").attr('address');
    house_no = $("input:radio[name=myaddress]:checked").attr('house_no');
    lat = parseFloat($("input:radio[name=myaddress]:checked").attr('lat'));
    lang = parseFloat($("input:radio[name=myaddress]:checked").attr('lang'));
    $('#grand_total').val(grand_total);
    $('.grand_total').html(currency_format(grand_total));
    $('#delivery_charge').val(0);
    $('.delivery_charge').html(currency_format(0));
    if ($('#environment').val() == 'sendbox') {
        $('#grand_total').val(delivery_charge_per_km + grand_total);
        $('.grand_total').html(currency_format(delivery_charge_per_km + grand_total));
        $('#delivery_charge').val(delivery_charge_per_km);
        $('.delivery_charge').html(currency_format(delivery_charge_per_km));
    } else {
        $("#preload").show();
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: $("input:radio[name=myaddress]:checked").attr('data-url'),
            data: { lat: lat, lang: lang },
            method: 'post',
            success: function (response) {
                $("#preload").hide();
                if (response.status == 1) {
                    delivery_charge = calcCrow(rest_lat, rest_lang, lat, lang).toFixed(1) * delivery_charge_per_km;
                    $('#grand_total').val(delivery_charge + grand_total);
                    $('.grand_total').html(currency_format(delivery_charge + grand_total));
                    $('#delivery_charge').val(delivery_charge);
                    $('.delivery_charge').html(currency_format(delivery_charge));
                    //This function takes in latitude and longitude of two location and returns the distance between them as the crow flies (in km)
                    function calcCrow(lat1, lon1, lat2, lon2) {
                        var R = 6371; // km
                        var dLat = toRad(lat2 - lat1);
                        var dLon = toRad(lon2 - lon1);
                        var lat1 = toRad(lat1);
                        var lat2 = toRad(lat2);
                        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
                        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                        var d = R * c;
                        return d;
                    }
                    // Converts numeric degrees to radians
                    function toRad(Value) {
                        return Value * Math.PI / 180;
                    }
                } else if (response.status == 2) {
                    $("input:radio[name=myaddress]:checked").prop('checked', false);
                    toastr.error(response.message);
                    return false;
                } else {
                    $("input:radio[name=myaddress]:checked").prop('checked', false);
                    toastr.error(wrong);
                    return false;
                }
            },
            error: function (e) {
                $("#preload").hide();
                toastr.error(wrong);
                return false;
            }
        });
    }
}
// TO-HIDE-PAYMENT-TYPE-ERROR
$('input:radio[name=transaction_type]').on('click', function (event) {
    "use strict";
    validate_transaction_type($(this).val())
});
setTimeout(function () {
    $('input:radio[name=transaction_type]:checked').on('click', function (event) {
        "use strict";
        validate_transaction_type($(this).val())
    }).click();
}, 2000);
function validate_transaction_type(type) {
    "use strict";
    $('.paymenterror').addClass('d-none');
    $('.walleterror').addClass('d-none');
    if (type == 4) {
        $('#card-element').removeClass('d-none');
    } else {
        $('#card-element').addClass('d-none');
    }
}
function isopenclose(opencloseurl, qty, order_amount) {
    "use strict";
    $("#preload").show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: opencloseurl,
        data: {
            qty: qty,
            order_amount: order_amount
        },
        method: 'post',
        success: function (response) {
            $("#preload").hide();
            if (response.status == 1) {
                validatedata();
            } else if (response.status == 2) {
                toastr.error(response.message);
            } else {
                restaurantclosed();
                return false;
            }
        },
        error: function (e) {
            $("#preload").hide();
            toastr.error(wrong);
            return false;
        }
    });
}
function validatedata() {
    "use strict";
    // common-variables
    var order_notes = $('#order_notes').val();
    var transaction_type = $("input:radio[name=transaction_type]:checked").val();
    var transaction_currency = $("input:radio[name=transaction_type]:checked").attr('data-currency');
    var delivery_charge = parseFloat($('#delivery_charge').val());
    var grand_total = parseFloat($('#grand_total').val());
    // TO-CHECK-ADDRESS-IS-SELECTED-OR-NOT
    if (order_type == 1) {
        var address_type = $("input:radio[name=myaddress]:checked").val();
        if (address_type == null) {
            $('.addresserror').removeClass('d-none');
            return false;
        } else {
            $('.addresserror').addClass('d-none');
        }
    }
    // TO-CHECK-PAYMENT-TYPE-IS-SELECTED-OR-NOT
    if (transaction_type == null) {
        $('.paymenterror').removeClass('d-none');
        return false;
    } else {
        $('.paymenterror').addClass('d-none');
        $('.walleterror').addClass('d-none');
    }
    // COD || Wallet
    if (transaction_type == 1 || transaction_type == 2) {
        $("#preload").show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: orderurl,
            data: {
                order_type: order_type,
                delivery_charge: delivery_charge,
                grand_total: grand_total,
                tax_amount: tax_amount,
                address_type: address_type,
                address: address,
                house_no: house_no,
                lat: lat,
                lang: lang,
                order_notes: order_notes,
                transaction_type: transaction_type,
            },
            method: 'POST',
            success: function (response) {
                $('#preload').hide();
                if (response.status == 1) {
                    ordersuccess(successurl, response.order_id, continueurl);
                } else {
                    $('.paymenterror').removeClass('d-none').html(response.message);
                    setTimeout(function () {
                        $(".paymenterror").addClass('d-none');
                    }, 5000);
                    return false;
                }
            },
            error: function (error) {
                $('#preload').hide();
                $('.paymenterror').removeClass('d-none').html(error);
                setTimeout(function () {
                    $(".paymenterror").addClass('d-none');
                }, 5000);
                return false;
            }
        });
    }
    //Razorpay
    if (transaction_type == 3) {
        var options = {
            "key": $('#razorpaykey').val(),
            "amount": parseInt(grand_total * 100),
            "name": "SingleRestaurant",
            "description": "Razorpay Order payment",
            "image": 'https://badges.razorpay.com/badge-light.png',
            "handler": function (response) {
                $("#preload").show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: orderurl,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        order_type: order_type,
                        delivery_charge: delivery_charge,
                        grand_total: grand_total,
                        tax_amount: tax_amount,
                        address_type: address_type,
                        address: address,
                        house_no: house_no,
                        lat: lat,
                        lang: lang,
                        order_notes: order_notes,
                        transaction_type: transaction_type,
                        transaction_id: response.razorpay_payment_id,
                    },
                    success: function (response) {
                        $('#preload').hide();
                        if (response.status == 1) {
                            ordersuccess(successurl, response.order_id, continueurl);
                        } else {
                            $('.paymenterror').removeClass('d-none').html(response.message);
                            setTimeout(function () {
                                $(".paymenterror").addClass('d-none');
                            }, 5000);
                        }
                    },
                    error: function (error) {
                        $('#preload').hide();
                        $('.paymenterror').removeClass('d-none').html(error);
                        setTimeout(function () {
                            $(".paymenterror").addClass('d-none');
                        }, 5000);
                    }
                });
            },
            "prefill": {
                "name": user_name,
                "email": user_email,
                "contact": user_mobile,
            },
            "theme": {
                "color": "#366ed4"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    }
    // stripe
    if (transaction_type == 4) {
        var form = document.getElementById('payment-form');
        stripe.createToken(card).then(function (result) {
            if (result.error) {
                toastr.error(result.error.message);
                return false;
            } else {
                $("#preload").show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: orderurl,
                    data: {
                        order_type: order_type,
                        delivery_charge: delivery_charge,
                        grand_total: grand_total,
                        tax_amount: tax_amount,
                        address_type: address_type,
                        address: address,
                        house_no: house_no,
                        lat: lat,
                        lang: lang,
                        order_notes: order_notes,
                        transaction_type: transaction_type,
                        transaction_id: result.token.id,
                    },
                    method: 'POST',
                    success: function (response) {
                        $('#preload').hide();
                        if (response.status == 1) {
                            ordersuccess(successurl, response.order_id, continueurl);
                        } else {
                            $('.paymenterror').removeClass('d-none').html(response.message);
                            setTimeout(function () {
                                $(".paymenterror").addClass('d-none');
                            }, 50000);
                            return false;
                        }
                    },
                    error: function (error) {
                        $('#preload').hide();
                        $('.paymenterror').removeClass('d-none').html(error);
                        setTimeout(function () {
                            $(".paymenterror").addClass('d-none');
                        }, 50000);
                        return false;
                    }
                });
            }
        });
    }
    //Flutterwave
    if (transaction_type == 5) {
        FlutterwaveCheckout({
            public_key: $('#flutterwavekey').val(),
            tx_ref: user_name,
            amount: grand_total,
            currency: transaction_currency,
            payment_options: "",
            customer: {
                name: user_name,
                email: user_email,
                phone_number: user_mobile,
            },
            callback: function (data) {
                $("#preload").show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: orderurl,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        order_type: order_type,
                        delivery_charge: delivery_charge,
                        grand_total: grand_total,
                        tax_amount: tax_amount,
                        address_type: address_type,
                        address: address,
                        house_no: house_no,
                        lat: lat,
                        lang: lang,
                        order_notes: order_notes,
                        transaction_type: transaction_type,
                        transaction_id: data.flw_ref,
                    },
                    success: function (response) {
                        $('#preload').hide();
                        if (response.status == 1) {
                            ordersuccess(successurl, response.order_id, continueurl);
                        } else {
                            $('.paymenterror').removeClass('d-none').html(response.message);
                            setTimeout(function () {
                                $(".paymenterror").addClass('d-none');
                            }, 5000);
                        }
                    },
                    error: function (error) {
                        $('#preload').hide();
                        $('.paymenterror').removeClass('d-none').html(error);
                        setTimeout(function () {
                            $(".paymenterror").addClass('d-none');
                        }, 5000);
                    }
                });
            },
            onclose: function () {
                location.reload();
            },
            customizations: {
                title: "SingleRestaurant",
                description: 'Flutterwave Order payment',
                logo: "https://flutterwave.com/images/logo/logo-mark/full.svg",
            },
        });
    }
    //Paystack
    if (transaction_type == 6) {
        let handler = PaystackPop.setup({
            key: $('#paystackkey').val(),
            email: user_email,
            amount: parseInt(grand_total * 100),
            currency: transaction_currency, // Use USD for US Dollars OR GHS for Ghana Cedis
            ref: 'trx_' + Math.random().toString(16).slice(2),
            label: "Paystack Order payment",
            onClose: function () {
                location.reload();
            },
            callback: function (response) {
                $("#preload").show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: orderurl,
                    data: {
                        order_type: order_type,
                        delivery_charge: delivery_charge,
                        grand_total: grand_total,
                        tax_amount: tax_amount,
                        address_type: address_type,
                        address: address,
                        house_no: house_no,
                        lat: lat,
                        lang: lang,
                        order_notes: order_notes,
                        transaction_type: transaction_type,
                        transaction_id: response.trxref,
                    },
                    method: 'POST',
                    success: function (response) {
                        $('#preload').hide();
                        if (response.status == 1) {
                            ordersuccess(successurl, response.order_id, continueurl);
                        } else {
                            $('.paymenterror').removeClass('d-none').html(response.message);
                            setTimeout(function () {
                                $(".paymenterror").addClass('d-none');
                            }, 5000);
                            return false;
                        }
                    },
                    error: function (error) {
                        $('#preload').hide();
                        $('.paymenterror').removeClass('d-none').html(error);
                        setTimeout(function () {
                            $(".paymenterror").addClass('d-none');
                        }, 5000);
                        return false;
                    }
                });
            }
        });
        handler.openIframe();
    }
}
