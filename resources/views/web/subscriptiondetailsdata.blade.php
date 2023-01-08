@extends('web.subscriptiondetails')

@section('subscriptiondetailsdata')
@foreach($getsubscriptiondata['items'] as $item)
    @if($loop->first)
    <div class="item-details">
        @if (!empty($item))
            <div class="row mb-4">
                <div class="col-lg-5 col-md-5 col">
                    <div class="item-img-cover">
                        <div class="item-img show">
                            @foreach ($item['item_images'] as $key => $firstimage)
                                <img data-enlargable src="{{ $firstimage->image_url }}" alt="item-image"
                                    id="show-img">
                                @php
                                    $image_name = $firstimage->image_name;
                                    if ($key == 0) {
                                        break;
                                    }
                                @endphp
                            @endforeach
                        </div>
                    </div>
                    @if (count($item['item_images']) > 1)
                        <div class="row gx-0 justify-content-center" dir="ltr">
                            <div class="small-img">
                                <img src="{{ Helper::web_image_path('nexticon.png') }}" class="icon-left"
                                    alt="" id="prev-img">
                                <div class="small-container">
                                    <div id="small-img-roll">

                                    <script>
                                        function generateImages(item) {
                                            const myElement = document.getElementById("small-img-roll");
                                            myElement.innerHTML = '';
                                            console.log("please")
                                            console.log(item['item_images'])
                                            console.log(Array.isArray(item['item_images']))
                                            var data = JSON.stringify(item['item_images']);
                                            data = JSON.parse(data);

                                            var count = 1
                                            item['item_images'].forEach(generateImage)
                                            
                                            function generateImage(itemImage){
                                                var imageUrl = itemImage.imageUrl

                                                var img = document.createElement("img");
                                                if(count==1){
                                                    img.alt = 'now'
                                                }
                                                count = count+1
                                                img.src = itemImage['image_url']
                                                img.className = 'show-small-img'
                                                document.getElementById("small-img-roll").appendChild(img);

                                                $('.show-small-img:first-of-type').css({'border': 'solid 1px #951b25', 'padding': '2px'})
                                                $('.show-small-img:first-of-type').attr('alt', 'now').siblings().removeAttr('alt')
                                                $('.show-small-img').click(function () {
                                                $('#show-img').attr('src', $(this).attr('src'))
                                                $('#big-img').attr('src', $(this).attr('src'))
                                                $(this).attr('alt', 'now').siblings().removeAttr('alt')
                                                $(this).css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
                                                if ($('#small-img-roll').children().length > 4) {
                                                    if ($(this).index() >= 3 && $(this).index() < $('#small-img-roll').children().length - 1){
                                                    $('#small-img-roll').css('left', -($(this).index() - 2) * 76 + 'px')
                                                    } else if ($(this).index() == $('#small-img-roll').children().length - 1) {
                                                    $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
                                                    } else {
                                                    $('#small-img-roll').css('left', '0')
                                                    }
                                                }
                                                })
                                            }
                                        }
                                    </script>
                                        @foreach ($item['item_images'] as $key => $itemimage)
                                            <img src="{{ $itemimage->image_url }}" class="show-small-img"
                                                alt="">
                                        @endforeach
                                    </div>
                                </div>
                                <img src="{{ Helper::web_image_path('nexticon.png') }}" class="icon-right"
                                    alt="" id="next-img">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-7 col-md-7 col">
                    <div class="item-content">
                        <div class="item-heading">
                            <div class="d-flex align-items-start">
                                <img class="col-1" id="item-type" @if ($getsubscriptiondata->item_type == 1) src="{{ Helper::image_path('veg.svg') }}" @else src="{{ Helper::image_path('nonveg.svg') }}" @endif
                                    alt="">
                                <span id="item-name" class="item-title col-11 {{ session()->get('direction') == 'rtl' ? 'me-2' : 'ms-2' }}">{{ $item->item_name }}</span>
                            </div>
                        </div>
                        <div class="row justify-content-between mb-1">
                            <div class="col-auto">
                                <span
                                    class="green_color" id="cuisine-info" >{{ $item['cuisine_info']->cuisine_name }}</span>
                            </div>
                            <div class="col-auto">
                                @if ($item->tax > 0)
                                    <span class="text-danger float-end">+ {{ $item->tax }}%
                                        {{ trans('labels.additional_taxes') }}</span>
                                @else
                                    <span
                                        class="text-danger float-end">{{ trans('labels.inclusive_taxes') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row pb-2 mb-3 border-bottom align-items-center">
                            @php
                                if ($item->has_variation == 1) {
                                    foreach ($item['variation'] as $key => $value) {
                                        $price = $value->product_price;
                                        if ($key == 0) {
                                            break;
                                        }
                                    }
                                } else {
                                    $price = $item->price;
                                }
                            @endphp
                            <p class="item-price item_price m-0">{{ Helper::currency_format($price) }}</p>
                        </div>
                        <div class="row pb-3 mb-3 border-bottom">
                            <div class="col-md-6 item-detail-wrapper" id="style-3">
                                <div class="item-variation-list">
                                    <h5 class="dark_color">Ingredients</h5>
                                    <div class="form-check {{ session()->get('direction') == 'rtl' ? 'd-flex' : '' }}">
                                    <table class="table table-borderless">
                                        <tbody>
                                        @foreach ($item['ingredients'] as $key => $ingredient)
                                            <tr>
                                            <th scope="row">{{$ingredient->ingredient_name}}</th>
                                            <td>{{$ingredient->pivot->quantity}}</td>
                                            <td>{{$ingredient->measurement}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($item->addons) && count($item->addons) > 0)
                                <div class="col-md-6 item-detail-wrapper" id="style-3">
                                    <div class="item-variation-list">
                                        <h5 class="dark_color">{{ trans('labels.addons') }}</h5>
                                        @foreach ($item->addons as $addonsdata)
                                            <div class="form-check {{ session()->get('direction') == 'rtl' ? 'd-flex' : '' }}">
                                                <input class="form-check-input cursor-pointer addons-checkbox {{ session()->get('direction') == 'rtl' ? 'ms-0' : '' }}"
                                                    type="checkbox" value="{{ $addonsdata->id }}'"
                                                    data-addons-id="{{ $addonsdata->id }}"
                                                    data-addons-price="{{ $addonsdata->price }}"
                                                    data-addons-name="{{ $addonsdata->name }}"
                                                    onclick="getaddons(this)"
                                                    id="addons{{ $addonsdata->id }}">
                                                <label class="form-check-label cursor-pointer me-3"
                                                    for="addons{{ $addonsdata->id }}">{{ $addonsdata->name }}
                                                    : <span
                                                        class="text-muted">{{ Helper::currency_format($addonsdata->price) }}</span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- <br> slug -->
                        <input type="hidden" name="slug" id="slug" value="{{ $getsubscriptiondata->slug }}">
                        <!-- <br> item_name -->
                        <input type="hidden" name="item_name" id="item_name"
                            value="{{ $getsubscriptiondata->item_name }}">
                        <!-- <br> item_type -->
                        <input type="hidden" name="item_type" id="item_type"
                            value="{{ $getsubscriptiondata->item_type }}">
                        <!-- <br> image_name -->
                        <input type="hidden" name="image_name" id="image_name" value="{{ $image_name }}">
                        <!-- <br> tax -->
                        <input type="hidden" name="tax" id="item_tax" value="{{ $getsubscriptiondata->tax }}">
                        <!-- <br> item_price -->
                        <input type="hidden" name="item_price" id="item_price" value="{{ $price }}">
                        <!-- <br> addonstotal -->
                        <input type="hidden" name="addonstotal" id="addonstotal" value="0">
                        <!-- <br> subtotal -->
                        <input type="hidden" name="subtotal" id="subtotal" value="{{ $price }}">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-6 col-sm-6 col-auto">
                                @if (Auth::user() && Auth::user()->type == 2)
                                    <a class="btn btn-success btn-lg w-100 m-0 text-uppercase fs-6"
                                        onclick="addtocart('{{ URL::to('addtocart') }}')">{{ trans('labels.add_to_cart') }}</a>
                                @else
                                    <a class="btn btn-success btn-lg w-100 m-0 text-uppercase fs-6"
                                        href="{{ URL::to('/login') }}">{{ trans('labels.add_to_cart') }}</a>
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-6 col-auto">
                                <div class="wishlist">
                                    @if ($item->is_favorite == 1)
                                        <a class="btn btn-lg w-100 wishlist-btn heart-red"
                                            @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $item->id }}',0)" @else href="{{ URL::to('/login') }}" @endif>{{ trans('labels.remove_wishlist') }}
                                        </a>
                                    @else
                                        <a class="btn btn-lg w-100 wishlist-btn border-success"
                                            @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $item->id }}',1)" @else href="{{ URL::to('/login') }}" @endif>{{ trans('labels.add_wishlist') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($item->item_description))
                <div class="row mt-2">
                    <div class="col-auto">
                        <div class="item-description">
                            <h4>{{ trans('labels.description') }}</h4>
                            <p class="text-justify">{!! $item->item_description !!}</p>
                        </div>
                    </div>
                </div>
            @endif
        @else
            @include('web.nodata')
        @endif
    </div>
    @endif
@endforeach
@endsection