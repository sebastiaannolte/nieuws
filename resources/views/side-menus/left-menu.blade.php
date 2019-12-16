<div class="col-sm-2">
    <div class="list-group side-bar hidden-xs">
        @foreach ($sub_menu as $item)
        <a href="{{'/'.$urls.'/'.create_slug($item->category_name).'/'}}"
            class="list-group-item {{ strtolower(request()->segment(count(request()->segments()))) == (strtolower($item->category_name)) ? 'active' : '' }}">{{$item->category_name}}</a>
        @endforeach
    </div>
</div>
