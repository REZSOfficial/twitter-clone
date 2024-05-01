<div class="row justify-content-center modal modal-lg fade" id="followers-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card bg-custom-dark text-light shadow h-100">
            <div class="card-header bg-info text-dark fw-bold">Followers</div>
            <div class="card-body d-flex flex-column">
                @foreach ($followers as $follower)
                <a class="text-decoration-none text-info my-1"
                    href="{{route('viewUser', ['id' => $follower->id])}}">{{$follower->username}}</a>
                @endforeach
            </div>
        </div>
    </div>

</div>
</div>