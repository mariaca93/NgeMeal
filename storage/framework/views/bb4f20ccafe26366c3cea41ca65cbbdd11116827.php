<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.favourite_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.favourite_list')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.favourite_list')); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-3">
                    <?php echo $__env->make('web.layout.usersidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-lg-9 d-flex">
                    <div class="user-content-wrapper">
                        <p class="title"><?php echo e(trans('labels.favourite_list')); ?></p>
                        <?php if(count($getfavoritelist) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover favouritelist">
                                    <?php $__currentLoopData = $getfavoritelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="item-image">
                                                <img src="<?php echo e($itemdata['item_image']->image_url); ?>" class="hw-70">
                                            </td>
                                            <td>
                                                <div class="item-title">
                                                    <a href="<?php echo e(URL::to('item-' . $itemdata->slug)); ?>"
                                                        class="fw-500 dark_color text-break">
                                                        <?php if($itemdata->item_type == 1): ?>
                                                            <img style="width:20px" src="<?php echo e(Helper::image_path('veg.svg')); ?>" class="me-1"
                                                                alt="">
                                                        <?php else: ?>
                                                            <img style="width:20px" src="<?php echo e(Helper::image_path('nonveg.svg')); ?>"
                                                                class="me-1" alt="">
                                                        <?php endif; ?>
                                                        <?php echo e($itemdata->item_name); ?>

                                                    </a>
                                                    <?php if($itemdata->is_favorite == 1): ?>
                                                        <a class="heart-icon heart-red <?php echo e(session()->get('direction') == 'rtl' ? 'text-start' : 'text-end'); ?>"
                                                            <?php if(Auth::user()): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($itemdata->id); ?>',0,'<?php echo e(URL::to('/managefavorite')); ?>')" title="<?php echo e(trans('labels.remove_wishlist')); ?>" <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>>
                                                            
                                                            <img src="<?php echo e(Helper::image_path('bookmark.png')); ?>" width="15" height="15" alt="">
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="heart-icon <?php echo e(session()->get('direction') == 'rtl' ? 'text-start' : 'text-end'); ?>"
                                                            <?php if(Auth::user()): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($itemdata->id); ?>',1,'<?php echo e(URL::to('/managefavorite')); ?>')" title="<?php echo e(trans('labels.add_wishlist')); ?>" <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>>
                                                            
                                                            <img src="<?php echo e(Helper::image_path('bookmark.png')); ?>" width="15" height="15" alt="">
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="row align-items-center justify-content-between gx-0">
                                                    <div class="col-auto">
                                                        <span style= "color:black"
                                                            class="fs-8"><?php echo e($itemdata['cuisine_info']->cuisine_name); ?></span>
                                                        <?php
                                                            $price = $itemdata->price;
                                                        ?>
                                                        <div style= "color:black" class="fw-600"><?php echo e(Helper::currency_format($price)); ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                            <div class="mt-2 d-flex justify-content-center">
                                <?php echo e($getfavoritelist->links()); ?>

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

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Christanto\Desktop\Materi\Project Skripsi\NgeMeal\resources\views/web/favoritelist.blade.php ENDPATH**/ ?>