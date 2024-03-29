<!-- Back to Top Button Start Here -->
<div id="back-to-top">
    <a class="btn text-primary">
        <i class="fa-solid fa-angle-up"></i>
    </a>
</div>
<!-- Back to Top Button End Here -->
<!-- Footer Start Here -->
<footer>
    <div class="container" style="padding:15px 0px">
        <div class="row justify-content-center mb-4">
            <?php $__currentLoopData = Helper::footer_features(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                <div class="quality">
                    <div class="quality-wrapper d-flex align-items-center">
                        <div class="quality-icon px-3">
                            <?php echo $feature->icon; ?>

                        </div>
                        <div class="quality-content">
                            <h3><?php echo e($feature->title); ?></h3>
                            <p><?php echo e($feature->description); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="footer" style="background : linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('<?php echo e(Helper::image_path(@Helper::appdata()->footer_bg_image)); ?>')
     center center/cover no-repeat rgba(0, 0, 0, .6) !important;">
        <div class="container">
            <div class="row footer-area border-bottom-primary">
                <div class="col-lg-4 col-md-4 col-sm-4 col-auto left-side mt-3">
                    <a href="<?php echo e(route('home')); ?>">
                        <img src="<?php echo e(Helper::image_path(@Helper::appdata()->logo)); ?>" width="75" class="my-3" alt="footer_logo">
                    </a>
                    <h1><?php echo e(@Helper::appdata()->footer_title); ?></h1>
                    <p style="color:white!important"><?php echo e(@Helper::appdata()->footer_description); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-auto right-side">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-auto mb-2">
                            <h4><?php echo e(trans('labels.about_us')); ?></h4>
                            <ul>
                                <li><a href="" class="text-white"><?php echo e(trans('labels.about')); ?></a></li>
                                <li><a href="" class="text-white"><?php echo e(trans('labels.our_team')); ?></a></li>
                                <li><a href="" class="text-white"><?php echo e(trans('labels.testimonials')); ?></a></li>
                                <li><a href="" class="text-white"><?php echo e(trans('labels.todays_special')); ?></a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-4 col-auto mb-2">
                            <h4><?php echo e(trans('labels.legal')); ?></h4>
                            <ul>
                                <li><a href="" class="text-white"><?php echo e(trans('labels.privacy_policy')); ?></a></li>
                                <li><a href="" class="text-white"><?php echo e(trans('labels.terms_condition')); ?></a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-4 col-auto mb-2">
                            <h4><?php echo e(trans('labels.other_pages')); ?></h4>
                            <ul>
                                <li>
                                    <a href="<?php echo e(route('faq')); ?>" class="text-white"><?php echo e(trans('labels.faq')); ?></a>
                                </li>
                                <li>
                                    <a href="" class="text-white"><?php echo e(trans('labels.gallery')); ?></a>
                                </li>
                                <li>
                                    <a href="" class="text-white"><?php echo e(trans('labels.help_contact_us')); ?></a>
                                </li>
                                </li>
                                <li>
                                    <a href="" class="text-white"><?php echo e(trans('labels.blogs')); ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="my-4 d-flex">
                        <?php if(!Helper::appdata()->android == ''): ?>
                            <a href="<?php echo e(Helper::appdata()->android); ?>" target="_blank">
                                <img src="<?php echo e(Helper::web_image_path('playstore.png')); ?>" width="153" height="46" alt="">
                            </a>
                        <?php endif; ?>
                        <?php if(!Helper::appdata()->ios == ''): ?>
                            <a class="<?php echo e(session()->get('direction') == "rtl" ? 'me-2' : 'ms-2'); ?>" href="<?php echo e(Helper::appdata()->ios); ?>" target="_blank">
                                <img src="<?php echo e(Helper::web_image_path('appstore.svg')); ?>" width="153" height="46" alt="">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <p class="text-white my-3"><?php echo e(Helper::appdata()->copyright); ?></p>
        </div>
    </div>
</footer>
<!-- Footer End here -->
<?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/layout/footer.blade.php ENDPATH**/ ?>