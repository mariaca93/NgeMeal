@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.help_contact_us') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.help_contact_us') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.help_contact_us') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Contact us Section Start Here -->
    <section>
        <div class="contact-us">
            <div class="container">
                <div class="contact-content">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-auto left-side">
                            <div class="row justify-content-evenly my-5">
                                <div class="col-md-6 col-sm-6 col">
                                    <i class="fa-solid fa-envelope"></i>
                                    <h3>{{ trans('labels.email') }}</h3>
                                    <a href="mailto:{{@Helper::appdata()->email }}"
                                        class=" text-break">{{@Helper::appdata()->email }}</a>
                                </div>
                                <div class="col-md-6 col-sm-6 col">
                                    <i class="fa-solid fa-phone"></i>
                                    <h3>{{ trans('labels.mobile') }}</h3>
                                    <a href="tel:{{@Helper::appdata()->mobile }}"
                                        class="text-break">{{@Helper::appdata()->mobile }}</a>
                                </div>
                            </div>
                            <div class="row justify-content-evenly my-5">
                                <div class="col-md-6 col-sm-6 col">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <h3>{{ trans('labels.address') }}</h3>
                                    <a href="javascript:void(0)">{{@Helper::appdata()->address }}</a>
                                </div>
                                <div class="col-md-6 col-sm-6 col">
                                    <i class="fa-solid fa-clock"></i>
                                    <h3>{{ trans('labels.opening_time') }}</h3>
                                    <h5 class="text-muted">{{ ucfirst($timedata->day) }}</h5>
                                    <p>{{ $timedata->open_time }} <b>{{ trans('labels.to') }}</b>
                                        {{ $timedata->break_start }}</p>
                                    <p>{{ $timedata->break_end }} <b>{{ trans('labels.to') }}</b>
                                        {{ $timedata->close_time }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-auto right-side">
                            <form method="POST" action="{{ route('createcontact') }}">
                                @csrf
                                <div class="row">
                                    <p class="text-center">{{ trans('labels.contactus_heading') }}</p>
                                    <span
                                        class="text-muted text-center">{{ trans('labels.contactus_description') }}</span>
                                </div>
                                <div class="mb-3 mt-5 form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" class="form-control" name="fname" placeholder="{{ trans('messages.first_name') }}">
                                            @error('fname') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" name="lname" placeholder="{{ trans('messages.last_name') }}">
                                            @error('lname') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 form-group">
                                    <input type="email" class="form-control" name="email" placeholder="{{ trans('labels.email') }}">
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <textarea class="form-control" rows="2" name="message" placeholder="{{ trans('labels.message') }}"></textarea>
                                    @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="d-flex">
                                    <button type="submit" name="submit" class="btn btn-primary w-100">{{ trans('labels.save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact us Section End Here -->
@endsection