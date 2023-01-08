@extends('web.layout.default')
<link rel="stylesheet" href="{{ url('/storage/app/public/web-assets/css/fancybox/fancybox-v4-0-27.css') }}"><!-- Fancybox 4.0 CSS -->
@section('page_title')
    | {{ trans('labels.gallery') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.gallery') }}</h1>
            </div>
        </div>
    </div>
    <section>
        <div class="container mb-5">
            @if (count($getgalleries)>0)    
            <div id="galleryimg">
                @foreach ($getgalleries as $image)
                    <div data-src="{{ $image->image_url }}" data-fancybox="gallery" data-thumb="{{ $image->image_url }}">
                        <img src="{{ $image->image_url }}" width="200" height="150" />
                      </div>
                @endforeach
            </div>
            @else
                @include('web.nodata')
            @endif
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ url('/storage/app/public/web-assets/js/fancybox/fancybox-v4-0-27.js') }}"></script><!-- Fancybox 4.0 JS -->
@endsection
