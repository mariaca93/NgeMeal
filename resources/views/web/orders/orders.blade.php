@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.my_orders') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.my_orders') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == 'rtl' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.my_orders') }}</li>
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
                <div class="col-lg-9 d-flex">
                    <div class="user-content-wrapper">
                        <p class="title">{{ trans('labels.my_orders') }}</p>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <a href="{{ URL::to('/orders?type=processing') }}"
                                    class="order-status-card {{ isset($_GET['type']) == true ? ($_GET['type'] == 'processing' || $_GET['type'] == '' ? 'border-warning' : '') : (!isset($_GET['type']) == true ? 'border-warning' : '') }}">
                                    <div class="icon bg-light-warning">
                                        {{-- <i class="fs-5 fa-solid fa-hourglass-empty"></i> --}}
                                        <img src="{{ Helper::image_path('ongoing.png') }}" width="30" height="30" alt="">
                                    </div>
                                    <div class="status-card-content px-3">
                                        <p class="text-warning">{{ trans('labels.ongoing') }}</p>
                                        <h5 class="mb-0 fw-600">{{ $totalprocessing }}</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="{{ URL::to('/orders?type=completed') }}"
                                    class="order-status-card {{ isset($_GET['type']) == true ? ($_GET['type'] == 'completed' ? 'border-green' : '') : '' }}">
                                    <div class="icon bg-light-green">
                                        {{-- <i class="fs-5 fa-solid fa-check"></i> --}}
                                        <img src="{{ Helper::image_path('completed.png') }}" width="30" height="30" alt="">
                                    </div>
                                    <div class="status-card-content px-3">
                                        <p class="green_color">{{ trans('labels.completed') }}</p>
                                        <h5 class="mb-0 fw-600">{{ $totalcompleted }}</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="{{ URL::to('/orders?type=cancelled') }}"
                                    class="order-status-card {{ isset($_GET['type']) == true ? ($_GET['type'] == 'cancelled' ? 'border-danger' : '') : '' }}">
                                    <div class="icon bg-light-danger">
                                        {{-- <i class="fs-5 fa-solid fa-xmark"></i> --}}
                                        <img src="{{ Helper::image_path('cancelled-bar.png') }}" width="30" height="30" alt="">
                                    </div>
                                    <div class="status-card-content px-3">
                                        <p class="red_color">{{ trans('labels.cancelled') }}</p>
                                        <h5 class="mb-0 fw-600">{{ $totalcancelled }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @if (count($getorders)>0)
                        <div class="row mb-3">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="rounded-top" style="color:black">
                                        <tr class="bg-light align-middle">
                                            <th class="fs-7 fw-600">{{ trans('labels.order_number') }}</th>
                                            <th class="fs-7 fw-600">{{ trans('labels.date') }}</th>
                                            <th class="fs-7 fw-600">{{ trans('labels.order_type') }}</th>
                                            <th class="fs-7 fw-600">{{ trans('labels.order_amount') }}</th>
                                            <th class="fs-7 fw-600">{{ trans('labels.payment_type') }}</th>
                                            <th class="fs-7 fw-600">{{ trans('labels.status') }}</th>
                                            <th class="fs-7 fw-600">{{ trans('labels.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="rounded-bottom" style="color:#A99EBE">
                                        @foreach ($getorders as $orderdata)
                                            <tr class="align-middle">
                                                <td class="fs-7 fw-600">{{ $orderdata->order_number }}</td>
                                                <td class="fs-7">{{ Helper::date_format($orderdata->created_at) }}
                                                </td>
                                                <td class="fs-7">
                                                    {{ $orderdata->order_type == 1 ? trans('labels.delivery') : trans('labels.pickup') }}
                                                </td>
                                                <td class="fs-7">
                                                    {{ Helper::currency_format($orderdata->grand_total) }}
                                                </td>
                                                <td class="fs-7">
                                                    @if ($orderdata->transaction_type == 1)
                                                        {{trans('labels.cash')}}
                                                    @elseif ($orderdata->transaction_type == 4)
                                                        {{trans('labels.visa')}}
                                                    @else
                                                    --
                                                    @endif
                                                </td>
                                                <td class="fs-7">
                                                    @if ($orderdata->status == '1')
                                                        <span
                                                            class="text-order-placed">{{ trans('labels.placed') }}</span>
                                                    @elseif($orderdata->status == '2')
                                                        <span
                                                            class="text-order-preparing">{{ trans('labels.preparing') }}</span>
                                                    @elseif($orderdata->status == '3')
                                                        <span
                                                            class="text-order-ready">{{ trans('labels.ready') }}</span>
                                                    @elseif($orderdata->status == '4')
                                                        @if ($orderdata->order_type == 2)
                                                            <span
                                                                class="text-order-waitingpickup">{{ trans('labels.waiting_pickup') }}</span>
                                                        @else
                                                            <span
                                                                class="text-order-ontheway">{{ trans('labels.on_the_way') }}</span>
                                                        @endif
                                                    @elseif($orderdata->status == '5')
                                                        <span
                                                            class="text-order-completed">{{ trans('labels.completed') }}</span>
                                                    @elseif($orderdata->status == '6' || $orderdata->status == '7')
                                                        <span
                                                            class="text-order-cancelled">{{ trans('labels.cancelled') }}</span>
                                                    @else
                                                        --
                                                    @endif
                                                </td>
                                                <td class="fs-7">
                                                    <a href="{{ URL::to('orders-' . $orderdata->order_number) }}"
                                                        class="btn btn-outline-info btn-sm mx-1 mb-1">
                                                        {{-- <i class="fa-regular fa-eye"></i> --}}
                                                        <img src="{{ Helper::image_path('view.png') }}" width="15" height="15" alt="">
                                                    </a>
                                                    @if ($orderdata->status == 1)
                                                        <a href="javascript:void(0)"
                                                            onclick="cancelorder('{{ $orderdata->order_number }}','{{ URL::to('/orders/cancel') }}')"
                                                            class="btn btn-danger btn-sm mx-1 mb-1">
                                                            {{-- <i class="fa-solid fa-xmark"></i> --}}
                                                            <img src="{{ Helper::image_path('cancelled-button.png') }}" width="15" height="15" alt="">
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $getorders->appends(request()->query())->links() }}
                        </div>
                        @else
                            @include('web.nodata')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ url('/web-assets/js/orders/orders.js')}}"></script>
@endsection
