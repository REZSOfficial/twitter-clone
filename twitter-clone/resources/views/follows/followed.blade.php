<div class="row justify-content-center modal modal-lg fade" id="followed-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card bg-custom-dark text-light shadow h-100">
            <div class="card-header bg-info text-dark fw-bold">Followed</div>
            <div class="card-body d-flex flex-column">
                @foreach ($followed as $followed)
                <a class="text-decoration-none text-info my-1"
                    href="{{route('viewUser', ['id' => $followed->id])}}">{{$followed->username}}</a>
                @endforeach
            </div>
        </div>
    </div>

</div>
</div>