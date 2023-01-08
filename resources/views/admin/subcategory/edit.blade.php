@extends('admin.theme.default')
@section('content')
@include('admin.breadcrumb')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="form-validation">
                        <form action="{{URL::to('admin/sub-cuisine/update-'.$subcatdata->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
<div class="row">
                                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="">{{trans('labels.subcuisine')}} <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="name" placeholder="{{trans('labels.subcuisine')}}" value="{{$subcatdata->subcuisine_name}}">
                                    @error('name') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="">{{trans('labels.cuisine')}} <span class="text-danger">*</span> </label>
                                    <select class="form-select" name="cuisine">
                                        <option value="" selected>{{trans('labels.select')}}</option>
                                        @foreach ($getcuisine as $cuisine)
                                            <option value="{{$cuisine->id}}" {{$subcatdata->cuisine_id == $cuisine->id ? 'selected' : ''}}>{{$cuisine->cuisine_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('cuisine') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
</div>
                                </div>
                            <div class="form-group text-end">
                                <a href="{{URL::to('admin/sub-cuisine')}}" class="btn btn-outline-danger">{{trans('labels.cancel')}}</a>
                                    <button class="btn btn-primary" @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{trans('labels.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection