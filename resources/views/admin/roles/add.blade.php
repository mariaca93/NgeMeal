@extends('admin.theme.default')
@section('content')
@include('admin.breadcrumb')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="form-validation roles-form">
                        <form action="{{URL::to('admin/roles/store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="">{{trans('labels.role_name')}} <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="name" placeholder="{{trans('labels.role_name')}}" >
                                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="">{{trans('labels.system_modules')}} <span class="text-danger">*</span> </label>
                                        <div class="row mb-0">
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox0">
                                                    <input type="checkbox" class="me-2" id="checkbox0" name="modules[]" value="0" {{ !empty(old('modules')) && in_array(0,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.dashboard')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.dashboard')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox1">
                                                    <input type="checkbox" class="me-2" id="checkbox1" name="modules[]" value="1" {{ !empty(old('modules')) && in_array(1,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.orders')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.orders')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox2">
                                                    <input type="checkbox" class="me-2" id="checkbox2" name="modules[]" value="2" {{ !empty(old('modules')) && in_array(2,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.report')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.report')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox3">
                                                    <input type="checkbox" class="me-2" id="checkbox3" name="modules[]" value="3" {{ !empty(old('modules')) && in_array(3,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.sliders')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.sliders')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox4">
                                                    <input type="checkbox" class="me-2" id="checkbox4" name="modules[]" value="4" {{ !empty(old('modules')) && in_array(4,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.banners')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.banners')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox5">
                                                    <input type="checkbox" class="me-2" id="checkbox5" name="modules[]" value="5" {{ !empty(old('modules')) && in_array(5,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.promocodes')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.promocodes')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox6">
                                                    <input type="checkbox" class="me-2" id="checkbox6" name="modules[]" value="6" {{ !empty(old('modules')) && in_array(6,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.notification')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.notification')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox7">
                                                    <input type="checkbox" class="me-2" id="checkbox7" name="modules[]" value="7" {{ !empty(old('modules')) && in_array(7,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.cuisines')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.cuisines')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox8">
                                                    <input type="checkbox" class="me-2" id="checkbox8" name="modules[]" value="8" {{ !empty(old('modules')) && in_array(8,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.subcuisines')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.subcuisines')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox9">
                                                    <input type="checkbox" class="me-2" id="checkbox9" name="modules[]" value="9" {{ !empty(old('modules')) && in_array(9,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.addons')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.addons')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox10">
                                                    <input type="checkbox" class="me-2" id="checkbox10" name="modules[]" value="10" {{ !empty(old('modules')) && in_array(10,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.items')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.items')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox11">
                                                    <input type="checkbox" class="me-2" id="checkbox11" name="modules[]" value="11" {{ !empty(old('modules')) && in_array(11,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.zone')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.zone')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox12">
                                                    <input type="checkbox" class="me-2" id="checkbox12" name="modules[]" value="12" {{ !empty(old('modules')) && in_array(12,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.working_hours')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.working_hours')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox13">
                                                    <input type="checkbox" class="me-2" id="checkbox13" name="modules[]" value="13" {{ !empty(old('modules')) && in_array(13,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.payment_methods')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.payment_methods')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox14">
                                                    <input type="checkbox" class="me-2" id="checkbox14" name="modules[]" value="14" {{ !empty(old('modules')) && in_array(14,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.reviews')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.reviews')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox15">
                                                    <input type="checkbox" class="me-2" id="checkbox15" name="modules[]" value="15" {{ !empty(old('modules')) && in_array(15,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.bookings')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.bookings')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox16">
                                                    <input type="checkbox" class="me-2" id="checkbox16" name="modules[]" value="16" {{ !empty(old('modules')) && in_array(16,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.inquiries')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.inquiries')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox17">
                                                    <input type="checkbox" class="me-2" id="checkbox17" name="modules[]" value="17" {{ !empty(old('modules')) && in_array(17,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.customers')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.customers')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox18">
                                                    <input type="checkbox" class="me-2" id="checkbox18" name="modules[]" value="18" {{ !empty(old('modules')) && in_array(18,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.drivers')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.drivers')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox19">
                                                    <input type="checkbox" class="me-2" id="checkbox19" name="modules[]" value="19" {{ !empty(old('modules')) && in_array(19,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.employee_role')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.employee_role')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox20">
                                                    <input type="checkbox" class="me-2" id="checkbox20" name="modules[]" value="20" {{ !empty(old('modules')) && in_array(20,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.employee')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.employee')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox21">
                                                    <input type="checkbox" class="me-2" id="checkbox21" name="modules[]" value="21" {{ !empty(old('modules')) && in_array(21,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.pages')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.pages')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox22">
                                                    <input type="checkbox" class="me-2" id="checkbox22" name="modules[]" value="22" {{ !empty(old('modules')) && in_array(22,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.general_settings')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.general_settings')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox23">
                                                    <input type="checkbox" class="me-2" id="checkbox23" name="modules[]" value="23" {{ !empty(old('modules')) && in_array(23,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.addons_manager')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.addons_manager')}}">
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox24">
                                                    <input type="checkbox" class="me-2" id="checkbox24" name="modules[]" value="24" {{ !empty(old('modules')) && in_array(24,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.clear_cache')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.clear_cache')}}">
                                                </label>
                                            </div>
                                            @if (\App\SystemAddons::where('unique_identifier', 'pos')->first() != null && \App\SystemAddons::where('unique_identifier', 'pos')->first()->activated)
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox25">
                                                    <input type="checkbox" class="me-2" id="checkbox25" name="modules[]" value="25" {{ !empty(old('modules')) && in_array(25,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.pos')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.pos')}}">
                                                </label>
                                            </div>
                                            @endif
                                            @if (\App\SystemAddons::where('unique_identifier', 'otp')->first() != null && \App\SystemAddons::where('unique_identifier', 'otp')->first()->activated)
                                            <div class="col-lg-4 col-md-6 py-2">
                                                <label class="cursor-pointer" for="checkbox26">
                                                    <input type="checkbox" class="me-2" id="checkbox26" name="modules[]" value="26" {{ !empty(old('modules')) && in_array(26,old('modules')) ? 'checked' : '' }}>
                                                    {{trans('labels.otp_configuration')}}
                                                    <input type="hidden" name="title[]" value="{{trans('labels.otp_configuration')}}">
                                                </label>
                                            </div>
                                            @endif
                                            @error('modules') <br><span class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-end">
                                <a href="{{URL::to('admin/roles')}}" class="btn btn-outline-danger">{{trans('labels.cancel')}}</a>
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