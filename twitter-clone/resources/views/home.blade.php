@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-dark d-flex justify-content-center w-50 mx-auto rounded">
        <a class="w-50 btn {{ Route::currentRouteName() === 'home' ? 'btn-info' : 'btn-dark' }} rounded-end-0"
            href="{{route('home')}}">All</a>
        <a class="w-50 btn {{ Route::currentRouteName() === 'homeFollowed' ? 'btn-info' : 'btn-dark' }} rounded-start-0"
            href="{{route('homeFollowed')}}">Followed</a>
    </div>
    @foreach ($posts as $post)
    @include('posts.post')
    @endforeach
    @include('posts.show')
</div>
<div id="messages-container" class="fixed-bottom w-fit d-flex flex-row"></div>
@endsection