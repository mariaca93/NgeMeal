@extends('web.layout.default')
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.testimonials') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="javascript:void(0)">{{ trans('labels.testimonials') }}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="testimonials-wrapper">
            <div class="container">
                @if (Auth::user() && Auth::user()->type == 2)
                    @if (!Helper::check_review_exist(Auth::user()->id))
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addreviewmodal">{{ trans('labels.add_review') }}</a>
                    @endif
                @else
                    <a class="btn btn-primary" href="{{ URL::to('/login') }}">{{ trans('labels.add_review') }}</a>
                @endif
                @if (count($testimonials) > 0)
                    <div class="row mt-5 mb-3">
                        @foreach ($testimonials as $testimonialdata)
                            <div class="col-lg-4 col-md-6 col-sm-12 d-flex mb-3">
                                <div class="review">
                                    <img src="{{ $testimonialdata['user_info']->profile_image }}"
                                        class="img-circle img-responsive" />
                                    <h4>{{ $testimonialdata['user_info']->name }}</h4>
                                    <div class="review-star">
                                        @if ($testimonialdata->ratting == 1)
                                            <i class="fa-solid fa-star"></i>
                                        @elseif($testimonialdata->ratting == 2)
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        @elseif($testimonialdata->ratting == 3)
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        @elseif($testimonialdata->ratting == 4)
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        @elseif($testimonialdata->ratting == 5)
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        @endif
                                    </div>
                                    <p><span class="text-primary">"</span>{{ $testimonialdata->comment }}<span
                                            class="text-primary">"</span></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-5 d-flex justify-content-center">
                        {{ $testimonials->links() }}
                    </div>
                @else
                    @include('web.nodata')
                @endif
            </div>
            <!-- ADD_REVIEW_ODAL_START -->
            <div class="modal fade" id="addreviewmodal" tabindex="-1" aria-labelledby="addreviewmodalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addreviewmodalLabel">{{ trans('labels.add_review') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ URL::to('/add-review') }}" method="POST" class="mb-0">
                            @csrf
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="form-group col-lg-12 text-center">
                                        <div class="review border-0 py-0">
                                            <img src="{{ Helper::image_path(@Auth::user()->profile_image) }}"
                                                class="img-circle img-responsive mb-0" />
                                            <h4 class="mb-0 mt-3">{{ @Auth::user()->name }}</h4>
                                        </div>
                                        <div class="star-rating">
                                            @for ($i = 5; $i > 0; $i=$i-1)
                                                <input type="radio" id="{{$i}}" name="rating" onclick="$('#ratting').val('{{$i}}')" {{$i == 1 ? 'checked' : ''}}>
                                                <label for="{{$i}}"><i class="fa-solid fa-star" aria-hidden="true"></i></label>
                                            @endfor
                                            @error('ratting')
                                                <span class="text-danger"> <br> {{ $message }} </span>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="ratting" id="ratting" value="1">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <textarea name="message" rows="4" class="form-control" placeholder="Message" required></textarea>
                                        @error('message')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center border-0">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">{{ trans('labels.close') }}</button>
                                <button type="submit" class="btn btn-primary">{{ trans('labels.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ADD_REVIEW_ODAL_END -->
        </div>
    </section>
@endsection
