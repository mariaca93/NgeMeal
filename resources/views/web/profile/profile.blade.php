@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.my_profile') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.my_profile') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.my_profile') }}</li>
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
                        <p class="title">{{ trans('labels.my_profile') }}</p>
                        <form action="{{URL::to('/profile/update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="avatar-upload">
                                    <div class="avatar-edit {{ session()->get('direction') == 'rtl' ? 'avatar-edit-rtl' : '' }}">
                                        <input type='file' name="profile_image" id="imageupload" accept=".png, .jpg, .jpeg" />
                                        <label for="imageupload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagepreview">
                                            <img src="{{ Helper::image_path(Auth::user()->profile_image) }}" alt="" id="imgupload">
                                        </div>
                                    </div>
                                </div>
                                @error('profile_image') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label mb-0">{{ trans('labels.full_name') }}</label>
                                <input type="text" class="form-control" name="name" placeholder="{{trans('labels.full_name')}}" value="{{Auth::user()->name}}">
                                @error('name') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label mb-0">{{ trans('labels.email') }}</label>
                                <input type="email" class="form-control" name="email" placeholder="{{trans('labels.email')}}" value="{{Auth::user()->email}}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label mb-0">{{ trans('labels.mobile') }}</label>
                                <input type="text" class="form-control" name="mobile" placeholder="{{trans('labels.mobile')}}" value="{{Auth::user()->mobile}}" disabled>
                            </div>
                            <button class="btn btn-primary" @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script src="{{ url('/resources/views/web/profile/profile.js')}}"></script>
@endsection
