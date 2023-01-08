<div class="col-lg-4 col-md-6  col-auto d-flex mb-4">
    <div class="card rounded">
        <a href="{{URL::to('/blogs-'.$bloglist->slug)}}"><img src="{{ Helper::image_path($bloglist->image) }}" class="card-img-top" alt="..."></a>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-auto blog-date">
                    <span>{{ Helper::date_format($bloglist->created_at) }}</span>
                </div>
                <div class="col-auto blog-author">
                    <span>{{trans('labels.post_by')}} <a href="javascript:void(0)" class="dark_color">{{trans('labels.admin_title')}}</a></span>
                </div>
            </div>
            <h5 class="card-title fw-600 dark_color"><a href="{{URL::to('/blogs-'.$bloglist->slug)}}" class="dark_color">{{ $bloglist->title }}</a></h5>
            <p class="card-text">{{ Str::limit($bloglist->description, 150) }}</p>
            <a href="{{URL::to('/blogs-'.$bloglist->slug)}}" class="btn btn-primary border-0">{{trans('labels.read_more')}}</a>
        </div>
    </div>
</div>