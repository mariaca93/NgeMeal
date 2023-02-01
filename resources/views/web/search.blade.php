@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.search') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.search') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a></li>
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="javascript:void(0)">{{ trans('labels.search') }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section>
        <div class="container mt-5">
            <div class="menu-section menu-section-header">
                <form action="{{ URL::to('/search') }}" method="get" id="form-item">
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
                                placeholder="{{ trans('labels.search_here') }}"
                                @isset($_GET['itemname']) value="{{ $_GET['itemname'] }}" @endisset>

                            <select name="" id="ingredient_input" hidden style="width: 500px;" multiple>
                                @foreach($getingredients as $ingredient)
                                <option value="{{$ingredient->id}}">{{$ingredient->ingredient_name}}</option>
                                @endforeach
                            </select>
                            <button class="input-group-text rounded submit-btn" type="submit" id="inputGroup-sizing-lg">
                                {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                                <img src="{{ Helper::image_path('search-button.png') }}" width="20" height="20" alt="">
                            </button>
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
                    @if (count($getsearchitems) > 0)
                        <div class="row boxes">
                            @foreach ($getsearchitems as $itemdata)
                                @include('web.itemview')
                            @endforeach
                        </div>
                        <div class="mt-5 d-flex justify-content-center">
                            {{ $getsearchitems->appends(request()->query())->links() }}
                        </div>
                    @else
                        @include('web.nodata')
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
