@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $post)
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card bg-custom-dark text-light shadow">
                <div class="card-header">{{$post->user->username}}</div>
                <div class="card-body d-flex flex-column align-items-center justify-content-center post-hover">
                    <div>{{$post->text}}</div>
                    <hr class="text-light w-75">
                    <img class="shadow w-75 rounded my-1" src="{{asset('images/'.$post->img)}}" alt="">
                    <hr class="text-light w-75">
                    <div class="text-light w-75 px-3 d-flex justify-content-between align-items-center mt-3">
                        <i class="fa-regular fa-heart fs-3 like-hover">
                            <p>{{$post->postlikes_count}}</p>
                        </i>
                        <i class="fa-regular fa-comment fs-3 comment-hover">{{$post->postcomments_count}}</i>
                    </div>
                </div>

            </div>

        </div>
    </div>
    @endforeach

</div>
@endsection