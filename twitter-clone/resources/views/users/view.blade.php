@extends('layouts.app')

@section('content')

@if (session('success'))
<div id="profile-notification" class="bg-success text-dark ms-2 mt-2 p-2 rounded w-fit">
    {{ session('success') }}<i onclick="closeNotification()" class="ms-3 fa-solid fa-x"></i>
</div>
@endif
<div class="text-info">
    <div class="d-flex border-bottom border-2 border-info p-2 justify-content-between">
        <div class="div mt-3">
            <div class="profile-picture-container">
                @php
                $profilePicture = $user->profilepicture ? asset('images/'.$user->profilepicture) :
                asset('images/noprofilepicture.jpg');
                @endphp
                <img id="profile-picture" src="{{ $profilePicture }}" alt="Profile Picture" width="150" height="150"
                    style="object-fit: cover" class="ms-2 rounded-circle border border-info">
                <div class="overlay bg-dark text-light p-1 rounded" data-bs-toggle="modal"
                    data-bs-target="#change-profile-modal">
                    Change picture
                </div>
            </div>
            <div class="ms-2 mt-2 d-flex">
                <h1>{{'@'}}</h1>
                <h1 @if (Auth::user()->id == $user->id) id="{{Auth::user()->id}}"
                    onclick="convertToInputField(this)"
                    @endif>{{$user->username}}</h1>
                <div id="toastContainer" class="w-100 ms-4" style="min-height: 4rem">
                </div>
            </div>
        </div>
        <div class="d-flex flex-column mt-auto me-2 mb-2">
            <h5>@if (Auth::user()->id == $user->id) Your profile @endif</h5>
            <h5 class="text-light">{{$post_count}} post(s)</h3>
        </div>
    </div>

</div>
<div class="container">
    @foreach ($posts as $post)
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card bg-custom-dark text-light shadow">

                <div class="card-header d-flex justify-content-between">
                    <div><a class="username-container text-info text-decoration-none"
                            href="{{route('viewUser', ['id' => $post->user->id])}}">{{'@'}}{{$post->user->username}}</a>
                    </div>
                    <div onclick="showMessages({{Auth::user()->id}}, {{$post->user->id}})">
                        <i class="fa-solid fa-message text-info"></i>
                    </div>
                </div>

                <div class="card-body d-flex flex-column align-items-center justify-content-center post-hover">
                    <div class="d-flex flex-column align-items-center w-100" data-bs-toggle="modal"
                        data-bs-target="#post-modal-{{$post->id}}"
                        class="d-flex flex-column align-items-center justify-content-center">
                        <div>{{$post->text}}</div>
                        <hr class="text-light w-75">
                        <img class="shadow w-75 rounded my-1" src="{{asset('images/'.$post->img)}}" alt="">
                        <hr class="text-light w-75">
                    </div>
                    <div class="text-light w-75 px-3 d-flex justify-content-between align-items-center mt-3">
                        <i tabindex="-1" id="post-like-icon{{$post->id}}"
                            onclick="like({{$post->id}}, {{Auth::user()->id}})" class="fa-regular fa-heart fs-3 like-hover d-flex @if(in_array($post->id, $user_likes))
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
    @include('users.changeprofilepicutre')
</div>

<div id="messages-container" class="fixed-bottom w-fit d-flex flex-row"></div>
@endsection