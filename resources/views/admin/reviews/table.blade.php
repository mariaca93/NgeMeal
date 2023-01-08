<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('labels.image') }}</th>
            <th>{{ trans('labels.name') }}</th>
            <th>{{ trans('labels.date') }}</th>
            <th>{{ trans('labels.reviews') }}</th>
            <th>{{ trans('labels.message') }}</th>
            <th>{{ trans('labels.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach ($getreview as $reviews)
            <tr>
                <td>@php echo $i++; @endphp</td>
                <td><img src="{{$reviews['user_info']->profile_image}}" class="img-fluid rounded hw-50" alt="..."></td>
                <td>{{$reviews['user_info']->name}}</td>
                <td>{{Helper::date_format($reviews->created_at)}}</td>
                <td><i class="fa fa-star text-warning"></i> {{number_format($reviews->ratting,1)}} </td>
                <td><small>{{$reviews->comment}}</small></td>
                <td>
                    <a class="btn btn-sm btn-outline-danger" @if(env('Environment')=='sendbox') onclick="myFunction()" @else onclick="DeleteData('{{$reviews->id}}','{{URL::to('admin/reviews/destroy')}}')" @endif><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
