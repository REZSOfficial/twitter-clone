@extends('layouts.app')

@section('content')

@if (session('success'))
<div id="profile-notification" class="bg-success text-light w-fit ms-4 fixed-top rounded p-2">
    {{ session('success') }}<i onclick="closeNotification()" class="ms-3 fa-solid fa-x"></i>
</div>
@endif
<div id="toastContainer" class="text-light w-fit fixed-top rounded p-2"></div>

<div class="d-flex">
    <div class="text-info position-fixed h-100">
        <div class="d-flex flex-column justify-content-between">
            <div class="div body-bg p-2">
                <div class="profile-picture-container w-100 h-100 p-2 d-flex justify-content-center align-items-center">
                    @php
                    $profilePicture = $user->profilepicture ? asset('images/'.$user->profilepicture) :
                    asset('images/noprofilepicture.jpg');
                    @endphp
                    <img @if (Auth::user()->id == $user->id) id="profile-picture" @endif src="{{ $profilePicture }}"
                    alt="Profile Picture" width="150" height="150"
                    style="object-fit: cover" class="rounded-circle border border-2 border-info">
                    @if (Auth::user()->id == $user->id)
                    <div class="overlay bg-custom-dark text-light p-1 rounded" data-bs-toggle="modal"
                        data-bs-target="#change-profile-modal">
                        Change picture
                    </div>
                    @endif
                </div>
                <div class="d-flex">
                    <div class="ms-2 p-1 mt-2 w-fit d-flex">
                        <h1>@</h1>
                        <h1 @if (Auth::user()->id == $user->id) id="{{Auth::user()->id}}"
                            onclick="convertToInputField(this)"
                            @endif>{{$user->username}}</h1>
                    </div>

                </div>

                <div class="d-flex flex-column mt-auto body-bg pt-1 px-2">
                    <h5 class="text-info fs-6">@if (Auth::user()->id == $user->id) Your profile @endif</h5>
                    <h5 class="text-info">{{$post_count}} post(s)</h5>
                    <h6 role="button" data-bs-toggle="modal" data-bs-target="#followers-modal">Followers:
                        {{count($followers)}}</h6>
                    <h6 role="button" data-bs-toggle="modal" data-bs-target="#followed-modal">Followed:
                        {{count($followed)}}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @foreach ($posts as $post)
        @include('posts.post')
        @endforeach
        @include('posts.show')
        @include('users.changeprofilepicutre')
    </div>
</div>
@include('follows.followers')
@include('follows.followed')
<div id="messages-container" class="fixed-bottom w-fit d-flex flex-row"></div>
@endsection