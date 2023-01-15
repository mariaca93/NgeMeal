<header>
    <div class="header-bar" id="header1">
        <nav class="navbar navbar-expand-lg sticky-top p-0">
            <div class="container navbar-container">
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                    <img class="img-resposive img-fluid" src="<?php echo e(Helper::image_path(@Helper::appdata()->logo)); ?>"
                        alt="logo">
                </a>
                <button class="btn hamburger-lines" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <?php if(session()->get('direction') == ''): ?>
                    <div class="border-0 offcanvas offcanvas-end  nav-sidebar" data-bs-scroll="true"
                        data-bs-backdrop="false" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                    <?php elseif(session()->get('direction') == 'rtl'): ?>
                        <div class="border-0 offcanvas offcanvas-start  nav-sidebar" data-bs-scroll="true"
                            data-bs-backdrop="false" tabindex="-1" id="offcanvasRight"
                            aria-labelledby="offcanvasRightLabel">
                        <?php else: ?>
                            <div class="border-0 offcanvas offcanvas-end  nav-sidebar" data-bs-scroll="true"
                                data-bs-backdrop="false" tabindex="-1" id="offcanvasRight"
                                aria-labelledby="offcanvasRightLabel">
                <?php endif; ?>
                
                <div class="offcanvas-header">
                    <button type="button" class="btn text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i
                            class="fa-solid fa-xmark  text-primary fs-3"></i></button>
                </div>
                <div class="offcanvas-body">
                    <a class="nav-link text-white <?php echo e(request()->is('/') || request()->is('home') ? 'active' : ''); ?>"
                        aria-current="page" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    <li class="nav-item dropdown list-unstyled">
                        <a class="nav-link text-white dropdown-toggle <?php echo e(request()->is('menu*') ? 'active' : ''); ?>"
                            href="javascript:void(0)" id="menudropdown" data-bs-toggle="dropdown"
                            aria-expanded="false"><?php echo e(trans('labels.menu')); ?></a>
                        <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="menudropdown" id="style-3">
                            <?php $__currentLoopData = Helper::get_cuisines(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuisine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a class="dropdown-item text-dark <?php if(isset($_GET['cuisine']) && $_GET['cuisine'] == $cuisine->slug): ?> active <?php endif; ?>"
                                        href="<?php echo e(URL::to('/menu?cuisine=' . $cuisine->slug)); ?>"><?php echo e($cuisine->cuisine_name); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <a class="nav-link text-white <?php echo e(request()->is('contactus') ? 'active' : ''); ?>"
                        href="<?php echo e(route('contact-us')); ?> "><?php echo e(trans('labels.help_contact_us')); ?></a>
                    <?php if(Auth::user()): ?>
                        <a class="nav-link text-white <?php echo e(request()->is('cart') ? 'active' : ''); ?>"
                            href="<?php echo e(route('cart')); ?>"><?php echo e(trans('labels.cart')); ?></a>
                    <?php else: ?>
                        <a class="nav-link text-white" href="<?php echo e(route('login')); ?>"><?php echo e(trans('labels.cart')); ?></a>
                    <?php endif; ?>
                    <a class="nav-link text-white" href="<?php echo e(route('search')); ?>"><?php echo e(trans('labels.search')); ?></a>
                    <?php if(session()->get('direction') == ''): ?>
                        <a href="<?php echo e(URL::to('/direction?dir=rtl')); ?>" class="btn btn-sm btn-primary px-3 mx-3"><?php echo e(trans('labels.rtl')); ?></a>
                    <?php elseif(session()->get('direction') == 'rtl'): ?>
                        <a href="<?php echo e(URL::to('/direction?dir=ltr')); ?>" class="btn btn-sm btn-primary px-3 mx-3"><?php echo e(trans('labels.ltr')); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(URL::to('/direction?dir=rtl')); ?>" class="btn btn-sm btn-primary px-3 mx-3"><?php echo e(trans('labels.rtl')); ?></a>
                    <?php endif; ?>
                    <?php if(Auth::user() && Auth::user()->type == 2): ?>
                        <div class="sidebar-login border-top">
                            <ul class="navbar-nav my-3 px-3">
                                <li class="nav-item dropdown">
                                    <div class="dropup">
                                        <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                            id="profiledropdown" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="true"><i class="mx-2 fa-regular fa-user"></i>
                                            <?php echo e(Str::limit(Auth::user()->name, 10)); ?>

                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="profiledropdown">
                                            <li><a class="dropdown-item text-dark"
                                                    href="<?php echo e(route('user-profile')); ?>"><i
                                                        class="me-2 fa-regular fa-user"></i><?php echo e(trans('labels.my_profile')); ?></a>
                                            </li>
                                            <li><a class="dropdown-item text-dark"
                                                    href="<?php echo e(route('order-history')); ?>"><i
                                                        class="me-2 fa fa-list-check"></i><?php echo e(trans('labels.my_orders')); ?></a>
                                            </li>
                                            <li><a class="dropdown-item text-dark"
                                                    href="<?php echo e(route('user-favouritelist')); ?>"><i
                                                        class="me-2 fa fa-heart-circle-check"></i><?php echo e(trans('labels.favourite_list')); ?></a>
                                            </li>
                                            <li><a class="dropdown-item text-dark"
                                                    href="<?php echo e(route('user-changepassword')); ?>"><i
                                                        class="me-2 fa fa-key"></i><?php echo e(trans('labels.change_password')); ?></a>
                                            </li>
                                            <li><a class="dropdown-item text-dark" href="<?php echo e(route('address')); ?>"><i
                                                        class="me-2 fa-solid fa-location-crosshairs"></i><?php echo e(trans('labels.my_addresses')); ?></a>
                                            </li>
                                            <li><a class="dropdown-item text-dark" href="javascript:void(0)"><i
                                                        class="me-2 fa fa-wallet"></i><?php echo e(trans('labels.my_wallet')); ?></a>
                                            </li>
                                            <li><a class="dropdown-item text-dark" href="javascript:void(0)"
                                                    onclick="logout('<?php echo e(route('logout')); ?>','<?php echo e(trans('messages.are_you_sure_logout')); ?>','<?php echo e(trans('labels.logout')); ?>')"><i
                                                        class="me-2 fa fa-arrow-right-from-bracket"></i><?php echo e(trans('labels.logout')); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="sidebar-login">
                            <a class="my-3 w-100 btn btn-primary"
                                href="<?php echo e(route('login')); ?>"><?php echo e(trans('labels.signin')); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="navbar-collapse collapse">
                <div class="navbar-nav mx-auto">
                    <a class="nav-link px-3 <?php echo e(request()->is('/') || request()->is('home') ? 'active' : ''); ?>"
                        aria-current="page" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    <li class="nav-item dropdown">
                        <a class="nav-link px-3 dropdown-toggle <?php echo e(request()->is('menu*') ? 'active' : ''); ?>"
                            href="javascript:void(0)" id="menudropdown" data-bs-toggle="dropdown"
                            aria-expanded="false"><?php echo e(trans('labels.menu')); ?></a>
                        <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="menudropdown" id="style-3">
                            <?php $__currentLoopData = Helper::get_cuisines(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuisine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a class="dropdown-item text-dark <?php if(isset($_GET['cuisine']) && $_GET['cuisine'] == $cuisine->slug): ?> active <?php endif; ?> "
                                        href="<?php echo e(URL::to('menu?cuisine=' . $cuisine->slug)); ?>"><?php echo e($cuisine->cuisine_name); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <a class="nav-link px-3 <?php echo e(request()->is('contactus') ? 'active' : ''); ?>"
                        href="<?php echo e(route('contact-us')); ?> "><?php echo e(trans('labels.help_contact_us')); ?></a>
                </div>
                <div class="d-flex align-items-center nav-sidebar-d-none">
                    <div class="header-search mx-2">
                        <input type="text" class="search-form"
                            placeholder="<?php echo e(trans('labels.search_here')); ?>"required>
                        <?php if(session()->get('direction') == ''): ?>
                            <a href="<?php echo e(route('search')); ?>" class="search-button border-end pe-3">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        <?php elseif(session()->get('direction') == 'rtl'): ?>
                            <a href="<?php echo e(route('search')); ?>" class="search-button border-start ps-3">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('search')); ?>" class="search-button border-end pe-3">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="cart-area mx-2 d-block">
                        <a <?php if(Auth::user()): ?> href="<?php echo e(route('cart')); ?>" <?php else: ?> href="<?php echo e(route('login')); ?>" <?php endif; ?>
                            class="text-white"><i class="fa-solid fa-cart-shopping"></i><span
                                class="cart-badge"><?php echo e(Helper::get_user_cart()); ?></span></a>
                    </div>
                    <div class="mx-3">
                        <?php if(Auth::user() && Auth::user()->type == 2): ?>
                            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link px-3" href="<?php echo e(route('user-profile')); ?>"
                                            id="profiledropdown" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa-regular fa-user"></i>
                                            <?php echo e(Str::limit(Auth::user()->name, 6)); ?>

                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="profiledropdown">
                                            <li>
                                                <a class="dropdown-item text-dark"
                                                    href="<?php echo e(route('user-profile')); ?>">
                                                    <i class="mx-2 fa-regular fa-user"></i><?php echo e(trans('labels.my_profile')); ?>

                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-dark" href="javascript:void(0)"
                                                    onclick="logout('<?php echo e(route('logout')); ?>','<?php echo e(trans('messages.are_you_sure_logout')); ?>','<?php echo e(trans('labels.logout')); ?>')">
                                                    <i
                                                        class="mx-2 fa fa-arrow-right-from-bracket"></i><?php echo e(trans('labels.logout')); ?>

                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <div class="mx-4">
                                <a href="<?php echo e(route('login')); ?>"
                                    class="btn btn-sm btn-primary"><?php echo e(trans('labels.signin')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if(session()->get('direction') == ''): ?>
                        <a href="<?php echo e(URL::to('/direction?dir=rtl')); ?>"
                            class="btn btn-sm btn-primary border-0"><?php echo e(trans('labels.rtl')); ?></a>
                    <?php elseif(session()->get('direction') == 'rtl'): ?>
                        <a href="<?php echo e(URL::to('/direction?dir=ltr')); ?>"
                            class="btn btn-sm btn-primary border-0"><?php echo e(trans('labels.ltr')); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(URL::to('/direction?dir=rtl')); ?>"
                            class="btn btn-sm btn-primary border-0"><?php echo e(trans('labels.rtl')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
    </div>
    </nav>
    </div>
</header>
<?php /**PATH /Users/user/Downloads/NgeMeal-master/resources/views/web/layout/header.blade.php ENDPATH**/ ?>