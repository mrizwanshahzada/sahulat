@extends('frontend.layouts.app')

@section('title')
  SAHULAT | Chat
@endsection

@section('custom-styles')

    <style type="text/css">
        .chat-container { height: 510px; }
        .update-row { background: #dfe7f5; height: 510px; }
        .title-row { background: #FF4F57; padding: 2%; height: 50px; color: white;}
        .conversation-row { background: #ede3c7; height: 400px; overflow-y: scroll}
        .send-row { bottom: 0; background: #faebed; height: 50px;}
        .send-btn { color: white; height: 100%; }
        .offer-btn { width: 100%; position: absolute; bottom: 2%; }
        .send-btn-span { height: 50px; }
        .type-message { padding: 2%; }
        .message { font-size: 150%; float: left; background: white; padding: 1%; border-radius: 5px; margin-bottom: 0;}
        .message-sender-photo { width: 30px; height: 30px; float: right;}
        .conversation-message { margin: 1%; height: auto;}
        .update-task-title { color: red; padding: 2%; }
        .message-details { font-size: 80%; padding-left: 2%;}
    </style>
@endsection

@section("content")
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<div class="container chat-container" >
    <div class="row">
        <div class="col-md-4">
            <div class="row update-row">
                <h3 align="center" class="update-task-title">Task Details</h3>

                @if(Auth::user()->role == 'Vendor')
                    <h4>Budget</h4>
                    <input type="text" id="budget" name="budget" class="form-control" placeholder="Type budget here" value="{{ $data['task']->budget }}">
                    <h4>Deadline</h4>
                    <p class="form-control">{{ $data['task']->deadline }}</p>
                    @if($data['task']->status == 'Pending' || $data['task']->status == 'Assigned')
                        <button class="btn btn-primary offer-btn" id="offer-btn">Offer</button>
                    @endif
                @else
                    <h4>Budget</h4>
                    <p class="form-control">{{ $data['task']->budget }}</p>
                    <h4>Deadline</h4>
                    <p class="form-control">{{ $data['task']->deadline }}</p>
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <div class="row title-row">
                <h3>{{ Auth::user()->name }}</h3>
            </div>
            <div class="row conversation-row" id="conversation-row">
                <!-- messages -->
                @if($data['messages']->count() < 1)
                    <script>
                        Swal.fire(
                            'Leave a message',
                            'Please leave a message to start conversation',
                            'alert'
                        )
                    </script>
                    @endif
                @foreach($data['messages'] as $message)
                <div class="conversation-message">
                    <div class="col-md-1">
                        <img src="../storage/images/user-profile-images/{{ $message->sender->profile_photo }}" class="message-sender-photo img-circle">
                    </div>
                    <div class="col-md-11">
                        <p class="message"> {{ $message->message }} </p>
                    </div>
                    <p class="col-md-offset-1 message-details"><i>{{ $message->created_at->format('h:i A d M Y') }} by <strong>{{ $message->sender->name }}</strong></i></p>
                </div>
                @endforeach


            </div>
            <div class="row send-row">
                <div class="input-group">
                    <input id="message_input" type="text" class="form-control type-message" placeholder="type message here">
                    <span class="input-group-addon send-btn-span"><button id="send-button" class="btn btn-danger send-btn">Send</button></span>
                </div>
            </div>
        </div>
    </div>
<!--  -->

</div>
@section('custom-scripts')

    <script type="text/javascript">

        $('#conversation-row').animate({ scrollTop: $('#conversation-row').prop('scrollHeight')}, 0);

        $('#message_input').keypress(function(event){
            if (event.which == 13) {
                $.post(
                '{{route("sendMessage")}}',
                {
                    message: $('#message_input').val(),
                    sender_id: '{{ Auth::user()->id }}',
                    receiver_id: '{{ $data["receiver_id"] }}',
                    task_id: '{{ $data["task"]->id }}',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                function(){
                    $("#message_input").val("");
                });
            }

        });

    </script>

    <script type="module">

        Echo.private('chat.'+'{{ $data["task"]->id }}')
        .listen('SendMessageEvent', (e) => {
            var date = new Date(e._message.created_at);
            date = date.getHours()+':'+date.getMinutes()+' '+date.getMonth()+' '+date.getDate()+' '+date.getFullYear();
            $('#conversation-row').append('<div class="conversation-message"><div class="col-md-1"><img src="../storage/images/user-profile-images/'+e._sender.profile_photo+'" class="message-sender-photo img-circle"></div><div class="col-md-11"><p class="message"> '+e._message.message+'</p></div><p class="col-md-offset-1 message-details"><i>'+date+' by <strong>'+e._sender.name+'</strong></i></p></div>');
            $('#conversation-row').animate({ scrollTop: $('#conversation-row').prop('scrollHeight')}, 0);
        });


    </script>

    <!-- Update Budget Script -->
    <script type="text/javascript">
        $('#offer-btn').click(function(){
            var newBudget = $('#budget').val();
            $.post(
            '{{route("updateBudget")}}',
            {
                task_id: '{{ $data["task"]->id }}',
                budget: newBudget,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            function(e){
                $('#budget').val(newBudget);
                Swal.fire(
                    'You Offered Rs '+newBudget+' !',
                    'Your offer has been sent to the customer!',
                    'success'
                )
            });
        });
    </script>

@endsection
@endsection





