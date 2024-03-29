<div class="paymenterror alert alert-danger my-2 py-1 d-none"> {{ trans('messages.payment_selection_required') }}</div>
<div class="row justify-content-center">
    @foreach ($getpaymentmethods as $key => $pmdata)
        @php
            $transaction_type = $pmdata->id;
            $paymentname = $pmdata->payment_name;
        @endphp
        <label class="form-check-label col-md-6" for="payment{{ $transaction_type }}">
            <input class="form-check-input" type="radio" name="transaction_type"
                id="payment{{ $transaction_type }}"
                data-payment-type="{{ $transaction_type }}"
                value="{{ $transaction_type }}" data-currency="{{ $pmdata->currency }}" {{$key == 0 ? 'checked' : ''}}>
            <div class="payment-gateway mt-2 mb-0">
                <img src="{{ Helper::image_path($pmdata->image) }}" alt="">
                {{ ucfirst($paymentname) }}
                @if (in_array($transaction_type, [3, 4, 5, 6]))
                    @if ($transaction_type == 4)
                        <input type="hidden" name="stripekey" id="stripekey" value="{{ $pmdata->public_key }}">
                    @endif
                @endif
            </div>
        </label>
        @if ($transaction_type == 4)
            <form action="" method="" id="payment-form">
                <div class="my-3 d-none" id="card-element"></div>
            </form>
        @endif
    @endforeach
    @if (!in_array(4, array_column($getpaymentmethods->toArray(),'id')))
        <input type="hidden" name="stripekey" id="stripekey" value="">
    @endif
</div>