@extends('errors.master-error')

@section('title', $msg)

@section('content')
<div class="error-message">
    <h1>
        <small>{{$msg}}</small>
    </h1>
    <a href="/" class="button">Naar de homepagina</a>

</div>

@endsection
