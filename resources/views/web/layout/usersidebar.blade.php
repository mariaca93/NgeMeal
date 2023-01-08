<div class="user-sidebar">
    <li>
        <a class="{{ request()->is('profile') ? 'active' : '' }}" href="{{ route('user-profile') }}">
            <i class="mx-2 fa-regular fa-user"></i>{{ trans('labels.my_profile') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('orders*') ? 'active' : '' }}" href="{{ route('order-history') }}">
            <i class="mx-2 fa fa-list-check"></i>{{ trans('labels.my_orders') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('favouritelist') ? 'active' : '' }}" href="{{ route('user-favouritelist') }}">
            <i class="mx-2 fa-regular fa-heart"></i>{{ trans('labels.favourite_list') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('changepassword') ? 'active' : '' }}"
            href="{{ route('user-changepassword') }}">
            <i class="mx-2 fa fa-key"></i>{{ trans('labels.change_password') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('address*') ? 'active' : '' }}" href="{{ route('address') }}">
            <i class="mx-2 fa-regular fa-map"></i>{{ trans('labels.my_addresses') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('wallet*') ? 'active' : '' }}" href="{{ route('user-wallet') }}">
            <i class="mx-2 fa-solid fa-wallet"></i>{{ trans('labels.my_wallet') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('refer-earn') ? 'active' : '' }}" href="{{ route('refer-earn') }}">
            <i class="mx-2 fa-solid fa-share-nodes"></i>{{ trans('labels.refer_earn') }} </a>
    </li>
    <li>
        <a href="javascript:void(0)" onclick="logout('{{ route('logout') }}','{{ trans('messages.are_you_sure_logout') }}','{{ trans('labels.logout') }}')">
            <i class="mx-2 fa fa-arrow-right-from-bracket"></i>{{ trans('labels.logout') }} </a>
    </li>
</div>
