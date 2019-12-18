@extends('masters.master-category')

@section('title', ucfirst(basename(Request::url())))

@section('content')

<div class="col-sm-7">
    <div class="news-list">
        <?php $i = 0;?>

        @foreach ($posts as $post)

        <div class="news-list-item clearfix">
            <div class="col-xs-5">
                {{-- {{dump($post)}} --}}
                <img src="{{ $post->post_links()->first()['title'] }}">
            </div>
            <div class="col-xs-7">
                <a href="/p/{{ $post->post_links()->first()['slug'] }}"
                    class="title">{{ $post->post_links()->first()['title'] }}</a>
                <div class="info">
                    <span class="avatar"><img src="{{asset('img/logo.png')}}"></span>
                    {{-- @foreach ($post as $tag) --}}
                    <div class="label label-default">{{$post->category_name}}</div>
                    {{-- @endforeach --}}

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
