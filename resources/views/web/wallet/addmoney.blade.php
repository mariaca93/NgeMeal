@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.add_money') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.add_money') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.add_money') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-3 d-flex">
                    @include('web.layout.usersidebar')
                </div>
                <div class="col-lg-9">
                    <div class="user-content-wrapper">
                        <div class="row justify-content-between mb-3">
                            <div class="col-auto">
                                <p class="title">{{ trans('labels.add_money') }}</p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">{{ trans('labels.amount') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded">{{@Helper::appdata()->currency }}</span>
                                    <input type="text" class="form-control rounded" name="amount" id="amount"
                                        placeholder="{{ trans('messages.amount_required') }}">
                                </div>
                                <small
                                    class="amounterror text-danger d-none">{{ trans('messages.amount_required') }}</small>
                            </div>
                        </div>
                        <div class="payment-option mb-3">
                            {{-- payment-options --}}
                            @include('web.paymentmethodsview')
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary"
                                onclick="addmoney()">{{ trans('labels.proceed_to_pay') }}</button>
                        </div>
                        <div class="mb-3">
                            <p class="mb-0">{{ trans('labels.notes') }} :</p>
                            <ul>
                                <li class="text-muted"><i
                                        class="fa-regular fa-circle-check mx-2 text-success"></i>{{ trans('labels.wallet_add_note_1') }}
                                </li>
                                <li class="text-muted"><i
                                        class="fa-regular fa-circle-check mx-2 text-success"></i>{{ trans('labels.wallet_add_note_2') }}
                                </li>
                            </ul>
                        </div>
                        <input type="hidden" name="walleturl" id="walleturl" value="{{ URL::to('/wallet/recharge') }}">
                        <input type="hidden" name="successurl" id="successurl" value="{{ URL::to('/wallet') }}">
                        <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="user_email" id="user_email" value="{{ Auth::user()->email }}">
                        <input type="hidden" name="user_mobile" id="user_mobile" value="{{ Auth::user()->mobile }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="{{ url('/resources/views/web/wallet/wallet.js')}}"></script>
@endsection
