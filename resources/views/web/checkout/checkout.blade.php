@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.checkout') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.checkout') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.checkout') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @if (count($getcartlist) > 0)
        @php
            $totaltax = 0;
            $totaltaxamount = 0;
            $order_total = 0;
            $total_item_qty = 0;
        @endphp
        @foreach ($getcartlist as $item)
            @php
                $tax = ($item['item_price'] * $item['qty'] * $item['tax']) / 100;
                $total_price = ($item['item_price'] + $item['addons_total_price']) * $item['qty'];
                $totaltaxamount += (float) $tax;
                $order_total += (float) $total_price;
                $total_item_qty += $item['qty'];
            @endphp
        @endforeach
        <section>
            <div class="container">
                <div class="cart-view my-5">
                    <div class="row">
                        {{-- address-view --}}
                        <div class="col-lg-8 order-md2">
                            @if (session()->get('order_type') == 1)
                                <div class="checkout-view p-4 mb-3">
                                    <div class="heading mb-2">
                                        <h2>{{ trans('labels.select_address') }}</h2>
                                    </div>
                                    <div class="addresserror alert alert-danger my-2 py-1 d-none">
                                        {{ trans('messages.select_address') }}</div>
                                    <div class="row address-list">
                                        @foreach ($getaddresses as $key => $addressdata)
                                            <div class="col-md-6 d-flex">
                                                <input type="radio" name="myaddress" class="d-none"
                                                    value="{{ $addressdata->id }}" id="rad{{ $addressdata->id }}"
                                                    data-address-type="{{ $addressdata->address_type }}"
                                                    address="{{ $addressdata->address }}"
                                                    house_no="{{ $addressdata->house_no }}"
                                                    area="{{ $addressdata->area }}" lat="{{ $addressdata->lat }}"
                                                    lang="{{ $addressdata->lang }}" data-url="{{URL::to('/checkdeliveryzone')}}" {{$key == 0 ? 'checked' : ''}}>
                                                <div class="address-card w-100">
                                                    <div class="col-2 address-icon">
                                                        @if ($addressdata->address_type == 1)
                                                            <i class="fa-solid fa-house-chimney"></i>
                                                            @php $address_type_text = trans('labels.home'); @endphp
                                                        @elseif ($addressdata->address_type == 2)
                                                            <i class="fa-solid fa-briefcase"></i>
                                                            @php $address_type_text = trans('labels.office'); @endphp
                                                        @else
                                                            <i class="fa-solid fa-map-location-dot"></i>
                                                            @php $address_type_text = trans('labels.other'); @endphp
                                                        @endif
                                                    </div>
                                                    <div class="col-10 address pe-3">
                                                        <h4>{{ $address_type_text }}</h4>
                                                        <p>{{ $addressdata->address }}, {{ $addressdata->area }}, {{ $addressdata->house_no }}</p>
                                                        <label class="btn btn-sm btn-success border-0 text-uppercase" for="rad{{ $addressdata->id }}">{{ trans('labels.deliver_here') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-6">
                                            <div
                                                class="address-card border-dashed d-flex justify-content-center align-items-center text-center w-100">
                                                <div class="address">
                                                    <h4>{{ trans('labels.add_new_address') }}</h4>
                                                    <a class="btn btn-outline-success text-uppercase btn-sm"
                                                        href="{{ URL::to('/address/add') }}">{{ trans('labels.add_new') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="payment-option mb-3">
                                <div class="heading mb-2">
                                    <h2>{{ trans('labels.choose_payment') }}</h2>
                                </div>
                                {{-- payment-options --}}
                                @include('web.paymentmethodsview')
                                <div class="d-flex justify-content-center mt-4">
                                    <button class="btn btn-primary"
                                        onclick="isopenclose('{{ URL::to('/isopenclose') }}','{{$total_item_qty}}','{{$order_total}}')">{{ trans('labels.proceed_pay') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 order-md1">
                            {{-- payment-summary --}}
                            <div class="summary py-3 mb-4">
                                <h2 class="border-bottom">{{ trans('labels.payment_summary') }}</h2>
                                <div class="bill-details border-bottom">
                                    @php
                                        if (session()->has('discount_data')) {
                                            $discount_amount = session()->get('discount_data')['offer_amount'];
                                        } else {
                                            $discount_amount = 0;
                                        }
                                        $grand_total = $order_total - $discount_amount + $totaltaxamount;
                                    @endphp
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span>{{ trans('labels.subtotal') }}</span></div>
                                        <div class="col-auto">
                                            <p>{{ Helper::currency_format($order_total) }}</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span>{{ trans('labels.tax') }}</span></div>
                                        <div class="col-auto">
                                            <p>{{ Helper::currency_format($totaltaxamount) }}</p>
                                        </div>
                                    </div>
                                    @if (session()->has('discount_data'))
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto"><span>{{ trans('labels.discount') }}
                                                {{ session()->has('discount_data') == true ? '(' . session()->get('discount_data')['offer_code'] . ')' : '' }}
                                            </span></div>
                                            <div class="col-auto">
                                                <p>- {{ Helper::currency_format($discount_amount) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if (session()->get('order_type') == 1)
                                        @php $delivery_charge = 0; @endphp
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto"><span>{{ trans('labels.delivery_charge') }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <p class="delivery_charge">{{ Helper::currency_format($delivery_charge) }}</p>
                                            </div>
                                        </div>
                                    @else
                                        @php $delivery_charge = 0; @endphp
                                    @endif
                                </div>
                                <div class="bill-total mt-2">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span>{{ trans('labels.grand_total') }}</span></div>
                                        <div class="col-auto"><span class="grand_total">{{ Helper::currency_format($grand_total) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- special-instruction --}}
                            <div class="special-instruction py-3 mb-3">
                                <label class="form-label mb-2"
                                    for="order_notes">{{ trans('labels.special_instruction') }}</label>
                                <textarea class="form-control" name="order_notes" id="order_notes" rows="3"
                                    placeholder="{{ trans('labels.special_instruction') }}"></textarea>
                            </div>
                            <a href="{{ URL::to('/') }}" class="continue-shopping mb-3"><i class="fa-solid fa-circle-arrow-left me-2"></i>{{ trans('labels.continue_shopping') }}</a>
                        </div>
                    </div>
                    {{-- <br> order_type --}}
                    <input type="hidden" name="order_type" id="order_type" value="{{ session()->get('order_type') }}">
                    {{-- <br> grand_total --}}
                    <input type="hidden" name="grand_total" id="grand_total" value="{{ $grand_total }}">
                    {{-- <br> totaltaxamount --}}
                    <input type="hidden" name="totaltaxamount" id="totaltaxamount" value="{{ $totaltaxamount }}">
                    {{-- <br> delivery_charge --}}
                    <input type="hidden" name="delivery_charge" id="delivery_charge" value="{{ $delivery_charge }}">
                    <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="user_email" id="user_email" value="{{ Auth::user()->email }}">
                    <input type="hidden" name="user_mobile" id="user_mobile" value="{{ Auth::user()->mobile }}">
                    <input type="hidden" name="rest_lat" id="rest_lat" value="{{@Helper::appdata()->lat }}">
                    <input type="hidden" name="rest_lang" id="rest_lang" value="{{@Helper::appdata()->lang }}">
                    <input type="hidden" name="delivery_charge_per_km" id="delivery_charge_per_km" value="{{@Helper::appdata()->delivery_charge }}">
                    <input type="hidden" name="orderurl" id="orderurl" value="{{ URL::to('placeorder') }}">
                    <input type="hidden" name="successurl" id="successurl" value="{{ URL::to('/orders') }}">
                    <input type="hidden" name="continueurl" id="continueurl" value="{{ URL::to('/') }}">
                    <input type="hidden" name="environment" id="environment" value="{{ env('Environment') }}">
                </div>
            </div>
        </section>
    @else
        @include('web.nodata')
    @endif
@endsection
@section('scripts')
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="{{ url('/resources/views/web/checkout/checkout.js')}}"></script>
@endsection
