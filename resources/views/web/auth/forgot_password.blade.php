<!doctype html>
<html lang="en" dir="{{ session()->get('direction') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> {{ @Helper::appdata()->title }} | {{ trans('labels.forgot_password') }} </title>
    <link rel="icon" href="{{ Helper::image_path(@Helper::appdata()->favicon) }}"><!-- Favicon -->
    <link rel="stylesheet" href="{{ url('/storage/app/public/web-assets/css/bootstrap.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/storage/app/public/web-assets/css/font_awesome/all.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ url('/storage/app/public/web-assets/css/style.css') }}"><!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('/storage/app/public/web-assets/css/responsive.css') }}">
    <!-- Media Query Resposive CSS -->
    <!-- COMMON-CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/assets/css/toastr/toastr.min.css') }}">
    <!-- Toastr CSS -->
</head>

<body>
    <!--Preloader start here-->
    <div id="preload" class="bg-light">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class='loader-icon'><img src="{{ Helper::image_path(@Helper::appdata()->logo) }}" alt="Swipy">
                </div>
            </div>
        </div>
    </div>
    <!--Preloader area end here-->
    <main>
        <div class="bg img-fluid"
            style="background: url('{{ Helper::image_path(Helper::appdata()->auth_bg_image) }}') center center/cover no-repeat !important;">
            <div class="bg-img-dark">
                <div class="auth_form_container container p-3">
                    <div class="auth_form_inner">
                        <form action="{{ route('sendpass') }}" method="POST" class="auth_form">
                            @csrf
                            <div class="text-center">
                                <a href="{{ route('home') }}">
                                    <img src="{{ Helper::image_path(@Helper::appdata()->logo) }}" alt=""
                                        class="login-form-logo pb-2">
                                </a>
                                <h5 class="p-3 text-white bottom-line m-0 fw-bold w-auto">
                                    {{ @Helper::appdata()->short_title }}</h5>
                            </div>
                            <div class="m-3">
                                <h5 class="text-center secondary_color fw-bold fs-2 mb-1">
                                    {{ trans('labels.forgot_password') }}</h5>
                                <p class="text-white w-410 text-center">{{ trans('labels.reset_pass_note') }}</p>
                            </div>
                            <div class="m-3">
                                <div class="card bg-transparent">
                                    <div class="card-body">
                                        <label class="form-label secondary_color">{{ trans('labels.email') }}</label>
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text btn-primary border-0" id="addon-wrapping"> <i
                                                    class="fa-solid fa-envelope text-white"></i></span>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="{{ trans('labels.email') }}">
                                        </div>
                                        @error('email')
                                            <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="m-3 d-grid">
                                <button
                                    @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif
                                    class="btn btn-primary">{{ trans('labels.submit') }}</button>
                            </div>
                            <div class="m-3 d-flex align-items-center justify-content-center">
                                <p class="text-white fw-lighter mb-0">
                                    {{ trans('labels.dont_account') }}
                                    <a href="{{ route('register') }}"
                                        class="text-primary fw-bold ">{{ trans('labels.signup') }}</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ url('/storage/app/public/web-assets/js/jquery/jquery-3.6.0.js') }}"></script><!-- jQuery JS -->
    <script src="{{ url('/storage/app/public/web-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script><!-- Bootstrap JS -->
    <!-- COMMON-JS -->
    <script src="{{ url('storage/app/public/admin-assets/assets/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
    <script>
        toastr.options = {
            "closeButton": true,
        }
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        // for-page-loader
        $(window).on('load', function() {
            "use strict";
            $("#preload").delay(600).fadeOut(500);
            $(".pre-loader").delay(600).fadeOut(500);
        })

        function myFunction() {
            "use strict";
            toastr.error("This operation was not performed due to demo mode");
        }
    </script>
</body>

</html>
