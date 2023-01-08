@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.refer_earn') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.refer_earn') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.refer_earn') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-3 d-flex">
                    @include('web.layout.usersidebar')
                </div>
                <div class="col-lg-9">
                    <div class="user-content-wrapper">
                        <p class="title">{{ trans('labels.refer_earn') }}</p>
                        <div class="d-flex flex-column align-items-center w-100">
                            <img class="mb-4 refer-img" src="{{ Helper::web_image_path('refer.svg') }}">
                            <h5 class="text-uppercase">{{ trans('labels.refer_earn') }}</h5>
                            <p class="fs-6 text-center text-muted">{{ trans('labels.refer_note_1') }} {{Helper::currency_format(@Helper::appdata()->referral_amount)}} {{ trans('labels.refer_note_2') }}</p>
                            <input type="url" class="form-control mb-3" id="data"
                                value="{{ URL::to('/register?referral=' . Auth::user()->referral_code) }}" readonly>
                            <button class="btn btn-primary" id="tool" onclick="copytext('{{ trans('labels.copied') }}')">{{ trans('labels.copy_link') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ url('/resources/views/web/referearn/referearn.js')}}"></script>
@endsection