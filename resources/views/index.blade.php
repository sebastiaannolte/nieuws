@extends('masters.master-index')

@section('title', 'Nieuws')
@section('content')



<div class="col-sm-2">
    <div class="list-group side-bar hidden-xs">
        {{-- @foreach ($sub_categories as $category)
                <a href="/c/{{$category->category_name}}" class="list-group-item">{{$category->category_name}}</a>
        @endforeach --}}
        {{-- <a href="#" class="list-group-item">ChristenUnie</a>
                <a href="#" class="list-group-item">D66</a>
                <a href="#" class="list-group-item">Forum voor Democratie</a>
                <a href="#" class="list-group-item">GroenLinks</a>
                <a href="#" class="list-group-item">PvdA</a>
                <a href="#" class="list-group-item">PvdD</a>
                <a href="#" class="list-group-item">PVV</a> --}}
    </div>
</div>
<div class="col-sm-7">
    <div class="news-list">
        @foreach ($posts as $post)
        <div class="news-list-item clearfix">
            <div class="col-xs-5">
                {{-- {{dd($post->category_links->first()->id)}} --}}
                <img src="{{$post->getImage()}}">
            </div>

            <div class="col-xs-7">


                {{-- {{dd($post->category_links->first()->category_name)}}
                {{-- {{$idd = $post->category_links->first()->id}} --}}
                {{-- --}}
                {{-- {{dd($post)}} --}}
                <a href="/{{$post->category_links->first()['slug']}}" class="title">{{$post->title}}</a>


                <div class="info">
                    <span class="avatar"><img src="img/logo.png"></span>
                    @foreach ($post->category_links as $tag)
                    <div class="label label-default">{{$tag->category_name}}</div>
                    @endforeach


                    <span>{{time_elapsed_string($post->created_at)}}</span>
                </div>
            </div>
        </div>
        @endforeach
        {{-- <div class="news-list-item clearfix">
            <div class="col-xs-5">
                <img src="img/003.jpg">
            </div>
            <div class="col-xs-7">
                <a href="news.html" class="title">医保异地结算已实现：只需4步，一分钟看懂怎么办</a>
                <div class="info">
                    <span class="avatar"><img src="img/logo.png"></span>
                    <span>王花花</span>•
                    <span>25k评论</span>•
                    <span>10分钟前</span>
                </div>
            </div>
        </div>
        <div class="news-list-item clearfix">
            <div class="col-xs-5">
                <img src="img/004.jpg">
            </div>
            <div class="col-xs-7">
                <a href="news.html" class="title">医保异地结算已实现：只需4步，一分钟看懂怎么办</a>
                <div class="info">
                    <span class="avatar"><img src="img/logo.png"></span>
                    <span>王花花</span>•
                    <span>25k评论</span>•
                    <span>10分钟前</span>
                </div>
            </div>
        </div>
        <div class="news-list-item clearfix">
            <div class="col-xs-5">
                <img src="img/005.jpg">
            </div>
            <div class="col-xs-7">
                <a href="news.html" class="title">医保异地结算已实现：只需4步，一分钟看懂怎么办</a>
                <div class="info">
                    <span class="avatar"><img src="img/logo.png"></span>
                    <span>王花花</span>•
                    <span>25k评论</span>•
                    <span>10分钟前</span>
                </div>
            </div>
        </div> --}}
    </div>
    {!! $posts->render() !!}
</div>


@endsection
