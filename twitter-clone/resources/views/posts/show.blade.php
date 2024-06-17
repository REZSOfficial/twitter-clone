@foreach ($posts as $post)
<div class="row justify-content-center modal modal-lg fade" id="post-modal-{{$post->id}}" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card bg-custom-dark text-light shadow h-100">
            <div class="card-header bg-info text-dark fw-bold">{{'@'}}{{$post->user->username}}</div>
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <div>{{$post->text}}</div>
                @if ($post->img != null)
                <hr class="text-light w-75">
                <img class="shadow w-75 rounded my-1 img-fluid" src="{{asset('images/'.$post->img)}}" alt="">
                @endif
                <div class="comments w-75 custom-scroll">
                    <div class="d-flex my-3 me-2">
                        <div class="d-flex w-100">
                            <textarea rows="2" id="comment-text-{{$post->id}}" type="text"
                                class="w-100 me-1 post-input text-info bg-dark border border-info fw-bold" name="text"
                                autocomplete="text" autofocus></textarea>
                            <button type="submit" class="btn btn-dark border-info"
                                onclick="comment({{$post->id}}, {{Auth::user()->id}}, {{json_encode(Auth::user()->username)}})">
                                {{ __('Comment') }}
                            </button>
                        </div>

                    </div>
                    <div id="comments-{{$post->id}}">
                        @foreach ($post->postcomments as $postcomment)

                        <hr class="text-light me-2">
                        <div class="mb-2 p-2 rounded">
                            <div class="fw-bold text-info">
                                {{$postcomment->user->username}}
                            </div>
                            <div>
                                {{$postcomment->text}}
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endforeach