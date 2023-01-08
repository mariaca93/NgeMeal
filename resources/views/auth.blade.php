<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ @Helper::appdata()->title }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{Helper::image_path(@Helper::appdata()->favicon)}}"><!-- Favicon icon -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/assets/css/bootstrap/bootstrap.min.css') }}"><!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/assets/css/fontawesome/all.min.css') }}"><!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/assets/css/toastr/toastr.min.css') }}"><!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/assets/css/style.css') }}"><!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/assets/css/responsive.css') }}"><!-- Responsive CSS -->
</head>

<body>
    @include('admin.theme.preloader')
    <main>
        <div class="wrapper">
            <section>
                <div class="row justify-content-center align-items-center g-0 w-100 h-100vh">
                    <div class="col-xl-4 col-lg-6 col-sm-8 col-auto px-5">
                        <div class="card box-shadow overflow-hidden border-0">
                            <div class="bg-primary-light">
                                <div class="row">
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="text-primary p-4">
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{Helper::image_path('authformbgimage.png')}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <form class="my-3" method="POST" action="{{ URL::to('admin/auth')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="envato_username" type="text" class="form-control @error('envato_username') is-invalid @enderror" name="envato_username" value="{{ old('envato_username')}}" required autocomplete="envato_username" autofocus placeholder="Envato Username">
                                        @error('envato_username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')}}" required autocomplete="email" autofocus placeholder="Email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="purchase_key" type="text" class="form-control @error('purchase_key') is-invalid @enderror" name="purchase_key" required autocomplete="current-purchase_key" placeholder="Purchase Key">
                                        @error('purchase_key')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <?php
                                    $text = str_replace('auth', 'admin', url()->current());
                                    ?>
                                    <div class="form-group">
                                        <input id="domain" type="hidden" class="form-control @error('domain') is-invalid @enderror" name="domain" required autocomplete="current-domain" value="{{$text}}" placeholder="domain" readonly="">
                                    </div>
                                    <button class="btn btn-primary w-100 my-3" type="submit">{{ trans('labels.submit') }}</button>
                                </form>
                                <div class="mb-3 text-center">
                                    <a href="{{URL::to('admin/forgot-password')}}" class="text-muted fs-8 fw-500">
                                        <i class="fa-solid fa-lock-keyhole mx-2 fs-7"></i>{{trans('labels.forgot_password_q')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script src="{{ url('storage/app/public/admin-assets/assets/js/jquery/jquery.min.js') }}"></script><!-- jQuery JS -->
    <script src="{{ url('storage/app/public/admin-assets/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script><!-- Bootstrap JS -->
    <script src="{{ url('storage/app/public/admin-assets/assets/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
    <script src="{{ url('storage/app/public/admin-assets/assets/js/common.js') }}"></script><!-- Common JS -->
</body>

</html>