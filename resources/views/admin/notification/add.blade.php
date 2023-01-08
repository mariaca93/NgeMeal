@extends('admin.theme.default')
@section('content')
@include('admin.breadcrumb')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="form-validation">
                        <form action="{{URL::to('admin/notification/store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="">{{trans('labels.title')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" placeholder="{{trans('labels.title')}}" >
                                        @error('title') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="type">{{trans('labels.type')}}</label>
                                        <select name="type" class="form-select type" data-live-search="true" id="type">
                                            <option value="" selected>{{trans('labels.select')}}</option>
                                            <option value="1" {{old('type') == 1 ? 'selected' : ''}}>{{trans('labels.cuisine')}}</option>
                                            <option value="2" {{old('type') == 2 ? 'selected' : ''}}>{{trans('labels.item')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group 1 gravity @if(old('type') == 1) @else dn @endif">
                                        <label class="col-form-label" for="">{{trans('labels.cuisine')}} <span class="text-danger">*</span></label>
                                        <select name="cuisine_id" class="form-select selectpicker" data-live-search="true" id="cuisine_id">
                                            <option value="" selected>{{trans('labels.select')}}</option>
                                            @foreach ($getcuisine as $cuisine)
                                            <option value="{{$cuisine->id}}" {{old('cuisine_id') == $cuisine->id ? 'selected' : '' }}>{{$cuisine->cuisine_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('cuisine_id') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group 2 gravity @if(old('type') == 2) @else dn @endif">
                                        <label class="col-form-label" for="">{{trans('labels.item')}} <span class="text-danger">*</span></label>
                                        <select name="item_id" class="form-select selectpicker" data-live-search="true" id="item_id">
                                            <option value="" selected>{{trans('labels.select')}}</option>
                                            @foreach ($getitem as $item)
                                            <option value="{{$item->id}}" {{old('item_id') == $item->id ? 'selected' : '' }}>{{$item->item_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('item_id') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="">{{trans('labels.message')}} <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="message" placeholder="{{trans('labels.message')}}" rows="4"></textarea>
                                        @error('message') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="form-group text-end">
                                <a href="{{URL::to('admin/notification')}}" class="btn btn-outline-danger">{{trans('labels.cancel')}}</a>
                                    <button class="btn btn-primary" type="submit">{{trans('labels.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{url('resources/views/admin/notification/notification.js')}}"></script>
@endsection
