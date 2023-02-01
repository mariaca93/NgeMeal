@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.view_all') }}
@endsection
@section('content')
    @if (isset($_GET['type']) && $_GET['type'] != '')
        <div class="breadcrumb-sec">
            <div class="container">
                <div class="breadcrumb-sec-content">
                    @php
                        $type = $_GET['type'];
                        if ($_GET['type'] == 'alacarte') {
                            $title = trans('labels.alacarte');
                        } elseif ($_GET['type'] == 'todayspecial') {
                            $title = trans('labels.todays_special');
                        } elseif ($_GET['type'] == 'recommended') {
                            $title = trans('labels.recommended');
                        } elseif ($_GET['type'] == 'subscription') {
                            $title = trans('labels.subscription_menu');
                        }else {
                            $title = '';
                        }
                    @endphp
                    <h1>{{ $title }}</h1>
                    <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li
                                class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                                <a class="text-muted" href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a>
                            </li>
                            <li
                                class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active">
                                {{ $title }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="menu-section menu-section-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="sub-cat-tab food-type d-flex justify-content-center">
                        <nav class="nav nav-pills m-auto justify-content-center veg align-items-baseline">
                            <a class="nav-link px-3 mx-2 @if (isset($_GET['filter']) && $_GET['filter'] == 'veg') active-cat @else border @endif"
                                @if (isset($_GET['filter']) && $_GET['filter'] == 'veg') href="{{ URL::to('/view-all?type=' . @$type) }}"
                                @else
                                    href="{{ URL::to('/view-all?type=' . @$type . '&filter=veg') }}" @endif>
                                <img src="{{ Helper::image_path('veg.svg') }}" class="pe-1" width="50"
                                    alt="">{{ trans('labels.veg') }}
                            </a>
                            <a class="nav-link px-3 mx-2 @if (isset($_GET['filter']) && $_GET['filter'] == 'nonveg') active-cat @else border @endif"
                                @if (isset($_GET['filter']) && $_GET['filter'] == 'nonveg') href="{{ URL::to('/view-all?type=' . @$type) }}"
                                @else
                                    href="{{ URL::to('/view-all?type=' . @$type . '&filter=nonveg') }}" @endif>
                                <img src="{{ Helper::image_path('nonveg.svg') }}" class="pe-1" width="50"
                                    alt="">{{ trans('labels.nonveg') }}
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container my-5">
        <div class="row mb-5">
            <div class="menu my-0">
                @php
                    $type = $_GET['type'];
                    if ($_GET['type'] == 'alacarte') {
                        $tipe = 'alacarte';
                    } elseif ($_GET['type'] == 'subscription') {
                        $tipe = 'subscription';
                    }
                @endphp
                @if ($tipe == 'alacarte' || $tipe == 'subscription')
                    <div class="row">
                        @if($tipe == 'alacarte')
                            @foreach ($getsearchitems as $itemdata)
                                @include('web.itemview')
                            @endforeach
                        @elseif($tipe == 'subscription')
                            @foreach ($subscriptions as $itemdata)
                                @include('web.itemview')
                            @endforeach
                        @endif
                    </div>
                    @if($tipe == 'alacarte')
                        <div class="mt-5 d-flex justify-content-center">
                            <h1>{{ $getsearchitems->appends(request()->query())->links() }}</h1>

                        </div>
                    @elseif($tipe == 'subscription')
                        <div class="mt-5 d-flex justify-content-center">
                            {{ $getsearchitems->appends(request()->query())->links() }}
                        </div>
                    @endif
                @else
                    @include('web.nodata')
                @endif
            </div>
        </div>
    </div>
@endsection
