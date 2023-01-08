@php
$ran = ['gradient-1', 'gradient-2', 'gradient-3', 'gradient-4', 'gradient-5', 'gradient-6', 'gradient-7', 'gradient-8', 'gradient-9'];
@endphp
<table class="table">
    <thead>
        <tr>
            <th>{{ trans('labels.image') }}</th>
            <th>{{ trans('labels.item_name') }}</th>
            <th>{{ trans('labels.cuisine') }}</th>
            <th>{{ trans('labels.orders') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach ($topitems as $item)
            @if ($item->item_order_counter > 0)
                <tr>
                    <td><img src="{{ Helper::image_path($item['item_image']->image_name) }}" class="rounded hw-50" alt=""></td>
                    <td><a href="{{ URL::to('admin/item-'.$item->id) }}">{{ $item->item_name }}</a></td>
                    <td>{{ @$item['cuisine_info']->cuisine_name }}</td>
                    <td>
                        @php
                            $per = ($item->item_order_counter * 100) / count(@$getorderdetailscount);
                        @endphp
                        {{number_format($per,2)}}%
                        <div class="progress" style="height: 10px">
                            <div class="progress-bar {{ $ran[array_rand($ran, 1)] }}"
                                style="width: {{ $per }}%;" role="progressbar"><span
                                    class="sr-only">{{ $per }}% {{ trans('labels.orders') }}</span>
                            </div>
                        </div>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
