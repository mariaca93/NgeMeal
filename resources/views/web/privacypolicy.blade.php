@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.privacy_policy') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.privacy_policy') }}</h1>
            </div>
        </div>
    </div>
    <section>
        <div class="container cms-section text-justify mb-5">
            @if (@$getprivacypolicy->privacypolicy_content != '')
                <div class="cms-section">
                    <p>
                        {!! $getprivacypolicy->privacypolicy_content !!}
                    </p>
                </div>
            @else
                @include('web.nodata')
            @endif
        </div>
    </section>
@endsection
