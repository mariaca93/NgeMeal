<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{trans('labels.image')}}</th>
            <th>{{trans('labels.cuisine')}}</th>
            <th>{{trans('labels.status')}}</th>
            <th>{{trans('labels.action')}}</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach ($getcuisine as $cuisine)
        <tr id="dataid{{$cuisine->id}}">
            <td>@php echo $i++; @endphp</td>
            <td><img src='{{Helper::image_path($cuisine->image)}}' class='img-fluid rounded hw-50'></td>
            <td>{{$cuisine->cuisine_name}}</td>
            <td>
                @if($cuisine->is_available == 1)
                    <a class="btn btn-sm btn-outline-success" @if(env('Environment')=='sendbox') onclick="myFunction()" @else onclick="StatusUpdate('{{$cuisine->id}}','2','{{URL::to('admin/cuisine/status')}}')" @endif><i class="fa-sharp fa-solid fa-check"></i></a>
                @else
                    <a class="btn btn-sm btn-outline-danger" @if(env('Environment')=='sendbox') onclick="myFunction()" @else onclick="StatusUpdate('{{$cuisine->id}}','1','{{URL::to('admin/cuisine/status')}}')" @endif><i class="fa-sharp fa-solid fa-xmark"></i></a>
                @endif
            </td>
            <td>
                <a class="btn btn-sm btn-outline-info" href="{{URL::to('admin/cuisine-'.$cuisine->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-sm btn-outline-danger" href="javascript:void(0)" @if(env('Environment')=='sendbox') onclick="myFunction()" @else onclick="Delete('{{$cuisine->id}}','{{URL::to('admin/cuisine/delete')}}')" @endif><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>