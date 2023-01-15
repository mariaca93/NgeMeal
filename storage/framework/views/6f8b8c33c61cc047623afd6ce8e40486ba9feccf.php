
<?php $__env->startSection('page_title'); ?>
    | <?php echo e(@$getsubscriptiondata->subscription_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="mt-5">
        <div class="container">
            <!-- untuk image scroll diatas -->
            <div class="row gx-0 justify-content-center" style="margin-bottom:1em" dir="ltr">
                <div class="small-img-item">
                    <img src="<?php echo e(Helper::web_image_path('nexticon.png')); ?>" class="icon-left"
                        alt="" id="prev-img-item" onclick="getPrevItem()">
                    <div class="small-container">
                        <div id="small-img-roll-item">
                            <?php $__currentLoopData = $getsubscriptiondata['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(asset('admin-assets/images/item/'. $item->image)); ?>" id =<?php echo e($key); ?> class="show-small-img-item"
                                alt="">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <img src="<?php echo e(Helper::web_image_path('nexticon.png')); ?>" class="icon-right"
                        alt="" id="next-img-item" onclick="getNextItem()">
                </div>
            </div>
            <!-- untuk image scroll diatas -->

            <script>
                function getNextItem() {
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
                    var items = <?php echo json_encode($getsubscriptiondata['items']); ?>

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
                    var items = <?php echo json_encode($getsubscriptiondata['items']); ?>

                    var addons = items[$id]['addons']
                    console.log(addons)

                    for (let i = 1; i <= addons.length; i++) {
                        var addonsid = "addons"+i;
                        var getaddons = document.getElementById(addonsid);

                        if(getaddons != null){
                            getaddons.remove()
                        }
                    }

                    document.getElementById("form-addon").innerHTML = ""
                    document.getElementById("addon-name").innerHTML = ""
                    items[$id]['addons'].forEach(generateAddon)
                    function generateAddon(Addon){
                        var div = document.createElement("div")
                        div.setAttribute("class", "form-check")

                        var input = document.createElement("input")
                        input.setAttribute("type", "checkbox")
                        input.setAttribute("class", "form-check-input cursor-pointer addons-checkbox")

                        var labelAddon = document.createElement("label")
                        labelAddon.setAttribute("class", "form-check-label cursor-pointer me-3")

                        var priceAddon = document.createElement("span")
                        priceAddon.setAttribute("class", "text-muted")

                        labelAddon.innerHTML = Addon["name"] + " : "
                        priceAddon.innerHTML = "$" + Addon["price"] + ".00"

                        labelAddon.appendChild(priceAddon);
                        div.appendChild(input)
                        div.appendChild(labelAddon)

                        document.getElementById("form-addon").appendChild(div)

                    }

                    // console.log($(".show-small-img-item[alt='now']").next().attr('src'))

                    // var items = <?php echo json_encode($getsubscriptiondata['items']); ?>


                    // console.log(items)
                    // document.getElementById("item-name").innerHTML = "New text!"
                }

                function getPrevItem() {
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
                     var items = <?php echo json_encode($getsubscriptiondata['items']); ?>

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
                    var items = <?php echo json_encode($getsubscriptiondata['items']); ?>

                    var addons = items[$id]['addons']
                    console.log(addons)

                    for (let i = 1; i <= addons.length; i++) {
                        var addonsid = "addons"+i;
                        var getaddons = document.getElementById(addonsid);

                        if(getaddons != null){
                            getaddons.remove()
                        }
                    }

                    document.getElementById("form-addon").innerHTML = ""
                    document.getElementById("addon-name").innerHTML = ""
                    items[$id]['addons'].forEach(generateAddon)
                    function generateAddon(Addon){
                        var div = document.createElement("div")
                        div.setAttribute("class", "form-check")

                        var input = document.createElement("input")
                        input.setAttribute("type", "checkbox")
                        input.setAttribute("class", "form-check-input cursor-pointer addons-checkbox")

                        var labelAddon = document.createElement("label")
                        labelAddon.setAttribute("class", "form-check-label cursor-pointer me-3")

                        var priceAddon = document.createElement("span")
                        priceAddon.setAttribute("class", "text-muted")

                        labelAddon.innerHTML = Addon["name"] + " : "
                        priceAddon.innerHTML = "$" + Addon["price"] + ".00"

                        labelAddon.appendChild(priceAddon);
                        div.appendChild(input)
                        div.appendChild(labelAddon)

                        document.getElementById("form-addon").appendChild(div)

                    }
                    // console.log($(".show-small-img-item[alt='now']").next().attr('src'))

                    // var items = <?php echo json_encode($getsubscriptiondata['items']); ?>


                    // console.log(items)
                    // document.getElementById("item-name").innerHTML = "New text!"
                }
            </script>

            <?php $__currentLoopData = $getsubscriptiondata['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($loop->first): ?>
                <div class="item-details">
                    <?php if(!empty($item)): ?>
                        <div class="row mb-4">
                            <div class="col-lg-5 col-md-5 col">
                                <div class="item-img-cover">
                                    <div class="item-img show">
                                        <?php $__currentLoopData = $item['item_images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $firstimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <img data-enlargable src="<?php echo e($firstimage->image_url); ?>" alt="item-image"
                                                id="show-img">
                                            <?php
                                                $image_name = $firstimage->image_name;
                                                if ($key == 0) {
                                                    break;
                                                }
                                            ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <?php if(count($item['item_images']) > 1): ?>
                                    <div class="row gx-0 justify-content-center" dir="ltr">
                                        <div class="small-img">
                                            <img src="<?php echo e(Helper::web_image_path('nexticon.png')); ?>" class="icon-left"
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
                                                    <?php $__currentLoopData = $item['item_images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $itemimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <img src="<?php echo e($itemimage->image_url); ?>" class="show-small-img"
                                                            alt="">
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                            <img src="<?php echo e(Helper::web_image_path('nexticon.png')); ?>" class="icon-right"
                                                alt="" id="next-img">
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-7 col-md-7 col">
                                <div class="item-content">
                                    <div class="item-heading">
                                        <div class="d-flex align-items-start">
                                            <img class="col-1" id="item-type" <?php if($item->item_type == 1): ?> src="<?php echo e(Helper::image_path('veg.svg')); ?>" <?php else: ?> src="<?php echo e(Helper::image_path('nonveg.svg')); ?>" <?php endif; ?>
                                                alt="">
                                            <span id="item-name" onchange="checkaddons()" class="item-title col-11 <?php echo e(session()->get('direction') == 'rtl' ? 'me-2' : 'ms-2'); ?>"><?php echo e($item->item_name); ?></span>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between mb-1">
                                        <div class="col-auto">
                                            <span
                                                class="white_color" id="cuisine-info"><?php echo e($item['cuisine_info']->cuisine_name); ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <?php if($item->tax > 0): ?>
                                                <span class="text-light float-end">+ <?php echo e($item->tax); ?>%
                                                    <?php echo e(trans('labels.additional_taxes')); ?></span>
                                            <?php else: ?>
                                                <span
                                                    class="text-light float-end"><?php echo e(trans('labels.inclusive_taxes')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row pb-2 mb-3 border-bottom align-items-center">
                                        <?php
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
                                        ?>
                                        <p class="item-price item_price m-0" id ="price"><?php echo e(Helper::currency_format($price)); ?></p>
                                    </div>
                                    <div class="row pb-3 mb-3 border-bottom">
                                        <div class="col-md-6 item-detail-wrapper" id="style-3">
                                            <div class="item-variation-list">
                                                <h5 class="dark_color">Ingredients</h5>
                                                <div class="form-check <?php echo e(session()->get('direction') == 'rtl' ? 'd-flex' : ''); ?>">
                                                <table class="table table-borderless">
                                                    <tbody id="table-body">
                                                    <?php $__currentLoopData = $item['ingredients']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                        <th scope="row"><?php echo e($ingredient->ingredient_name); ?></th>
                                                        <td><?php echo e($ingredient->pivot->quantity); ?></td>
                                                        <td><?php echo e($ingredient->measurement); ?></td>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(!empty($item->addons) && count($item->addons) > 0): ?>
                                            <div class="col-md-6 item-detail-wrapper" id="style-3">
                                                <div class="item-variation-list" id="item-variation-addon">
                                                    <h5 class="dark_color" id="addon-label" ><?php echo e(trans('labels.addons')); ?></h5>
                                                    <?php $__currentLoopData = $item->addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addonsdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="form-check" id="form-addon" <?php echo e(session()->get('direction') == 'rtl' ? 'd-flex' : ''); ?>">
                                                            <input class="form-check-input cursor-pointer addons-checkbox <?php echo e(session()->get('direction') == 'rtl' ? 'ms-0' : ''); ?>"
                                                                type="checkbox" value="<?php echo $addonsdata->id; ?>'"
                                                                data-addons-id="<?php echo $addonsdata->id; ?>"
                                                                data-addons-price="<?php echo $addonsdata->price; ?>"
                                                                data-addons-name="<?php echo $addonsdata->name; ?>"
                                                                onclick="getaddons(this)"
                                                                id="addons<?php echo e($addonsdata->id); ?>">
                                                                <!-- id="<?php echo e($item->item_name); ?><?php echo e($addonsdata->id); ?>"> -->
                                                            <label class="form-check-label cursor-pointer me-3"
                                                                for="addons<?php echo e($addonsdata->id); ?>" id ="addon-name"><?php echo e($addonsdata->name); ?>

                                                                : <span
                                                                    class="text-muted" id="addon-price"><?php echo e(Helper::currency_format($addonsdata->price)); ?></span></label>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- <br> slug -->
                                    <input type="hidden" name="slug" id="slug" value="<?php echo e($getsubscriptiondata->slug); ?>">
                                    <!-- <br> item_name -->
                                    <?php if($getsubscriptiondata->item_name != ""): ?>
                                        <input type="hidden" name="item_name" id="item_name"
                                            value="<?php echo e($getsubscriptiondata->item_name); ?>">
                                    <?php else: ?>
                                        <input type="hidden" name="item_name" id="item_name"
                                        value="<?php echo e($getsubscriptiondata->subscription_name); ?>">
                                    <?php endif; ?>
                                    <!-- <br> item_type -->
                                    <?php if($getsubscriptiondata->item_type != ""): ?>
                                        <input type="hidden" name="item_type" id="item_type"
                                            value="<?php echo e($getsubscriptiondata->item_type); ?>">
                                    <?php else: ?>
                                        <input type="hidden" name="item_type" id="item_type"
                                        value="<?php echo e($getsubscriptiondata->subscription_type); ?>">
                                    <?php endif; ?>
                                    <!-- <br> image_name -->
                                    <input type="hidden" name="image_name" id="image_name" value="<?php echo e($getsubscriptiondata->image); ?>">
                                    <!-- <br> tax -->
                                    <input type="hidden" name="tax" id="item_tax" value="<?php echo e($getsubscriptiondata->tax); ?>">
                                    <!-- <br> item_price -->
                                    <input type="hidden" name="item_price" id="item_price" value="<?php echo e($getsubscriptiondata->price); ?>">
                                    <!-- <br> addonstotal -->
                                    <input type="hidden" name="addonstotal" id="addonstotal" value="0">
                                    <!-- <br> subtotal -->
                                    <input type="hidden" name="subtotal" id="subtotal" value="<?php echo e($price); ?>">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-md-6 col-sm-6 col-auto">
                                            <?php if(Auth::user() && Auth::user()->type == 2): ?>
                                                <a class="btn btn-success btn-lg w-100 m-0 text-uppercase fs-6"
                                                    onclick="addtocart('<?php echo e(URL::to('addtocart')); ?>')"><?php echo e(trans('labels.add_to_cart')); ?></a>
                                            <?php else: ?>
                                                <a class="btn btn-success btn-lg w-100 m-0 text-uppercase fs-6"
                                                    href="<?php echo e(URL::to('/login')); ?>"><?php echo e(trans('labels.add_to_cart')); ?></a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-auto">
                                            <div class="wishlist">
                                                <?php if($item->is_favorite == 1): ?>
                                                    <a class="btn btn-lg w-100 wishlist-btn heart-red"
                                                        <?php if(Auth::user() && Auth::user()->type == 2): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($item->id); ?>',0)" <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>><?php echo e(trans('labels.remove_wishlist')); ?>

                                                    </a>
                                                <?php else: ?>
                                                    <a class="btn btn-lg w-100 wishlist-btn border-success"
                                                        <?php if(Auth::user() && Auth::user()->type == 2): ?> href="javascript:void(0)" onclick="managefavorite('<?php echo e($item->id); ?>',1)" <?php else: ?> href="<?php echo e(URL::to('/login')); ?>" <?php endif; ?>><?php echo e(trans('labels.add_wishlist')); ?>

                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($item->item_description)): ?>
                            <div class="row mt-2">
                                <div class="col-auto">
                                    <div class="item-description">
                                        <h4><?php echo e(trans('labels.description')); ?></h4>
                                        <p class="text-justify" id="item-description"><?php echo $item->item_description; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <!-- RELATED PRODUCTS Section Start Here -->
    <?php if(count($getrelateditems) > 0): ?>
        <section class="menu mt-3">
            <div class="container">
                <div class="row align-items-center justify-content-between my-2 px-2">
                    <div class="col-auto menu-heading">
                        <h1 class="text-capitalize"><?php echo e(trans('labels.related_items')); ?></h1>
                    </div>
                    <div class="col-auto"><a
                            href="<?php echo e(URL::to('menu?cuisine=' . $getsubscriptiondata['cuisine_info']->slug)); ?>"
                            class="btn btn-sm btn-outline-primary"><?php echo e(trans('labels.view_all')); ?></a></div>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $getrelateditems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- RELATED PRODUCTS Section End Here -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('web-assets/js/item-image-carousel/main.js')); ?>"></script>
    <script src="<?php echo e(asset('web-assets/js/item-image-carousel/zoom-image.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Skripsi\NgeMeal\resources\views/web/subscriptiondetails.blade.php ENDPATH**/ ?>