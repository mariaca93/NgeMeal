@extends('admin.theme.default')
@section('content')
    @include('admin.breadcrumb')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 float-end">
                    <form action="{{URL::to('admin/item')}}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control rounded" name="search" @isset($_GET['search']) value="{{$_GET['search']}}" @endisset placeholder="{{trans('labels.type_and_enter')}}" aria-label="{{trans('labels.type_and_enter')}}" aria-describedby="basic-addon2">
                            <div class="input-group-append px-1">
                                <button class="btn btn-outline-secondary rounded" type="submit">{{ trans('labels.fetch') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="table-responsive" id="table-display">
                            @include('admin.item.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{url('resources/views/admin/item/additem.js')}}"></script>
@endsection
