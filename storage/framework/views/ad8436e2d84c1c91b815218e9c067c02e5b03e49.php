<div class="col-lg-3 col-md-4 col-sm-6 col-xs-auto mb-3">
    <div class="card rounded mx-1 border-light">
        <a href="<?php echo e(URL::to('item-' . $itemdata->slug)); ?>">
            <div class="card-image">
                <img src="<?php echo e(asset('admin-assets/images/item/'.$itemdata->image)); ?>"
                    class="card-img-top border-0 rounded-0 rounded-top position-relative" alt="dishes">
            </div>
            <div class="card-body pb-0">
                <h5 class="item-card-title">
                    <?php if($itemdata->item_type == 1): ?>
                        <img src="<?php echo e(Helper::image_path('veg.svg')); ?>" width="20" height="20" alt="">
                    <?php else: ?>
                        <img src="<?php echo e(Helper::image_path('nonveg.svg')); ?>" width="20" height="20" alt="">
                    <?php endif; ?>
                    <?php echo e($itemdata->item_name); ?>

                </h5>
                <div class="pb-2 cat-span border-bottom"><span><?php echo e($itemdata['cuisine_info']->cuisine_name); ?></span></div>
            </div>
        </a>
        <div class="img-overlay set-fav-<?php echo e($itemdata->id); ?>">
            <?php if($itemdata->is_favorite == 1): ?>
                <a class="heart-icon btn btn-wishlist"
                    <?php if(Auth::user()): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($itemdata->id); ?>',0,'<?php echo e(URL::to('/managefavorite')); ?>')" title="<?php echo e(trans('labels.remove_wishlist')); ?>"
                <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>>
                    <i class="fa-solid fa-bookmark fs-5"></i> </a>
            <?php else: ?>
                <a class="heart-icon btn btn-wishlist"
                    <?php if(Auth::user()): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($itemdata->id); ?>',1,'<?php echo e(URL::to('/managefavorite')); ?>')" title="<?php echo e(trans('labels.add_wishlist')); ?>"
                <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>>
                    <i class="fa-regular fa-bookmark fs-5"></i> </a>
            <?php endif; ?>
        </div>
        <div class="item-card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <?php
                    if ($itemdata->has_variation == 1) {
                        foreach ($itemdata['variation'] as $key => $value) {
                            $price = $value->product_price;
                            if ($key == 0) {
                                break;
                            }
                        }
                    } else {
                        $price = $itemdata->item_price;
                    }
                ?>
                <span><?php echo e(Helper::currency_format($price)); ?></span>
                <?php if(Auth::user() && Auth::user()->type == 2): ?>
                    <?php if($itemdata->is_cart == 1): ?>
                        <div class="item-quantity">
                            <button type="button" class="btn btn-sm pastel_purple_color fw-500" onclick="removefromcart('<?php echo e(URL::to('/cart')); ?>','<?php echo e(trans('messages.remove_cartitem_note')); ?>','<?php echo e(trans('labels.goto_cart')); ?>')">-</button>
                            <input class="pastel_purple_color fw-500 item-total-qty-<?php echo e($itemdata->slug); ?>" type="text" value="<?php echo e(Helper::get_item_cart($itemdata->id)); ?>" disabled/>
                            <?php if($itemdata->addons_id != '' || count($itemdata->variation) > 0): ?>
                                <a class="btn btn-sm pastel_purple_color fw-500" onclick="showitem('<?php echo e($itemdata->slug); ?>','<?php echo e(URL::to('/show-item')); ?>')">+</a>
                            <?php else: ?>
                                <a class="btn btn-sm pastel_purple_color fw-500" onclick="calladdtocart('<?php echo e($itemdata->slug); ?>','<?php echo e($itemdata->item_name); ?>','<?php echo e($itemdata->item_type); ?>','<?php echo e($itemdata['item_image']->image_name); ?>','<?php echo e($itemdata->tax); ?>','<?php echo e($itemdata->price); ?>','','','','','','<?php echo e(URL::to('addtocart')); ?>')">+</a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <?php if($itemdata->addons_id != '' || count($itemdata->variation) > 0): ?>
                            <a class="btn btn-sm border pastel_purple_color fw-500"
                                onclick="showitem('<?php echo e($itemdata->slug); ?>','<?php echo e(URL::to('/show-item')); ?>')"><?php echo e(trans('labels.add')); ?></a>
                        <?php else: ?>
                            <a class="btn btn-sm border pastel_purple_color fw-500"
                                onclick="calladdtocart('<?php echo e($itemdata->slug); ?>','<?php echo e($itemdata->item_name); ?>','<?php echo e($itemdata->item_type); ?>','<?php echo e($itemdata['item_image']->image_name); ?>','<?php echo e($itemdata->tax); ?>','<?php echo e($itemdata->price); ?>','','','','','','<?php echo e(URL::to('addtocart')); ?>')"><?php echo e(trans('labels.add')); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="btn btn-sm border pastel_purple_color fw-500"
                        href="<?php echo e(URL::to('/login')); ?>"><?php echo e(trans('labels.add')); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/itemview.blade.php ENDPATH**/ ?>