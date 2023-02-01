<div class="col-lg-3 col-md-4 col-sm-6 col-xs-auto mb-3">
    <div class="card rounded mx-1 border-light">
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
        
        
    </div>
</div>
<?php /**PATH C:\Users\Christanto\Desktop\Materi\Project Skripsi\NgeMeal\resources\views/web/subscriptionview.blade.php ENDPATH**/ ?>