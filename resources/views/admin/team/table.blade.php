<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>{{trans('labels.image')}}</th>
            <th>{{trans('labels.title')}}</th>
            <th>{{trans('labels.subtitle')}}</th>
            <th>{{trans('labels.description')}}</th>
            <th>{{trans('labels.action')}}</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach ($getteams as $team)
        <tr id="dataid{{$team->id}}">
            <td>@php echo $i++; @endphp</td>
            <td><img src='{{Helper::image_path($team->image)}}' alt="{{$team->image}}" class='img-fluid rounded hw-50'></td>
            <td>{{$team->title}}</td>
            <td>{{$team->subtitle}}</td>
            <td>{{$team->description}}</td>
            <td>
                <a class="btn btn-sm btn-outline-info" href="{{URL::to('admin/our-team-'.$team->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-sm btn-outline-danger" @if(env('Environment')=='sendbox') onclick="myFunction()" @else onclick="Delete('{{$team->id}}','{{URL::to('admin/our-team/delete')}}')" @endif><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>