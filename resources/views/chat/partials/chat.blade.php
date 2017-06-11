<!DOCTYPE html>
<html>
<head>
    <title>Kluss chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,200italic,300italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://d3dhju7igb20wy.cloudfront.net/assets/0-4-0/all-the-things.css" />
    <style>
        .chat-app {
            margin: 50px;
            padding-top: 10px;
        }

        .chat-app .message:first-child {
            margin-top: 15px;
        }

        #messages {
            height: 300px;
            overflow: auto;
            padding-top: 5px;
        }
    </style>

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.rawgit.com/samsonjs/strftime/master/strftime-min.js"></script>

    <script>
        // Ensure CSRF token is sent with AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Added Pusher logging
        Pusher.log = function(msg) {
            // console.log(msg);
        };
    </script>
</head>
<body>
    {{-- Let's get our users to check if we're gucci or not --}}
    <?php $users = ChatParticipators($chatChannel); ?>

<section class="" style="display: block; margin-bottom: 2em;">
    <div class="container">
        <div class="row light-grey-blue-background chat-app">

            <div id="messages">
                <div class="time-divide">
                    <span class="date">Start chat</span>
                </div>
                @foreach($messages as $message)
                    <div class="message">
                        <div class="avatar">
                            <img src="/assets{{$message->profile_pic}}" alt="">
                        </div>
                        <div class="text-display">
                            <div class="message-data">
                                <span class="author">{{$message->name}}</span>
                                <span class="timestamp">{{\App\Message::formatDate($message->created_at)}}</span>
                                <span class="seen"></span>
                            </div>
                            <p class="message-body">{{$message->message}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="action-bar">
                @if(areWeCool($users->user_one, $users->user_two) == "")
                <textarea class="input-message col-xs-10" placeholder="Your message"></textarea>
                <div class="option col-xs-1 white-background">
                    <span class="fa fa-smile-o light-grey"></span>
                </div>
                <div class="option col-xs-1 green-background send-message">
                    <span class="white light fa fa-paper-plane-o"></span>
                </div>
                @else
                    <p>Je bent of hebt de andere gebruiker geblokkeerd. Chatten is niet mogelijk.</p>
                @endif
            </div>

        </div>
    </div>
</section>

<script id="chat_message_template" type="text/template">
    <div class="message">
        <div class="avatar">
            <img src="">
        </div>
        <div class="text-display">
            <div class="message-data">
                <span class="author"></span>
                <span class="timestamp"></span>
                <span class="seen"></span>
            </div>
            <p class="message-body"></p>
        </div>
    </div>
</script>
<script>
    function init() {
        // send button click handling
        $('.send-message').click(sendMessage);
        $('.input-message').keypress(checkSend);

        var d = $('#messages');
        d.scrollTop(d.prop("scrollHeight"));
    }

    // Send on enter/return key
    function checkSend(e) {
        if (e.keyCode === 13) {
            return sendMessage();
        }
    }

    // Handle the send button being clicked
    function sendMessage() {
        var messageText = $('.input-message').val();
        if(messageText.length < 3) {
            return false;
        }

        // Build POST data and make AJAX request
        var data = {chat_text: messageText, chatChannel : "{{$chatChannel}}"};
        $.post('/chat/message', data).success(sendMessageSuccess);

        // Ensure the normal browser event doesn't take place
        return false;
    }

    // Handle the success callback
    function sendMessageSuccess() {
        $('.input-message').val('')
        // console.log('message sent successfully');
    }

    // Build the UI for a new message and add to the DOM
    function addMessage(data) {
        // Create element from template and set values
        var el = createMessageEl();
        el.find('.message-body').html(data.text);
        el.find('.author').text(data.username);
        el.find('.avatar img').attr('src', '/assets'+data.avatar);

        // Utility to build nicely formatted time
        el.find('.timestamp').text(strftime('%d/%m/%y %H:%M:%S', new Date(data.timestamp)));

        var messages = $('#messages');
        messages.append(el);

        // Make sure the incoming message is shown
        messages.scrollTop(messages[0].scrollHeight);
    }

    // Creates an activity element from the template
    function createMessageEl() {
        var text = $('#chat_message_template').text();
        var el = $(text);
        return el;
    }

    $(init);

    /***********************************************/
    var channel = pusher.subscribe("{{$chatChannel}}");
    // console.log(channel);
    channel.bind('new-message', addMessage);

</script>

</body>
</html>
