<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{trans('labels.name')}}</th>
            <th>{{trans('labels.cuisine')}}</th>
            <th>{{trans('labels.status')}}</th>
            <th>{{trans('labels.action')}}</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach ($getsubcuisine as $cuisine)
        <tr id="dataid{{$cuisine->id}}">
            <td>@php echo $i++; @endphp</td>
            <td>{{$cuisine->subcuisine_name}}</td>
            <td>{{@$cuisine['cuisine_info']->cuisine_name}}</td>
            <td>
                @if ($cuisine->is_available == 1)
                    <a class="btn btn-sm btn-outline-success" @if(env('Environment')=='sendbox') onclick="myFunction()" @else onclick="StatusUpdate('{{$cuisine->id}}','2','{{ URL::to('admin/sub-cuisine/status')}}')" @endif><i class="fa-sharp fa-solid fa-check"></i></a>
                @else
                    <a class="btn btn-sm btn-outline-danger" @if(env('Environment')=='sendbox') onclick="myFunction()" @else onclick="StatusUpdate('{{$cuisine->id}}','1','{{ URL::to('admin/sub-cuisine/status')}}')" @endif><i class="fa-sharp fa-solid fa-xmark"></i></a>
                @endif
            </td>
            <td>
                <a class="btn btn-sm btn-outline-info" href="{{URL::to('admin/sub-cuisine-'.$cuisine->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-sm btn-outline-danger" @if(env('Environment')=='sendbox') onclick="myFunction()" @else onclick="Delete('{{$cuisine->id}}','{{URL::to('admin/sub-cuisine/delete')}}')" @endif><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>