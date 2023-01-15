<div class="col-lg-3 col-md-4 col-sm-6 col-xs-auto mb-3">
    <div class="card rounded mx-1 border-light">
        <a href="{{ URL::to('item-' . $itemdata->slug) }}">
            <div class="card-image">
                <img src="{{ asset('admin-assets/images/item/'.$itemdata->image) }}"
                    class="card-img-top border-0 rounded-0 rounded-top position-relative" alt="dishes">
            </div>
            <div class="card-body pb-0">
                <h5 class="item-card-title">
                    @if ($itemdata->item_type == 1)
                        <img src="{{ Helper::image_path('veg.svg') }}" width="20" height="20" alt="">
                    @else
                        <img src="{{ Helper::image_path('nonveg.svg') }}" width="20" height="20" alt="">
                    @endif
                    {{ $itemdata->item_name }}
                </h5>
                <div class="pb-2 cat-span border-bottom"><span>{{ $itemdata['cuisine_info']->cuisine_name }}</span></div>
            </div>
        </a>
        <div class="img-overlay set-fav-{{ $itemdata->id }}">
            @if ($itemdata->is_favorite == 1)
                <a class="heart-icon btn btn-wishlist"
                    @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',0,'{{ URL::to('/managefavorite') }}')" title="{{ trans('labels.remove_wishlist') }}"
                @else href="{{ URL::to('/login') }}" @endif>
                    <i class="fa-solid fa-bookmark fs-5"></i> </a>
            @else
                <a class="heart-icon btn btn-wishlist"
                    @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',1,'{{ URL::to('/managefavorite') }}')" title="{{ trans('labels.add_wishlist') }}"
                @else href="{{ URL::to('/login') }}" @endif>
                    <i class="fa-regular fa-bookmark fs-5"></i> </a>
            @endif
        </div>
        <div class="item-card-footer">
            <div class="d-flex justify-content-between align-items-center">
                @php
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
                @endphp
                <span>{{ Helper::currency_format($price) }}</span>
                @if (Auth::user() && Auth::user()->type == 2)
                    @if ($itemdata->is_cart == 1)
                        <div class="item-quantity">
                            <button type="button" class="btn btn-sm pastel_purple_color fw-500" onclick="removefromcart('{{ URL::to('/cart') }}','{{ trans('messages.remove_cartitem_note') }}','{{ trans('labels.goto_cart') }}')">-</button>
                            <input class="pastel_purple_color fw-500 item-total-qty-{{$itemdata->slug}}" type="text" value="{{ Helper::get_item_cart($itemdata->id) }}" disabled/>
                            @if ($itemdata->addons_id != '' || count($itemdata->variation) > 0)
                                <a class="btn btn-sm pastel_purple_color fw-500" onclick="showitem('{{ $itemdata->slug }}','{{ URL::to('/show-item') }}')">+</a>
                            @else
                                <a class="btn btn-sm pastel_purple_color fw-500" onclick="calladdtocart('{{ $itemdata->slug }}','{{ $itemdata->item_name }}','{{ $itemdata->item_type }}','{{ $itemdata['item_image']->image_name }}','{{ $itemdata->tax }}','{{ $itemdata->price }}','','','','','','{{ URL::to('addtocart') }}')">+</a>
                            @endif
                        </div>
                    @else
                        @if ($itemdata->addons_id != '' || count($itemdata->variation) > 0)
                            <a class="btn btn-sm border pastel_purple_color fw-500"
                                onclick="showitem('{{ $itemdata->slug }}','{{ URL::to('/show-item') }}')">{{ trans('labels.add') }}</a>
                        @else
                            <a class="btn btn-sm border pastel_purple_color fw-500"
                                onclick="calladdtocart('{{ $itemdata->slug }}','{{ $itemdata->item_name }}','{{ $itemdata->item_type }}','{{ $itemdata['item_image']->image_name }}','{{ $itemdata->tax }}','{{ $itemdata->price }}','','','','','','{{ URL::to('addtocart') }}')">{{ trans('labels.add') }}</a>
                        @endif
                    @endif
                @else
                    <a class="btn btn-sm border pastel_purple_color fw-500"
                        href="{{ URL::to('/login') }}">{{ trans('labels.add') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
