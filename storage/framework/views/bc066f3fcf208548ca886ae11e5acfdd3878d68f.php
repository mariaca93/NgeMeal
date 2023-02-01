<?php $__env->startSection('page_title'); ?>
    | <?php echo e(@$getitemdata->item_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="mt-5">
        <div class="container">
            <div class="item-details">
                <?php if(!empty($getitemdata)): ?>
                    <div class="row mb-4">
                        <div class="col-lg-5 col-md-5 col">
                            <div class="item-img-cover">
                                <div class="item-img show">
                                    <?php $__currentLoopData = $getitemdata['item_images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $firstimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img data-enlargable src="<?php echo e($firstimage->image_url); ?>" alt="item-image"
                                            id="show-img">
                                        <?php
                                            $image_name = $firstimage->image_name;
                                            if ($key == 0) {
                                                break;
                                            }
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <?php if(count($getitemdata['item_images']) > 1): ?>
                                <div class="row gx-0 justify-content-center" dir="ltr">
                                    <div class="small-img">
                                        <img src="<?php echo e(Helper::web_image_path('nexticon.png')); ?>" class="icon-left"
                                            alt="" id="prev-img">
                                        <div class="small-container">
                                            <div id="small-img-roll">
                                                <?php $__currentLoopData = $getitemdata['item_images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $itemimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <img src="<?php echo e($itemimage->image_url); ?>" class="show-small-img"
                                                        alt="">
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <img src="<?php echo e(Helper::web_image_path('nexticon.png')); ?>" class="icon-right"
                                            alt="" id="next-img">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-7 col-md-7 col">
                            <div class="item-content">
                                <div class="item-heading">
                                    <div class="d-flex align-items-start">
                                        <img class="col-1" <?php if($getitemdata->item_type == 1): ?> src="<?php echo e(Helper::image_path('veg.svg')); ?>" <?php else: ?> src="<?php echo e(Helper::image_path('nonveg.svg')); ?>" <?php endif; ?>
                                            alt="">
                                        <span class="item-title col-11 <?php echo e(session()->get('direction') == 'rtl' ? 'me-2' : 'ms-2'); ?>"><?php echo e($getitemdata->item_name); ?></span>
                                    </div>
                                </div>
                                <div class="row justify-content-between mb-1">
                                    <div class="col-auto">
                                        <span
                                            class="white_color"><?php echo e($getitemdata['cuisine_info']->cuisine_name); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <span class="text-light float-end"><?php echo e(trans('labels.inclusive_taxes')); ?></span>
                                    </div>
                                </div>
                                <div class="row pb-2 mb-3 border-bottom align-items-center">
                                    <?php
                                        $price = $getitemdata->price;
                                    ?>
                                    <p class="item-price item_price m-0"><?php echo e(Helper::currency_format($price)); ?></p>
                                </div>
                                <div class="row pb-3 mb-3 border-bottom">
                                    <div class="col-md-6 item-detail-wrapper" id="style-3">
                                        <div class="item-variation-list">
                                            <h5 class="dark_color">Ingredients</h5>
                                            <div class="form-check <?php echo e(session()->get('direction') == 'rtl' ? 'd-flex' : ''); ?>">
                                            <table class="table table-borderless">
                                                <tbody>
                                                <?php $__currentLoopData = $getitemdata['ingredients']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                    <th scope="row"><?php echo e($ingredient->ingredient_name); ?></th>
                                                    <td><?php echo e($ingredient->pivot->quantity); ?></td>
                                                    <td><?php echo e($ingredient->measurement); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <br> slug -->
                                <input type="hidden" name="slug" id="slug" value="<?php echo e($getitemdata->slug); ?>">
                                <!-- <br> item_name -->
                                <input type="hidden" name="item_name" id="item_name"
                                    value="<?php echo e($getitemdata->item_name); ?>">
                                <!-- <br> item_type -->
                                <input type="hidden" name="item_type" id="item_type"
                                    value="<?php echo e($getitemdata->item_type); ?>">
                                <!-- <br> image_name -->
                                <input type="hidden" name="image_name" id="image_name" value="<?php echo e($image_name); ?>">
                                <!-- <br> item_price -->
                                <input type="hidden" name="item_price" id="item_price" value="<?php echo e($price); ?>">
                                <!-- <br> addonstotal -->
                                <input type="hidden" name="addonstotal" id="addonstotal" value="0">
                                <!-- <br> subtotal -->
                                <input type="hidden" name="subtotal" id="subtotal" value="<?php echo e($price); ?>">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-md-6 col-sm-6 col-auto">
                                        <?php if(Auth::user()): ?>
                                            <a class="btn btn-success btn-lg w-100 m-0 text-uppercase fs-6"
                                                onclick="addtocart('<?php echo e(URL::to('addtocart')); ?>')"><?php echo e(trans('labels.add_to_cart')); ?></a>
                                        <?php else: ?>
                                            <a class="btn btn-success btn-lg w-100 m-0 text-uppercase fs-6"
                                                href="<?php echo e(URL::to('/login')); ?>"><?php echo e(trans('labels.add_to_cart')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-auto">
                                        <div class="wishlist">
                                            <?php if($getitemdata->is_favorite == 0): ?>
                                                <a class="btn btn-lg w-100 wishlist-btn border-success"
                                                    <?php if(Auth::user()): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($getitemdata->id); ?>',1, '<?php echo e(URL::to('/managefavorite')); ?>')" <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>><?php echo e(trans('labels.add_wishlist')); ?>

                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($getitemdata->item_description)): ?>
                        <div class="row mt-2">
                            <div class="col-auto">
                                <div class="item-description">
                                    <h4><?php echo e(trans('labels.tutorial')); ?></h4>
                                    <h5>Preparation time : <?php echo e($getitemdata->preparation_time); ?> minute(s)</h5>
                                    <p class="text-justify"><?php echo $getitemdata->item_description; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('web-assets/js/item-image-carousel/main.js')); ?>"></script>
    <script src="<?php echo e(asset('web-assets/js/item-image-carousel/zoom-image.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Christanto\Desktop\Materi\Project Skripsi\NgeMeal\resources\views/web/productdetails.blade.php ENDPATH**/ ?>