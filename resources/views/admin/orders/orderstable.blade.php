<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.order_number') }}</th>
            <th>{{ trans('labels.date') }}</th>
            <th>{{ trans('labels.user_info') }}</th>
            <th>{{ trans('labels.order_type') }}</th>
            <th>{{ trans('labels.amount') }}</th>
            <th>{{ trans('labels.payment_type') }}</th>
            <th>{{ trans('labels.status') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
            foreach ($getorders as $orderdata) {
                ?>
        <tr id="dataid{{ $orderdata->id }}">
            <td> <?php echo $i++;?></td>
            <td>
                <a href="{{ URL::to('admin/invoice/' . $orderdata->id) }}">
                    {{ $orderdata->order_number }}
                </a>
            </td>
            <td>{{ Helper::date_format($orderdata->created_at) }}</td>
            <td>{{ @$orderdata['user_info']->name }}</td>
            <td>{{ $orderdata->order_type == 1 ? trans('labels.delivery') : trans('labels.pickup') }}</td>
            <td>{{ Helper::currency_format($orderdata->grand_total) }}</td>
            <td>
                @if ($orderdata->transaction_type == 1)
                    {{ trans('labels.cash') }}
                @elseif ($orderdata->transaction_type == 2)
                    {{ trans('labels.wallet') }}
                @elseif ($orderdata->transaction_type == 3)
                    {{ trans('labels.razorpay') }}
                @elseif ($orderdata->transaction_type == 4)
                    {{ trans('labels.stripe') }}
                @elseif ($orderdata->transaction_type == 5)
                    {{ trans('labels.flutterwave') }}
                @elseif ($orderdata->transaction_type == 6)
                    {{ trans('labels.paystack') }}
                @else
                    --
                @endif
            </td>
            <td>
                @if ($orderdata->status == '1')
                    <span class="text-order-placed">{{ trans('labels.placed') }}</span>
                @elseif($orderdata->status == '2')
                    <span class="text-order-preparing">{{ trans('labels.preparing') }}</span>
                @elseif($orderdata->status == '3')
                    <span class="text-order-ready">{{ trans('labels.ready') }}</span>
                @elseif($orderdata->status == '4')
                    @if ($orderdata->order_type == 2)
                        <span class="text-order-waitingpickup">{{ trans('labels.waiting_pickup') }}</span>
                    @else
                        <span class="text-order-ontheway">{{ trans('labels.on_the_way') }}</span>
                    @endif
                @elseif($orderdata->status == '5')
                    <span class="text-order-completed">{{ trans('labels.completed') }}</span>
                @elseif($orderdata->status == '6' || $orderdata->status == '7')
                    <span class="text-order-cancelled">{{ trans('labels.cancelled') }}</span>
                @else
                    --
                @endif
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-dark dropdown-toggle"
                    data-bs-toggle="dropdown">{{ trans('labels.action') }}</button>
                <div class="dropdown-menu dropdown-menu-right">
                    @if ($orderdata->order_from == 'pos')
                        <a class="dropdown-item w-auto @if ($orderdata->status == '2') fw-600 @endif"
                              title="{{ trans('labels.complete') }}"
                            onclick="OrderStatusUpdate('{{ $orderdata->id }}','5','{{ URL::to('admin/orders/update') }}')">
                            {{ trans('labels.complete') }} </a>
                        <a class="dropdown-item w-auto" 
                              title="{{ trans('labels.reject') }}"
                            onclick="OrderStatusUpdate('{{ $orderdata->id }}','6','{{ URL::to('admin/orders/update') }}')">
                            {{ trans('labels.reject') }} </a>
                    @else
                        <a class="dropdown-item w-auto @if ($orderdata->status == '1') fw-600 @endif"
                              title="{{ trans('labels.accept') }}"
                            onclick="OrderStatusUpdate('{{ $orderdata->id }}','2','{{ URL::to('admin/orders/update') }}')">{{ trans('labels.accept') }}</a>
                        <a class="dropdown-item w-auto @if ($orderdata->status == '2') fw-600 @endif"
                              title="{{ trans('labels.ready') }}"
                            onclick="OrderStatusUpdate('{{ $orderdata->id }}','3','{{ URL::to('admin/orders/update') }}')">{{ trans('labels.ready') }}</a>
                        @if ($orderdata->order_type == '2')
                            <a class="dropdown-item w-auto @if ($orderdata->status == '3') fw-600 @endif"
                                  title="{{ trans('labels.ready_pickup') }}"
                                onclick="OrderStatusUpdate('{{ $orderdata->id }}','4','{{ URL::to('admin/orders/update') }}')">{{ trans('labels.ready_pickup') }}</a>
                        @else
                            <a class="dropdown-item w-auto @if ($orderdata->status == '3') fw-600 @endif open-AddBookDialog"
                                data-bs-toggle="modal" data-id="{{ $orderdata->id }}"
                                data-number="{{ $orderdata->order_number }}"
                                data-bs-target="#myModal">{{ trans('labels.assign_to_driver') }}</a>
                        @endif
                        <a class="dropdown-item w-auto @if ($orderdata->status == '4') fw-600 @endif"
                              title="{{ trans('labels.complete') }}"
                            onclick="OrderStatusUpdate('{{ $orderdata->id }}','5','{{ URL::to('admin/orders/update') }}')">{{ trans('labels.complete') }}</a>
                        <a class="dropdown-item w-auto" 
                              title="{{ trans('labels.reject') }}"
                            onclick="OrderStatusUpdate('{{ $orderdata->id }}','6','{{ URL::to('admin/orders/update') }}')">{{ trans('labels.reject') }}</a>
                    @endif
                </div>
                <a class="btn btn-sm btn-light" title="{{ trans('labels.view') }}" href="{{ URL::to('admin/invoice/' . $orderdata->id) }}"><i class="fa fa-list"></i></a>
            </td>
        </tr>
        <?php
        $i++;
        }
        ?>
    </tbody>
</table>
