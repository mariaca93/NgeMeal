<?php $__env->startSection('page_title'); ?>
| <?php echo e(trans('labels.home')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Slider Area Start Here -->
<?php if(count($sliders)>0): ?>
<section class="slider-area">
    <div id="slidercarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sliderdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                <img src="<?php echo e(Helper::web_image_path($sliderdata->image)); ?>" class="d-block img-fluid" alt="slider">
                <div class="carousel-caption d-flex h-100 align-items-center justify-content-center flex-column">
                    <h5><?php echo e($sliderdata->title); ?></h5>
                    <p><?php echo e($sliderdata->description); ?></p>
                    <?php if($sliderdata['item_info'] != ''): ?>
                    <a href="<?php echo e(URL::to('/item-' . $sliderdata['item_info']->slug)); ?>" class="btn btn-primary fw-bold"><?php echo e(trans('labels.explore')); ?> <i class="fa-solid fa-circle-arrow-right"></i> </a>
                    <?php endif; ?>
                    <?php if($sliderdata['cuisine_info'] != ''): ?>
                    <a href="<?php echo e(URL::to('/menu/?cuisine=' . $sliderdata['cuisine_info']->slug)); ?>" class="btn btn-primary fw-bold"><?php echo e(trans('labels.explore')); ?> <i class="fa-solid fa-circle-arrow-right"></i> </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="carousel-control-prev <?php echo e(count($sliders) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#slidercarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next <?php echo e(count($sliders) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#slidercarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</section>
<?php endif; ?>
<!-- Slider Area End Here -->
<!-- Promotional topbanners Start Here -->
<?php if(count($banners['topbanners']) > 0): ?>
<section class="banner1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="news-slider" class="owl-carousel">
                    <?php $__currentLoopData = $banners['topbanners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bannerdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="post-slide">
                        <div class="post-img">
                            <?php if($bannerdata['item_info'] != ''): ?>
                            <a href="<?php echo e(URL::to('/item-' . $bannerdata['item_info']->slug)); ?>">
                                <?php elseif($bannerdata['cuisine_info'] != ''): ?>
                                <a href="<?php echo e(URL::to('/menu/?cuisine=' . $bannerdata['cuisine_info']->slug)); ?>">
                                    <?php else: ?>
                                    <a href="javascript:void(0);">
                                        <?php endif; ?>
                                        <img src="<?php echo e($bannerdata['image']); ?>" alt="banner">
                                    </a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Promotional topbanners End Here -->
<!-- Cuisine Section Start Here -->
<!-- <button id="find-me">Show my location</button><br />
<p id="status"></p>
<a id="map-link" target="_blank"></a> -->

<form  hidden name="formSubmit" method="GET" action="<?php echo e(URL::to('home')); ?>">
    <input hidden name="longitude" id="longitude" value="">
    <input hidden name="latitude" id="latitude" value="">
<button hidden id="btnSubmit" type="submit"></button>
</form>

<script>
    window.onload = function() {
        if(document.cookie.indexOf('weather') == -1 ){
            geoFindMe();
        }
    };

    function geoFindMe() {
        const status = document.querySelector('#status');
        const mapLink = document.querySelector('#map-link');

        mapLink.href = '';
        mapLink.textContent = '';

        function success(position) {
            const latitude  = position.coords.latitude;
            const longitude = position.coords.longitude;
            status.textContent = '';
            mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
            mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
            console.log("lat nya" + latitude);
            console.log("long nya " +longitude);
            
            document.getElementById('latitude').value=latitude;
            document.getElementById('longitude').value=longitude;
        }

        function error() {
            status.textContent = 'Unable to retrieve your location';
        }

        if (!navigator.geolocation) {
            status.textContent = 'Geolocation is not supported by your browser';
        } else {
            status.textContent = 'Locating…';
            navigator.geolocation.getCurrentPosition(success, error, {timeout:10000});
        }
    }
</script>

<?php if(count(Helper::get_cuisines()) > 0): ?>
<section class="cuisine">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="text-capitalize fw-bold"><?php echo e(trans('labels.cuisines')); ?></h1>
                    </div>
                    <div class="col-auto text-end align-center">
                        <a href="<?php echo e(route('cuisines')); ?>" class="btn btn-sm btn-outline-primary"><?php echo e(trans('labels.view_all')); ?></a>
                    </div>
                </div>
                <div id="cuisine" class="owl-carousel mt-2">
                    <?php $__currentLoopData = Helper::get_cuisines(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuisinedata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="cuisine-wrapper mx-2">
                        <a href="<?php echo e(URL::to('/menu/?cuisine=' . $cuisinedata->slug)); ?>">
                            <div class="cat rounded-circle">
                                <img src="<?php echo e(Helper::image_path($cuisinedata->image)); ?>" class="rounded-circle" alt="cuisine">
                            </div>
                        </a>
                        <p class="text-center my-2"><?php echo e($cuisinedata->cuisine_name); ?></p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Cuisine Section End Here -->

<!-- food based on weather section starts here-->
<?php if(count($basedonweather) > 0): ?>
<section class="menu">
    <div class="container">
        <div class="row align-items-center justify-content-between my-2">
            <div class="col-auto menu-heading">
                <h1><?php echo e($weathermessage); ?></h1>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(URL::to('/view-all?type=topitems')); ?>" class="btn btn-sm btn-outline-primary"><?php echo e(trans('labels.view_all')); ?></a>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $basedonweather; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- food based on weather section ends here-->

<!-- topitemlist dishes Section Start Here -->
<?php if(count($topitemlist) > 0): ?>
<section class="menu">
    <div class="container">
        <div class="row align-items-center justify-content-between my-2">
            <div class="col-auto menu-heading">
                <h1><?php echo e(trans('labels.trending')); ?></h1>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(URL::to('/view-all?type=topitems')); ?>" class="btn btn-sm btn-outline-primary"><?php echo e(trans('labels.view_all')); ?></a>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $topitemlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- topitemlist dishes Section End Here -->
<!-- Promotional bannersection1 Start Here -->
<?php if(count($banners['bannersection1']) > 0): ?>
<section class="banner2 my-md-5 my-sm-3">
    <div id="banner1" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $__currentLoopData = $banners['bannersection1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bannerdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                <?php if($bannerdata['item_info'] != ''): ?>
                <a href="<?php echo e(URL::to('/item-' . $bannerdata['item_info']->slug)); ?>">
                    <?php elseif($bannerdata['cuisine_info'] != ''): ?>
                    <a href=" <?php echo e(URL::to('/menu/?cuisine=' . $bannerdata['cuisine_info']->slug)); ?> ">
                        <?php else: ?>
                        <a href="javascript:void(0)">
                            <?php endif; ?>
                            <img src="<?php echo e($bannerdata['image']); ?>" height="400" alt="banner2">
                        </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="carousel-control-prev <?php echo e(count($banners['bannersection1']) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#banner1" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next <?php echo e(count($banners['bannersection1']) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#banner1" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<?php endif; ?>
<!-- Promotional bannersection1 End Here -->
<!-- todayspecial Dishes Section Start Here -->
<?php if(count($todayspecial) > 0): ?>
<section class="menu">
    <div class="container">
        <div class="row align-items-center justify-content-between my-2">
            <div class="col-auto menu-heading">
                <h1><?php echo e(trans('labels.todays_special')); ?></h1>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(URL::to('/view-all?type=todayspecial')); ?>" class="btn btn-sm btn-outline-primary"><?php echo e(trans('labels.view_all')); ?></a>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $todayspecial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('web.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- todayspecial Dishes Section End Here -->
<!-- todayspecial Dishes Section Start Here -->
<?php if(count($subscriptions) > 0): ?>
<section class="menu">
    <div class="container">
        <div class="row align-items-center justify-content-between my-2">
            <div class="col-auto menu-heading">
                <h1><?php echo e(trans('labels.subscription_menu')); ?></h1>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(URL::to('/view-all?type=subscription')); ?>" class="btn btn-sm btn-outline-primary"><?php echo e(trans('labels.view_all')); ?></a>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscriptiondata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('web.subscriptionview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- todayspecial Dishes Section End Here -->
<!-- Promotional bannersection2 Start Here -->
<?php if(count($banners['bannersection2']) > 0): ?>
<section class="banner1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div id="bannersection2" class="owl-carousel">
                    <?php $__currentLoopData = $banners['bannersection2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bannerdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="post-slide">
                        <div class="post-img">
                            <?php if($bannerdata['item_info'] != ''): ?>
                            <a href="<?php echo e(URL::to('/item-' . $bannerdata['item_info']->slug)); ?>">
                                <?php elseif($bannerdata['cuisine_info'] != ''): ?>
                                <a href="<?php echo e(URL::to('/menu/?cuisine=' . $bannerdata['cuisine_info']->slug)); ?>">
                                    <?php else: ?>
                                    <a href="javascript:void(0);">
                                        <?php endif; ?>
                                        <img src="<?php echo e($bannerdata['image']); ?>" alt="banner">
                                    </a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Promotional bannersection2 End Here -->
<!-- recommended Section Start Here -->
<?php if(count($recommended) > 0): ?>
<section class="menu">
    <div class="container">
        <div class="row align-items-center justify-content-between my-2">
            <div class="col-auto menu-heading">
                <h1><?php echo e(trans('labels.recommended')); ?></h1>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(URL::to('/view-all?type=recommended')); ?>" class="btn btn-sm btn-outline-primary"><?php echo e(trans('labels.view_all')); ?></a>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $recommended; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('web.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- recommended Section End Here -->
<!-- Promotional bannersection3 Start Here -->
<?php if(count($banners['bannersection3']) > 0): ?>
<section class="banner2 mt-md-5 mt-sm-3 mb-0">
    <div id="banner3" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $__currentLoopData = $banners['bannersection3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bannerdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                <?php if($bannerdata['item_info'] != ''): ?>
                <a href="<?php echo e(URL::to('/item-' . $bannerdata['item_info']->slug)); ?>">
                    <?php elseif($bannerdata['cuisine_info'] != ''): ?>
                    <a href=" <?php echo e(URL::to('/menu/?cuisine=' . $bannerdata['cuisine_info']->slug)); ?> ">
                        <?php else: ?>
                        <a href="javascript:void(0)">
                            <?php endif; ?>
                            <img src="<?php echo e($bannerdata['image']); ?>" height="400" alt="banner3">
                        </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="carousel-control-prev <?php echo e(count($banners['bannersection3']) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#banner3" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php echo e(trans('labels.previous')); ?></span>
        </button>
        <button class="carousel-control-next <?php echo e(count($banners['bannersection3']) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#banner3" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php echo e(trans('labels.next')); ?></span>
        </button>
    </div>
</section>
<?php endif; ?>
<!-- Promotional bannersection3 End Here -->
<!-- Testimonials Section Start Here -->
<?php if(count($testimonials) > 0): ?>
<section>
    <div class="testimonials py-5" style="background: url('<?php echo e(Helper::image_path(@Helper::appdata()->reviews_bg_image)); ?>') center center/cover no-repeat #f3f0e7 !important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto d-flex justify-content-center">
                    <div id="testimonial4" class="carousel slide testimonial4_indicators testimonial4_control_button thumb_scroll_x swipe_x" data-bs-ride="carousel" data-pause="hover" data-interval="1000" data-duration="1000">
                        <div class="carousel-inner" role="listbox">
                            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $testimonialdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                                <div class="testimonial4_slide">
                                    <img src="<?php echo e($testimonialdata['user_info']->profile_image); ?>" class="img-circle img-responsive mx-auto" />
                                    <h4><?php echo e($testimonialdata['user_info']->name); ?></h4>
                                    <div class="review-star">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <span><?php echo e(number_format($testimonialdata->ratting, 1)); ?>/5.0
                                        <?php echo e(trans('labels.reviews')); ?></span>
                                    <p>
                                        <span class="text-primary">"</span>
                                        <?php echo e(Str::limit($testimonialdata->comment, 100)); ?>

                                        <span class="text-primary">"</span>
                                    </p>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Testimonials Section End Here -->
<!-- App Download Section Start Here -->
<?php if(!empty(@Helper::appdata()->mobile_app_image)): ?>
<section>
    <div class="app_download" style="background: url('<?php echo e(Helper::image_path(@Helper::appdata()->mobile_app_bg_image)); ?>') center center/cover no-repeat !important;">
        <div class="container mt-5">
            <div class="row">
                <div class="col-6 d-flex justify-content-center align-items-center app-screen">
                    <img src="<?php echo e(Helper::image_path(@Helper::appdata()->mobile_app_image)); ?>" alt="app-screen">
                </div>
                <div class="col-6 d-flex align-items-center">
                    <div class="app_content">
                        <h1><?php echo e(@Helper::appdata()->mobile_app_title); ?></h1>
                        <span class="text-muted"><?php echo e(@Helper::appdata()->mobile_app_description); ?></span>
                        <div class="my-4 d-flex">
                            <?php if(!@Helper::appdata()->android == ''): ?>
                            <a href="<?php echo e(@Helper::appdata()->android); ?>" target="_blank">
                                <img src="<?php echo e(Helper::web_image_path('playstore.png')); ?>" width="153" height="46" alt="">
                            </a>
                            <?php endif; ?>
                            <?php if(!@Helper::appdata()->ios == ''): ?>
                            <a class="ms-2" href="<?php echo e(@Helper::appdata()->ios); ?>" target="_blank">
                                <img src="<?php echo e(Helper::web_image_path('appstore.svg')); ?>" width="153" height="46" alt="">
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- App Download Section End Here -->
<!-- Table Resrvation Section Start Here -->
<section class="res">
    <div class="reservation" style="background: url('<?php echo e(Helper::image_path(@Helper::appdata()->booknow_bg_image)); ?>') center center/cover no-repeat #f3f0e7 !important;">
        <div class="container">
            <div class="reservation-content px-3">
                <div class="row text-center">
                    <h1><?php echo e(trans('labels.book_table')); ?></h1>
                    <p><?php echo e(trans('labels.make_reservation')); ?></p>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="<?php echo e(route('reservation')); ?>" class="btn btn-primary btn-sm" role="button"><?php echo e(trans('labels.book_now')); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table Resrvation Section End Here -->
<!-- Blog Section Start Here -->
<?php if(count($getblogs) > 0): ?>
<section>
    <div class="blog-wrapper mb-3">
        <div class="container">
            <div class="row align-items-center justify-content-between my-2">
                <div class="col-auto blog-heading">
                    <h1><?php echo e(trans('labels.latest_blogs')); ?></h1>
                </div>
                <div class="col-auto">
                    <a href="<?php echo e(route('blogs')); ?>" class="btn btn-sm btn-outline-primary"><?php echo e(trans('labels.view_all')); ?></a>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $getblogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bloglist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.blogs.blogview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Blog Section End Here -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <!-- JS For Promotional Banner Section 1 -->
    <script>
        $(document).ready(function() {
            $("#news-slider ").owlCarousel({
                rtl: <?php if(session()->get('direction') == 'rtl'): ?>
                    true
                <?php else: ?>
                    false
                <?php endif; ?> ,
                loop: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    400: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    600: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    800: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    1000: {
                        items: 3,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    1200: {
                        items: 3,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    }
                }
            });
        });
    </script>
    <!-- JS For Cuisine Section -->
    <script>
        $(document).ready(function() {
            $("#cuisine").owlCarousel({
                rtl: <?php if(session()->get('direction') == 'rtl'): ?>
                    true
                <?php else: ?>
                    false
                <?php endif; ?> ,
                loop: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                    },
                    400: {
                        items: 3,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 65,
                    },
                    600: {
                        items: 4,
                        nav: false,
                        dots: false,
                        margin: 38,
                    },
                    800: {
                        items: 5,
                        nav: false,
                        dots: false,
                        margin: 45,
                    },
                    1000: {
                        items: 6,
                        dots: false,
                        nav: false,
                        loop: false,
                        arrows: true,
                        margin: 35,
                    },
                }
            });
        });
    </script>
    <!-- JS For Promotional Banner Section 3 -->
    <script>
        $(document).ready(function() {
            $("#bannersection2").owlCarousel({
                rtl: <?php if(session()->get('direction') == 'rtl'): ?>
                    true
                <?php else: ?>
                    false
                <?php endif; ?> ,
                loop: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    400: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    600: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    800: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    1000: {
                        items: 3,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    1200: {
                        items: 4,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/index.blade.php ENDPATH**/ ?>