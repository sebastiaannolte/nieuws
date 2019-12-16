@inject('postId', 'App\Http\Controllers\HomeController')
<div class="side-bar-card">
    <div class="card-title">Nieuw</div>
    <div class="card-body">
        <div class="list">
            <?php $i = 0;?>

            @foreach ($newPosts as $newPost)
            <div class="item">
                <a href="/{{$newPost->category_path($newPost->category_links->first()['id'])}}"
                    class="title">{{$newPost->title}}</a>
                <div class="desc">
                    @foreach ($newPost->category_links as $tag)
                    <div class="label label-default">{{$tag->category_name}}</div>
                    @endforeach
                    {{time_elapsed_string($newPost->created_at)}}
                    {{-- - 15k Weergaven --}}
                </div>
            </div>
            <?php $i++; ?>
            @endforeach
        </div>
    </div>
</div>
