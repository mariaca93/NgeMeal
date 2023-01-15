<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.my_wallet')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.my_wallet')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.my_wallet')); ?></li>
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
                        <div class="row justify-content-between mb-2">
                            <div class="col-auto">
                                <p class="title"><?php echo e(trans('labels.my_wallet')); ?> :- <small
                                        class="white_color"><?php echo e(Helper::currency_format(Auth::user()->wallet)); ?></small></p>
                            </div>
                            <div class="col-auto"><a href="<?php echo e(route('add-money')); ?>"
                                    class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-plus"></i>
                                    <?php echo e(trans('labels.add_money')); ?></a></div>
                        </div>
                        <div class="row">
                            <ul class="mb-3">
                                <li><i class="fa-regular fa-circle-check mx-2 text-success"></i><?php echo e(trans('labels.fast_payment')); ?></li>
                                <li><i class="fa-regular fa-circle-check mx-2 text-success"></i><?php echo e(trans('labels.secure_payment')); ?></li>
                                <li><i class="fa-regular fa-circle-check mx-2 text-success"></i><?php echo e(trans('labels.no_document_required')); ?></li>
                                <li><i class="fa-regular fa-circle-check mx-2 text-success"></i><?php echo e(trans('labels.wallet_note')); ?></li>
                            </ul>
                        </div>
                        <?php if(count($gettransactions) > 0): ?>
                            <div class="row mb-3">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="rounded-top">
                                            <tr class="bg-light text-center align-middle">
                                                <th class="fs-7 fw-600"><?php echo e(trans('labels.date')); ?></th>
                                                <th class="fs-7 fw-600"><?php echo e(trans('labels.description')); ?></th>
                                                <th class="fs-7 fw-600"><?php echo e(trans('labels.amount')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="rounded-bottom">
                                            <?php $__currentLoopData = $gettransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="text-center align-middle">
                                                    <td class="fs-7"><?php echo e(Helper::date_format($tdata->created_at)); ?></td>
                                                    <td class="fs-7 w-410">
                                                        <?php if(in_array($tdata->transaction_type, [3, 4, 5, 6, 8, 9])): ?>
                                                            <?php echo e(trans('labels.wallet_recharge')); ?>

                                                            [
                                                            <?php if($tdata->transaction_type == 8): ?>
                                                                <?php echo e(trans('labels.added_by_admin')); ?>

                                                            <?php elseif($tdata->transaction_type == 9): ?>
                                                                <?php echo e(trans('labels.deducted_by_admin')); ?>

                                                            <?php endif; ?>
                                                            <?php if($tdata->transaction_type == 3): ?>
                                                                <?php echo e(trans('labels.razorpay')); ?> :
                                                            <?php elseif($tdata->transaction_type == 4): ?>
                                                                <?php echo e(trans('labels.stripe')); ?> :
                                                            <?php elseif($tdata->transaction_type == 5): ?>
                                                                <?php echo e(trans('labels.flutterwave')); ?> :
                                                            <?php elseif($tdata->transaction_type == 6): ?>
                                                                <?php echo e(trans('labels.paystack')); ?> :
                                                            <?php endif; ?>
                                                            <?php if(in_array($tdata->transaction_type, [3, 4, 5, 6])): ?>
                                                                <?php echo e($tdata->transaction_id); ?>

                                                            <?php endif; ?>
                                                            ]
                                                        <?php elseif($tdata->transaction_type == 2): ?>
                                                            <?php echo e(trans('labels.order_cancelled')); ?>

                                                        <?php elseif($tdata->transaction_type == 1): ?>
                                                            <?php echo e(trans('labels.order_placed')); ?>

                                                        <?php elseif($tdata->transaction_type == 7): ?>
                                                            <?php echo e(trans('labels.referral_earning')); ?>

                                                            [<?php echo e($tdata->username); ?>]
                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                        <?php if(in_array($tdata->transaction_type, [1, 2])): ?>
                                                            [<?php echo e($tdata->order_number); ?>]
                                                        <?php endif; ?>
                                                    </td>
                                                    <td
                                                        class="fs-7 <?php echo e(in_array($tdata->transaction_type, [2, 3, 4, 5, 6, 7, 8]) == true ? 'text-success' : 'text-light'); ?>">
                                                        <?php echo e(Helper::currency_format($tdata->amount)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <?php echo e($gettransactions->links()); ?>

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

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/wallet/index.blade.php ENDPATH**/ ?>