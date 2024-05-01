<div id="message-{{$partner_id}}" class="card border-0 ms-2" style="width: 18rem;">
    <div class="card-header bg-info d-flex justify-content-between">
        <div class="fs-5">{{$partner->username}}</div>
        <i onclick="hideMessage()" class="fa-solid fa-x my-auto fs-5"></i>
    </div>
    <div class="card-body bg-dark overflow-y-scroll message-scroll py-0" style="height: 22rem;">

        <ul id="sent-message-{{$partner->id}}" class="d-flex flex-column w-100 justify-content-end message-ul p-0">
            @foreach ($messages as $message)
            @if ($message->sender_id == $user_id)
            <div class="d-flex w-100 justify-content-end">
                <li class="fs-6 bg-dark border border-info text-info rounded p-2 mt-2 w-fit">
                    {{$message->message_text}}</li>
            </div>
            @else
            <li class="fs-6 bg-info text-dark rounded p-2 mt-2 w-fit">
                {{$message->message_text}}</li>
            @endif
            @endforeach
        </ul>



    </div>
    <div class="d-flex border border-info">
        <input onfocus="setListener({{$user_id}}, {{$partner->id}})" type="text" id="message-input"
            class="bg-dark text-info border-0" name="text" autocomplete="text">
        <button onclick="sendMessage({{$user_id}}, {{$partner->id}})" type="submit"
            class="rounded-0 w-100 btn btn-dark">
            <i class="fa-solid fa-paper-plane text-info"></i>
        </button>
    </div>
</div>