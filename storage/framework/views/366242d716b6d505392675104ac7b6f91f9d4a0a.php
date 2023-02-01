<div class="user-sidebar">
    <li>
        <a class="<?php echo e(request()->is('profile') ? 'active' : ''); ?>" href="<?php echo e(route('user-profile')); ?>">
            
            <img src="<?php echo e(Helper::image_path('myprofile.png')); ?>" width="15" height="15" alt="" style="margin-right: 10px">
            <?php echo e(trans('labels.my_profile')); ?> </a>
        </li>
    <li>
        <a class="<?php echo e(request()->is('orders*') ? 'active' : ''); ?>" href="<?php echo e(route('order-history')); ?>">
            
            <img src="<?php echo e(Helper::image_path('check-list.png')); ?>" width="15" height="15" alt="" style="margin-right: 10px">
        <?php echo e(trans('labels.my_orders')); ?> </a>
    </li>
    <li>
        <a class="<?php echo e(request()->is('favouritelist') ? 'active' : ''); ?>" href="<?php echo e(route('user-favouritelist')); ?>">
            
            <img src="<?php echo e(Helper::image_path('favorite.png')); ?>" width="15" height="15" alt="" style="margin-right: 10px">
            <?php echo e(trans('labels.favourite_list')); ?> </a>
    </li>
    <li>
        <a class="<?php echo e(request()->is('changepassword') ? 'active' : ''); ?>"
            href="<?php echo e(route('user-changepassword')); ?>">
            
            <img src="<?php echo e(Helper::image_path('change-pass.png')); ?>" width="15" height="15" alt="" style="margin-right: 10px">
            <?php echo e(trans('labels.change_password')); ?> </a>
    </li>
    <li>
        <a class="<?php echo e(request()->is('address*') ? 'active' : ''); ?>" href="<?php echo e(route('address')); ?>">
            
            <img src="<?php echo e(Helper::image_path('change-address.png')); ?>" width="15" height="15" alt="" style="margin-right: 10px">
            <?php echo e(trans('labels.my_addresses')); ?> </a>
    </li>
    
</div>
<?php /**PATH C:\Users\Christanto\Desktop\Materi\Project Skripsi\NgeMeal\resources\views/web/layout/usersidebar.blade.php ENDPATH**/ ?>