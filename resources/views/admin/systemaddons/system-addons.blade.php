@extends('admin.theme.default')
@section('content')
    <div class="row page-titles mx-0 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ URL::to('/admin/home') }}">{{ trans('labels.dashboard') }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">System Addons</a></li>
            </ol>
            <a href="{{ URL::to('/admin/createsystem-addons') }}" class="btn btn-primary">Install/Update addons</a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0">
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                    href="#installed">Installed Addons</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#available">Available
                                    Addons</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="installed" role="tabpanel">
                                <div class="row">
                                    @forelse(\App\SystemAddons::all() as $key => $addon)
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card p-2">
                                                <img class="img-fluid rounded" src='{!! URL('storage/app/public/addons/' . $addon->image) !!}'
                                                    alt="">
                                                <div class="card-body p-0 pt-3">
                                                    <h5 class="card-title mb-1">{{ ucfirst($addon->name) }}</h5>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="card-text d-inline">Version : {{ $addon->version }}
                                                        </p>
                                                        @if ($addon->activated)
                                                            <a href="#" class="btn btn-sm btn-primary float-end"
                                                                @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="StatusUpdate('{{ $addon->id }}','0','{{ URL::to('admin/systemaddons/update') }}')" @endif>Activated</a>
                                                        @else
                                                            <a href="#" class="btn btn-sm btn-danger float-end"
                                                                @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="StatusUpdate('{{ $addon->id }}','1','{{ URL::to('admin/systemaddons/update') }}')" @endif>Deactivated</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-md-6 col-lg-3 mt-4">
                                            <h4>{{ trans('labels.no_data') }}</h4>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane fade" id="available">
                                @php
                                    $payload = file_get_contents('https://gravityinfotech.net/api/addonsapi.php?type=gravity');
                                    $obj = json_decode($payload);
                                @endphp
                                <div class="row">
                                    @foreach ($obj->data as $item)
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card p-2">
                                                <img class="img-fluid rounded" src='{{ $item->image }}'
                                                    alt="">
                                                <div class="card-body p-0 pt-3">
                                                    <h5 class="card-title mb-1">{{ $item->name }}</h5>
                                                    <small>{{ $item->short_description }}</small>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ $item->purchase }}" target="_blank"
                                                            class="btn btn-sm btn-primary">Purchase</a>
                                                        <a href="{{ $item->link }}" target="_blank"
                                                            class="btn btn-sm btn-success float-end">Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ url('resources/views/admin/systemaddons/systemaddons.js') }}"></script>
@endsection
