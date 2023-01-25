
<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.menu')); ?> | <?php echo e(@$cuisinedata->cuisine_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(!empty($cuisinedata)): ?>
        <div class="breadcrumb-sec">
            <div class="container">
                <div class="breadcrumb-sec-content">
                    <h1><?php echo e(@$cuisinedata->cuisine_name); ?></h1>
                    <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li
                                class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                                <a class="text-muted" href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                            </li>
                            <li class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                                aria-current="page"><?php echo e(@$cuisinedata->cuisine_name); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="menu-section">
            <div class="container px-5">
                <div class="row mb-5">
                    <div class="filter-sidebar mb-3">
                        <div class="sidebar-wrap" id="style-3">
                            <?php if(count($subcuisines) > 0 || count($getitemlist) > 0 ): ?>
                            <a href="<?php echo e(URL::to('/menu?cuisine='.$cuisinedata->slug)); ?>"
                                class="<?php if(!isset($_GET['subcuisine'])): ?> active <?php endif; ?>"><?php echo e(trans('labels.all')); ?></a>
                            <?php endif; ?>
                            <?php $__currentLoopData = $subcuisines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcatdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(URL::to('/menu?cuisine=' . $cuisinedata->slug . '&subcuisine=' . $subcatdata->slug)); ?>"
                                    class="<?php if(isset($_GET['subcuisine']) && $_GET['subcuisine'] == $subcatdata->slug): ?> active <?php endif; ?>"><?php echo e(ucfirst($subcatdata->subcuisine_name)); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php if(count($getitemlist) > 0): ?>
                        <div class="menu my-0">
                            <div class="row boxes">
                                <?php $__currentLoopData = $getitemlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('web.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="mt-5 d-flex justify-content-center">
                            <?php echo e($getitemlist->appends(request()->query())->links()); ?>

                        </div>
                    <?php else: ?>
                        <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php else: ?>
        <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Christanto\Desktop\Materi\Project Skripsi\NgeMeal\resources\views/web/menu.blade.php ENDPATH**/ ?>