<div class="col-lg-3 col-md-4 col-sm-6 col-xs-auto mb-3">
    <div class="card rounded mx-1 border-light">
        <a href="{{ URL::to('subscription-' . $subscriptiondata->slug) }}">
            <div class="card-image">
                <img src="{{ asset('admin-assets/images/item/'.$subscriptiondata->image) }}"
                    class="card-img-top border-0 rounded-0 rounded-top position-relative" alt="dishes">
            </div>
            <div class="card-body pb-0">
                <h5 class="item-card-title">
                    @if ($subscriptiondata->subscription_type == 1)
                        <img src="{{ Helper::image_path('veg.svg') }}" width="20" height="20" alt="">
                    @else
                        <img src="{{ Helper::image_path('nonveg.svg') }}" width="20" height="20" alt="">
                    @endif
                    {{ $subscriptiondata->subscription_name }}
                </h5>
                <div class="pb-2 cat-span border-bottom"><span>Subscription</span></div>
            </div>
        </a>
        <div class="img-overlay set-fav-{{ $subscriptiondata->id }}">
            @if ($subscriptiondata->is_favorite == 1)
                <a class="heart-icon btn btn-wishlist"
                    @if (Auth::user()) href="javascript:void(0)" onclick="managefavorite('{{ $subscriptiondata->id }}',0,'{{ URL::to('/managefavorite') }}')" title="{{ trans('labels.remove_wishlist') }}"
                @else href="{{ URL::to('/login') }}" @endif>
                    <i class="fa-solid fa-bookmark fs-5"></i> </a>
            @else
                <a class="heart-icon btn btn-wishlist"
                    @if (Auth::user()) href="javascript:void(0)" onclick="managefavorite('{{ $subscriptiondata->id }}',1,'{{ URL::to('/managefavorite') }}')" title="{{ trans('labels.add_wishlist') }}"
                @else href="{{ URL::to('/login') }}" @endif>
                    <i class="fa-regular fa-bookmark fs-5"></i> </a>
            @endif
        </div>
        <div class="item-card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <span>{{ Helper::currency_format($subscriptiondata->price) }}</span>
                @if (Auth::user())
                    @if ($subscriptiondata->is_cart == 1)
                        <div class="item-quantity">
                            <button type="button" class="btn btn-sm pastel_purple_color fw-500" onclick="removefromcart('{{ URL::to('/cart') }}','{{ trans('messages.remove_cartitem_note') }}','{{ trans('labels.goto_cart') }}')">-</button>
                            <input class="pastel_purple_color fw-500 item-total-qty-{{$subscriptiondata->slug}}" type="text" value="{{ Helper::get_item_cart($subscriptiondata->id) }}" disabled/>
                            <a class="btn btn-sm pastel_purple_color fw-500" onclick="showsubscription('{{ $subscriptiondata->slug }}','{{ URL::to('/show-subscription') }}')">+</a>
                        </div>
                    @else
                        <a class="btn btn-sm border pastel_purple_color fw-500"
                        onclick="showsubscription('{{ $subscriptiondata->slug }}','{{ URL::to('/show-subscription') }}')">{{ trans('labels.add') }}</a>
                    @endif
                @else
                    <a class="btn btn-sm border pastel_purple_color fw-500"
                        href="{{ URL::to('/login') }}">{{ trans('labels.add') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
