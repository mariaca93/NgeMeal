@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.change_password') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.change_password') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.change_password') }}</li>
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
                        <p class="title">{{ trans('labels.change_password') }}</p>
                        <form action="{{ URL::to('/changepassword') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="" class="form-label mb-0">{{ trans('labels.old_password') }}</label>
                                <input type="password" class="form-control" name="old_password"
                                    placeholder="{{ trans('labels.old_password') }}" value="{{ old('old_password') }}">
                                @error('old_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label mb-0">{{ trans('labels.new_password') }}</label>
                                <input type="password" class="form-control" name="new_password"
                                    placeholder="{{ trans('labels.new_password') }}" value="{{ old('new_password') }}">
                                @error('new_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for=""
                                    class="form-label mb-0">{{ trans('labels.confirm_password') }}</label>
                                <input type="password" class="form-control" name="confirm_password"
                                    placeholder="{{ trans('labels.confirm_password') }}"
                                    value="{{ old('confirm_password') }}">
                                @error('confirm_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif
                                class="btn btn-primary">{{ trans('labels.reset') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function myFunction() {
            "use strict";
            toastr.error("This operation was not performed due to demo mode");
        }
    </script>
@endsection
