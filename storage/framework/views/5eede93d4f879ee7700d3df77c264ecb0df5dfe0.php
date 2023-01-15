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
                                                            <img src="<?php echo e(Helper::image_path('veg.svg')); ?>" class="me-1"
                                                                alt="">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(Helper::image_path('nonveg.svg')); ?>"
                                                                class="me-1" alt="">
                                                        <?php endif; ?>
                                                        <?php echo e($itemdata->item_name); ?>

                                                    </a>
                                                    <?php if($itemdata->is_favorite == 1): ?>
                                                        <a class="heart-icon heart-red <?php echo e(session()->get('direction') == 'rtl' ? 'text-start' : 'text-end'); ?>"
                                                            <?php if(Auth::user() && Auth::user()->type == 2): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($itemdata->id); ?>',0,'<?php echo e(URL::to('/managefavorite')); ?>')" title="<?php echo e(trans('labels.remove_wishlist')); ?>" <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>>
                                                            <i class="fa-solid fa-bookmark fs-5"></i> </a>
                                                    <?php else: ?>
                                                        <a class="heart-icon <?php echo e(session()->get('direction') == 'rtl' ? 'text-start' : 'text-end'); ?>"
                                                            <?php if(Auth::user() && Auth::user()->type == 2): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($itemdata->id); ?>',1,'<?php echo e(URL::to('/managefavorite')); ?>')" title="<?php echo e(trans('labels.add_wishlist')); ?>" <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>>
                                                            <i class="fa-regular fa-bookmark fs-5"></i> </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="row align-items-center justify-content-between gx-0">
                                                    <div class="col-auto">
                                                        <span
                                                            class="white_color fs-8"><?php echo e($itemdata['cuisine_info']->cuisine_name); ?></span>
                                                        <?php
                                                            if ($itemdata->has_variation == 1) {
                                                                foreach ($itemdata['variation'] as $key => $value) {
                                                                    $price = $value->product_price;
                                                                    if ($key == 0) {
                                                                        break;
                                                                    }
                                                                }
                                                            } else {
                                                                $price = $itemdata->price;
                                                            }
                                                        ?>
                                                        <div class="fw-600"><?php echo e(Helper::currency_format($price)); ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <?php if(Auth::user() && Auth::user()->type == 2): ?>
                                                            <?php if($itemdata->is_cart == 1): ?>
                                                                <div class="item-quantity">
                                                                    <button class="btn btn-sm pastel_purple_color fw-500"
                                                                        onclick="removefromcart('<?php echo e(URL::to('/cart')); ?>','<?php echo e(trans('messages.remove_cartitem_note')); ?>','<?php echo e(trans('labels.goto_cart')); ?>')">-</button>
                                                                    <input
                                                                        class="pastel_purple_color fw-500 item-total-qty-<?php echo e($itemdata->slug); ?>"
                                                                        type="text"
                                                                        value="<?php echo e(Helper::get_item_cart($itemdata->id)); ?>"
                                                                        disabled />
                                                                    <?php if($itemdata->addons_id != '' || count($itemdata->variation) > 0): ?>
                                                                        <a class="btn btn-sm pastel_purple_color fw-500"
                                                                            onclick="showitem('<?php echo e($itemdata->slug); ?>','<?php echo e(URL::to('/show-item')); ?>')">+</a>
                                                                    <?php else: ?>
                                                                        <a class="btn btn-sm pastel_purple_color fw-500"
                                                                            onclick="calladdtocart('<?php echo e($itemdata->slug); ?>','<?php echo e($itemdata->item_name); ?>','<?php echo e($itemdata->item_type); ?>','<?php echo e($itemdata['item_image']->image_name); ?>','<?php echo e($itemdata->tax); ?>','<?php echo e($itemdata->price); ?>','','','','','','<?php echo e(URL::to('addtocart')); ?>')">+</a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php else: ?>
                                                                <?php if($itemdata->addons_id != '' || count($itemdata->variation) > 0): ?>
                                                                    <a class="btn btn-sm border pastel_purple_color fw-500 fs-7 text-end"
                                                                        onclick="showitem('<?php echo e($itemdata->slug); ?>','<?php echo e(URL::to('/show-item')); ?>')"><?php echo e(trans('labels.add')); ?></a>
                                                                <?php else: ?>
                                                                    <a class="btn btn-sm border pastel_purple_color fw-500 fs-7 text-end"
                                                                        onclick="calladdtocart('<?php echo e($itemdata->slug); ?>','<?php echo e($itemdata->item_name); ?>','<?php echo e($itemdata->item_type); ?>','<?php echo e($itemdata['item_image']->image_name); ?>','<?php echo e($itemdata->tax); ?>','<?php echo e($itemdata->price); ?>','','','','','','<?php echo e(URL::to('addtocart')); ?>')"><?php echo e(trans('labels.add')); ?></a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <a class="btn btn-sm border pastel_purple_color fw-500 fs-7 text-end"
                                                                href="<?php echo e(URL::to('/login')); ?>"><?php echo e(trans('labels.add')); ?></a>
                                                        <?php endif; ?>
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

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/favoritelist.blade.php ENDPATH**/ ?>