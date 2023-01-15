<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.change_password')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.change_password')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.change_password')); ?></li>
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
                        <p class="title"><?php echo e(trans('labels.change_password')); ?></p>
                        <form action="<?php echo e(URL::to('/changepassword')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-3">
                                <label for="" class="form-label mb-0"><?php echo e(trans('labels.old_password')); ?></label>
                                <input type="password" class="form-control" name="old_password"
                                    placeholder="<?php echo e(trans('labels.old_password')); ?>" value="<?php echo e(old('old_password')); ?>">
                                <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-light"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label mb-0"><?php echo e(trans('labels.new_password')); ?></label>
                                <input type="password" class="form-control" name="new_password"
                                    placeholder="<?php echo e(trans('labels.new_password')); ?>" value="<?php echo e(old('new_password')); ?>">
                                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-light"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for=""
                                    class="form-label mb-0"><?php echo e(trans('labels.confirm_password')); ?></label>
                                <input type="password" class="form-control" name="confirm_password"
                                    placeholder="<?php echo e(trans('labels.confirm_password')); ?>"
                                    value="<?php echo e(old('confirm_password')); ?>">
                                <?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-light"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <button <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                                class="btn btn-primary"><?php echo e(trans('labels.reset')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        function myFunction() {
            "use strict";
            toastr.error("This operation was not performed due to demo mode");
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/changepassword.blade.php ENDPATH**/ ?>