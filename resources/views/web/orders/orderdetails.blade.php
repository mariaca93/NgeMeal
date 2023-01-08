@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.order_details') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.order_details') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.order_details') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-3 d-flex">
                    @include('web.layout.usersidebar')
                </div>
                <div class="col-lg-9">
                    <div class="user-content-wrapper">
                        <p class="">{{ trans('labels.order_details') }}
                            @if ($orderdata->status == 1)
                                <a class="btn btn-danger btn-sm mx-1 float-end" href="javascript:void(0)" onclick="cancelorder('{{$orderdata->order_number}}','{{URL::to('/orders/cancel')}}')">
                                    <i class="fa-regular fa-trash-can"></i>
                                    {{ trans('labels.cancel_order') }}
                                </a>
                            @endif
                        </p>
                        <div class="progress-barrr">
                            @if (in_array($orderdata->status, [6, 7]))
                            <div class="progress-step is-active">
                                <div class="step-count"><i class="fa fa-close"></i></div>
                                <div class="step-description">
                                    {{ $orderdata->status == '6' ? trans('labels.cancel_by_admin') : trans('labels.cancel_by_you') }}
                                </div>
                            </div>
                            @else
                            @if (!in_array($orderdata->status, [1, 2, 3, 4, 5]))
                            <div class="progress-step {{ session()->get('direction') == 'rtl' ? 'progress-step-rtl' : '' }} is-active">
                                <div class="step-count"><i class="fa fa-exclamation-triangle"></i></div>
                                <div class="step-description">{{ trans('messages.wrong') }}</div>
                            </div>
                            @else
                            <div class="progress-step {{ session()->get('direction') == 'rtl' ? 'progress-step-rtl' : '' }} @if ($orderdata->status == '1') is-active @endif">
                                <div class="step-count"><i class="fa fa-bell"></i></div>
                                <div class="step-description">{{ trans('labels.placed') }}</div>
                            </div>
                            <div class="progress-step {{ session()->get('direction') == 'rtl' ? 'progress-step-rtl' : '' }} @if ($orderdata->status == '2') is-active @endif">
                                <div class="step-count"><i class="fa fa-tasks"></i></div>
                                <div class="step-description">{{ trans('labels.preparing') }}</div>
                            </div>
                            @if ($orderdata->order_from != 'pos')
                            <div class="progress-step {{ session()->get('direction') == 'rtl' ? 'progress-step-rtl' : '' }} @if ($orderdata->status == '3') is-active @endif">
                                <div class="step-count"><i class="fa fa-thumbs-up"></i></div>
                                <div class="step-description">{{ trans('labels.ready') }}</div>
                            </div>
                            <div class="progress-step {{ session()->get('direction') == 'rtl' ? 'progress-step-rtl' : '' }} @if ($orderdata->status == '4') is-active @endif">
                                @if ($orderdata->order_type == 2)
                                <div class="step-count"><i class="fa fa-hourglass"></i></div>
                                <div class="step-description">{{ trans('labels.waiting_pickup') }}</div>
                                @else
                                <div class="step-count"><i class="fa fa-user"></i></div>
                                <div class="step-description">{{ trans('labels.on_the_way') }}
                                    <br>{{ $orderdata['driver_info'] != '' ? '[' . $orderdata['driver_info']->name . ']' : '' }}
                                </div>
                                @endif
                            </div>
                            @endif
                            <div class="progress-step {{ session()->get('direction') == 'rtl' ? 'progress-step-rtl' : '' }} @if ($orderdata->status == '5') is-active @endif">
                                <div class="step-count"><i class="fa fa-check"></i></div>
                                <div class="step-description">{{ trans('labels.completed') }}</div>
                            </div>
                            @endif
                            @endif
                        </div>
                        <div class="d-flex justify-content-start mb-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    <span class="fw-600">  {{ trans('labels.order_number') }} : </span>
                                    <span class="text-break">{{ $orderdata->order_number }}</span>
                                </li>
                                <li class="list-group-item px-0">
                                    <span class="fw-600">  {{ trans('labels.order_type') }} : </span>
                                    <span class="text-break">{{ $orderdata->order_type == '1' ? trans('labels.delivery') : trans('labels.pickup') }}</span>
                                </li>
                                <li class="list-group-item px-0">
                                    <span class="fw-600">  {{ trans('labels.payment_type') }} : </span>
                                    <span class="text-break">
                                        @if ($orderdata->transaction_type == 1)
                                            {{trans('labels.cash')}}
                                        @elseif ($orderdata->transaction_type == 2)
                                            {{trans('labels.wallet')}}
                                        @elseif ($orderdata->transaction_type == 3)
                                            {{trans('labels.razorpay')}}
                                        @elseif ($orderdata->transaction_type == 4)
                                            {{trans('labels.stripe')}}
                                        @elseif ($orderdata->transaction_type == 5)
                                            {{trans('labels.flutterwave')}}
                                        @elseif ($orderdata->transaction_type == 6)
                                            {{trans('labels.paystack')}}
                                        @else
                                        --
                                        @endif
                                        @if (!in_array($orderdata->transaction_type, [1, 2])) [{{ $orderdata->transaction_id }}] @endif
                                </span>
                                </li>
                                 @if ($orderdata->order_notes != '')
                                <li class="list-group-item px-0">
                                    <span class="fw-600">  {{ trans('labels.order_note') }} : </span>
                                    <span class="text-break">{{ $orderdata->order_notes }}</span>
                                </li>
                                @endif
                                 @if ($orderdata->order_type == 1)
                                <li class="list-group-item px-0">
                                    <span class="fw-600">  {{ trans('labels.delivery_address') }} : </span>
                                    <span class="text-break">{{ $orderdata->address }}, {{ $orderdata->area }}, {{ $orderdata->house_no }}</span>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ trans('labels.image') }}</th>
                                        <th>{{ trans('labels.item') }}</th>
                                        <th class="text-end">{{ trans('labels.unit_cost') }}</th>
                                        <th class="text-end">{{ trans('labels.qty') }}</th>
                                        <th class="text-end">{{ trans('labels.subtotal') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $data = array();
                                foreach ($ordersdetails as $orders) {
                                    $total_price = ($orders['item_price'] + $orders['addons_total_price']) * $orders['qty'];
                                    $data[] = array("total_price" => $total_price,);
                                ?>
                                    <tr>
                                        <td><img src="{{ Helper::image_path($orders->item_image) }}" class="rounded hw-50" alt=""></td>
                                        <td>
                                            <img @if ($orders['item_type']==1) src="{{ Helper::image_path('veg.svg') }}" @else src="{{ Helper::image_path('nonveg.svg') }}" @endif class="item-type-img" alt="">
                                            {{ $orders->item_name }} @if ($orders->variation != '')
                                            [{{ $orders->variation }}]
                                            @endif <br>
                                            <?php
                                            $addons_id = explode(',', $orders->addons_id);
                                            $addons_name = explode(',', $orders->addons_name);
                                            $addons_price = explode(',', $orders->addons_price);
                                            $addonstotal = $orders->addons_total_price;
                                            ?>
                                            @if ($orders->addons_id != '')
                                                <small class="text-muted">
                                                    @foreach ($addons_name as $key => $val)
                                                        {{ $addons_name[$key] }}
                                                        {{ $key < count($addons_id) - 1 ? ',' : '' }}
                                                    @endforeach
                                                </small>
                                            @endif
                                        </td>
                                        <td class="text-end">{{ Helper::currency_format($orders->item_price) }}
                                            @if ($addonstotal != '0')
                                                <br><small class="text-muted">+ {{ Helper::currency_format($addonstotal) }}</small>
                                            @endif
                                        </td>
                                        <td class="text-end">{{ $orders->qty }}</td>
                                        <td class="text-end">{{ Helper::currency_format($total_price) }}</td>
                                    </tr>
                                <?php
                                }
                                $order_total = array_sum(array_column(@$data, 'total_price'));
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="col-md-4 col-12">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="fw-600"> {{ trans('labels.order_total') }} </span>
                                        <span class="text-break">{{ Helper::currency_format($order_total) }}</span>
                                    </li>
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="fw-600"> {{ trans('labels.tax') }} </span>
                                        <span class="text-break">{{ Helper::currency_format($orderdata->tax_amount) }}</span>
                                    </li>
                                    @if ($orderdata->discount_amount > 0)   
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="fw-600"> {{ trans('labels.discount') }} {{ $orderdata->offer_code != '' ? '(' . $orderdata->offer_code . ')' : '' }} </span>
                                        <span class="text-break">- {{ Helper::currency_format($orderdata->discount_amount) }}</span>
                                    </li>
                                    @endif
                                    @if ($orderdata->order_type == 1)   
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="fw-600"> {{ trans('labels.delivery_charge') }} </span>
                                        <span class="text-break">{{ Helper::currency_format($orderdata->delivery_charge) }}</span>
                                    </li>
                                    @endif
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="fw-600 green_color"> {{ trans('labels.grand_total') }} </span>
                                        <span class="fw-600 green_color text-break">{{ Helper::currency_format($orderdata->grand_total) }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script src="{{ url('/resources/views/web/orders/orders.js')}}"></script>
@endsection
