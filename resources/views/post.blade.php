@extends('masters.master-post')

@section('title', $post->title)

@section('content')
<div class="col-xs-8">
    <h1 class="news-title">{{$post->title}}</h1>
    <div class="news-status">25k weergaven • {{time_elapsed_string($post->created_at)}}
        @foreach ($post->category_links as $tag)
        <div class="label label-default">{{$tag->category_name}}</div>
        @endforeach

    </div>
    <div class="news-content">
        <img class="center-block" src="{{$post->getImage()}}">
        {{$post->description}}
    </div>
</div>



@endsection
