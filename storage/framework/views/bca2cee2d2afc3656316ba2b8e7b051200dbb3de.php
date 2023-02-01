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
                    <h5 style="font-size:10rem;font-family:'bebas neue', cursive"><?php echo e($sliderdata->title); ?></h5>
                    <p style="position: absolute;z-index:100;font-family:'homemade apple', cursive"><?php echo e($sliderdata->description); ?></p>
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

<form hidden name="formSubmit" method="GET" action="<?php echo e(URL::to('home')); ?>">
    <input hidden name="longitude" id="longitude" value="">
    <input hidden name="latitude" id="latitude" value="">
<button hidden id="btnSubmit" type="submit"></button>
</form>

<script>
    geoFindMe();
    setTimeout(function() {

        if(document.cookie.indexOf('weather') == -1 ){
            var lat = document.getElementById('latitude').value;
            var long = document.getElementById('longitude').value;
            document.cookie = 'weather=loaded;max-age=600';
            var text = "Allow location access for weather reccomendation?";
            if (confirm(text) == true) {
                document.getElementById('btnSubmit').click();
            }
        }
    },5000);
    function geoFindMe() {

        function success(position) {
            const latitude  = position.coords.latitude;
            const longitude = position.coords.longitude;
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
                <h1><?php echo e(trans('labels.alacarte')); ?></h1>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(URL::to('/view-all?type=alacarte')); ?>" class="btn btn-sm btn-outline-primary"><?php echo e(trans('labels.view_all')); ?></a>
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&<?php echo e(@Helper::appdata()->map != 'map_key' ? 'key=' . @Helper::appdata()->map : ''); ?>">
    </script>

    <script>
        var geocoder;
        var map;
        var marker;
        var infowindow = new google.maps.InfoWindow({
            size: new google.maps.Size(150, 50)
        });

        function initialize() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((showPosition) => {
                    geocoder = new google.maps.Geocoder();
                    create_map(showPosition.coords.latitude, showPosition.coords.longitude)
                    // to-change-marker-on-typing-address --> START
                    var input = document.getElementById('address');
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    google.maps.event.addListener(autocomplete, 'place_changed', function() {
                        var place = autocomplete.getPlace();
                        $('#lat').val(place.geometry.location.lat());
                        $('#lang').val(place.geometry.location.lng());
                        create_map(place.geometry.location.lat(), place.geometry.location.lng());
                    });
                    // to-change-marker-on-typing-address --> END
                }, (showError) => {
                    $('#mymap').hide();
                    $('#address').hide();
                });
            } else {
                $('.err').html("Geolocation is not supported by this browser.");
            }
        }

        function create_map(lat, lang) {
            var latlng = new google.maps.LatLng(lat, lang);
            var default_address = $('#address').val();
            var mapOptions = {
                zoom: 15,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById('mymap'), mapOptions);
            google.maps.event.addListener(map, 'click', function() {
                infowindow.close();
            });
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: latlng
            });
            if ("<?php echo e(env('Environment')); ?>" != "sendbox") {
                google.maps.event.addListener(marker, 'dragend', function() {
                    $('#lat').val(this.getPosition().lat());
                    $('#lang').val(this.getPosition().lng());
                    geocodePosition(marker.getPosition());
                });
                google.maps.event.addListener(map, 'dragend', function() {
                    $('#lat').val(this.getCenter().lat());
                    $('#lang').val(this.getCenter().lng());
                    marker.setPosition(this.getCenter());
                    geocodePosition(this.getCenter());
                });
                google.maps.event.addListener(marker, 'click', function() {
                    marker.setPosition(this.getPosition());
                    geocodePosition(this.getPosition());
                    $('#lat').val(this.getPosition().lat());
                    $('#lang').val(this.getPosition().lng());
                });
                google.maps.event.trigger(marker, 'click');
            }
        }

        function geocodePosition(pos) {
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                    marker.formatted_address = responses[0].formatted_address;
                    $('#address').val(marker.formatted_address);
                } else {
                    marker.formatted_address = 'Cannot determine address at this location.';
                }
                default_address = marker.formatted_address
                infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition()
                    .toUrlValue(6));
                infowindow.open(map, marker);
            });
        }
        google.maps.event.addDomListener(window, "load", initialize);
    </script>

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

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Christanto\Desktop\Materi\Project Skripsi\NgeMeal\resources\views/web/index.blade.php ENDPATH**/ ?>