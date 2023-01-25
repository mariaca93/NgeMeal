
<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.my_profile')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.my_profile')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.my_profile')); ?></li>
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
                        <p class="title"><?php echo e(trans('labels.my_profile')); ?></p>
                        <form action="<?php echo e(URL::to('/profile/update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row mb-3">
                                <div class="avatar-upload">
                                    <div class="avatar-edit <?php echo e(session()->get('direction') == 'rtl' ? 'avatar-edit-rtl' : ''); ?>">
                                        <input type='file' name="profile_image" id="imageupload" accept=".png, .jpg, .jpeg" />
                                        <label for="imageupload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagepreview">
                                            <img src="<?php echo e(Helper::image_path(Auth::user()->profile_image)); ?>" alt="" id="imgupload">
                                        </div>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['profile_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-light"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label mb-0"><?php echo e(trans('labels.full_name')); ?></label>
                                <input type="text" class="form-control" name="name" placeholder="<?php echo e(trans('labels.full_name')); ?>" value="<?php echo e(Auth::user()->name); ?>">
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-light"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label mb-0"><?php echo e(trans('labels.email')); ?></label>
                                <input type="email" class="form-control" name="email" placeholder="<?php echo e(trans('labels.email')); ?>" value="<?php echo e(Auth::user()->email); ?>" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label mb-0"><?php echo e(trans('labels.mobile')); ?></label>
                                <input type="text" class="form-control" name="mobile" placeholder="<?php echo e(trans('labels.mobile')); ?>" value="<?php echo e(Auth::user()->mobile); ?>" disabled>
                            </div>
                            <button class="btn btn-primary" <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(url('/resources/views/web/profile/profile.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Christanto\Desktop\Materi\Project Skripsi\NgeMeal\resources\views/web/profile/profile.blade.php ENDPATH**/ ?>