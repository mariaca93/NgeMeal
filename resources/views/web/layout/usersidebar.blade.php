<div class="user-sidebar">
    <li>
        <a class="{{ request()->is('profile') ? 'active' : '' }}" href="{{ route('user-profile') }}">
            {{-- <i class="mx-2 fa-regular fa-user"></i> --}}
            <img src="{{ Helper::image_path('myprofile.png') }}" width="15" height="15" alt="" style="margin-right: 10px">
            {{ trans('labels.my_profile') }} </a>
        </li>
    <li>
        <a class="{{ request()->is('orders*') ? 'active' : '' }}" href="{{ route('order-history') }}">
            {{-- <i class="mx-2 fa fa-list-check"></i> --}}
            <img src="{{ Helper::image_path('check-list.png') }}" width="15" height="15" alt="" style="margin-right: 10px">
        {{ trans('labels.my_orders') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('favouritelist') ? 'active' : '' }}" href="{{ route('user-favouritelist') }}">
            {{-- <i class="mx-2 fa-regular fa-heart"></i> --}}
            <img src="{{ Helper::image_path('favorite.png') }}" width="15" height="15" alt="" style="margin-right: 10px">
            {{ trans('labels.favourite_list') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('changepassword') ? 'active' : '' }}"
            href="{{ route('user-changepassword') }}">
            {{-- <i class="mx-2 fa fa-key"></i> --}}
            <img src="{{ Helper::image_path('change-pass.png') }}" width="15" height="15" alt="" style="margin-right: 10px">
            {{ trans('labels.change_password') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('address*') ? 'active' : '' }}" href="{{ route('address') }}">
            {{-- <i class="mx-2 fa-regular fa-map"></i> --}}
            <img src="{{ Helper::image_path('change-address.png') }}" width="15" height="15" alt="" style="margin-right: 10px">
            {{ trans('labels.my_addresses') }} </a>
    </li>
    {{-- <li>
        <a href="javascript:void(0)" onclick="logout('{{ route('logout') }}','{{ trans('messages.are_you_sure_logout') }}','{{ trans('labels.logout') }}')">
            <i class="mx-2 fa fa-arrow-right-from-bracket"></i>{{ trans('labels.logout') }} </a>
    </li> --}}
</div>
