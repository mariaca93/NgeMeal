<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.faq')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.faq')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.faq')); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container my-5">
            <?php if(count($getfaqs) > 0): ?>
                <div class="d-flex justify-content-center">
                    <?php
                        $i = 1;
                    ?>
                    <div class="col-10">
                        <div class="accordion faq" id="faqleft">
                            <?php $__currentLoopData = $getfaqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faqdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="accordion-item border rounded mb-3">
                                <h2 class="accordion-header" id="faq<?php echo e($key); ?>">
                                    <button class="accordion-button <?php echo e($key==0 ? '' : 'collapsed'); ?> " type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqs<?php echo e($key); ?>" aria-expanded="<?php echo e($key==0 ? 'true' : 'false'); ?>" aria-controls="collapseOne">
                                        <?php echo e($faqdata->title); ?>

                                    </button>
                                </h2>
                                <div id="faqs<?php echo e($key); ?>" class="accordion-collapse collapse <?php echo e($key==0 ? 'show' : ''); ?>" aria-labelledby="faq<?php echo e($key); ?>"
                                    data-bs-parent="#faqleft">
                                    <div class="accordion-body" style="white-space: pre-line"><?php echo e($faqdata->description); ?></div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/faq.blade.php ENDPATH**/ ?>