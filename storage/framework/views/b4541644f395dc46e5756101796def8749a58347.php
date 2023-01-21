<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.my_cart')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.my_cart')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.cart')); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="cart-view my-5">
                <?php if(count($getcartlist) > 0): ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <?php
                                $order_total = 0;
                                $total_item_qty = 0;
                            ?>
                            <?php $__currentLoopData = $getcartlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="text-light err<?php echo e($item['id']); ?>"></span>
                                <div class="order-list mb-4">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-auto d-flex justify-content-center item-img-none">
                                            <div class="item-img">
                                                <img src="<?php echo e(asset('admin-assets/images/item/'.$item->item_image)); ?>" alt="item-image">
                                            </div>
                                        </div>
                                        <div class="col-md-10 col-sm-10 col-auto col-detail">
                                            <div class="row">
                                                <div class="col-md-10 col-sm-10 col-auto">
                                                    <?php
                                                        $addons_id = explode(',', $item['addons_id']);
                                                        $addons_price = explode(',', $item['addons_price']);
                                                        $addons_name = explode(',', $item['addons_name']);
                                                    ?>

                                                    <div class="item-title mb-0">
                                                        <img <?php if($item->item_type == 1): ?> src="<?php echo e(Helper::image_path('veg.svg')); ?>" <?php else: ?> src="<?php echo e(Helper::image_path('nonveg.svg')); ?>" <?php endif; ?>
                                                        width="20" height="20" alt="" class="me-1">
                                                        <?php echo e($item->item_name); ?>

                                                    </div>
                                                        <p class="mb-0">
                                                            <?php if($item['addons_id'] != ''): ?>
                                                            <small><a class="text-muted" href="javascript:void(0)" onclick="showaddons('<?php echo e($item['addons_name']); ?>','<?php echo e($item['addons_price']); ?>')" data-bs-toggle="modal" data-bs-target="#modal_selected_addons"><?php echo e(trans('labels.addons')); ?> <i class="fa-solid fa-angles-right"></i></a></small>
                                                            <?php else: ?>
                                                            <small>-</small>
                                                            <?php endif; ?>
                                                        </p>
                                                        <p class="item-price text-start"><?php echo e(Helper::currency_format($item['item_price'] + $item['addons_total_price'])); ?></p>
                                                    <?php
                                                        $total_price = ($item['item_price'] + $item['addons_total_price']) * $item['qty'];
                                                        $order_total += (float) $total_price;
                                                        $total_item_qty += $item['qty'];
                                                    ?>
                                                </div>
                                                <div
                                                    class="col-md-2 col-sm-2 col-auto d-flex align-items-end justify-content-between flex-column quantity-column">
                                                    <a href="javascript:void(0)"
                                                        onclick="deletecartitem('<?php echo e($item['id']); ?>','<?php echo e(URL::to('/cart/deleteitem')); ?> ') ">
                                                        <i class="fa-solid fa-trash-can text-primary mb-2"></i> </a>
                                                    <div class="item-quantity">
                                                        <button class="btn btn-sm item-quantity-minus"
                                                            onclick="qtyupdate('<?php echo e($item['id']); ?>','minus','<?php echo e(URL::to('/cart/qtyupdate')); ?>')">-</button>
                                                        <input class="item-quantity-input" type="text"
                                                            value="<?php echo e($item['qty']); ?>" readonly />
                                                        <button class="btn btn-sm item-quantity-plus"
                                                            onclick="qtyupdate('<?php echo e($item['id']); ?>','plus','<?php echo e(URL::to('/cart/qtyupdate')); ?>')">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="promocode mb-4 py-4">
                                <div class="row justify-content-between align-items-center mb-2">
                                    <div class="col-auto"><label for="offer_code"><?php echo e(trans('labels.promocode')); ?></label>
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <form action="" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="d-flex">
                                            <input type="hidden" name="order_amount" value="<?php echo e($order_total); ?>">
                                            <input type="text" class="form-control" name="offer_code"
                                                value="<?php echo e(old('offer_code')); ?>" id="offer_code"
                                                placeholder="<?php echo e(trans('labels.have_promocode')); ?>" readonly>
                                            <button type="submit"
                                                class="btn btn-primary bg-primary border-0 ms-2"><?php echo e(trans('labels.apply')); ?></button>
                                        </div>
                                        <?php $__errorArgs = ['offer_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <small class="text-light"><?php echo e($message); ?></small>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </form>
                                </div>
                            </div>
                            <div class="summary py-3 mb-4">
                                <h2 class="border-bottom"><?php echo e(trans('labels.bill_details')); ?></h2>
                                <div class="bill-details border-bottom">
                                    <?php
                                        $grand_total = $order_total;
                                    ?>
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span><?php echo e(trans('labels.order_total')); ?></span></div>
                                        <div class="col-auto">
                                            <p><?php echo e(Helper::currency_format($order_total)); ?></p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span><?php echo e(trans('labels.tax')); ?></span></div>
                                        <div class="col-auto">
                                            <p>0</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bill-total mt-2">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span><?php echo e(trans('labels.grand_total')); ?></span></div>
                                        <div class="col-auto"><span><?php echo e(Helper::currency_format($grand_total)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <a style="color:white!important" href="<?php echo e(URL::to('checkout')); ?>" class="text-muted fs-8 fw-500">
                                    <?php echo e(trans('labels.continue')); ?>

                                </a></button>
                        </div>
                    </div>
                    <?php else: ?>
                    <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- MODAL_SELECTED_ADDONS--START -->
        <div class="modal fade" id="modal_selected_addons" tabindex="-1" aria-labelledby="selected_addons_Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="selected_addons_Label"><?php echo e(trans('labels.selected_addons')); ?></h5>
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-flush"></ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL_SELECTED_ADDONS--END -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url('/web-assets/js/cart/cart.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/cart/cart.blade.php ENDPATH**/ ?>