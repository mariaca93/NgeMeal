
<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.search')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.search')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('labels.home')); ?></a></li>
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="javascript:void(0)"><?php echo e(trans('labels.search')); ?></a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section>
        <div class="container mt-5">
            <div class="menu-section menu-section-header">
                <form action="<?php echo e(URL::to('/search')); ?>" method="get" id="form-item">
                    <div class="form-group">
                        <div class="input-group input-group-large">
                            <div class="btn-group btn-group-toggle" id="div-with-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary active">
                                    <input type="radio" name="options" id="byName" autocomplete="off" checked> Name
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="options" id="byIngredient" autocomplete="off"> Ingredient
                                </label>
                            </div>
                            <input type="text" class="form-control rounded" name="itemname" id="item_input"
                                placeholder="<?php echo e(trans('labels.search_here')); ?>"
                                <?php if(isset($_GET['itemname'])): ?> value="<?php echo e($_GET['itemname']); ?>" <?php endif; ?>>

                            <select name="" id="ingredient_input" hidden style="width: 500px;" multiple>
                                <?php $__currentLoopData = $getingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($ingredient->id); ?>"><?php echo e($ingredient->ingredient_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <button class="input-group-text rounded submit-btn" type="submit" id="inputGroup-sizing-lg"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            var btnContainer = document.getElementById("div-with-toggle");

            // Get all buttons with class="btn" inside the container
            var btns = btnContainer.getElementsByClassName("btn");

            // Loop through the buttons and add the active class to the current/clicked button
            for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";

                var by = $(".active").children("input").attr("id");

                switch(by){
                    case "byName" :
                        var item = document.getElementById("item_input");
                        $(item).attr("type", "text");
                        // document.getElementById("ingredient_input").hidden = true;
                        var input = document.getElementById("ingredient_input_chosen");
                        $(input).attr("style", "display: none;");
                        break;
                    case "byIngredient" :
                        var item = document.getElementById("item_input");
                        $(item).attr("value", "");
                        
                        var btn = document.getElementsByClassName("submit-btn");
                        $(btn).attr("type", "");

                        var item = document.getElementById("item_input");
                        $(item).attr("type", "hidden");
                        // document.getElementById("ingredient_input").hidden = false;
                        var input = document.getElementById("ingredient_input_chosen");
                        $(input).attr("style", "width: 500px");
                        $('#ingredient_input').chosen();
                        break;
                }
            });
            }
        </script>

        <div class="container">
            <div class="row mb-5">
                <div class="menu m-0">
                    <?php if(count($getsearchitems) > 0): ?>
                        <div class="row boxes">
                            <?php $__currentLoopData = $getsearchitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('web.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="mt-5 d-flex justify-content-center">
                            <?php echo e($getsearchitems->appends(request()->query())->links()); ?>

                        </div>
                    <?php else: ?>
                        <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Christanto\Desktop\Materi\Project Skripsi\NgeMeal\resources\views/web/search.blade.php ENDPATH**/ ?>