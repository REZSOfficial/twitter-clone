<div id="message-{{$partner_id}}"
    class="message border border-2 border-info border-bottom-0 rounded-top-3 text-light ms-2 bg-dark">
    <div class="row justify-content-between m-0 p-2 fs-4 overflow-hidden bg-info text-dark">
        <div class="w-50 my-auto">
            <div class="fs-5">{{$partner->username}}</div>
        </div>
        <div class="w-50 my-auto d-flex justify-content-end"><i onclick="hideMessage()" class="fa-solid fa-x fs-5"></i>
        </div>
    </div>
    <div class="message-area h-75 overflow-auto p-2">
        @foreach ($messages as $message)
        @if ($message->sender_id == $user_id)
        <div id="sent-message-{{$partner->id}}" class="d-flex flex-column w-100 justify-content-end">
            <p class="fs-6 bg-dark border border-info text-info rounded p-2">{{$message->message_text}}</p>
        </div>
        @else
        <div class="d-flex w-100 justify-content-start">
            <p class="fs-6 bg-info text-dark rounded p-2">{{$message->message_text}}</p>
        </div>
        @endif


        @endforeach


    </div>
    <div class="input-area h-25 d-flex">
        <div class="col-md-9 h-50">
            <input type="text" id="message-input"
                class="rounded-0 h-100 w-100 post-input text-info border border-start-0 border-end-0 border-info bg-dark border-info fw-bold fs-5 px-1"
                name="text" autocomplete="text">
        </div>
        <div class="col-md-3 h-50">
            <button onclick="sendMessage({{$user_id}}, {{$partner->id}})" type="submit" style="height: 104% !important"
                class="rounded-0 h-100 w-100 btn btn-dark border-start-0 border-end-0 border-info">
                <i class="fa-solid fa-paper-plane text-info"></i>
            </button>
        </div>
    </div>
</div>