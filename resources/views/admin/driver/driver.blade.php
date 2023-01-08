@extends('admin.theme.default')
@section('content')
@include('admin.breadcrumb')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive" id="table-display">
                        @include('admin.driver.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{url('resources/views/admin/driver/driver.js')}}"></script>
@endsection
