@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $post)
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card bg-custom-dark text-light shadow">

                <div class="card-header d-flex justify-content-between">
                    <div>{{'@'}}{{$post->user->username}}</div>
                    <div onclick="showMessages({{Auth::user()->id}}, {{$post->user->id}})">
                        <i class="fa-solid fa-message text-info"></i>
                    </div>
                </div>


                <div class="card-body d-flex flex-column align-items-center justify-content-center post-hover">
                    <div>{{$post->text}}</div>
                    <hr class="text-light w-75">
                    <img class="shadow w-75 rounded my-1" src="{{asset('images/'.$post->img)}}" alt="">
                    <hr class="text-light w-75">
                    <div class="text-light w-75 px-3 d-flex justify-content-between align-items-center mt-3">
                        <i id="post-like-icon{{$post->id}}" onclick="like({{$post->id}}, {{Auth::user()->id}})" class="fa-regular fa-heart fs-3 like-hover d-flex @if(in_array($post->id, $user_likes))
                            text-danger
                            @endif">
                            <p id="post-like{{$post->id}}">{{$post->postlikes_count}}</p>
                        </i>

                        <i id="post-comment-icon{{$post->id}}" class="fa-regular fa-comment fs-3 comment-hover d-flex"
                            data-bs-toggle="modal" data-bs-target="#post-modal-{{$post->id}}">
                            <p id="post-comment{{$post->id}}">{{$post->postcomments_count}}</p>
                        </i>
                    </div>
                </div>

            </div>

        </div>
    </div>
    @endforeach
    @include('posts.show')
</div>
<div id="messages-container" class="fixed-bottom w-fit"></div>
@endsection