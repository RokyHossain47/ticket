@extends('layouts.admin')
@section('title', 'Open Ticket')
@section('content')
<script src="{{asset('build/js/jquery-3.6.0.min.js')}}"></script>
<style>
    .message-body {
        height: 300px;
        overflow: scroll;
        overflow-x: hidden;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .message-body ul {
        padding: 0;
    }
    .message-body li {
        list-style: none;    
    }
    .message-body::-webkit-scrollbar {
        display: none;
    }
</style>

<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <h4 class="card-header">{{$ticket->subject}}</h4>
                <div class="card-body">
                    <form id="form" action="{{route('send-message',['ticket_id'=>$ticket->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="message-body">
                            @php
                                if($ticket->user_id == auth()->user()->id) {
                                    $class = 'text-right';
                                }else{
                                    $class = 'text-left';
                                }
                            @endphp

                            <ul>
                                <li class="{{$class}}">
                                    <strong>#</strong>
                                    <span>{{$ticket->message}}</span>
                                </li>

                                @foreach ($messages as $message)
                                    @if ($message->sender_id == auth()->user()->id)    
                                        <li class="text-right">
                                            <strong>#</strong>
                                            <span>{{$message->message}}</span>
                                        </li>
                                    @else
                                        <li class="text-left">
                                            <strong>#</strong>
                                            <span>{{$message->message}}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>

                        </div>
                    
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="message" name="message" placeholder="Write a message">
                            <button class="btn btn-outline-success" type="button" onclick="onSubmit()">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <h4 class="card-header">User Information</h4>
                <div class="card-body">
                    User Name: - {{App\Models\User::where('id',$ticket->user_id)->first()->name;}}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('build/js/pusher.min.js')}}"></script>
<script>

var pusher = new Pusher('37eb9e2779a16399f44b', {
    cluster: 'ap2',
    encrypted: true
});

var channel = pusher.subscribe('ticket.{{ $ticket->id }}');
channel.bind('App\\Events\\MessageSent', function(data) {
    console.log('Received data:', data);
    if (data.message) {
        const messageList = $('.message-body ul');
        const isSender = data.message.sender_id == '{{ auth()->user()->id }}';
        
        const messageClass = isSender ? 'text-right' : 'text-left';
        const newMessage = `<li class="${messageClass}"><strong>#</strong><span>${data.message.message}</span></li>`;
        messageList.append(newMessage);
        scrollToBottom()
    }
});

function scrollToBottom() {
    const messageBody = $('.message-body');
    messageBody.scrollTop(messageBody[0].scrollHeight);
}
scrollToBottom();
$("#form").on('submit', function(){
    event.preventDefault();
    onSubmit();
});

function onSubmit(){
    const messageInput = $('#message');
    const message = messageInput.val();

    if (!message) {
        alert("Please enter a message.");
        return;
    }

    // Send message via AJAX
    $.ajax({
        url: "{{ route('send-message', ['ticket_id' => $ticket->id]) }}",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        contentType: 'application/json',
        data: JSON.stringify({ message: message }),
        success: function(data) {
            if (data.status) {
                const messageList = $('.message-body ul');
                const newMessage = `<li class="text-right"><strong>#    </strong><span>${message}</span></li>`;
                messageInput.val('');
                scrollToBottom();
            }
        }
    });
}

    </script>
    

@endsection