<!doctype html>
<html lang="en" dir="{{ session()->get('direction') }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> {{@Helper::appdata()->title}} | {{trans('labels.signup')}} </title>
    <link rel="icon" href="{{Helper::image_path(@Helper::appdata()->favicon)}}"><!-- Favicon -->
    <link rel="stylesheet" href="{{ asset('/web-assets/css/bootstrap.min.css') }}"><!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/web-assets/css/font_awesome/all.css') }}"><!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('/web-assets/css/style.css') }}"><!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/web-assets/css/responsive.css') }}"><!-- Media Query Resposive CSS -->
    <!-- COMMON-CSS -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/assets/css/toastr/toastr.min.css') }}"><!-- Toastr CSS -->
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
                        <div class="auth_form">
                            <!-- Authentication Form Body -->
                            <form action="{{ route('adduser') }}" method="POST">
                                @csrf
                                <!-- Authentication Form Inner Content -->
                                <div class="text-center">
                                    <a href="{{route('home')}}"><img src="{{ Helper::image_path(@Helper::appdata()->logo) }}" alt="" class="login-form-logo pb-2"></a>
                                    <h5 class="p-3 text-white bottom-line fw-bold w-auto">{{@Helper::appdata()->short_title }}</h5>
                                </div>
                                <div class="form-body mt-3">
                                    <div class="form-group">
                                        <label class="text-white form-label" for="name">{{trans('labels.full_name')}}</label>
                                            <input type="text" class="form-control custom-input rounded mb-3" name="name" value="{{ old('name') }}"  placeholder="{{trans('labels.full_name')}}">
                                        @error('name')<span class="red_color">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="text-white form-label" for="email">{{trans('labels.email')}}</label>
                                            <input type="email" class="form-control custom-input rounded mb-3" name="email" value="{{ old('email') }}" id="email" placeholder="{{trans('labels.email')}}">
                                        @error('email')<span class="red_color">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md">
                                                <label class="text-white form-label" for="mobile">{{trans('labels.mobile')}}</label>
                                                <div class="input-group">
                                                    <input type="hidden" name="country" id="country" value="62">
                                                    <input type="tel" id="mobile" name="mobile" class="form-control custom-input rounded mb-3" placeholder="{{trans('labels.mobile')}}" value="{{old('mobile')}}">
                                                    @error('mobile')<div class="red_color">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md">
                                                <label class="text-white form-label" for="password">{{trans('labels.password')}}</label>
                                                    <input type="password" class="form-control custom-input rounded mb-3" id="password" name="password" placeholder="{{trans('labels.password')}}" value="{{old('password')}}">
                                                    @error('password')<div class="text-light">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="col-md">
                                                    <label class="text-white form-label" for="confirm_password">{{trans('labels.confirm_password')}}</label>
                                                    <input type="password" class="form-control custom-input rounded mb-3" id="confirm_password" name="password_confirmation" placeholder="{{trans('labels.confirm_password')}}" value="{{old('password_confirmation')}}">
                                                    @error('password_confirmation')<div class="text-light">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="checkbox" id="checkbox" value="1" class="form-check-input me-1" {{old('checkbox') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox" class="text-white form-check-label m-auto">
                                        {{ trans('labels.i_accepts_the') }} <a href="" class="text-primary text-decoration-none fw-bold">{{ trans('labels.terms_conditions') }}</a></label>
                                        @error('checkbox') <br> <span class="red_color">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary w-100">{{trans('labels.signup')}}</button>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-3">
                                    <p class="text-white mb-0">
                                        {{trans('labels.already_account')}}
                                        <a href="{{ 'login' }}" class="text-primary fw-bold text-decoration-none">{{trans('labels.signin')}}</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('/web-assets/js/jquery/jquery-3.6.0.js') }}"></script><!-- jQuery JS -->
    <script src="{{ asset('/web-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script><!-- Bootstrap JS -->
    <!-- COMMON-JS -->
    <script src="{{ asset('/admin-assets/assets/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
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
    <script src="{{ asset('/web-assets/js/intl-tel-input/17.0.8.intlTelInput.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/web-assets/js/intl-tel-input/17.0.8.intlTelInput.min.css') }}">
    <script src="{{ asset('/web-assets/js/intl-tel-input/17.0.8.utils.js') }}"></script>
    <script>
        // var input = $('#mobile');
        // var iti = intlTelInput(input.get(0))
        // iti.setCountry("id");
        // input.on('countrychange', function(e) {
        //     $('#country').val(iti.getSelectedCountryData().dialCode);
        // });
        // $('.iti--allow-dropdown').addClass('w-100');
    </script>
</body>
</html>
