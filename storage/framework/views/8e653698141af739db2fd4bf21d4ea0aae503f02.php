<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.view_all')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(isset($_GET['type']) && $_GET['type'] != ''): ?>
        <div class="breadcrumb-sec">
            <div class="container">
                <div class="breadcrumb-sec-content">
                    <?php
                        $type = $_GET['type'];
                        if ($_GET['type'] == 'topitems') {
                            $title = trans('labels.trending');
                        } elseif ($_GET['type'] == 'todayspecial') {
                            $title = trans('labels.todays_special');
                        } elseif ($_GET['type'] == 'recommended') {
                            $title = trans('labels.recommended');
                        } else {
                            $title = '';
                        }
                    ?>
                    <h1><?php echo e($title); ?></h1>
                    <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li
                                class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                                <a class="text-muted" href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                            </li>
                            <li
                                class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active">
                                <?php echo e($title); ?>

                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="menu-section menu-section-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="sub-cat-tab food-type d-flex justify-content-center">
                        <nav class="nav nav-pills m-auto justify-content-center veg align-items-baseline">
                            <a class="nav-link px-3 mx-2 <?php if(isset($_GET['filter']) && $_GET['filter'] == 'veg'): ?> active-cat <?php else: ?> border <?php endif; ?>"
                                <?php if(isset($_GET['filter']) && $_GET['filter'] == 'veg'): ?> href="<?php echo e(URL::to('/view-all?type=' . @$type)); ?>"
                                <?php else: ?>
                                    href="<?php echo e(URL::to('/view-all?type=' . @$type . '&filter=veg')); ?>" <?php endif; ?>>
                                <img src="<?php echo e(Helper::image_path('veg.svg')); ?>" class="pe-1"
                                    alt=""><?php echo e(trans('labels.veg')); ?>

                            </a>
                            <a class="nav-link px-3 mx-2 <?php if(isset($_GET['filter']) && $_GET['filter'] == 'nonveg'): ?> active-cat <?php else: ?> border <?php endif; ?>"
                                <?php if(isset($_GET['filter']) && $_GET['filter'] == 'nonveg'): ?> href="<?php echo e(URL::to('/view-all?type=' . @$type)); ?>"
                                <?php else: ?>
                                    href="<?php echo e(URL::to('/view-all?type=' . @$type . '&filter=nonveg')); ?>" <?php endif; ?>>
                                <img src="<?php echo e(Helper::image_path('nonveg.svg')); ?>" class="pe-1"
                                    alt=""><?php echo e(trans('labels.nonveg')); ?>

                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="container my-5">
        <div class="row mb-5">
            <div class="menu my-0">
                <?php if(count($getsearchitems) > 0): ?>
                    <div class="row">
                        <?php $__currentLoopData = $getsearchitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="mt-5 d-flex justify-content-center">
                        <?php echo e($getsearchitems->appends(request()->query())->links()); ?>

                    </div>
                <?php else: ?>
                    <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/viewall.blade.php ENDPATH**/ ?>