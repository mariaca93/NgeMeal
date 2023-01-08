@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.cuisines') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.cuisines') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active">
                            {{ trans('labels.cuisines') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-3">
            @foreach (Helper::get_cuisines() as $cuisinedata)
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 ">
                    <div class="cuisine-wrapper mx-2">
                        <a href="{{ URL::to('/menu/?cuisine=' . $cuisinedata->slug) }}">
                            <div class="cat rounded-circle mx-auto">
                                <img src="{{ Helper::image_path($cuisinedata->image) }}" class="rounded-circle"
                                    alt="cuisine">
                            </div>
                        </a>
                        <p class="my-2 text-center">{{ $cuisinedata->cuisine_name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
