<header>
    <div class="header-bar" id="header1">
        <nav class="navbar navbar-expand-lg sticky-top p-0">
            <div class="container navbar-container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img class="img-resposive img-fluid" src="{{ Helper::image_path(@Helper::appdata()->logo) }}"
                        alt="logo">
                </a>
                <button class="btn hamburger-lines" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="fa-solid fa-bars"></i>
                </button>
                @if (session()->get('direction') == '')
                    <div class="border-0 offcanvas offcanvas-end  nav-sidebar" data-bs-scroll="true"
                        data-bs-backdrop="false" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                    @elseif (session()->get('direction') == 'rtl')
                        <div class="border-0 offcanvas offcanvas-start  nav-sidebar" data-bs-scroll="true"
                            data-bs-backdrop="false" tabindex="-1" id="offcanvasRight"
                            aria-labelledby="offcanvasRightLabel">
                        @else
                            <div class="border-0 offcanvas offcanvas-end  nav-sidebar" data-bs-scroll="true"
                                data-bs-backdrop="false" tabindex="-1" id="offcanvasRight"
                                aria-labelledby="offcanvasRightLabel">
                @endif
                {{-- for sidebar - for small devices --}}
                <div class="offcanvas-header">
                    <button type="button" class="btn text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i
                            class="fa-solid fa-xmark  text-primary fs-3"></i></button>
                </div>
                <div class="offcanvas-body">
                    <a class="nav-link text-white {{ request()->is('/') || request()->is('home') ? 'active' : '' }}"
                        aria-current="page" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                    <li class="nav-item dropdown list-unstyled">
                        <a class="nav-link text-white dropdown-toggle {{ request()->is('menu*') ? 'active' : '' }}"
                            href="javascript:void(0)" id="menudropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">{{ trans('labels.menu') }}</a>
                        <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="menudropdown" id="style-3">
                            @foreach (Helper::get_cuisines() as $cuisine)
                                <li><a class="dropdown-item text-dark @if (isset($_GET['cuisine']) && $_GET['cuisine'] == $cuisine->slug) active @endif"
                                        href="{{ URL::to('/menu?cuisine=' . $cuisine->slug) }}">{{ $cuisine->cuisine_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <a class="nav-link text-white {{ request()->is('contactus') ? 'active' : '' }}"
                        href="{{ route('contact-us') }} ">{{ trans('labels.help_contact_us') }}</a>
                    @if (Auth::user())
                        <a class="nav-link text-white {{ request()->is('cart') ? 'active' : '' }}"
                            href="{{ route('cart') }}">{{ trans('labels.cart') }}</a>
                    @else
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ trans('labels.cart') }}</a>
                    @endif
                    <a class="nav-link text-white" href="{{ route('search') }}">{{ trans('labels.search') }}</a>
                    @if (session()->get('direction') == '')
                        <a href="{{ URL::to('/direction?dir=rtl') }}" class="btn btn-sm btn-primary px-3 mx-3">{{ trans('labels.rtl') }}</a>
                    @elseif (session()->get('direction') == 'rtl')
                        <a href="{{ URL::to('/direction?dir=ltr') }}" class="btn btn-sm btn-primary px-3 mx-3">{{ trans('labels.ltr') }}</a>
                    @else
                        <a href="{{ URL::to('/direction?dir=rtl') }}" class="btn btn-sm btn-primary px-3 mx-3">{{ trans('labels.rtl') }}</a>
                    @endif
                    @if (Auth::user() && Auth::user()->type == 2)
                        <div class="sidebar-login border-top">
                            <ul class="navbar-nav my-3 px-3">
                                <li class="nav-item dropdown">
                                    <div class="dropup">
                                        <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                            id="profiledropdown" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="true"><i class="mx-2 fa-regular fa-user"></i>
                                            {{ Str::limit(Auth::user()->name, 10) }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="profiledropdown">
                                            <li><a class="dropdown-item text-dark"
                                                    href="{{ route('user-profile') }}"><i
                                                        class="me-2 fa-regular fa-user"></i>{{ trans('labels.my_profile') }}</a>
                                            </li>
                                            <li><a class="dropdown-item text-dark"
                                                    href="{{ route('order-history') }}"><i
                                                        class="me-2 fa fa-list-check"></i>{{ trans('labels.my_orders') }}</a>
                                            </li>
                                            <li><a class="dropdown-item text-dark"
                                                    href="{{ route('user-favouritelist') }}"><i
                                                        class="me-2 fa fa-heart-circle-check"></i>{{ trans('labels.favourite_list') }}</a>
                                            </li>
                                            <li><a class="dropdown-item text-dark"
                                                    href="{{ route('user-changepassword') }}"><i
                                                        class="me-2 fa fa-key"></i>{{ trans('labels.change_password') }}</a>
                                            </li>
                                            <li><a class="dropdown-item text-dark" href="{{ route('address') }}"><i
                                                        class="me-2 fa-solid fa-location-crosshairs"></i>{{ trans('labels.my_addresses') }}</a>
                                            </li>
                                            <li><a class="dropdown-item text-dark" href="javascript:void(0)"><i
                                                        class="me-2 fa fa-wallet"></i>{{ trans('labels.my_wallet') }}</a>
                                            </li>
                                            <li><a class="dropdown-item text-dark" href="javascript:void(0)"
                                                    onclick="logout('{{ route('logout') }}','{{ trans('messages.are_you_sure_logout') }}','{{ trans('labels.logout') }}')"><i
                                                        class="me-2 fa fa-arrow-right-from-bracket"></i>{{ trans('labels.logout') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="sidebar-login">
                            <a class="my-3 w-100 btn btn-primary"
                                href="{{ route('login') }}">{{ trans('labels.signin') }}</a>
                        </div>
                    @endif
                </div>
            </div>
            {{-- for large devices - for header bar --}}
            <div class="navbar-collapse collapse">
                <div class="navbar-nav mx-auto">
                    <a class="nav-link px-3 {{ request()->is('/') || request()->is('home') ? 'active' : '' }}"
                        aria-current="page" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link px-3 dropdown-toggle {{ request()->is('menu*') ? 'active' : '' }}"
                            href="javascript:void(0)" id="menudropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">{{ trans('labels.menu') }}</a>
                        <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="menudropdown" id="style-3">
                            @foreach (Helper::get_cuisines() as $cuisine)
                                <li><a class="dropdown-item text-dark @if (isset($_GET['cuisine']) && $_GET['cuisine'] == $cuisine->slug) active @endif "
                                        href="{{ URL::to('menu?cuisine=' . $cuisine->slug) }}">{{ $cuisine->cuisine_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <a class="nav-link px-3 {{ request()->is('contactus') ? 'active' : '' }}"
                        href="{{ route('contact-us') }} ">{{ trans('labels.help_contact_us') }}</a>
                </div>
                <div class="d-flex align-items-center nav-sidebar-d-none">
                    <div class="header-search mx-2">
                        <input type="text" class="search-form"
                            placeholder="{{ trans('labels.search_here') }}"required>
                        @if (session()->get('direction') == '')
                            <a href="{{ route('search') }}" class="search-button border-end pe-3">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        @elseif (session()->get('direction') == 'rtl')
                            <a href="{{ route('search') }}" class="search-button border-start ps-3">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        @else
                            <a href="{{ route('search') }}" class="search-button border-end pe-3">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        @endif
                    </div>
                    <div class="cart-area mx-2 d-block">
                        <a @if (Auth::user()) href="{{ route('cart') }}" @else href="{{ route('login') }}" @endif
                            class="text-white"><i class="fa-solid fa-cart-shopping"></i><span
                                class="cart-badge">{{ Helper::get_user_cart() }}</span></a>
                    </div>
                    <div class="mx-3">
                        @if (Auth::user() && Auth::user()->type == 2)
                            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link px-3" href="{{ route('user-profile') }}"
                                            id="profiledropdown" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa-regular fa-user"></i>
                                            {{ Str::limit(Auth::user()->name, 6) }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="profiledropdown">
                                            <li>
                                                <a class="dropdown-item text-dark"
                                                    href="{{ route('user-profile') }}">
                                                    <i class="mx-2 fa-regular fa-user"></i>{{ trans('labels.my_profile') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-dark" href="javascript:void(0)"
                                                    onclick="logout('{{ route('logout') }}','{{ trans('messages.are_you_sure_logout') }}','{{ trans('labels.logout') }}')">
                                                    <i
                                                        class="mx-2 fa fa-arrow-right-from-bracket"></i>{{ trans('labels.logout') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="mx-4">
                                <a href="{{ route('login') }}"
                                    class="btn btn-sm btn-primary">{{ trans('labels.signin') }}</a>
                            </div>
                        @endif
                    </div>
                    @if (session()->get('direction') == '')
                        <a href="{{ URL::to('/direction?dir=rtl') }}"
                            class="btn btn-sm btn-primary border-0">{{ trans('labels.rtl') }}</a>
                    @elseif (session()->get('direction') == 'rtl')
                        <a href="{{ URL::to('/direction?dir=ltr') }}"
                            class="btn btn-sm btn-primary border-0">{{ trans('labels.ltr') }}</a>
                    @else
                        <a href="{{ URL::to('/direction?dir=rtl') }}"
                            class="btn btn-sm btn-primary border-0">{{ trans('labels.rtl') }}</a>
                    @endif
                </div>
            </div>
    </div>
    </nav>
    </div>
</header>
