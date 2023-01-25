
<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.help_contact_us')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.help_contact_us')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.help_contact_us')); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Contact us Section Start Here -->
    <section>
        <div class="contact-us">
            <div class="container">
                <div class="contact-content">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-auto left-side">
                            <div class="row justify-content-evenly my-5">
                                <div class="col-md-6 col-sm-6 col">
                                    <i class="fa-solid fa-envelope"></i>
                                    <h3><?php echo e(trans('labels.email')); ?></h3>
                                    <a href="mailto:<?php echo e(@Helper::appdata()->email); ?>"
                                        class=" text-break"><?php echo e(@Helper::appdata()->email); ?></a>
                                </div>
                                <div class="col-md-6 col-sm-6 col">
                                    <i class="fa-solid fa-phone"></i>
                                    <h3><?php echo e(trans('labels.mobile')); ?></h3>
                                    <a href="tel:<?php echo e(@Helper::appdata()->mobile); ?>"
                                        class="text-break"><?php echo e(@Helper::appdata()->mobile); ?></a>
                                </div>
                            </div>
                            <div class="row justify-content-evenly my-5">
                                <div class="col-md-6 col-sm-6 col">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <h3><?php echo e(trans('labels.address')); ?></h3>
                                    <a href="javascript:void(0)"><?php echo e(@Helper::appdata()->address); ?></a>
                                </div>
                                <div class="col-md-6 col-sm-6 col">
                                    <i class="fa-solid fa-clock"></i>
                                    <h3><?php echo e(trans('labels.opening_time')); ?></h3>
                                    <h5 class="text-muted"><?php echo e(ucfirst($timedata->day)); ?></h5>
                                    <p><?php echo e($timedata->open_time); ?> <b><?php echo e(trans('labels.to')); ?></b>
                                        <?php echo e($timedata->break_start); ?></p>
                                    <p><?php echo e($timedata->break_end); ?> <b><?php echo e(trans('labels.to')); ?></b>
                                        <?php echo e($timedata->close_time); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-auto right-side">
                            <form method="POST" action="<?php echo e(route('createcontact')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <p class="text-center"><?php echo e(trans('labels.contactus_heading')); ?></p>
                                    <span
                                        class="text-muted text-center"><?php echo e(trans('labels.contactus_description')); ?></span>
                                </div>
                                <div class="mb-3 mt-5 form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" class="form-control" name="fname" placeholder="<?php echo e(trans('messages.first_name')); ?>">
                                            <?php $__errorArgs = ['fname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-light"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" name="lname" placeholder="<?php echo e(trans('messages.last_name')); ?>">
                                            <?php $__errorArgs = ['lname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-light"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 form-group">
                                    <input type="email" class="form-control" name="email" placeholder="<?php echo e(trans('labels.email')); ?>">
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-light"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="mb-3 form-group">
                                    <textarea class="form-control" rows="2" name="message" placeholder="<?php echo e(trans('labels.message')); ?>"></textarea>
                                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-light"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="d-flex">
                                    <button type="submit" name="submit" class="btn btn-primary w-100"><?php echo e(trans('labels.save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact us Section End Here -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Christanto\Desktop\Materi\Project Skripsi\NgeMeal\resources\views/web/contactus.blade.php ENDPATH**/ ?>