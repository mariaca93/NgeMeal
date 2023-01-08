<div class="col-lg-3 col-md-4 col-sm-6 col-xs-auto mb-3">
    <div class="card rounded mx-1">
        <a href="<?php echo e(URL::to('subscription-' . $subscriptiondata->slug)); ?>">
            <div class="card-image">
                <img src="<?php echo e(asset('admin-assets/images/item/'.$subscriptiondata->image)); ?>"
                    class="card-img-top border-0 rounded-0 rounded-top position-relative" alt="dishes">
            </div>
            <div class="card-body pb-0">
                <h5 class="item-card-title">
                    <?php if($subscriptiondata->subscription_type == 1): ?>
                        <img src="<?php echo e(Helper::image_path('veg.svg')); ?>" width="20" height="20" alt="">
                    <?php else: ?>
                        <img src="<?php echo e(Helper::image_path('nonveg.svg')); ?>" width="20" height="20" alt="">
                    <?php endif; ?>
                    <?php echo e($subscriptiondata->subscription_name); ?>

                </h5>
                <div class="pb-2 cat-span border-bottom"><span>Subscription</span></div>
            </div>
        </a>
        <div class="img-overlay set-fav-<?php echo e($subscriptiondata->id); ?>">
            <?php if($subscriptiondata->is_favorite == 1): ?>
                <a class="heart-icon btn btn-wishlist"
                    <?php if(Auth::user() && Auth::user()->type == 2): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($subscriptiondata->id); ?>',0,'<?php echo e(URL::to('/managefavorite')); ?>')" title="<?php echo e(trans('labels.remove_wishlist')); ?>"
                <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>>
                    <i class="fa-solid fa-bookmark fs-5"></i> </a>
            <?php else: ?>
                <a class="heart-icon btn btn-wishlist"
                    <?php if(Auth::user() && Auth::user()->type == 2): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($subscriptiondata->id); ?>',1,'<?php echo e(URL::to('/managefavorite')); ?>')" title="<?php echo e(trans('labels.add_wishlist')); ?>"
                <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>>
                    <i class="fa-regular fa-bookmark fs-5"></i> </a>
            <?php endif; ?>
        </div>
        <div class="item-card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <span><?php echo e(Helper::currency_format($subscriptiondata->price)); ?></span>
                <?php if(Auth::user() && Auth::user()->type == 2): ?>
                    <?php if($subscriptiondata->is_cart == 1): ?>
                        <div class="item-quantity">
                            <button type="button" class="btn btn-sm green_color fw-500" onclick="removefromcart('<?php echo e(URL::to('/cart')); ?>','<?php echo e(trans('messages.remove_cartitem_note')); ?>','<?php echo e(trans('labels.goto_cart')); ?>')">-</button>
                            <input class="green_color fw-500 item-total-qty-<?php echo e($subscriptiondata->slug); ?>" type="text" value="<?php echo e(Helper::get_item_cart($subscriptiondata->id)); ?>" disabled/>
                            <a class="btn btn-sm green_color fw-500" onclick="showsubscription('<?php echo e($subscriptiondata->slug); ?>','<?php echo e(URL::to('/show-subscription')); ?>')">+</a>
                        </div>
                    <?php else: ?>
                        <a class="btn btn-sm border green_color fw-500"
                        onclick="showsubscription('<?php echo e($subscriptiondata->slug); ?>','<?php echo e(URL::to('/show-subscription')); ?>')"><?php echo e(trans('labels.add')); ?></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="btn btn-sm border green_color fw-500"
                        href="<?php echo e(URL::to('/login')); ?>"><?php echo e(trans('labels.add')); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/subscriptionview.blade.php ENDPATH**/ ?>