@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.favourite_list') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.favourite_list') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.favourite_list') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-3">
                    @include('web.layout.usersidebar')
                </div>
                <div class="col-lg-9 d-flex">
                    <div class="user-content-wrapper">
                        <p class="title">{{ trans('labels.favourite_list') }}</p>
                        @if (count($getfavoritelist) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover favouritelist">
                                    @foreach ($getfavoritelist as $itemdata)
                                        <tr>
                                            <td class="item-image">
                                                <img src="{{ $itemdata['item_image']->image_url }}" class="hw-70">
                                            </td>
                                            <td>
                                                <div class="item-title">
                                                    <a href="{{ URL::to('item-' . $itemdata->slug) }}"
                                                        class="fw-500 dark_color text-break">
                                                        @if ($itemdata->item_type == 1)
                                                            <img src="{{ Helper::image_path('veg.svg') }}" class="me-1"
                                                                alt="">
                                                        @else
                                                            <img src="{{ Helper::image_path('nonveg.svg') }}"
                                                                class="me-1" alt="">
                                                        @endif
                                                        {{ $itemdata->item_name }}
                                                    </a>
                                                    @if ($itemdata->is_favorite == 1)
                                                        <a class="heart-icon heart-red {{ session()->get('direction') == 'rtl' ? 'text-start' : 'text-end' }}"
                                                            @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',0,'{{ URL::to('/managefavorite') }}')" title="{{ trans('labels.remove_wishlist') }}" @else href="{{ URL::to('/login') }}" @endif>
                                                            <i class="fa-solid fa-bookmark fs-5"></i> </a>
                                                    @else
                                                        <a class="heart-icon {{ session()->get('direction') == 'rtl' ? 'text-start' : 'text-end' }}"
                                                            @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',1,'{{ URL::to('/managefavorite') }}')" title="{{ trans('labels.add_wishlist') }}" @else href="{{ URL::to('/login') }}" @endif>
                                                            <i class="fa-regular fa-bookmark fs-5"></i> </a>
                                                    @endif
                                                </div>
                                                <div class="row align-items-center justify-content-between gx-0">
                                                    <div class="col-auto">
                                                        <span
                                                            class="white_color fs-8">{{ $itemdata['cuisine_info']->cuisine_name }}</span>
                                                        @php
                                                            if ($itemdata->has_variation == 1) {
                                                                foreach ($itemdata['variation'] as $key => $value) {
                                                                    $price = $value->product_price;
                                                                    if ($key == 0) {
                                                                        break;
                                                                    }
                                                                }
                                                            } else {
                                                                $price = $itemdata->price;
                                                            }
                                                        @endphp
                                                        <div class="fw-600">{{ Helper::currency_format($price) }}</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        @if (Auth::user() && Auth::user()->type == 2)
                                                            @if ($itemdata->is_cart == 1)
                                                                <div class="item-quantity">
                                                                    <button class="btn btn-sm pastel_purple_color fw-500"
                                                                        onclick="removefromcart('{{ URL::to('/cart') }}','{{ trans('messages.remove_cartitem_note') }}','{{ trans('labels.goto_cart') }}')">-</button>
                                                                    <input
                                                                        class="pastel_purple_color fw-500 item-total-qty-{{ $itemdata->slug }}"
                                                                        type="text"
                                                                        value="{{ Helper::get_item_cart($itemdata->id) }}"
                                                                        disabled />
                                                                    @if ($itemdata->addons_id != '' || count($itemdata->variation) > 0)
                                                                        <a class="btn btn-sm pastel_purple_color fw-500"
                                                                            onclick="showitem('{{ $itemdata->slug }}','{{ URL::to('/show-item') }}')">+</a>
                                                                    @else
                                                                        <a class="btn btn-sm pastel_purple_color fw-500"
                                                                            onclick="calladdtocart('{{ $itemdata->slug }}','{{ $itemdata->item_name }}','{{ $itemdata->item_type }}','{{ $itemdata['item_image']->image_name }}','{{ $itemdata->tax }}','{{ $itemdata->price }}','','','','','','{{ URL::to('addtocart') }}')">+</a>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                @if ($itemdata->addons_id != '' || count($itemdata->variation) > 0)
                                                                    <a class="btn btn-sm border pastel_purple_color fw-500 fs-7 text-end"
                                                                        onclick="showitem('{{ $itemdata->slug }}','{{ URL::to('/show-item') }}')">{{ trans('labels.add') }}</a>
                                                                @else
                                                                    <a class="btn btn-sm border pastel_purple_color fw-500 fs-7 text-end"
                                                                        onclick="calladdtocart('{{ $itemdata->slug }}','{{ $itemdata->item_name }}','{{ $itemdata->item_type }}','{{ $itemdata['item_image']->image_name }}','{{ $itemdata->tax }}','{{ $itemdata->price }}','','','','','','{{ URL::to('addtocart') }}')">{{ trans('labels.add') }}</a>
                                                                @endif
                                                            @endif
                                                        @else
                                                            <a class="btn btn-sm border pastel_purple_color fw-500 fs-7 text-end"
                                                                href="{{ URL::to('/login') }}">{{ trans('labels.add') }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="mt-2 d-flex justify-content-center">
                                {{ $getfavoritelist->links() }}
                            </div>
                        @else
                            @include('web.nodata')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
