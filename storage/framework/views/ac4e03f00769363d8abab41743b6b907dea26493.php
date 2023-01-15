<div class="user-sidebar">
    <li>
        <a class="<?php echo e(request()->is('profile') ? 'active' : ''); ?>" href="<?php echo e(route('user-profile')); ?>">
            <i class="mx-2 fa-regular fa-user"></i><?php echo e(trans('labels.my_profile')); ?> </a>
    </li>
    <li>
        <a class="<?php echo e(request()->is('orders*') ? 'active' : ''); ?>" href="<?php echo e(route('order-history')); ?>">
            <i class="mx-2 fa fa-list-check"></i><?php echo e(trans('labels.my_orders')); ?> </a>
    </li>
    <li>
        <a class="<?php echo e(request()->is('favouritelist') ? 'active' : ''); ?>" href="<?php echo e(route('user-favouritelist')); ?>">
            <i class="mx-2 fa-regular fa-heart"></i><?php echo e(trans('labels.favourite_list')); ?> </a>
    </li>
    <li>
        <a class="<?php echo e(request()->is('changepassword') ? 'active' : ''); ?>"
            href="<?php echo e(route('user-changepassword')); ?>">
            <i class="mx-2 fa fa-key"></i><?php echo e(trans('labels.change_password')); ?> </a>
    </li>
    <li>
        <a class="<?php echo e(request()->is('address*') ? 'active' : ''); ?>" href="<?php echo e(route('address')); ?>">
            <i class="mx-2 fa-regular fa-map"></i><?php echo e(trans('labels.my_addresses')); ?> </a>
    </li>
    <li>
        <a href="javascript:void(0)" onclick="logout('<?php echo e(route('logout')); ?>','<?php echo e(trans('messages.are_you_sure_logout')); ?>','<?php echo e(trans('labels.logout')); ?>')">
            <i class="mx-2 fa fa-arrow-right-from-bracket"></i><?php echo e(trans('labels.logout')); ?> </a>
    </li>
</div>
<?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/layout/usersidebar.blade.php ENDPATH**/ ?>