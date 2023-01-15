<!doctype html>
<html lang="en" dir="<?php echo e(session()->get('direction')); ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> <?php echo e(@Helper::appdata()->title); ?> | <?php echo e(trans('labels.signup')); ?> </title>
    <link rel="icon" href="<?php echo e(Helper::image_path(@Helper::appdata()->favicon)); ?>"><!-- Favicon -->
    <link rel="stylesheet" href="<?php echo e(asset('/web-assets/css/bootstrap.min.css')); ?>"><!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('/web-assets/css/font_awesome/all.css')); ?>"><!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('/web-assets/css/style.css')); ?>"><!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('/web-assets/css/responsive.css')); ?>"><!-- Media Query Resposive CSS -->
    <!-- COMMON-CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('/admin-assets/assets/css/toastr/toastr.min.css')); ?>"><!-- Toastr CSS -->
</head>
<body>
    <!--Preloader start here-->
    <div id="preload" class="bg-light">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class='loader-icon'><img src="<?php echo e(Helper::image_path(@Helper::appdata()->logo)); ?>" alt="Swipy">
                </div>
            </div>
        </div>
    </div>
    <!--Preloader area end here-->
    <main>
        <div class="bg img-fluid" style="background: url('<?php echo e(Helper::image_path(Helper::appdata()->auth_bg_image)); ?>') center center/cover no-repeat !important;">
            <!-- Sticky Background Image -->
            <div class="bg-img-dark">
                <div class="auth_form_container container p-3">
                    <div class="auth_form_inner">
                        <div class="auth_form">
                            <!-- Authentication Form Body -->
                            <form action="<?php echo e(route('adduser')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <!-- Authentication Form Inner Content -->
                                <div class="text-center">
                                    <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(Helper::image_path(@Helper::appdata()->logo)); ?>" alt="" class="login-form-logo pb-2"></a>
                                    <h5 class="p-3 text-white bottom-line fw-bold w-auto"><?php echo e(@Helper::appdata()->short_title); ?></h5>
                                </div>
                                <div class="form-body mt-3">
                                    <div class="form-group">
                                        <label class="text-white form-label" for="name"><?php echo e(trans('labels.full_name')); ?></label>
                                        <?php if(session()->has('social_login')): ?>
                                            <input type="text" class="form-control custom-input rounded mb-3" name="name" value="<?php echo e(session()->get('social_login')['name']); ?>"  placeholder="<?php echo e(trans('labels.full_name')); ?>">
                                        <?php else: ?>
                                            <input type="text" class="form-control custom-input rounded mb-3" name="name" value="<?php echo e(old('name')); ?>"  placeholder="<?php echo e(trans('labels.full_name')); ?>">    
                                        <?php endif; ?>
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-light"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-white form-label" for="email"><?php echo e(trans('labels.email')); ?></label>
                                        <?php if(session()->has('social_login')): ?>
                                            <input type="email" class="form-control custom-input rounded mb-3" name="email" value="<?php echo e(session()->get('social_login')['email']); ?>" id="email" placeholder="<?php echo e(trans('labels.email')); ?>">
                                        <?php else: ?>
                                        <input type="email" class="form-control custom-input rounded mb-3" name="email" value="<?php echo e(old('email')); ?>" id="email" placeholder="<?php echo e(trans('labels.email')); ?>">
                                        <?php endif; ?>
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-light"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md">
                                                <label class="text-white form-label" for="mobile"><?php echo e(trans('labels.mobile')); ?></label>
                                                <div class="input-group">
                                                    <input type="hidden" name="country" id="country" value="62">
                                                    <input type="tel" id="mobile" name="mobile" class="form-control custom-input rounded mb-3" placeholder="<?php echo e(trans('labels.mobile')); ?>" value="<?php echo e(old('mobile')); ?>">
                                                    <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-light"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <label class="text-white form-label" for="referral_code"><?php echo e(trans('labels.referral_code')); ?> </label>
                                                <input type="text" class="form-control custom-input rounded mb-3" id="referral_code_o" name="referral_code" placeholder="<?php echo e(trans('labels.referral_code_o')); ?>" <?php if(isset($_GET['referral'])): ?> value="<?php echo e($_GET['referral']); ?>" <?php endif; ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <?php if(!session()->has('social_login')): ?>
                                        <?php if(\App\SystemAddons::where('unique_identifier', 'otp')->first() != null && \App\SystemAddons::where('unique_identifier', 'otp')->first()->activated): ?>
                                        <?php else: ?> -->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md">
                                                    <label class="text-white form-label" for="password"><?php echo e(trans('labels.password')); ?></label>
                                                        <input type="password" class="form-control custom-input rounded mb-3" id="password" name="password" placeholder="<?php echo e(trans('labels.password')); ?>" value="<?php echo e(old('password')); ?>">
                                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-light"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="col-md">
                                                        <label class="text-white form-label" for="confirm_password"><?php echo e(trans('labels.confirm_password')); ?></label>
                                                        <input type="password" class="form-control custom-input rounded mb-3" id="confirm_password" name="password_confirmation" placeholder="<?php echo e(trans('labels.confirm_password')); ?>" value="<?php echo e(old('password_confirmation')); ?>">
                                                        <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-light"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- <?php endif; ?>
                                    <?php endif; ?> -->
                                    <div class="form-group">
                                        <input type="checkbox" name="checkbox" id="checkbox" value="1" class="form-check-input me-1" <?php echo e(old('checkbox') == 1 ? 'checked' : ''); ?>>
                                        <label for="checkbox" class="text-white form-check-label m-auto">
                                        <?php echo e(trans('labels.i_accepts_the')); ?> <a href="<?php echo e(URL::to('terms-conditions')); ?>" class="text-primary text-decoration-none fw-bold"><?php echo e(trans('labels.terms_conditions')); ?></a></label>
                                        <?php $__errorArgs = ['checkbox'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <br> <span class="text-light"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary w-100"><?php echo e(trans('labels.signup')); ?></button>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-3">
                                    <p class="text-white mb-0">
                                        <?php echo e(trans('labels.already_account')); ?> 
                                        <a href="<?php echo e('login'); ?>" class="text-primary fw-bold text-decoration-none"><?php echo e(trans('labels.signin')); ?></a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="<?php echo e(asset('/web-assets/js/jquery/jquery-3.6.0.js')); ?>"></script><!-- jQuery JS -->
    <script src="<?php echo e(asset('/web-assets/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script><!-- Bootstrap JS -->
    <!-- COMMON-JS -->
    <script src="<?php echo e(asset('/admin-assets/assets/js/toastr/toastr.min.js')); ?>"></script><!-- Toastr JS -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        <?php if(Session::has('success')): ?>
            toastr.success("<?php echo e(session('success')); ?>");
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>
        // for-page-loader
        $(window).on('load', function() {
            "use strict";
            $("#preload").delay(600).fadeOut(500);
            $(".pre-loader").delay(600).fadeOut(500);
        })
    </script>
    <script src="<?php echo e(asset('/web-assets/js/intl-tel-input/17.0.8.intlTelInput.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('/web-assets/js/intl-tel-input/17.0.8.intlTelInput.min.css')); ?>">
    <script src="<?php echo e(asset('/web-assets/js/intl-tel-input/17.0.8.utils.js')); ?>"></script>
    <script>
        var input = $('#mobile');
        var iti = intlTelInput(input.get(0))
        iti.setCountry("in");
        input.on('countrychange', function(e) {
            $('#country').val(iti.getSelectedCountryData().dialCode);
        });
        $('.iti--allow-dropdown').addClass('w-100');
    </script>
</body>
</html><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/auth/register.blade.php ENDPATH**/ ?>