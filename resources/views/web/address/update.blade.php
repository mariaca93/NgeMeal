@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.update_address') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.update_address') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.my_addresses') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-3 d-flex">
                    @include('web.layout.usersidebar')
                </div>
                <div class="col-lg-9">
                    <div class="user-content-wrapper">
                        <div class="mb-3">
                            <p class="title mb-0">{{ trans('labels.update_address') }}</p>
                            <p class="text-muted mb-1">*Please allow to access the location to get better experience *</p>
                            <p class="text-danger err"></p>
                        </div>
                        <input type="textbox" class="form-control" id="address" value="">
                        <div class="address-map mb-3" id="mymap"></div>
                        <form action="{{ URL::to('/address/update-' . $addressdata->id) }}" method="POST">
                            @csrf
                            <input type="hidden" placeholder="{{ trans('labels.latitude') }}" class="form-control"
                                name="lat" value="{{ $addressdata->lat }}" id="lat" readonly>
                            @error('lat')
                                <small class="text-danger">{{ $message }}</small> <br>
                            @enderror
                            <input type="hidden" placeholder="{{ trans('labels.longitude') }}" class="form-control"
                                name="lang" value="{{ $addressdata->lang }}" id="lang" readonly>
                            @error('lang')
                                <small class="text-danger">{{ $message }}</small> <br>
                            @enderror
                            <div class="form-group mb-3">
                                <label class="form-label mb-0">{{ trans('labels.house_no') }}</label>
                                <input type="text" class="form-control" name="house_no"
                                    placeholder="{{ trans('messages.enter_house_no') }}"
                                    value="{{ $addressdata->house_no }}">
                                @error('house_no')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label mb-0">{{ trans('labels.area') }}</label>
                                <input type="text" class="form-control" name="area"
                                    placeholder="{{ trans('messages.enter_area') }}" value="{{ $addressdata->area }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label mb-0">{{ trans('labels.complete_address') }}</label>
                                <textarea rows="3" class="form-control" name="address" placeholder="{{ trans('labels.complete_address') }}">{{ $addressdata->address }}</textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small> <br>
                                @enderror
                                <span class="text-muted">*{{ trans('labels.address_note') }}*</span>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ trans('labels.save_as') }}</label>
                                <div class="row">
                                    <div class="col-auto new-address">
                                        <label class="form-check-label" for="home">
                                            <input class="form-check-input d-none" type="radio" name="address_type"
                                                value="1" {{ $addressdata->address_type == 1 ? 'checked' : '' }}
                                                id="home">
                                            <div class="save-as"><span>{{ trans('labels.home') }}</span></div>
                                        </label>
                                    </div>
                                    <div class="col-auto new-address">
                                        <label class="form-check-label" for="office">
                                            <input class="form-check-input d-none" type="radio" name="address_type"
                                                value="2" {{ $addressdata->address_type == 2 ? 'checked' : '' }}
                                                id="office">
                                            <div class="save-as"><span>{{ trans('labels.office') }}</span></div>
                                        </label>
                                    </div>
                                    <div class="col-auto new-address">
                                        <label class="form-check-label" for="other">
                                            <input class="form-check-input d-none" type="radio" name="address_type"
                                                value="3" {{ $addressdata->address_type == 3 ? 'checked' : '' }}
                                                id="other">
                                            <div class="save-as"><span>{{ trans('labels.other') }}</span></div>
                                        </label>
                                    </div>
                                </div>
                                @error('address_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-success"
                                @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save_address_details') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&{{ @Helper::appdata()->map != 'map_key' ? 'key=' . @Helper::appdata()->map : '' }}">
    </script>
    <script>
        function myFunction() {
            "use strict";
            toastr.error("This operation was not performed due to demo mode");
        }
    </script>
    <script>
        var geocoder;
        var map;
        var marker;
        var infowindow = new google.maps.InfoWindow({
            size: new google.maps.Size(150, 50)
        });

        function initialize() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((showPosition) => {
                    geocoder = new google.maps.Geocoder();
                    // create_map(showPosition.coords.latitude, showPosition.coords.longitude)
                    create_map(parseFloat($('#lat').val()), parseFloat($('#lang').val()))
                    // to-change-marker-on-typing-address --> START
                    var input = document.getElementById('address');
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    google.maps.event.addListener(autocomplete, 'place_changed', function() {
                        var place = autocomplete.getPlace();
                        $('#lat').val(place.geometry.location.lat());
                        $('#lang').val(place.geometry.location.lng());
                        create_map(place.geometry.location.lat(), place.geometry.location.lng());
                    });
                    // to-change-marker-on-typing-address --> END
                }, (showError) => {
                    $('#mymap').hide();
                    $('#address').hide();
                });
            } else {
                $('.err').html("Geolocation is not supported by this browser.");
            }
        }

        function create_map(lat, lang) {
            var latlng = new google.maps.LatLng(lat, lang);
            var default_address = $('#address').val();
            var mapOptions = {
                zoom: 15,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById('mymap'), mapOptions);
            google.maps.event.addListener(map, 'click', function() {
                infowindow.close();
            });
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: latlng
            });
            google.maps.event.addListener(marker, 'dragend', function() {
                $('#lat').val(this.getPosition().lat());
                $('#lang').val(this.getPosition().lng());
                geocodePosition(marker.getPosition());
            });
            google.maps.event.addListener(map, 'dragend', function() {
                $('#lat').val(this.getCenter().lat());
                $('#lang').val(this.getCenter().lng());
                marker.setPosition(this.getCenter());
                geocodePosition(this.getCenter());
            });
            google.maps.event.addListener(marker, 'click', function() {
                marker.setPosition(this.getPosition());
                geocodePosition(this.getPosition());
                $('#lat').val(this.getPosition().lat());
                $('#lang').val(this.getPosition().lng());
            });
            google.maps.event.trigger(marker, 'click');
        }

        function geocodePosition(pos) {
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                    marker.formatted_address = responses[0].formatted_address;
                    $('#address').val(marker.formatted_address);
                } else {
                    marker.formatted_address = 'Cannot determine address at this location.';
                }
                default_address = marker.formatted_address
                infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition()
                    .toUrlValue(6));
                infowindow.open(map, marker);
            });
        }
        google.maps.event.addDomListener(window, "load", initialize);
    </script>
@endsection
