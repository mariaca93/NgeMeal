@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.about_us') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.about_us') }}</h1>
            </div>
        </div>
    </div>
    <section>
        <div class="container  text-justify mb-5">
            @if (@$getaboutus->about_content != '')
                <div class="cms-section">
                    <p>
                        {!! $getaboutus->about_content !!}
                    </p>
                </div>
            @else
                @include('web.nodata')
            @endif
        </div>
    </section>
@endsection
