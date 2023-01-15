<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.my_orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.my_orders')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.my_orders')); ?></li>
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
                        <p class="title"><?php echo e(trans('labels.my_orders')); ?></p>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <a href="<?php echo e(URL::to('/orders?type=processing')); ?>"
                                    class="order-status-card <?php echo e(isset($_GET['type']) == true ? ($_GET['type'] == 'processing' || $_GET['type'] == '' ? 'border-warning' : '') : (!isset($_GET['type']) == true ? 'border-warning' : '')); ?>">
                                    <div class="icon bg-light-warning">
                                        <i class="fs-5 fa-solid fa-hourglass-empty"></i>
                                    </div>
                                    <div class="status-card-content px-3">
                                        <p class="text-warning"><?php echo e(trans('labels.processing')); ?></p>
                                        <h5 class="mb-0 fw-600"><?php echo e($totalprocessing); ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="<?php echo e(URL::to('/orders?type=completed')); ?>"
                                    class="order-status-card <?php echo e(isset($_GET['type']) == true ? ($_GET['type'] == 'completed' ? 'border-green' : '') : ''); ?>">
                                    <div class="icon bg-light-green">
                                        <i class="fs-5 fa-solid fa-check"></i>
                                    </div>
                                    <div class="status-card-content px-3">
                                        <p class="green_color"><?php echo e(trans('labels.completed')); ?></p>
                                        <h5 class="mb-0 fw-600"><?php echo e($totalcompleted); ?></h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="<?php echo e(URL::to('/orders?type=cancelled')); ?>"
                                    class="order-status-card <?php echo e(isset($_GET['type']) == true ? ($_GET['type'] == 'cancelled' ? 'border-danger' : '') : ''); ?>">
                                    <div class="icon bg-light-danger">
                                        <i class="fs-5 fa-solid fa-xmark"></i>
                                    </div>
                                    <div class="status-card-content px-3">
                                        <p class="red_color"><?php echo e(trans('labels.cancelled')); ?></p>
                                        <h5 class="mb-0 fw-600"><?php echo e($totalcancelled); ?></h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php if(count($getorders)>0): ?>
                        <div class="row mb-3">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="rounded-top" style="color:black">
                                        <tr class="bg-light align-middle">
                                            <th class="fs-7 fw-600"><?php echo e(trans('labels.order_number')); ?></th>
                                            <th class="fs-7 fw-600"><?php echo e(trans('labels.date')); ?></th>
                                            <th class="fs-7 fw-600"><?php echo e(trans('labels.order_type')); ?></th>
                                            <th class="fs-7 fw-600"><?php echo e(trans('labels.order_amount')); ?></th>
                                            <th class="fs-7 fw-600"><?php echo e(trans('labels.payment_type')); ?></th>
                                            <th class="fs-7 fw-600"><?php echo e(trans('labels.status')); ?></th>
                                            <th class="fs-7 fw-600"><?php echo e(trans('labels.action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="rounded-bottom" style="color:#A99EBE">
                                        <?php $__currentLoopData = $getorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="align-middle">
                                                <td class="fs-7 fw-600"><?php echo e($orderdata->order_number); ?></td>
                                                <td class="fs-7"><?php echo e(Helper::date_format($orderdata->created_at)); ?>

                                                </td>
                                                <td class="fs-7">
                                                    <?php echo e($orderdata->order_type == 1 ? trans('labels.delivery') : trans('labels.pickup')); ?>

                                                </td>
                                                <td class="fs-7">
                                                    <?php echo e(Helper::currency_format($orderdata->grand_total)); ?>

                                                </td>
                                                <td class="fs-7">
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
                                                </td>
                                                <td class="fs-7">
                                                    <?php if($orderdata->status == '1'): ?>
                                                        <span
                                                            class="text-order-placed"><?php echo e(trans('labels.placed')); ?></span>
                                                    <?php elseif($orderdata->status == '2'): ?>
                                                        <span
                                                            class="text-order-preparing"><?php echo e(trans('labels.preparing')); ?></span>
                                                    <?php elseif($orderdata->status == '3'): ?>
                                                        <span
                                                            class="text-order-ready"><?php echo e(trans('labels.ready')); ?></span>
                                                    <?php elseif($orderdata->status == '4'): ?>
                                                        <?php if($orderdata->order_type == 2): ?>
                                                            <span
                                                                class="text-order-waitingpickup"><?php echo e(trans('labels.waiting_pickup')); ?></span>
                                                        <?php else: ?>
                                                            <span
                                                                class="text-order-ontheway"><?php echo e(trans('labels.on_the_way')); ?></span>
                                                        <?php endif; ?>
                                                    <?php elseif($orderdata->status == '5'): ?>
                                                        <span
                                                            class="text-order-completed"><?php echo e(trans('labels.completed')); ?></span>
                                                    <?php elseif($orderdata->status == '6' || $orderdata->status == '7'): ?>
                                                        <span
                                                            class="text-order-cancelled"><?php echo e(trans('labels.cancelled')); ?></span>
                                                    <?php else: ?>
                                                        --
                                                    <?php endif; ?>
                                                </td>
                                                <td class="fs-7">
                                                    <a href="<?php echo e(URL::to('orders-' . $orderdata->order_number)); ?>"
                                                        class="btn btn-outline-info btn-sm mx-1 mb-1"><i
                                                            class="fa-regular fa-eye"></i></a>
                                                    <?php if($orderdata->status == 1): ?>
                                                        <a href="javascript:void(0)"
                                                            onclick="cancelorder('<?php echo e($orderdata->order_number); ?>','<?php echo e(URL::to('/orders/cancel')); ?>')"
                                                            class="btn btn-danger btn-sm mx-1 mb-1">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <?php echo e($getorders->appends(request()->query())->links()); ?>

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
    <script src="<?php echo e(url('/web-assets/js/orders/orders.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/orders/orders.blade.php ENDPATH**/ ?>