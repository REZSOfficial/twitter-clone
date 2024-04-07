@foreach ($posts as $post)
<div class="row justify-content-center modal modal-lg fade" id="post-modal-{{$post->id}}" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="card bg-custom-dark text-light shadow">
            <div class="card-header">{{'@'}}{{$post->user->username}}</div>
            <div class="card-body d-flex flex-column align-items-center justify-content-center post-hover">
                <div>{{$post->text}}</div>
                <hr class="text-light w-75">
                <img class="shadow w-75 rounded my-1" src="{{asset('images/'.$post->img)}}" alt="">
            </div>

        </div>

    </div>
</div>
@endforeach