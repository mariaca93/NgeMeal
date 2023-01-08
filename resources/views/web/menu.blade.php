@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.menu') }} | {{ @$cuisinedata->cuisine_name }}
@endsection
@section('content')
    @if (!empty($cuisinedata))
        <div class="breadcrumb-sec">
            <div class="container">
                <div class="breadcrumb-sec-content">
                    <h1>{{ @$cuisinedata->cuisine_name }}</h1>
                    <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li
                                class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                                <a class="text-muted" href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a>
                            </li>
                            <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                                aria-current="page">{{ @$cuisinedata->cuisine_name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="menu-section">
            <div class="container px-5">
                <div class="row mb-5">
                    <div class="filter-sidebar mb-3">
                        <div class="sidebar-wrap" id="style-3">
                            @if (count($subcuisines) > 0 || count($getitemlist) > 0 )
                            <a href="{{ URL::to('/menu?cuisine='.$cuisinedata->slug) }}"
                                class="@if(!isset($_GET['subcuisine'])) active @endif">{{ trans('labels.all') }}</a>
                            @endif
                            @foreach ($subcuisines as $key => $subcatdata)
                                <a href="{{ URL::to('/menu?cuisine=' . $cuisinedata->slug . '&subcuisine=' . $subcatdata->slug) }}"
                                    class="@if(isset($_GET['subcuisine']) && $_GET['subcuisine'] == $subcatdata->slug) active @endif">{{ ucfirst($subcatdata->subcuisine_name) }}</a>
                            @endforeach
                        </div>
                    </div>
                    @if (count($getitemlist) > 0)
                        <div class="menu my-0">
                            <div class="row boxes">
                                @foreach ($getitemlist as $itemdata)
                                    @include('web.itemview')
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-5 d-flex justify-content-center">
                            {{ $getitemlist->appends(request()->query())->links() }}
                        </div>
                    @else
                        @include('web.nodata')
                    @endif
                </div>
            </div>
        </section>
    @else
        @include('web.nodata')
    @endif
@endsection
