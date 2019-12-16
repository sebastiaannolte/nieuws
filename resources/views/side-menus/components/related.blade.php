<div class="side-bar-card related">

    <div class="card-body">
        <div class="card-title">Gerelateerd</div>
        <div class="list related-main">
            @foreach ($relatedPosts as $post)
            <div class="item clearfix related-item">
                <div class="col-xs-5 no-padding-h"><img src="{{$post->getImage()}}"></div>
                <div class="col-xs-7">
                    <div class="title">
                        <a href="/{{$post->category_path($post->category_links->first()['id'])}}"
                            class="title">{{$post->title}}</a>
                    </div>
                    @foreach ($post->category_links as $tag)
                    <div class="label label-default">{{$tag->category_name}}</div>
                    @endforeach
                    <div class="desc">25k weergaven • {{time_elapsed_string($post->created_at)}}</div>

                </div>
            </div>
            @endforeach
            {{-- <div class="item clearfix">
                <div class="col-xs-5 no-padding-h"><img src="https://dummyimage.com/1000x700/666/ccc"></div>
                <div class="col-xs-7">
                    <div class="title">记结婚高圆圆与赵又廷北京登</div>
                    <div class="desc">25k阅读•35分钟前发布</div>
                </div>
            </div>
            <div class="item clearfix">
                <div class="col-xs-5 no-padding-h"><img src="https://dummyimage.com/1000x700/666/ccc"></div>
                <div class="col-xs-7">
                    <div class="title">记结婚高圆圆与赵又廷北京登</div>
                    <div class="desc">25k阅读•35分钟前发布</div>
                </div>
            </div>
            <div class="item clearfix">
                <div class="col-xs-5 no-padding-h"><img src="https://dummyimage.com/1000x700/666/ccc"></div>
                <div class="col-xs-7">
                    <div class="title">记结婚高圆圆与赵又廷北京登</div>
                    <div class="desc">25k阅读•35分钟前发布</div>
                </div>
            </div>
            <div class="item clearfix">
                <div class="col-xs-5 no-padding-h"><img src="https://dummyimage.com/1000x700/666/ccc"></div>
                <div class="col-xs-7">
                    <div class="title">记结婚高圆圆与赵又廷北京登</div>
                    <div class="desc">25k阅读•35分钟前发布</div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
