@extends('admin.theme.default')
@section('content')
@include('admin.breadcrumb')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning">
                <i class="fa-regular fa-circle-exclamation"></i> {{ trans('labels.only_mobile') }}
            </div>
            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive" id="table-display">
                        @include('admin.tutorial.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ url('resources/views/admin/tutorial/tutorial.js') }}"></script>
@endsection