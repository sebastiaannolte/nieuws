<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <meta name="description" content="Sebastiaan.dev - Blog of Sebastiaan Nolte">
    <meta name="author" content="Sebastiaan Nolte">


    {{-- Bootstrap --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />
    {{-- Custom CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" />



    </body>


</head>


<body>
    @include('menu')
    <div class="container">
        <div class="row">

            @yield('content')
            {{-- @include('side-menus.right-menu-index') --}}

        </div>
    </div>
    @include('footer')


</body>
{{-- Javascript --}}
<script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/js/app.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>


</html>
