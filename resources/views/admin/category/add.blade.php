@extends('admin.theme.default')
@section('content')
    @include('admin.breadcrumb')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="{{ URL::to('admin/cuisine/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="">{{ trans('labels.cuisine') }}
                                                <span class="text-light">*</span> </label>
                                            <input type="text" class="form-control" name="cuisine_name"
                                                placeholder="{{ trans('labels.cuisine') }}"
                                                value="{{ old('cuisine_name') }}">
                                            @error('cuisine_name')
                                                <span class="text-light">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="">{{ trans('labels.image') }}
                                                (250x250)
                                                <span class="text-light">*</span> </label>
                                            <input type="file" class="form-control" name="image" accept="image/*">
                                            @error('image')
                                                <span class="text-light">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-end">
                                    <a href="{{ URL::to('admin/cuisine') }}"
                                        class="btn btn-outline-danger">{{ trans('labels.cancel') }}</a>
                                    <button class="btn btn-primary"
                                        @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
