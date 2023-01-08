<!-- Back to Top Button Start Here -->
<div id="back-to-top">
    <a class="btn text-primary">
        <i class="fa-solid fa-angle-up"></i>
    </a>
</div>
<!-- Back to Top Button End Here -->
<!-- Footer Start Here -->
<footer>
    <div class="container">
        <div class="row justify-content-center mb-4">
            @foreach (Helper::footer_features() as $feature)
            <div class="col-lg-4 col-md-4 col-sm-6 mb-2">
                <div class="quality">
                    <div class="quality-wrapper d-flex align-items-center">
                        <div class="quality-icon px-3">
                            {!! $feature->icon !!}
                        </div>
                        <div class="quality-content">
                            <h3>{{ $feature->title }}</h3>
                            <p>{{ $feature->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="footer" style="background : url('{{Helper::image_path(@Helper::appdata()->footer_bg_image)}}') center center/cover no-repeat rgba(0, 0, 0, .6) !important;">
        <div class="container">
            <div class="row footer-area border-bottom-primary">
                <div class="col-lg-4 col-md-4 col-sm-4 col-auto left-side mt-3">
                    <a href="{{ route('home') }}">
                        <img src="{{ Helper::image_path(@Helper::appdata()->logo) }}" width="75" class="my-3" alt="footer_logo">
                    </a>
                    <h1>{{ @Helper::appdata()->footer_title }}</h1>
                    <p>{{ @Helper::appdata()->footer_description }}</p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-auto right-side">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-auto mb-2">
                            <h4>{{ trans('labels.about_us') }}</h4>
                            <ul>
                                <li><a href="{{ route('about-us') }}" class="text-white">{{ trans('labels.about') }}</a></li>
                                <li><a href="{{ route('ourteam') }}" class="text-white">{{ trans('labels.our_team') }}</a></li>
                                <li><a href="{{ route('testimonials') }}" class="text-white">{{ trans('labels.testimonials') }}</a></li>
                                <li><a href="{{ URL::to('/view-all?type=todayspecial') }}" class="text-white">{{ trans('labels.todays_special') }}</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-4 col-auto mb-2">
                            <h4>{{ trans('labels.legal') }}</h4>
                            <ul>
                                <li><a href="{{route('privacy-policy')}}" class="text-white">{{ trans('labels.privacy_policy') }}</a></li>
                                <li><a href="{{route('terms-conditions')}}" class="text-white">{{ trans('labels.terms_condition') }}</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-4 col-auto mb-2">
                            <h4>{{ trans('labels.other_pages') }}</h4>
                            <ul>
                                <li>
                                    <a href="{{ route('faq') }}" class="text-white">{{ trans('labels.faq') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('gallery') }}" class="text-white">{{ trans('labels.gallery') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('contact-us') }}" class="text-white">{{ trans('labels.help_contact_us') }}</a>
                                </li>
                                </li>
                                <li>
                                    <a href="{{ route('blogs') }}" class="text-white">{{ trans('labels.blogs') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="my-4 d-flex">
                        @if (!Helper::appdata()->android == '')
                            <a href="{{Helper::appdata()->android }}" target="_blank">
                                <img src="{{ Helper::web_image_path('playstore.png') }}" width="153" height="46" alt="">
                            </a>
                        @endif
                        @if (!Helper::appdata()->ios == '')
                            <a class="{{session()->get('direction') == "rtl" ? 'me-2' : 'ms-2'}}" href="{{Helper::appdata()->ios }}" target="_blank">
                                <img src="{{ Helper::web_image_path('appstore.svg') }}" width="153" height="46" alt="">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <p class="text-white my-3">{{Helper::appdata()->copyright }}</p>
        </div>
    </div>
</footer>
<!-- Footer End here -->
