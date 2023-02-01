<div class="col-lg-3 col-md-4 col-sm-6 col-xs-auto mb-3">
    <div class="card rounded mx-1 border-light">

    @if(str_contains($itemdata->slug, 'sub'))
        <a href="{{ URL::to('subscription-' . $itemdata->slug) }}">
            <div class="card-image">
                <img src="{{ asset('admin-assets/images/item/'.$itemdata->image) }}"
                    class="card-img-top border-0 rounded-0 rounded-top position-relative" alt="dishes">
            </div>
            <div class="card-body pb-0">
                <h5 class="item-card-title">
                    @if ($itemdata->subscription_type == 1)
                        <img src="{{ Helper::image_path('veg.svg') }}" width="20" height="20" alt="">
                    @else
                        <img src="{{ Helper::image_path('nonveg.svg') }}" width="20" height="20" alt="">
                    @endif
                    {{ $itemdata->subscription_name }}
                </h5>
                <div class="pb-2 cat-span border-bottom"><span>Subscription</span></div>
            </div>
        </a>
    @else
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
    @endif

    @if(str_contains($itemdata->slug, 'sub'))
        <div class="item-card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <span>{{ Helper::currency_format($itemdata->price) }}</span>
            </div>
        </div>
    @else
    <div class="item-card-footer">
        <div class="d-flex justify-content-between align-items-center">
            @php
                $price = $itemdata->item_price;
            @endphp
            <span>{{ Helper::currency_format($price) }}</span>
            @if (Auth::user())
            <div class="item-details">
                {{-- <br> slug --}}
                <input type="hidden" name="slug" id="slug" value="{{$itemdata->slug}}">
                {{-- <br> item_name --}}
                <input type="hidden" name="item_name" id="item_name" value="{{$itemdata->item_name}}">
                {{-- <br> item_type --}}
                <input type="hidden" name="item_type" id="item_type" value="{{$itemdata->item_type}}">
                {{-- <br> image_name --}}
                <input type="hidden" name="image_name" id="image_name" value="{{$itemdata->image}}">
                {{-- <br> item_price --}}
                <input type="hidden" name="item_price" id="item_price" value="{{$itemdata->item_price}}">
                {{-- <br> subtotal --}}
                <input type="hidden" name="subtotal" id="subtotal" value="0">
            </div>
                <a class="btn btn-sm border pastel_purple_color fw-500"
                    onclick="showitem('{{ $itemdata->slug }}','{{ URL::to('/show-item') }}', '{{URL::to('addtocart')}}')">{{ trans('labels.add') }}</a>
            @else
                <a class="btn btn-sm border pastel_purple_color fw-500"
                    href="{{ URL::to('/login') }}">{{ trans('labels.add') }}</a>
            @endif
        </div>
    </div>
    @endif

    </div>
</div>
