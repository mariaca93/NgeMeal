@extends('web.layout.default')
@section('page_title')
    | {{ @$getsubscriptiondata->subscription_name }}
@endsection
@section('content')
    <section class="mt-5">
        <div class="container">
            <!-- untuk image scroll diatas -->
            <div class="row gx-0 justify-content-center" style="margin-bottom:1em" dir="ltr">
                <div class="small-img-item">
                    <img src="{{ Helper::web_image_path('nexticon.png') }}" class="icon-left"
                        alt="" id="prev-img-item" onclick="getPrevItem()">
                    <div class="small-container">
                        <div id="small-img-roll-item">
                            @foreach ($getsubscriptiondata['items'] as $key => $item)
                            <img src="{{ asset('admin-assets/images/item/'. $item->image) }}" id ={{$key}} class="show-small-img-item"
                                alt="">
                            @endforeach
                        </div>
                    </div>
                    <img src="{{ Helper::web_image_path('nexticon.png') }}" class="icon-right"
                        alt="" id="next-img-item" onclick="getNextItem()">
                </div>
            </div>
            <!-- untuk image scroll diatas -->

            <script>
                function getNextItem() {

                    //save current item addone checkboxes to local storage
                    $id = $(".show-small-img-item[alt='now']").attr('id')
                    var addonKey = 'sub'+'{{ $getsubscriptiondata->id}}'+'_item'+$id;
                    localStorage[addonKey]=document.getElementById("item-variation-addon").innerHTML

                    //show-img utk show large img
                    //show-small-img utk show image kecil yang di slider dan arrow

                    //ketika click next di slider atas maka what i want to happen is :
                    //1. slider atas pindah image jd rounded red border

                    $('#show-img').attr('src', $(".show-small-img-item[alt='now']").next().attr('src'))
                    $(".show-small-img-item[alt='now']").next().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
                    $(".show-small-img-item[alt='now']").next().attr('alt', 'now').siblings().removeAttr('alt');
                    if ($('#small-img-roll-item').children().length > 4) {
                        if ($(".show-small-img-item[alt='now']").index() >= 3 && $(".show-small-img-item[alt='now']").index() < $('#small-img-roll-item').children().length - 1){
                        $('#small-img-roll-item').css('left', -($(".show-small-img-item[alt='now']").index() - 2) * 76 + 'px')
                        } else if ($(".show-small-img-item[alt='now']").index() == $('#small-img-roll-item').children().length - 1) {
                        $('#small-img-roll-item').css('left', -($('#small-img-roll-item').children().length - 4) * 76 + 'px')
                        } else {
                        $('#small-img-roll-item').css('left', '0')
                        }
                    }

                     //2. data yang ditunjukin dbwh jd sesuai dengan data yang ada diatas
                     $id = $(".show-small-img-item[alt='now']").attr('id')
                    var items = {!! json_encode($getsubscriptiondata['items']) !!}
                    generateImages(items[$id])
                    var item_type = document.getElementById("item-type")
                    if(items[$id]["item_type"]=="1"){
                        item_type.setAttribute("src", "http://localhost:8000/admin-assets/images/about/veg.svg")
                    }
                    else{
                        item_type.setAttribute("src", "http://localhost:8000/admin-assets/images/about/nonveg.svg")
                    }
                    console.log(items[$id]["cuisine_info"]["cuisine_name"])
                    var cuisine_info = document.getElementById("cuisine-info")
                    cuisine_info.innerHTML = items[$id]["cuisine_info"]["cuisine_name"]

                    var item_name = document.getElementById("item-name")
                    item_name.innerHTML = items[$id]["item_name"]

                    var price = document.getElementById("price")
                    price.innerHTML = "Rp. " + items[$id]["price"]

                    document.getElementById("table-body").innerHTML = ""
                    items[$id]["ingredients"].forEach(generateIngredients)
                    function generateIngredients(ingredient){
                        var tr = document.createElement("tr")
                        var th = document.createElement("th")
                        var td1 = document.createElement("td")
                        var td2 = document.createElement("td")

                        th.scope = "row"
                        th.innerHTML = ingredient["ingredient_name"]

                        td1.innerHTML = ingredient["pivot"]["quantity"]
                        td2.innerHTML = ingredient["measurement"]

                        tr.appendChild(th)
                        tr.appendChild(td1)
                        tr.appendChild(td2)

                        document.getElementById("table-body").appendChild(tr)
                    }

                    var item_description = document.getElementById("item-description")
                    item_description.innerHTML = items[$id]["item_description"]


                    $id = $(".show-small-img-item[alt='now']").attr('id')
                    var items = {!! json_encode($getsubscriptiondata['items']) !!}
                    var addons = items[$id]['addons']
                    console.log(addons)

                    for (let i = 1; i <= addons.length; i++) {
                        var addonsid = "addons"+i;
                        var getaddons = document.getElementById(addonsid);

                        if(getaddons != null){
                            getaddons.remove()
                        }
                    }

                    $('.form-check-addon').remove()
                    var keyAddon = 'sub'+'{{ $getsubscriptiondata->id}}'+'_item'+$id;
                    if(localStorage[keyAddon]){
                        document.getElementById('item-variation-addon').innerHTML=''
                        document.getElementById('item-variation-addon').innerHTML=localStorage[keyAddon]
                    }else{
                        items[$id]['addons'].forEach(generateAddon)
                    }

                    function generateAddon(Addon){
                        var div = document.createElement("div")
                        div.setAttribute("class", "form-check form-check-addon")

                        var input = document.createElement("input")
                        input.setAttribute("type", "checkbox")
                        input.setAttribute("class", "form-check-input cursor-pointer addons-checkbox")
                        input.setAttribute("value", Addon["id"])
                        input.setAttribute("data-addons-id", Addon["id"])
                        input.setAttribute("data-addons-price", Addon["price"])
                        input.setAttribute("data-addons-name", Addon["name"])
                        input.setAttribute("onclick", "getaddons(this)")
                        input.setAttribute("name", Addon["name"])
                        input.setAttribute("id", Addon["id"])

                        var labelAddon = document.createElement("label")
                        labelAddon.setAttribute("class", "form-check-label cursor-pointer me-3")

                        var priceAddon = document.createElement("span")
                        priceAddon.setAttribute("class", "text-muted")

                        labelAddon.innerHTML = Addon["name"] + " : "
                        priceAddon.innerHTML = "Rp. " + Addon["price"] + ".00"

                        labelAddon.appendChild(priceAddon);
                        div.appendChild(input)
                        div.appendChild(labelAddon)

                        document.getElementById("item-variation-addon").appendChild(div)
                    }

                    // console.log($(".show-small-img-item[alt='now']").next().attr('src'))

                    // var items = {!! json_encode($getsubscriptiondata['items']) !!}

                    // console.log(items)
                    // document.getElementById("item-name").innerHTML = "New text!"
                }

                function getPrevItem() {
                    //save current item addon checkboxes to local storage
                    $id = $(".show-small-img-item[alt='now']").attr('id')
                    var addonKey = 'sub'+'{{ $getsubscriptiondata->id}}'+'_item'+$id;
                    localStorage[addonKey]=document.getElementById("item-variation-addon").innerHTML

                    //show-img utk show large img
                    //show-small-img utk show image kecil yang di slider dan arrow

                    //ketika click next di slider atas maka what i want to happen is :
                    //1. slider atas pindah image jd rounded red border

                    $('#show-img').attr('src', $(".show-small-img-item[alt='now']").prev().attr('src'))
                    $(".show-small-img-item[alt='now']").prev().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
                    $(".show-small-img-item[alt='now']").prev().attr('alt', 'now').siblings().removeAttr('alt');
                    if ($('#small-img-roll-item').children().length > 4) {
                        if ($(".show-small-img-item[alt='now']").index() >= 3 && $(".show-small-img-item[alt='now']").index() < $('#small-img-roll-item').children().length - 1){
                        $('#small-img-roll-item').css('left', -($(".show-small-img-item[alt='now']").index() - 2) * 76 + 'px')
                        } else if ($(".show-small-img-item[alt='now']").index() == $('#small-img-roll-item').children().length - 1) {
                        $('#small-img-roll-item').css('left', -($('#small-img-roll-item').children().length - 4) * 76 + 'px')
                        } else {
                        $('#small-img-roll-item').css('left', '0')
                        }
                    }

                     //2. data yang ditunjukin dbwh jd sesuai dengan data yang ada diatas
                     $id = $(".show-small-img-item[alt='now']").attr('id')
                     var items = {!! json_encode($getsubscriptiondata['items']) !!}
                     generateImages(items[$id])
                     var item_type = document.getElementById("item-type")
                     if(items[$id]["item_type"]=="1"){
                        item_type.setAttribute("src", "http://localhost:8000/admin-assets/images/about/veg.svg")
                     }
                     else{
                         item_type.setAttribute("src", "http://localhost:8000/admin-assets/images/about/nonveg.svg")
                     }
                    //  console.log(items[$id]["cuisine_info"]["cuisine_name"])
                     var cuisine_info = document.getElementById("cuisine-info")
                     cuisine_info.innerHTML = items[$id]["cuisine_info"]["cuisine_name"]

                     var item_name = document.getElementById("item-name")
                     item_name.innerHTML = items[$id]["item_name"]

                     var price = document.getElementById("price")
                     price.innerHTML = "Rp. " + items[$id]["price"]

                     document.getElementById("table-body").innerHTML = ""
                     items[$id]["ingredients"].forEach(generateIngredients)
                     function generateIngredients(ingredient){
                         var tr = document.createElement("tr")
                         var th = document.createElement("th")
                         var td1 = document.createElement("td")
                         var td2 = document.createElement("td")

                         th.scope = "row"
                         th.innerHTML = ingredient["ingredient_name"]

                         td1.innerHTML = ingredient["pivot"]["quantity"]
                         td2.innerHTML = ingredient["measurement"]

                         tr.appendChild(th)
                         tr.appendChild(td1)
                         tr.appendChild(td2)

                         document.getElementById("table-body").appendChild(tr)
                     }

                     var item_description = document.getElementById("item-description")
                     item_description.innerHTML = items[$id]["item_description"]

                     //  2. Add on yang ditunjukin dbwh jd sesuai dengan data yang ada diatas
                     $id = $(".show-small-img-item[alt='now']").attr('id')
                    var items = {!! json_encode($getsubscriptiondata['items']) !!}
                    var addons = items[$id]['addons']
                    console.log(addons)

                    for (let i = 1; i <= addons.length; i++) {
                        var addonsid = "addons"+i;
                        var getaddons = document.getElementById(addonsid);

                        if(getaddons != null){
                            getaddons.remove()
                        }
                    }
                    $('.form-check-addon').remove()

                    var keyAddon = 'sub'+'{{ $getsubscriptiondata->id}}'+'_item'+$id;
                    if(localStorage[keyAddon]){
                        document.getElementById('item-variation-addon').innerHTML=''
                        document.getElementById('item-variation-addon').innerHTML=localStorage[keyAddon]
                    }else{
                        items[$id]['addons'].forEach(generateAddon)
                    }

                    function generateAddon(Addon){
                        var div = document.createElement("div")
                        div.setAttribute("class", "form-check form-check-addon")

                        var input = document.createElement("input")
                        input.setAttribute("type", "checkbox")
                        input.setAttribute("class", "form-check-input cursor-pointer addons-checkbox")
                        input.setAttribute("value", Addon["id"])
                        input.setAttribute("data-addons-id", Addon["id"])
                        input.setAttribute("data-addons-price", Addon["price"])
                        input.setAttribute("data-addons-name", Addon["name"])
                        input.setAttribute("onclick", "getaddons(this)")
                        input.setAttribute("name", Addon["name"])
                        input.setAttribute("id", Addon["id"])

                        var labelAddon = document.createElement("label")
                        labelAddon.setAttribute("class", "form-check-label cursor-pointer me-3")

                        var priceAddon = document.createElement("span")
                        priceAddon.setAttribute("class", "text-muted")

                        labelAddon.innerHTML = Addon["name"] + " : "
                        priceAddon.innerHTML = "Rp." + Addon["price"] + ".00"

                        labelAddon.appendChild(priceAddon);
                        div.appendChild(input)
                        div.appendChild(labelAddon)

                        document.getElementById("item-variation-addon").appendChild(div)

                    }
                    // console.log($(".show-small-img-item[alt='now']").next().attr('src'))

                    // var items = {!! json_encode($getsubscriptiondata['items']) !!}

                    // console.log(items)
                    // document.getElementById("item-name").innerHTML = "New text!"
                }
            </script>

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
                                                        // checkaddons();
                                                        const myElement = document.getElementById("small-img-roll");
                                                        myElement.innerHTML = '';
                                                        // console.log("please")
                                                        // console.log(item['item_images'])
                                                        // console.log(Array.isArray(item['item_images']))
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
                                            <img class="col-1" id="item-type" @if ($item->item_type == 1) src="{{ Helper::image_path('veg.svg') }}" @else src="{{ Helper::image_path('nonveg.svg') }}" @endif
                                                alt="">
                                            <span id="item-name" onchange="checkaddons()" class="item-title col-11 {{ session()->get('direction') == 'rtl' ? 'me-2' : 'ms-2' }}">{{ $item->item_name }}</span>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between mb-1">
                                        <div class="col-auto">
                                            <span
                                                class="white_color" id="cuisine-info">{{ $item['cuisine_info']->cuisine_name }}</span>
                                        </div>
                                        <div class="col-auto">
                                                <span
                                                    class="text-light float-end">{{ trans('labels.inclusive_taxes') }}</span>
                                        </div>
                                    </div>
                                    <div class="row pb-2 mb-3 border-bottom align-items-center">
                                        @php
                                            $price = $item->price;
                                        @endphp
                                        <p class="item-price item_price m-0" id ="price">{{ Helper::currency_format($price) }}</p>
                                    </div>
                                    <div class="row pb-3 mb-3 border-bottom">
                                        <div class="col-md-6 item-detail-wrapper" id="style-3">
                                            <div class="item-variation-list">
                                                <h5 class="dark_color">Ingredients</h5>
                                                <div class="form-check {{ session()->get('direction') == 'rtl' ? 'd-flex' : '' }}">
                                                <table class="table table-borderless">
                                                    <tbody id="table-body">
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
                                                <div class="item-variation-list" id="item-variation-addon">
                                                    <h5 class="dark_color" id="addon-label" >{{ trans('labels.addons') }}</h5>
                                                    @foreach ($item->addons as $addonsdata)
                                                        <div class="form-check form-check-addon" id="form-addon" {{ session()->get('direction') == 'rtl' ? 'd-flex' : '' }}">
                                                            <input class="form-check-input cursor-pointer addons-checkbox {{ session()->get('direction') == 'rtl' ? 'ms-0' : '' }}"
                                                                type="checkbox" value="{!! $addonsdata->id !!}'"
                                                                data-addons-id="{!! $addonsdata->id !!}"
                                                                data-addons-price="{!! $addonsdata->price !!}"
                                                                data-addons-name="{!! $addonsdata->name !!}"
                                                                onclick="getaddons(this)"
                                                                name="{!! $addonsdata->name !!}"
                                                                id="addons{{ $addonsdata->id }}">
                                                                <!-- id="{{ $item->item_name }}{{ $addonsdata->id }}"> -->
                                                            <label class="form-check-label cursor-pointer me-3"
                                                                for="addons{{ $addonsdata->id }}" id ="addon-name">{{ $addonsdata->name }}
                                                                : <span
                                                                    class="text-muted" id="addon-price">{{ Helper::currency_format($addonsdata->price) }}</span></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- <br> slug -->
                                    <input type="hidden" name="slug" id="slug" value="{{ $getsubscriptiondata->slug }}">
                                    <!-- <br> item_name -->
                                    @if($getsubscriptiondata->item_name != "")
                                        <input type="hidden" name="item_name" id="item_name"
                                            value="{{ $getsubscriptiondata->item_name }}">
                                    @else
                                        <input type="hidden" name="item_name" id="item_name"
                                        value="{{ $getsubscriptiondata->subscription_name }}">
                                    @endif
                                    <!-- <br> item_type -->
                                    @if($getsubscriptiondata->item_type != "")
                                        <input type="hidden" name="item_type" id="item_type"
                                            value="{{ $getsubscriptiondata->item_type }}">
                                    @else
                                        <input type="hidden" name="item_type" id="item_type"
                                        value="{{ $getsubscriptiondata->subscription_type }}">
                                    @endif
                                    <!-- <br> image_name -->
                                    <input type="hidden" name="image_name" id="image_name" value="{{ $getsubscriptiondata->image }}">
                                    <!-- <br> item_price -->
                                    <input type="hidden" name="item_price" id="item_price" value="{{ $getsubscriptiondata->price }}">
                                    <!-- <br> addonstotal -->
                                    <input type="hidden" name="addonstotal" id="addonstotal" value="0">
                                    <!-- <br> subtotal -->
                                    <input type="hidden" name="subtotal" id="subtotal" value="{{ $price }}">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-md-6 col-sm-6 col-auto">
                                            @if (Auth::user())
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
                                                        @if (Auth::user()) href="javascript:void(0)" onclick="managefavorite('{{ $item->id }}',0)" @else href="{{ URL::to('/login') }}" @endif>{{ trans('labels.remove_wishlist') }}
                                                    </a>
                                                @else
                                                    <a class="btn btn-lg w-100 wishlist-btn border-success"
                                                        @if (Auth::user()) href="javascript:void(0)" onclick="managefavorite('{{ $item->id }}',1)" @else href="{{ URL::to('/login') }}" @endif>{{ trans('labels.add_wishlist') }}
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
                                        <p class="text-justify" id="item-description">{!! $item->item_description !!}</p>
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
        </div>
    </section>
    <!-- RELATED PRODUCTS Section Start Here -->
    @if (count($getrelateditems) > 0)
        <section class="menu mt-3">
            <div class="container">
                <div class="row align-items-center justify-content-between my-2 px-2">
                    <div class="col-auto menu-heading">
                        <h1 class="text-capitalize">{{ trans('labels.related_items') }}</h1>
                    </div>
                    <div class="col-auto"><a
                            href="{{ URL::to('menu?cuisine=' . $getsubscriptiondata['cuisine_info']->slug) }}"
                            class="btn btn-sm btn-outline-primary">{{ trans('labels.view_all') }}</a></div>
                </div>
                <div class="row">
                    @foreach ($getrelateditems as $itemdata)
                        @include('web.itemview')
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- RELATED PRODUCTS Section End Here -->
@endsection
@section('scripts')
    <script src="{{ asset('web-assets/js/item-image-carousel/main.js') }}"></script>
    <script src="{{ asset('web-assets/js/item-image-carousel/zoom-image.js') }}"></script>
@endsection
