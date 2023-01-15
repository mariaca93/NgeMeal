<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.checkout')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.checkout')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.checkout')); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <?php if(count($getcartlist) > 0): ?>
        <?php
            $totaltax = 0;
            $totaltaxamount = 0;
            $order_total = 0;
            $total_item_qty = 0;
        ?>
        <?php $__currentLoopData = $getcartlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $tax = ($item['item_price'] * $item['qty'] * $item['tax']) / 100;
                $total_price = ($item['item_price'] + $item['addons_total_price']) * $item['qty'];
                $totaltaxamount += (float) $tax;
                $order_total += (float) $total_price;
                $total_item_qty += $item['qty'];
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <section>
            <div class="container">
                <div class="cart-view my-5">
                    <div class="row">
                        
                        <div class="col-lg-8 order-md2">
                            <?php if(session()->get('order_type') == 1): ?>
                                <div class="checkout-view p-4 mb-3">
                                    <div class="heading mb-2">
                                        <h2><?php echo e(trans('labels.select_address')); ?></h2>
                                    </div>
                                    <div class="addresserror alert alert-danger my-2 py-1 d-none">
                                        <?php echo e(trans('messages.select_address')); ?></div>
                                    <div class="row address-list">
                                        <?php $__currentLoopData = $getaddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $addressdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-6 d-flex">
                                                <input type="radio" name="myaddress" class="d-none"
                                                    value="<?php echo e($addressdata->id); ?>" id="rad<?php echo e($addressdata->id); ?>"
                                                    data-address-type="<?php echo e($addressdata->address_type); ?>"
                                                    address="<?php echo e($addressdata->address); ?>"
                                                    house_no="<?php echo e($addressdata->house_no); ?>"
                                                    area="<?php echo e($addressdata->area); ?>" lat="<?php echo e($addressdata->lat); ?>"
                                                    lang="<?php echo e($addressdata->lang); ?>" data-url="<?php echo e(URL::to('/checkdeliveryzone')); ?>" <?php echo e($key == 0 ? 'checked' : ''); ?>>
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
                                                    <div class="col-10 address pe-3">
                                                        <h4><?php echo e($address_type_text); ?></h4>
                                                        <p><?php echo e($addressdata->address); ?>, <?php echo e($addressdata->area); ?>, <?php echo e($addressdata->house_no); ?></p>
                                                        <label class="btn btn-sm btn-success border-0 text-uppercase" for="rad<?php echo e($addressdata->id); ?>"><?php echo e(trans('labels.deliver_here')); ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div
                                                class="address-card border-dashed d-flex justify-content-center align-items-center text-center w-100">
                                                <div class="address">
                                                    <h4><?php echo e(trans('labels.add_new_address')); ?></h4>
                                                    <a class="btn btn-outline-success text-uppercase btn-sm"
                                                        href="<?php echo e(URL::to('/address/add')); ?>"><?php echo e(trans('labels.add_new')); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="payment-option mb-3">
                                <div class="heading mb-2">
                                    <h2><?php echo e(trans('labels.choose_payment')); ?></h2>
                                </div>
                                
                                <?php echo $__env->make('web.paymentmethodsview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="d-flex justify-content-center mt-4">
                                    <button class="btn btn-primary"
                                        onclick="isopenclose('<?php echo e(URL::to('/isopenclose')); ?>','<?php echo e($total_item_qty); ?>','<?php echo e($order_total); ?>')"><?php echo e(trans('labels.proceed_pay')); ?></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 order-md1">
                            
                            <div class="summary py-3 mb-4">
                                <h2 class="border-bottom"><?php echo e(trans('labels.payment_summary')); ?></h2>
                                <div class="bill-details border-bottom">
                                    <?php
                                        if (session()->has('discount_data')) {
                                            $discount_amount = session()->get('discount_data')['offer_amount'];
                                        } else {
                                            $discount_amount = 0;
                                        }
                                        $grand_total = $order_total - $discount_amount + $totaltaxamount;
                                    ?>
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span><?php echo e(trans('labels.subtotal')); ?></span></div>
                                        <div class="col-auto">
                                            <p><?php echo e(Helper::currency_format($order_total)); ?></p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span><?php echo e(trans('labels.tax')); ?></span></div>
                                        <div class="col-auto">
                                            <p><?php echo e(Helper::currency_format($totaltaxamount)); ?></p>
                                        </div>
                                    </div>
                                    <?php if(session()->has('discount_data')): ?>
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto"><span><?php echo e(trans('labels.discount')); ?>

                                                <?php echo e(session()->has('discount_data') == true ? '(' . session()->get('discount_data')['offer_code'] . ')' : ''); ?>

                                            </span></div>
                                            <div class="col-auto">
                                                <p>- <?php echo e(Helper::currency_format($discount_amount)); ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(session()->get('order_type') == 1): ?>
                                        <?php $delivery_charge = 0; ?>
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto"><span><?php echo e(trans('labels.delivery_charge')); ?></span>
                                            </div>
                                            <div class="col-auto">
                                                <p class="delivery_charge"><?php echo e(Helper::currency_format($delivery_charge)); ?></p>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php $delivery_charge = 0; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="bill-total mt-2">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span><?php echo e(trans('labels.grand_total')); ?></span></div>
                                        <div class="col-auto"><span class="grand_total"><?php echo e(Helper::currency_format($grand_total)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="special-instruction py-3 mb-3">
                                <label class="form-label mb-2"
                                    for="order_notes"><?php echo e(trans('labels.special_instruction')); ?></label>
                                <textarea class="form-control" name="order_notes" id="order_notes" rows="3"
                                    placeholder="<?php echo e(trans('labels.special_instruction')); ?>"></textarea>
                            </div>
                            <a href="<?php echo e(URL::to('/')); ?>" class="continue-shopping mb-3"><i class="fa-solid fa-circle-arrow-left me-2"></i><?php echo e(trans('labels.continue_shopping')); ?></a>
                        </div>
                    </div>
                    
                    <input type="hidden" name="order_type" id="order_type" value="<?php echo e(session()->get('order_type')); ?>">
                    
                    <input type="hidden" name="grand_total" id="grand_total" value="<?php echo e($grand_total); ?>">
                    
                    <input type="hidden" name="totaltaxamount" id="totaltaxamount" value="<?php echo e($totaltaxamount); ?>">
                    
                    <input type="hidden" name="delivery_charge" id="delivery_charge" value="<?php echo e($delivery_charge); ?>">
                    <input type="hidden" name="user_name" id="user_name" value="<?php echo e(Auth::user()->name); ?>">
                    <input type="hidden" name="user_email" id="user_email" value="<?php echo e(Auth::user()->email); ?>">
                    <input type="hidden" name="user_mobile" id="user_mobile" value="<?php echo e(Auth::user()->mobile); ?>">
                    <input type="hidden" name="rest_lat" id="rest_lat" value="<?php echo e(@Helper::appdata()->lat); ?>">
                    <input type="hidden" name="rest_lang" id="rest_lang" value="<?php echo e(@Helper::appdata()->lang); ?>">
                    <input type="hidden" name="delivery_charge_per_km" id="delivery_charge_per_km" value="<?php echo e(@Helper::appdata()->delivery_charge); ?>">
                    <input type="hidden" name="orderurl" id="orderurl" value="<?php echo e(URL::to('placeorder')); ?>">
                    <input type="hidden" name="successurl" id="successurl" value="<?php echo e(URL::to('/orders')); ?>">
                    <input type="hidden" name="continueurl" id="continueurl" value="<?php echo e(URL::to('/')); ?>">
                    <input type="hidden" name="environment" id="environment" value="<?php echo e(env('Environment')); ?>">
                </div>
            </div>
        </section>
    <?php else: ?>
        <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="<?php echo e(url('/web-assets/js/checkout/checkout.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/checkout/checkout.blade.php ENDPATH**/ ?>