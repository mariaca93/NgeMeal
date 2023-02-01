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
                                    
                                    <img src="<?php echo e(Helper::image_path('delete.png')); ?>" width="15" height="15" alt="">
                                    <?php echo e(trans('labels.cancel_order')); ?>

                                </a>
                            <?php endif; ?>
                        </p>
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

                                        <?php elseif($orderdata->transaction_type == 4): ?>
                                            <?php echo e(trans('labels.visa')); ?>

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
                            <table class="table" style="color:black">
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
                                            <?php echo e($orders->item_name); ?>

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
                                        <span class="text-break">0</span>
                                    </li>
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

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Christanto\Desktop\Materi\Project Skripsi\NgeMeal\resources\views/web/orders/orderdetails.blade.php ENDPATH**/ ?>