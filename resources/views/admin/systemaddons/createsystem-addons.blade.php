@extends('admin.theme.default')
@section('content')
<div class="row page-titles mx-0 mb-3">
    <div class="d-flex justify-content-between align-items-center">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">{{ trans('labels.dashboard') }}</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">System Addons</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                    <h4 class="card-title">Install Addon</h4>
                    <p class="text-muted"><code></code>
                    </p>
                    <div id="privacy-policy-three" class="privacy-policy">
                        <form method="post" action="{{ URL::to('admin/systemaddons/store')}}" name="about" id="about" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3 col-md-12">
                                    <div class="form-group">
                                        <label for="addon_zip" class="col-form-label">Zip File</label>
                                        <input type="file" class="form-control" name="addon_zip" id="addon_zip" required="">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>Install</button>
                            <a href="{{URL::to('admin/systemaddons')}}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection