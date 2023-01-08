@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.terms_condition') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.terms_condition') }}</h1>
            </div>
        </div>
    </div>
    <section>
        <div class="container cms-section mb-5 text-justify">
            @if (@$gettermscondition->termscondition_content != '')
                <div class="cms-section">
                    <p>
                        {!! $gettermscondition->termscondition_content !!}
                    </p>
                </div>
            @else
                @include('web.nodata')
            @endif
        </div>
    </section>
@endsection
