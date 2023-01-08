@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.my_cart') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.my_cart') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.cart') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="cart-view my-5">
                @if (count($getcartlist) > 0)
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            @php
                                $totaltax = 0;
                                $totaltaxamount = 0;
                                $order_total = 0;
                            @endphp
                            @foreach ($getcartlist as $item)
                                <span class="text-danger err{{ $item['id'] }}"></span>
                                <div class="order-list mb-4">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-auto d-flex justify-content-center item-img-none">
                                            <div class="item-img">
                                                <img src="{{ Helper::image_path($item->item_image) }}" alt="item-image">
                                            </div>
                                        </div>
                                        <div class="col-md-10 col-sm-10 col-auto col-detail">
                                            <div class="row">
                                                <div class="col-md-10 col-sm-10 col-auto">
                                                    <div class="item-title">
                                                        <img @if ($item->item_type == 1) src="{{ Helper::image_path('veg.svg') }}" @else src="{{ Helper::image_path('nonveg.svg') }}" @endif
                                                            alt="" class="me-1">
                                                        {{ $item->item_name }}
                                                        @if ($item->variation != '')
                                                            [{{ $item->variation }}]
                                                        @endif
                                                    </div>
                                                    @php
                                                        $addonsttlprice = $item['addons_total_price'];
                                                        $addons_id = explode(',', $item['addons_id']);
                                                        $addons_price = explode(',', $item['addons_price']);
                                                        $addons_name = explode(',', $item['addons_name']);
                                                    @endphp
                                                    @if ($item['addons_id'] != '')
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <div class="item-addons">
                                                                    <span class="text-muted">
                                                                        @foreach ($addons_id as $key => $addons)
                                                                            {{ $addons_name[$key] }}
                                                                            {{ $key < count($addons_id) - 1 ? ',' : '' }}
                                                                        @endforeach
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @php
                                                        $tax = number_format(($item['item_price'] * $item['qty'] * $item['tax']) / 100, 2);
                                                        $total_price = ($item['item_price'] + $addonsttlprice) * $item['qty'];
                                                        $totaltaxamount += (float) $tax;
                                                        $order_total += (float) $total_price;
                                                    @endphp
                                                </div>
                                                <div
                                                    class="col-md-2 col-sm-2 col-auto d-flex align-items-end flex-column quantity-column">
                                                    <a href="javascript:void(0)"
                                                        onclick="deletecartitem('{{ $item['id'] }}','{{ URL::to('/cart/deleteitem') }} ') ">
                                                        <i class="fa-solid fa-trash-can text-primary mb-2"></i> </a>
                                                    <div class="item-quantity">
                                                        <button class="btn btn-sm item-quantity-minus"
                                                            onclick="qtyupdate('{{ $item['id'] }}','minus','{{ URL::to('/cart/qtyupdate') }}')">-</button>
                                                        <input class="item-quantity-input" type="text"
                                                            value="{{ $item['qty'] }}" readonly />
                                                        <button class="btn btn-sm item-quantity-plus"
                                                            onclick="qtyupdate('{{ $item['id'] }}','plus','{{ URL::to('/cart/qtyupdate') }}')">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <p class="item-price">{{ Helper::currency_format($item['item_price']) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="promocode mb-4 py-4">
                                <div class="row justify-content-between align-items-center mb-2">
                                    <div class="col-auto"><label for="offer_code">{{ trans('labels.promocode') }}</label>
                                    </div>
                                    @if (!session()->get('discount_data'))
                                        <div class="col-auto"><a href="javascript:void(0)" class="text-uppercase"
                                                data-bs-toggle="modal"
                                                data-bs-target="#promocodemodal">{{ trans('labels.select_promocode') }}</a></div>
                                    @endif
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    @if (session()->get('discount_data'))
                                        <form action="{{ URL::to('/promocodes/remove') }}" method="post">
                                            @csrf
                                            <div class="d-flex">
                                                <input type="text" class="form-control" name="offer_code"
                                                    value="{{ session()->get('discount_data')['offer_code'] }}"
                                                    id="offer_code" placeholder="{{ trans('labels.have_promocode') }}"
                                                    disabled>
                                                <button type="submit"
                                                    class="btn btn-primary bg-primary border-0 ms-2">{{ trans('labels.remove') }}
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="{{ URL::to('/promocodes/apply') }}" method="post">
                                            @csrf
                                            <div class="d-flex">
                                                <input type="hidden" name="order_amount" value="{{ $order_total }}">
                                                <input type="text" class="form-control" name="offer_code"
                                                    value="{{ old('offer_code') }}" id="offer_code"
                                                    placeholder="{{ trans('labels.have_promocode') }}" readonly>
                                                <button type="submit"
                                                    class="btn btn-primary bg-primary border-0 ms-2">{{ trans('labels.apply') }}</button>
                                            </div>
                                            @error('offer_code')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="summary py-3 mb-4">
                                <h2 class="border-bottom">{{ trans('labels.bill_details') }}</h2>
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
                                        <div class="col-auto"><span>{{ trans('labels.order_total') }}</span></div>
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
                                </div>
                                <div class="bill-total mt-2">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span>{{ trans('labels.grand_total') }}</span></div>
                                        <div class="col-auto"><span>{{ Helper::currency_format($grand_total) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success w-100"
                                onclick="isopenclose('{{ URL::to('/isopenclose') }}')">{{ trans('labels.continue') }}</button>
                            <!-- MODAL_ORDER_TYPE_SELECTION--START -->
                            <div class="modal fade" id="deliveryoption" tabindex="-1"
                                aria-labelledby="deliveryoptionLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deliveryoptionLabel">
                                                {{ trans('labels.delivery_option') }}</h5>
                                            <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="order-option">
                                                <label class="form-check-label" for="delivery">
                                                    <input class="form-check-input" type="radio" name="order_type"
                                                        value="1"
                                                        {{ session()->get('order_type') == 1 ? 'checked' : '' }}
                                                        id="delivery">
                                                    <div class="home-delivery-img">
                                                        <img src="{{ Helper::web_image_path('delivery.png') }}"
                                                            alt="">
                                                        <span>{{ trans('labels.delivery') }}</span>
                                                    </div>
                                                </label>
                                                <label class="form-check-label" for="pickup">
                                                    <input class="form-check-input" type="radio" name="order_type"
                                                        value="2"
                                                        {{ session()->get('order_type') == 2 ? 'checked' : '' }}
                                                        id="pickup">
                                                    <div class="home-delivery-img">
                                                        <img src="{{ Helper::web_image_path('takeaway.png') }}"
                                                            alt="">
                                                        <span>{{ trans('labels.take_away') }}</span>
                                                    </div>
                                                </label>
                                            </div>
                                            <span
                                                class="d-flex justify-content-center mt-3 holderror text-danger d-none">{{ trans('messages.order_type_selection_required') }}</span>
                                        </div>
                                        <div class="modal-footer checkout-btn">
                                            <a href="javascript:void(0)" onclick="holduser(this)"
                                                data-url="{{ URL::to('/holduser') }}"
                                                data-next-url="{{ route('checkout') }}" type="submit"
                                                class="btn btn-primary bg-success border-0">{{ trans('labels.continue') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL_ORDER_TYPE_SELECTION--END -->
                        </div>
                    </div>
                @else
                    @include('web.nodata')
                @endif
            </div>
        </div>
    </section>
    <!-- MODAL-PROMOCOE---START -->
    <div class="modal fade" id="promocodemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-body py-0 px-4 rounded">
                    @if (count($getpromocodelist) > 0)
                    <div class="modal-header border-0 px-0 pb-0">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('labels.apply_promo') }}</h5>
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                        @foreach ($getpromocodelist as $promocode)
                            <div class="card my-4 border-0">
                                <div class="card-body p-0 ps-3">
                                    <div class="coupon bg-white rounded d-flex justify-content-between">
                                        <div class="left-side py-3 d-flex w-100 justify-content-start">
                                            <div>
                                                <h5>{{ $promocode->offer_name }}</h5>
                                                <p class="dark_color mb-0 fw-600 fs-7 dark_color">
                                                    {{ trans('labels.promocode') }} :
                                                    <span
                                                        class="fw-normal text-decoration-underline text-uppercase text-primary">{{ $promocode->offer_code }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="right-side">
                                            <div class="info m-3 d-flex align-items-center">
                                                <div class="w-100 d-flex flex-column align-items-center">
                                                    <div class="block">
                                                        <span class="time font-weight-light">
                                                            <span>{{ $promocode->offer_type == 1 ? Helper::currency_format($promocode->offer_amount) : $promocode->offer_amount . '%' }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <button class="btn btn-sm btn-outline-primary btn-block"
                                                        onclick="getoffercode('{{ $promocode->offer_code }}')"
                                                        data-bs-dismiss="modal">{{ trans('labels.copy') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @include('web.nodata')
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL-PROMOCOE---END -->
@endsection
@section('scripts')
    <script src="{{ url('/resources/views/web/cart/cart.js') }}"></script>
@endsection
