<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.cuisines')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.cuisines')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active">
                            <?php echo e(trans('labels.cuisines')); ?>

                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-3">
            <?php $__currentLoopData = Helper::get_cuisines(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuisinedata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 ">
                    <div class="cuisine-wrapper mx-2">
                        <a href="<?php echo e(URL::to('/menu/?cuisine=' . $cuisinedata->slug)); ?>">
                            <div class="cat rounded-circle mx-auto">
                                <img src="<?php echo e(Helper::image_path($cuisinedata->image)); ?>" class="rounded-circle"
                                    alt="cuisine">
                            </div>
                        </a>
                        <p class="my-2 text-center"><?php echo e($cuisinedata->cuisine_name); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/cuisineviewall.blade.php ENDPATH**/ ?>