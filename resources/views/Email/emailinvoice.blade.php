<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Email Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }

            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 700;
                src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }

        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
        }

        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        table {
            border-collapse: collapse !important;
        }

        a {
            color: #1a82e2;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>

</head>

<body style="background-color: #D2C7BA;">

    
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" bgcolor="#D2C7BA">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="center" valign="top" style="padding: 36px 24px;">
                                <img src="{!! $logo !!}" alt="Logo" border="0" width="48"
                                    style="display: block; width: 48px; max-width: 48px; min-width: 48px;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#D2C7BA">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="left" bgcolor="#ffffff"
                                style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                                <h1
                                    style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                    Thank you for your order!</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#D2C7BA">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                        <tr>
                            <td align="left" bgcolor="#ffffff"
                                style="padding: 20px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                                <p style="margin: 0;">{{ trans('labels.dear') }} <span
                                        style="font-size: 12px; font-weight: 800; line-height: 24px; color: #777777;">{{ $orderdata->user_info->name }},</span>
                                </p>
                                <p style="margin: 0;">{{ $orderdata->user_info->email }}</p>
                                <p style="margin: 0;">{{ $orderdata->user_info->mobile }}</p>
                                @if ($orderdata->order_type == 1)
                                    <p style="margin: 0;"> {{ $orderdata->address }}</p>
                                @endif
                            </td>
                </td>
            </tr>
            <tr>
                <td align="left" bgcolor="#ffffff"
                    style="padding: 10px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">

                    <p style="margin: 0;">Your Order has been placed with Order number : <span
                            style="font-size: 12px; font-weight: 800; line-height: 24px; color: #777777;">{{ $orderdata->order_number }}</span>
                        and it will be processed as soon as possible by the Admin. You can use this Order number
                        to track Order status</p>

                    <p style="margin: 0;">Here is a summary of your recent order. If you have any questions or
                        concerns about your order, please <a href="#">contact us</a>.</p>
                </td>
            </tr>

            @if ($orderdata['order_notes'] != '')
                <tr>
                    <td align="left" bgcolor="#ffffff"
                        style="padding: 10px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">

                        <strong style="margin: 0;">{{ trans('labels.order_note') }}</strong>

                        <p style="margin: 0;">{{ $orderdata['order_notes'] }}</p>
                    </td>
                </tr>
            @endif
        </table>
    </td>
    </tr>
    <tr>
        <td align="center" bgcolor="#D2C7BA">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                <tr>
                    <td align="left" bgcolor="#ffffff"
                        style="padding: 10px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="left" bgcolor="#D2C7BA" width="5%"
                                    style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                                    <strong>#</strong>
                                </td>
                                <td align="left" bgcolor="#D2C7BA" width="55%"
                                    style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                                    <strong>{{ trans('labels.items') }}</strong>
                                </td>
                                <td align="left" bgcolor="#D2C7BA" width="15%"
                                    style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;text-align: right;">
                                    <strong>{{ trans('labels.unit_cost') }}</strong>
                                </td>
                                <td align="left" bgcolor="#D2C7BA" width="10%"
                                    style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;text-align: right;">
                                    <strong>{{ trans('labels.qty') }}</strong>
                                </td>
                                <td align="left" bgcolor="#D2C7BA" width="15%"
                                    style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;text-align: right;">
                                    <strong>{{ trans('labels.subtotal') }}</strong>
                                </td>
                            </tr>

                            <?php
                                $i=1;
                                foreach ($itemdata as $idata){
                                    $idata['addons_price'] == '' ? ($addonsprice = 0) : ($addonsprice = array_sum(explode(',', $idata['addons_price'])));
                                    $total_price = ($idata['item_price'] + $addonsprice) * $idata['qty'];
                                    $data[] = ['total_price' => $total_price];
                                ?>
                            <tr>
                                <td align="left" width="5%"
                                    style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                                    <?php echo $i++; ?></td>
                                <td align="left" width="55%"
                                    style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                                    {{ $idata['item_name'] }}
                                    @if ($idata->variation != '')
                                        [{{ $idata->variation }}]
                                    @endif
                                    <br>
                                    <?php
                                    $addons_name = explode(',', $idata->addons_name);
                                    $addons_price = explode(',', $idata->addons_price);
                                    ?>
                                    @if ($idata->addons_id != '')
                                        @foreach ($addons_name as $key => $val)
                                            <p style="margin: 0;color: #777777"><small>{{ $addons_name[$key] }} :
                                                    {{ Helper::currency_format($addons_price[$key]) }}</small></p>
                                        @endforeach
                                    @endif
                                </td>
                                <td align="left" width="15%"
                                    style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;text-align: right;">
                                    {{ Helper::currency_format($idata['item_price']) }}
                                    @if ($idata->addons_total_price > 0)
                                        <br><small>+
                                            {{ Helper::currency_format($idata->addons_total_price) }}</small>
                                    @endif
                                </td>

                                <td align="left" width="10%"
                                    style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;text-align: right;">
                                    {{ $idata['qty'] }}
                                </td>
                                <td align="left" width="15%"
                                    style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;text-align: right;">
                                    {{ Helper::currency_format($total_price) }}
                                </td>
                            </tr>
                            <?php
                                }
                                $order_total = array_sum(array_column(@$data, 'total_price'));
                            ?>


                            <tr>
                                <td align="left" colspan="4" width="75%"
                                    style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;">
                                    <strong>{{ trans('labels.order_total') }}</strong>
                                </td>
                                <td align="left" width="25%"
                                    style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;text-align: right;">
                                    <strong>{{ Helper::currency_format($order_total) }}</strong>
                                </td>


                            </tr>

                            <tr>
                                <td align="left" colspan="4" width="75%"
                                    style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;">
                                    <strong>{{ trans('labels.order_type') }}</strong>
                                </td>
                                <td align="left" width="25%"
                                    style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;text-align: right;">
                                    <strong>{{ $orderdata->order_type == 1 ? trans('labels.delivery') : trans('labels.pickup') }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="4" width="75%"
                                    style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;">
                                    <strong>{{ trans('labels.order_number') }}</strong>
                                </td>
                                <td align="left" width="25%"
                                    style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;text-align: right;">
                                    <strong>{{ $orderdata->order_number }}</strong>
                                </td>
                            </tr>

                            <!-- TRANSACTION TYPE -->
                            <tr>
                                <td align="left" colspan="4" width="75%"
                                    style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;">
                                    <strong>{{ trans('labels.payment_type') }}</strong>
                                </td>
                                <td align="left" width="25%"
                                    style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;text-align: right;">
                                    <strong>
                                        @if ($orderdata->transaction_type == 1)
                                            {{ trans('labels.cash') }}
                                        @endif
                                        @if ($orderdata->transaction_type == 2)
                                            {{ trans('labels.wallet') }}
                                        @endif
                                        @if ($orderdata->transaction_type == 3)
                                            {{ trans('labels.razorpay') }}
                                        @endif
                                        @if ($orderdata->transaction_type == 4)
                                            {{ trans('labels.stripe') }}
                                        @endif
                                        @if ($orderdata->transaction_type == 5)
                                            {{ trans('labels.flutterwave') }}
                                        @endif
                                        @if ($orderdata->transaction_type == 6)
                                            {{ trans('labels.paystack') }}
                                        @endif
                                    </strong>
                                </td>
                            </tr>
                            <!-- TRANSACTION ID -->
                            @if ($orderdata->transaction_type != 1 && $orderdata->transaction_type != 2)
                                <tr>
                                    <td align="left" colspan="4" width="75%"
                                        style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;">
                                        <strong>Transaction id</strong>
                                    </td>
                                    <td align="left" width="25%"
                                        style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;">
                                        <strong>{{ $orderdata->transaction_id }}</strong>
                                    </td>
                                </tr>
                            @endif

                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#ffffff"
                        style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="left" width="75%"
                                    style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                                    {{ trans('labels.order_total') }}</td>
                                <td align="left" width="25%"
                                    style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;text-align: right;">
                                    {{ Helper::currency_format($order_total) }}</td>
                            </tr>
                            <tr>
                                <td align="left" width="75%"
                                    style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                                    {{ trans('labels.tax') }}</td>
                                <td align="left" width="25%"
                                    style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;text-align: right;">
                                    {{ Helper::currency_format($orderdata->tax_amount) }}</td>
                            </tr>
                            @if ($orderdata->order_type == 1)

                                <tr>
                                    <td align="left" width="75%"
                                        style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                                        {{ trans('labels.delivery_charge') }}</td>
                                    <td align="left" width="25%"
                                        style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;text-align: right;">
                                        @if ($orderdata->delivery_charge == 0 || $orderdata->delivery_charge == '')
                                            {{ trans('labels.free') }}
                                        @else
                                            {{ Helper::currency_format($orderdata->delivery_charge) }}
                                        @endif
                                    </td>
                                </tr>
                            @endif
                            @if ($orderdata->discount_amount != '')
                                <tr>
                                    <td align="left" width="75%"
                                        style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                                        {{ trans('labels.discount') }}
                                    </td>
                                    <td align="left" width="25%"
                                        style="padding: 10px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;text-align: right;">
                                        (-) {{ Helper::currency_format($orderdata->discount_amount) }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td align="left" width="75%"
                                    style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;">
                                    <strong>{{ trans('labels.grand_total') }}</strong>
                                </td>
                                <td align="left" width="25%"
                                    style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;text-align: right;">
                                    <strong>{{ Helper::currency_format($orderdata->grand_total) }}</strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" bgcolor="#D2C7BA" style="padding: 24px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="center" bgcolor="#D2C7BA"
                        style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                        <p style="margin: 0;">You received this email because we received a request for order from
                            your account. If you didn't requested order, you can safely delete this email.</p>
                    </td>
                </tr>
                <tr>
                    <td align="center" bgcolor="#D2C7BA"
                        style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                        <p style="font-size: 11px;margin: 0;"><b>Note</b>:- Do not reply to this notification
                            message,this message was auto-generated by the sender's security system.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </table>
</body>

</html>

{{-- <div style="max-width: 800px;margin: auto;padding: 15px;border: 1px solid #eee;box-shadow: 0 0 10px rgba(0, 0, 0, .15);font-size: 16px;line-height: 24px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;color: #555;">
    <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
        <tr>
            <td colspan="5" style="padding: 5px;vertical-align: top;">
                <table style="width: 100%;line-height: inherit;text-align: left;">
                    <tr>
                        <td style="padding: 5px;vertical-align: top;padding-bottom: 20px;font-size: 45px;line-height: 45px;color: #333;"><img src='{{$logo}}' style="width:100%; max-width:100px;"></td>
                        <td style="padding: 5px;vertical-align: top;text-align: right;padding-bottom: 20px;">{{ trans('labels.invoice') }} #{{$orderdata->order_number}}</td>   
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="5" style="padding: 5px;vertical-align: top;">
                <table style="width: 100%;line-height: inherit;text-align: left;">
                    <tr>
                        <td style="padding-bottom: 0px;vertical-align: top;font-family:'Poppins',Helvetica,Arial,sans-serif;color:#19c0c2;font-weight:700;">
                            {{trans('labels.dear')}} {{$orderdata->user_info->name}},
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;text-align: left;padding-bottom: 30px;">
                            <p style="margin-top:2px;margin-bottom:2px; font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">Thank you for order with us.</p>
                            <p style="margin-top:2px;margin-bottom:2px; font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">Your Order has been placed with Order number : <span style="font-size: 12px; font-weight: 800; line-height: 24px; color: #777777;">{{$orderdata->order_number}}</span> and it will be processed as soon as possible by the Admin. You can use this Order number to track Order status</p>
                            <p style="margin-top:2px;margin-bottom:2px; font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">You will get an Order confirmation email from admin soon .
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="5" style="padding: 5px;vertical-align: top;">
                <table style="width: 100%;line-height: inherit;text-align: left;">
                    <tr>
                        <td style="padding: 5px;vertical-align: top;padding-bottom: 20px;">
                            {{$orderdata->user_info->email}}<br>
                            {{$orderdata->user_info->mobile}}<br>
                            {{$orderdata->address}}
                        </td>
                        <td style="padding: 5px;vertical-align: top;text-align: right;padding-bottom: 40px;">
                            @if ($orderdata['order_notes'] != '')
                                <strong>{{ trans('labels.order_note') }}</strong><br>
                                {{$orderdata['order_notes']}}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">#</td>
            <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">{{ trans('labels.items') }}</td>
            <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">{{ trans('labels.qty') }}</td>
            <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">{{ trans('labels.unit_cost') }}</td>
            <td style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">{{trans('labels.subtotal')}}</td>
        </tr>
        <?php
            $i=1;
            foreach ($itemdata as $orderitem){

            $orderitem['addons_price']=="" ? $addonsprice = 0 : $addonsprice = array_sum(explode(',',$orderitem['addons_price'])); 
            $total_price = ($orderitem['item_price']+$addonsprice)*$orderitem['qty'];
            $data[] = array("total_price" => $total_price,);
        ?>
            <tr>
                <td style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee;">{{$i}}</td>
                <td style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee;">
                    @if ($orderitem['item_type'] == 1) 
                        <img src="{{Helper::image_path('veg.svg')}}" alt="">
                    @else 
                        <img src="{{Helper::image_path('nonveg.svg')}}" alt="">
                    @endif
                    {{$orderitem['item_name']}}
                    @if ($orderitem->variation != '')
                        [{{$orderitem->variation}}]
                    @endif<br>
                    <?php
                    $addons_name = explode(',', $orderitem->addons_name);
                    $addons_price = explode(',', $orderitem->addons_price);
                    $addonstotal = 0;
                    ?>
                    @if ($orderitem->addons_id != '')
                        @foreach ($addons_name as $key => $val)
                        <small class="text-muted">{{$addons_name[$key]}} : <span>{{Helper::currency_format($addons_price[$key])}}</span></small><br>
                        <?php $addonstotal += (float) $addons_price[$key]; ?>
                        @endforeach
                    @endif
                </td>
                <td style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee;">{{$orderitem['qty']}}</td>          
                <td style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee;">{{Helper::currency_format($orderitem['item_price'])}}
                    @if ($addonstotal != '0')
                        <br><small class="text-muted">+ {{Helper::currency_format($addonstotal)}}</small>
                    @endif
                </td>
                <td style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee;">{{Helper::currency_format($total_price)}}</td>
            </tr>
        <?php
                $i++;
            }
            $order_total = array_sum(array_column(@$data, 'total_price'));
        ?>
        <tr>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;text-align: right;border-top: 2px solid #eee;font-weight: bold;">
               <strong>{{trans('labels.order_total')}} : </strong> {{Helper::currency_format($order_total)}}
            </td>
        </tr>
        @if ($orderdata->tax_amount > 0)
        <tr>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;text-align: right;border-top: 2px solid #eee;font-weight: bold;">
               <strong>{{trans('labels.tax')}} : </strong> {{Helper::currency_format($orderdata->tax_amount)}}
            </td>
        </tr>
        @endif
        @if ($orderdata->delivery_charge > 0)
        <tr>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;text-align: right;border-top: 2px solid #eee;font-weight: bold;">
               <strong>{{trans('labels.delivery_charge')}} : </strong> {{Helper::currency_format($orderdata->delivery_charge)}}
            </td>
        </tr>
        @endif
        @if ($orderdata->discount_amount > 0)
        <tr>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;text-align: right;border-top: 2px solid #eee;font-weight: bold;">
               <strong>{{trans('labels.discount')}} ({{$orderdata->offer_code}}) : </strong> {{Helper::currency_format($orderdata->discount_amount)}}
            </td>
        </tr>
        @endif
        <tr>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;"></td>
            <td style="padding: 5px;vertical-align: top;text-align: right;border-top: 2px solid #eee;font-weight: bold;">
               <strong>{{trans('labels.grand_total')}} : </strong> {{Helper::currency_format($orderdata->grand_total)}}
            </td>
        </tr>
    </table>
</div> --}}
