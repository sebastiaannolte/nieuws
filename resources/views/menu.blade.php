<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="/" class="navbar-brand"></a>
        </div>
        <!-- class="visible-xs-inline-block"：在超小屏幕上显示-->
        <label for="toggle-checkbox" id="toggle-label" class="visible-xs-inline-block">Menu</label>
        <input type="checkbox" class="hidden" id="toggle-checkbox">
        <div class="hidden-xs">
            <ul class="nav navbar-nav">
                @foreach ($menu as $item)
                <li class="{{ strtolower(Request::segment(1)) == (strtolower($item->category_name)) ? 'active' : '' }}">
                    <a href="/{{strtolower($item->category_name)}}/">{{$item->category_name}}</a></li>
                @endforeach

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.html">Login</a></li>
                <li><a href="signup.html">Registreren</a></li>
            </ul>
        </div>
    </div>
</div>
