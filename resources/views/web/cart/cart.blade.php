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
                                $order_total = 0;
                                $total_item_qty = 0;
                            @endphp
                            @foreach ($getcartlist as $item)
                                <span class="text-light err{{ $item['id'] }}"></span>
                                <div class="order-list mb-4">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-auto d-flex justify-content-center item-img-none">
                                            <div class="item-img">
                                                <img src="{{ asset('admin-assets/images/item/'.$item->item_image) }}" alt="item-image">
                                            </div>
                                        </div>
                                        <div class="col-md-10 col-sm-10 col-auto col-detail">
                                            <div class="row">
                                                <div class="col-md-10 col-sm-10 col-auto">
                                                    @php
                                                        $addons_id = explode(',', $item['addons_id']);
                                                        $addons_price = explode(',', $item['addons_price']);
                                                        $addons_name = explode(',', $item['addons_name']);
                                                    @endphp

                                                    <div class="item-title mb-0">
                                                        <img @if ($item->item_type == 1) src="{{ Helper::image_path('veg.svg') }}" @else src="{{ Helper::image_path('nonveg.svg') }}" @endif
                                                        width="20" height="20" alt="" class="me-1">
                                                        {{ $item->item_name }}
                                                    </div>
                                                        <p class="mb-0">
                                                            @if ($item['addons_id'] != '')
                                                            <small><a class="text-muted" href="javascript:void(0)" onclick="showaddons('{{$item['addons_name']}}','{{$item['addons_price']}}')" data-bs-toggle="modal" data-bs-target="#modal_selected_addons">{{ trans('labels.addons') }} <i class="fa-solid fa-angles-right"></i></a></small>
                                                            @else
                                                            <small>-</small>
                                                            @endif
                                                        </p>
                                                        <p class="item-price text-start">{{ Helper::currency_format($item['item_price'] + $item['addons_total_price']) }}</p>
                                                    @php
                                                        $total_price = ($item['item_price'] + $item['addons_total_price']) * $item['qty'];
                                                        $order_total += (float) $total_price;
                                                        $total_item_qty += $item['qty'];
                                                    @endphp
                                                </div>
                                                <div
                                                    class="col-md-2 col-sm-2 col-auto d-flex align-items-end justify-content-between flex-column quantity-column">
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
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <form action="" method="post">
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
                                            <small class="text-light">{{ $message }}</small>
                                        @enderror
                                    </form>
                                </div>
                            </div>
                            <div class="summary py-3 mb-4">
                                <h2 class="border-bottom">{{ trans('labels.bill_details') }}</h2>
                                <div class="bill-details border-bottom">
                                    @php
                                        $grand_total = $order_total;
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
                                            <p>0</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bill-total mt-2">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span>{{ trans('labels.grand_total') }}</span></div>
                                        <div class="col-auto"><span>{{ Helper::currency_format($grand_total) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <a style="color:white!important" href="{{URL::to('checkout')}}" class="text-muted fs-8 fw-500">
                                    {{ trans('labels.continue') }}
                                </a></button>
                        </div>
                    </div>
                    @else
                    @include('web.nodata')
                    @endif
                </div>
            </div>
        </section>

        <!-- MODAL_SELECTED_ADDONS--START -->
        <div class="modal fade" id="modal_selected_addons" tabindex="-1" aria-labelledby="selected_addons_Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="selected_addons_Label">{{ trans('labels.selected_addons') }}</h5>
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-flush"></ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">{{ trans('labels.close') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL_SELECTED_ADDONS--END -->
@endsection
@section('scripts')
    <script src="{{ url('/web-assets/js/cart/cart.js') }}"></script>
@endsection
