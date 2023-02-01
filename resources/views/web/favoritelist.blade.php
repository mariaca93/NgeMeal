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
                                                            <img style="width:20px" src="{{ Helper::image_path('veg.svg') }}" class="me-1"
                                                                alt="">
                                                        @else
                                                            <img style="width:20px" src="{{ Helper::image_path('nonveg.svg') }}"
                                                                class="me-1" alt="">
                                                        @endif
                                                        {{ $itemdata->item_name }}
                                                    </a>
                                                    @if ($itemdata->is_favorite == 1)
                                                        <a class="heart-icon heart-red {{ session()->get('direction') == 'rtl' ? 'text-start' : 'text-end' }}"
                                                            @if (Auth::user()) href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',0,'{{ URL::to('/managefavorite') }}')" title="{{ trans('labels.remove_wishlist') }}" @else href="{{ URL::to('/login') }}" @endif>
                                                            {{-- <i class="fa-solid fa-bookmark fs-5"></i> --}}
                                                            <img src="{{ Helper::image_path('bookmark.png') }}" width="15" height="15" alt="">
                                                        </a>
                                                    @else
                                                        <a class="heart-icon {{ session()->get('direction') == 'rtl' ? 'text-start' : 'text-end' }}"
                                                            @if (Auth::user()) href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',1,'{{ URL::to('/managefavorite') }}')" title="{{ trans('labels.add_wishlist') }}" @else href="{{ URL::to('/login') }}" @endif>
                                                            {{-- <i class="fa-regular fa-bookmark fs-5"></i> --}}
                                                            <img src="{{ Helper::image_path('bookmark.png') }}" width="15" height="15" alt="">
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="row align-items-center justify-content-between gx-0">
                                                    <div class="col-auto">
                                                        <span style= "color:black"
                                                            class="fs-8">{{ $itemdata['cuisine_info']->cuisine_name }}</span>
                                                        @php
                                                            $price = $itemdata->price;
                                                        @endphp
                                                        <div style= "color:black" class="fw-600">{{ Helper::currency_format($price) }}</div>
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
