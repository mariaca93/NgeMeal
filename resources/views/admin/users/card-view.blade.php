@if (count($getusers) > 0)
    <div class="row">
        @foreach ($getusers as $users)
            <div class="col-lg-3 col-md-4 col-sm-6 mt-5 mb-2">
                <div class="card border-0  card-section text-center">
                    <img src="{{Helper::image_path($users->profile_image)}}" class="listing-view-image mx-auto" alt="...">
                    <div class="card-body py-3">
                        <h6 class="card-title fw-bold mb-2">{{$users->name}}</h6>
                        <div class="item-details px-2">
                            <div class="d-flex justify-content-between">{{trans('labels.referral_code')}} <span>{{$users->referral_code}}</span></div>
                            <div class="d-flex justify-content-between">{{trans('labels.mobile')}} <span>{{$users->mobile}}</span></div>
                            <div class="d-flex justify-content-between">{{trans('labels.email')}} <span>{{$users->email}}</span></div>
                            <div class="d-flex justify-content-between">{{trans('labels.login_with')}} <span>@if($users->login_type == "facebook") {{trans('labels.facebook')}} @elseif($users->login_type == "google") {{trans('labels.google')}} @else {{trans('labels.email')}}@endif</span></div>
                            <div class="d-flex justify-content-between">{{trans('labels.otp_status')}} <span>{{$users->is_verified == "1" ? trans('labels.verified') : trans('labels.unverified')}}</span></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        @if ($users->is_available == 1)
                            <a class="btn btn-sm d-grid text-success" @if(env('Environment')=='sendbox') onclick="myFunction()" @else onclick="StatusUpdate('{{$users->id}}','2','{{URL::to('admin/users/status')}}')" @endif>
                                <i class="fa fa-check"></i><small>{{trans('labels.status')}}</small>
                            </a>
                        @else
                            <a class="btn btn-sm d-grid text-danger" @if(env('Environment')=='sendbox') onclick="myFunction()" @else onclick="StatusUpdate('{{$users->id}}','1','{{URL::to('admin/users/status')}}')" @endif>
                                <i class="fa fa-close"></i><small>{{trans('labels.status')}}</small>
                            </a>
                        @endif
                        <a class="btn btn-sm d-grid text-info" href="{{URL::to('admin/users-'.$users->id)}}">
                            <i class="fa fa-eye"></i><small>{{trans('labels.view')}}</small>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            {{$getusers->links()}}
        </div>
    </div>
@else
@include('admin.nodata')
@endif