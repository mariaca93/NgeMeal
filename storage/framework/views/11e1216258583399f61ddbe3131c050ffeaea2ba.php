<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.my_addresses')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.my_addresses')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.my_addresses')); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-3 d-flex">
                    <?php echo $__env->make('web.layout.usersidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-lg-9 d-flex">
                    <div class="user-content-wrapper">
                        <div class="d-flex justify-content-between mb-3">
                            <p class="col-auto mb-0 title"><?php echo e(trans('labels.my_addresses')); ?></p>
                            <a href="<?php echo e(route('add-address')); ?>" class="col-auto btn btn-outline-primary btn-sm"><?php echo e(trans('labels.add_new_address')); ?></a>
                        </div>
                        <?php if(count($getaddresses)>0): ?>
                        <div class="row address-list">
                            <?php $__currentLoopData = $getaddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addressdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6 d-flex">
                                    <div class="address-card w-100">
                                        <div class="col-2 address-icon">
                                            <?php if($addressdata->address_type == 1): ?>
                                                <i class="fa-solid fa-house-chimney"></i>
                                                <?php $address_type_text = trans('labels.home'); ?>
                                            <?php elseif($addressdata->address_type == 2): ?>
                                                <i class="fa-solid fa-briefcase"></i>
                                                <?php $address_type_text = trans('labels.office'); ?>
                                            <?php else: ?>
                                                <i class="fa-solid fa-map-location-dot"></i>
                                                <?php $address_type_text = trans('labels.other'); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-10 address">
                                            <h4 class="d-flex justify-content-between"><?php echo e($address_type_text); ?>

                                                <div class="px-3">
                                                    <a class="text-light" href="javascript:void(0)" onclick="deleteaddress('<?php echo e($addressdata->id); ?>','<?php echo e(URL::to('/address/delete')); ?> ') "><i class="fa-solid fa-trash-can"></i></a>
                                                    <a class="text-info me-1" href="<?php echo e(URL::to('/address-'.$addressdata->id)); ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                </div>
                                            </h4>
                                            <p class="mb-1"><?php echo e($addressdata->address); ?>, </p>
                                            <p class="mb-1"><?php echo e($addressdata->area); ?>, </p>
                                            <p class="mb-1"><?php echo e($addressdata->house_no); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php else: ?>
                            <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(url('resources/views/web/address/address.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/address/index.blade.php ENDPATH**/ ?>