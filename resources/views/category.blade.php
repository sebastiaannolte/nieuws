@extends('masters.master-category')

@section('title', ucfirst(basename(Request::url())))

@section('content')

<div class="col-sm-7">
    <div class="news-list">
        <?php $i = 0;?>

        @foreach ($posts as $post)

        <div class="news-list-item clearfix">
            <div class="col-xs-5">

                <img src="{{ $post->getImage() }}">
            </div>
            <div class="col-xs-7">
                <a href="/{{$post->category_path($post->category_links->first()['id'])}}"
                    class="title">{{$post->title}}</a>
                <div class="info">
                    <span class="avatar"><img src="{{asset('img/logo.png')}}"></span>
                    @foreach ($post->category_links as $tag)
                    <div class="label label-default">{{$tag->category_name}}</div>
                    @endforeach

                    <span>25k Weergaven</span>•
                    <span>{{time_elapsed_string($post->created_at)}}</span>
                </div>
            </div>
        </div>
        <?php $i++; ?>
        @endforeach
    </div>
    {!! $posts->render() !!}
</div>


@endsection
