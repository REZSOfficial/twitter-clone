<div class="row justify-content-center my-5">
    <div class="col-md-8">
        <div class="card bg-custom-dark text-light shadow">

            <div class="card-header bg-info text-dark d-flex justify-content-between">
                <div><a class="username-container text-dark fw-bold text-decoration-none"
                        href="{{route('viewUser', ['id' => $post->user->id])}}">{{'@'}}{{$post->user->username}}</a>
                </div>
                <div class="d-flex">
                    @if($post->user->id !== Auth::user()->id)
                    @if (in_array($post->user->id, $followed_array))
                    <form action="{{route('unfollow', ['id' => $post->user->id])}}" method="POST">
                        @csrf
                        <button class="bg-transparent border-0" type="submit">
                            <i class="fa-solid fa-person-circle-check fs-4 p-1 text-dark"></i>
                        </button>
                    </form>
                    @else
                    <form action="{{route('follow', ['id' => $post->user->id])}}" method="POST">
                        @csrf
                        <button class="bg-transparent border-0" type="submit">
                            <i class="fa-solid fa-person-circle-plus fs-4 p-1 text-dark"></i>
                        </button>
                    </form>
                    @endif
                    <button onclick="showMessages({{Auth::user()->id}}, {{$post->user->id}})"
                        class="bg-transparent border-0">
                        <i class="fa-solid fa-message text-dark fs-4 p-1"></i>
                    </button>
                    @else
                    <div class="dropdown">
                        <button class="bg-transparent border-0" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis fs-4 p-1"></i>
                        </button>
                        <ul class="dropdown-menu bg-dark dropdown-menu-dark">
                            <li>
                                <form id="deleteForm" action="{{route('deletePost', ['id' => $post->id])}}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="dropdown-item text-danger delete-post-btn" href="">Delete</button>
                                </form>
                            </li>

                            <li><a class="dropdown-item text-warning" href="#">Edit</a></li>
                        </ul>
                    </div>

                    @endif
                </div>
            </div>

            <div class="card-body d-flex flex-column align-items-center justify-content-center post-hover">
                <div data-bs-toggle="modal" data-bs-target="#post-modal-{{$post->id}}"
                    class="d-flex flex-column align-items-center w-100">
                    <div class="w-75">{{$post->text}}</div>
                    <hr class="text-light w-75">
                    @if ($post->img != null)
                    <img class="shadow w-75 rounded my-1" src="{{asset('images/'.$post->img)}}" alt="">
                    <hr class="text-light w-75">
                    @endif
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