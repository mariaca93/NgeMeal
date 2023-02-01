<!doctype html>
<html lang="en" dir="{{session()->get('direction')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> {{@Helper::appdata()->title}} | {{trans('labels.signin')}} </title>
    <link rel="icon" href="{{Helper::image_path(@Helper::appdata()->favicon)}}"><!-- Favicon -->
    <link rel="stylesheet" href="{{ asset('web-assets/css/bootstrap.min.css') }}"><!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('web-assets/css/font_awesome/all.css') }}"><!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('web-assets/css/style.css') }}"><!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('web-assets/css/responsive.css') }}"><!-- Media Query Resposive CSS -->
    <!-- COMMON-CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/css/toastr/toastr.min.css') }}"><!-- Toastr CSS -->
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
        <div class="bg img-fluid" style="background: url('{{Helper::image_path(Helper::appdata()->auth_bg_image)}}') center center/cover no-repeat !important;">
            <!-- Sticky Background Image -->
            <div class="bg-img-dark">
                <div class="auth_form_container container p-3">
                    <div class="auth_form_inner">
                        <!-- Authentication Form Body -->
                            <form action="{{ URL::to('/checklogin') }}" method="POST" class="auth_form">
                                <!-- Authentication Form Inner Content -->
                                @csrf
                                <div class="text-center">
                                    <a href="{{route('home')}}"><img src="{{ Helper::image_path(@Helper::appdata()->logo) }}" alt="" class="login-form-logo pb-2"></a>
                                    <h5 class="p-3 text-white bottom-line m-0 fw-bold">{{@Helper::appdata()->short_title }}</h5>
                                </div>
                                <div class="form-body mt-3">
                                    @if (\App\SystemAddons::where('unique_identifier', 'otp')->first() != null && \App\SystemAddons::where('unique_identifier', 'otp')->first()->activated)
                                        <div class="col-md">
                                            <label class="text-white form-label" for="mobile">{{trans('labels.mobile')}}</label>
                                            <div class="input-group">
                                                <input type="hidden" name="country" id="country" value="91">
                                                <input type="tel" id="mobile" name="mobile" class="form-control custom-input rounded mb-3" placeholder="{{trans('labels.mobile')}}" value="{{old('mobile')}}">
                                            </div>
                                            @error('mobile')<div class="text-light">{{ $message }}</div>@enderror
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="text-white form-label">{{trans('labels.email')}}</label>
                                            <input type="email" name="email" class="form-control custom-input mb-3" placeholder="{{trans('labels.email')}}" @if (env('Environment') == 'sendbox') value="user@gmail.com" @endif>
                                            @error('email')<span class="p-3 red_color bottom-line fw-bold w-auto">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="text-white form-label">{{trans('labels.password')}}</label>
                                            <input type="password" name="password" class="form-control custom-input mb-3" placeholder="{{trans('labels.password')}}" @if (env('Environment') == 'sendbox') value="123456" @endif>
                                            @error('password')<span class="p-3 red_color bottom-line fw-bold w-auto">{{ $message }}</span>@enderror
                                        </div>
                                        {{-- <div class="form-group d-flex justify-content-end">
                                            <a href="{{ URL::to('forgot-password') }}" class="text-primary fw-bold float-end">{{trans('labels.forgot_password_q')}}</a>
                                        </div> --}}
                                    @endif
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary w-100">{{trans('labels.signin')}}</button>
                                    </div>
                                </div>
                                <div class="or_section">
                                    <div class="line ms-4"></div>
                                    <p class="mb-0 text-white fw-light">{{ trans('labels.or') }}</p>
                                    <div class="line me-4"></div>
                                </div>
                                <div class="m-3 text-center">
                                    <p class="text-white fw-lighter mb-0">
                                        {{trans('labels.dont_account')}}
                                        <a href="{{ 'register' }}" class="text-primary fw-bold ">{{trans('labels.signup')}}</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('web-assets/js/jquery/jquery-3.6.0.js') }}"></script><!-- jQuery JS -->
    <script src="{{ asset('web-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script><!-- Bootstrap JS -->
    <!-- COMMON-JS -->
    <script src="{{ asset('admin-assets/assets/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
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
    </script>
    <script src="{{ asset('web-assets/js/intl-tel-input/17.0.8.intlTelInput.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('web-assets/js/intl-tel-input/17.0.8.intlTelInput.min.css') }}">
    <script src="{{ asset('web-assets/js/intl-tel-input/17.0.8.utils.js') }}"></script>
    <script>
        var input = $('#mobile');
        var checkval = $('#mobile').val();
        if(checkval == ""){
            var iti = intlTelInput(input.get(0))
            iti.setCountry("in");
            input.on('countrychange', function(e) {
                $('#country').val(iti.getSelectedCountryData().dialCode);
            });
            $('.iti--allow-dropdown').addClass('w-100');
        }
    </script>
</body>
</html>
