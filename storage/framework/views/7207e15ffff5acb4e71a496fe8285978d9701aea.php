<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.order_details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.order_details')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.order_details')); ?></li>
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
                <div class="col-lg-9">
                    <div class="user-content-wrapper">
                        <p class=""><?php echo e(trans('labels.order_details')); ?>

                            <?php if($orderdata->status == 1): ?>
                                <a class="btn btn-danger btn-sm mx-1 float-end" href="javascript:void(0)" onclick="cancelorder('<?php echo e($orderdata->order_number); ?>','<?php echo e(URL::to('/orders/cancel')); ?>')">
                                    <i class="fa-regular fa-trash-can"></i>
                                    <?php echo e(trans('labels.cancel_order')); ?>

                                </a>
                            <?php endif; ?>
                        </p>
                        <div class="progress-barrr">
                            <?php if(in_array($orderdata->status, [6, 7])): ?>
                            <div class="progress-step is-active">
                                <div class="step-count"><i class="fa fa-close"></i></div>
                                <div class="step-description">
                                    <?php echo e($orderdata->status == '6' ? trans('labels.cancel_by_admin') : trans('labels.cancel_by_you')); ?>

                                </div>
                            </div>
                            <?php else: ?>
                            <?php if(!in_array($orderdata->status, [1, 2, 3, 4, 5])): ?>
                            <div class="progress-step <?php echo e(session()->get('direction') == 'rtl' ? 'progress-step-rtl' : ''); ?> is-active">
                                <div class="step-count"><i class="fa fa-exclamation-triangle"></i></div>
                                <div class="step-description"><?php echo e(trans('messages.wrong')); ?></div>
                            </div>
                            <?php else: ?>
                            <div class="progress-step <?php echo e(session()->get('direction') == 'rtl' ? 'progress-step-rtl' : ''); ?> <?php if($orderdata->status == '1'): ?> is-active <?php endif; ?>">
                                <div class="step-count"><i class="fa fa-bell"></i></div>
                                <div class="step-description"><?php echo e(trans('labels.placed')); ?></div>
                            </div>
                            <div class="progress-step <?php echo e(session()->get('direction') == 'rtl' ? 'progress-step-rtl' : ''); ?> <?php if($orderdata->status == '2'): ?> is-active <?php endif; ?>">
                                <div class="step-count"><i class="fa fa-tasks"></i></div>
                                <div class="step-description"><?php echo e(trans('labels.preparing')); ?></div>
                            </div>
                            <?php if($orderdata->order_from != 'pos'): ?>
                            <div class="progress-step <?php echo e(session()->get('direction') == 'rtl' ? 'progress-step-rtl' : ''); ?> <?php if($orderdata->status == '3'): ?> is-active <?php endif; ?>">
                                <div class="step-count"><i class="fa fa-thumbs-up"></i></div>
                                <div class="step-description"><?php echo e(trans('labels.ready')); ?></div>
                            </div>
                            <div class="progress-step <?php echo e(session()->get('direction') == 'rtl' ? 'progress-step-rtl' : ''); ?> <?php if($orderdata->status == '4'): ?> is-active <?php endif; ?>">
                                <?php if($orderdata->order_type == 2): ?>
                                <div class="step-count"><i class="fa fa-hourglass"></i></div>
                                <div class="step-description"><?php echo e(trans('labels.waiting_pickup')); ?></div>
                                <?php else: ?>
                                <div class="step-count"><i class="fa fa-user"></i></div>
                                <div class="step-description"><?php echo e(trans('labels.on_the_way')); ?>

                                    <br><?php echo e($orderdata['driver_info'] != '' ? '[' . $orderdata['driver_info']->name . ']' : ''); ?>

                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            <div class="progress-step <?php echo e(session()->get('direction') == 'rtl' ? 'progress-step-rtl' : ''); ?> <?php if($orderdata->status == '5'): ?> is-active <?php endif; ?>">
                                <div class="step-count"><i class="fa fa-check"></i></div>
                                <div class="step-description"><?php echo e(trans('labels.completed')); ?></div>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-start mb-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    <span class="fw-600">  <?php echo e(trans('labels.order_number')); ?> : </span>
                                    <span class="text-break"><?php echo e($orderdata->order_number); ?></span>
                                </li>
                                <li class="list-group-item px-0">
                                    <span class="fw-600">  <?php echo e(trans('labels.order_type')); ?> : </span>
                                    <span class="text-break"><?php echo e($orderdata->order_type == '1' ? trans('labels.delivery') : trans('labels.pickup')); ?></span>
                                </li>
                                <li class="list-group-item px-0">
                                    <span class="fw-600">  <?php echo e(trans('labels.payment_type')); ?> : </span>
                                    <span class="text-break">
                                        <?php if($orderdata->transaction_type == 1): ?>
                                            <?php echo e(trans('labels.cash')); ?>

                                        <?php elseif($orderdata->transaction_type == 2): ?>
                                            <?php echo e(trans('labels.wallet')); ?>

                                        <?php elseif($orderdata->transaction_type == 3): ?>
                                            <?php echo e(trans('labels.razorpay')); ?>

                                        <?php elseif($orderdata->transaction_type == 4): ?>
                                            <?php echo e(trans('labels.stripe')); ?>

                                        <?php elseif($orderdata->transaction_type == 5): ?>
                                            <?php echo e(trans('labels.flutterwave')); ?>

                                        <?php elseif($orderdata->transaction_type == 6): ?>
                                            <?php echo e(trans('labels.paystack')); ?>

                                        <?php else: ?>
                                        --
                                        <?php endif; ?>
                                        <?php if(!in_array($orderdata->transaction_type, [1, 2])): ?> [<?php echo e($orderdata->transaction_id); ?>] <?php endif; ?>
                                </span>
                                </li>
                                 <?php if($orderdata->order_notes != ''): ?>
                                <li class="list-group-item px-0">
                                    <span class="fw-600">  <?php echo e(trans('labels.order_note')); ?> : </span>
                                    <span class="text-break"><?php echo e($orderdata->order_notes); ?></span>
                                </li>
                                <?php endif; ?>
                                 <?php if($orderdata->order_type == 1): ?>
                                <li class="list-group-item px-0">
                                    <span class="fw-600">  <?php echo e(trans('labels.delivery_address')); ?> : </span>
                                    <span class="text-break"><?php echo e($orderdata->address); ?>, <?php echo e($orderdata->area); ?>, <?php echo e($orderdata->house_no); ?></span>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(trans('labels.image')); ?></th>
                                        <th><?php echo e(trans('labels.item')); ?></th>
                                        <th class="text-end"><?php echo e(trans('labels.unit_cost')); ?></th>
                                        <th class="text-end"><?php echo e(trans('labels.qty')); ?></th>
                                        <th class="text-end"><?php echo e(trans('labels.subtotal')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $data = array();
                                foreach ($ordersdetails as $orders) {
                                    $total_price = ($orders['item_price'] + $orders['addons_total_price']) * $orders['qty'];
                                    $data[] = array("total_price" => $total_price,);
                                ?>
                                    <tr>
                                        <td><img src="<?php echo e(URL::to('admin-assets/images/item/'. $orders->item_image)); ?>" class="rounded hw-50" alt=""></td>
                                        <td>
                                            <img <?php if($orders['item_type']==1): ?> src="<?php echo e(Helper::image_path('veg.svg')); ?>" <?php else: ?> src="<?php echo e(Helper::image_path('nonveg.svg')); ?>" <?php endif; ?> class="item-type-img" alt="" style="width:20px">
                                            <?php echo e($orders->item_name); ?> <?php if($orders->variation != ''): ?>
                                            [<?php echo e($orders->variation); ?>]
                                            <?php endif; ?> <br>
                                            <?php
                                            $addons_id = explode(',', $orders->addons_id);
                                            $addons_name = explode(',', $orders->addons_name);
                                            $addons_price = explode(',', $orders->addons_price);
                                            $addonstotal = $orders->addons_total_price;
                                            ?>
                                            <?php if($orders->addons_id != ''): ?>
                                                <small class="text-muted">
                                                    <?php $__currentLoopData = $addons_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo e($addons_name[$key]); ?>

                                                        <?php echo e($key < count($addons_id) - 1 ? ',' : ''); ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </small>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end"><?php echo e(Helper::currency_format($orders->item_price)); ?>

                                            <?php if($addonstotal != '0'): ?>
                                                <br><small class="text-muted">+ <?php echo e(Helper::currency_format($addonstotal)); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end"><?php echo e($orders->qty); ?></td>
                                        <td class="text-end"><?php echo e(Helper::currency_format($total_price)); ?></td>
                                    </tr>
                                <?php
                                }
                                $order_total = array_sum(array_column(@$data, 'total_price'));
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="col-md-4 col-12">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="fw-600"> <?php echo e(trans('labels.order_total')); ?> </span>
                                        <span class="text-break"><?php echo e(Helper::currency_format($order_total)); ?></span>
                                    </li>
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="fw-600"> <?php echo e(trans('labels.tax')); ?> </span>
                                        <span class="text-break"><?php echo e(Helper::currency_format($orderdata->tax_amount)); ?></span>
                                    </li>
                                    <?php if($orderdata->discount_amount > 0): ?>   
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="fw-600"> <?php echo e(trans('labels.discount')); ?> <?php echo e($orderdata->offer_code != '' ? '(' . $orderdata->offer_code . ')' : ''); ?> </span>
                                        <span class="text-break">- <?php echo e(Helper::currency_format($orderdata->discount_amount)); ?></span>
                                    </li>
                                    <?php endif; ?>
                                    <?php if($orderdata->order_type == 1): ?>   
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="fw-600"> <?php echo e(trans('labels.delivery_charge')); ?> </span>
                                        <span class="text-break"><?php echo e(Helper::currency_format($orderdata->delivery_charge)); ?></span>
                                    </li>
                                    <?php endif; ?>
                                    <li class="list-group-item px-0 d-flex justify-content-between">
                                        <span class="fw-600 white_color"> <?php echo e(trans('labels.grand_total')); ?> </span>
                                        <span class="fw-600 white_color text-break"><?php echo e(Helper::currency_format($orderdata->grand_total)); ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(url('/web-assets/js/orders/orders.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/orders/orderdetails.blade.php ENDPATH**/ ?>