@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Error!</h1>
        <p class="lead">{{ $msg }}</p>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg" href="{{ $url }}" role="button">もどる</a>
    </div>
</div>
@endsection