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
    <script src="//js.pusher.com/3.0/pusher.min.js"></script>

    <script>
        // Ensure CSRF token is sent with AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Added Pusher logging
        Pusher.log = function(msg) {
            console.log(msg);
        };
    </script>
</head>
<body>

<div class="stripe no-padding-bottom numbered-stripe">
    <div class="fixed wrapper">
        <ol class="strong" start="1">
            <li>
                <img src="/assets/img/logo-klussklein_720.png" alt="" width="50px;" style="float:left; margin-right: 2rem;">
                <h2 style="margin-top: .8rem;"><b>Je bent aan het praten met:</b> <small>{{$user}}</small></h2>
            </li>
        </ol>
    </div>
</div>

<section class="" style="background-color: #238e48; border:none;">
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
                <textarea class="input-message col-xs-10" placeholder="Your message"></textarea>
                <div class="option col-xs-1 white-background">
                    <span class="fa fa-smile-o light-grey"></span>
                </div>
                <div class="option col-xs-1 green-background send-message">
                    <span class="white light fa fa-paper-plane-o"></span>
                </div>
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
        console.log('message sent successfully');
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
        messages.append(el)

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

    var pusher = new Pusher('1a329a7dd69a92834d4d', {
      cluster: 'eu',
      encrypted: true,
      authEndpoint: '/chat/auth',
      auth: {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }
    });
    var channel = pusher.subscribe("{{$chatChannel}}");
    console.log(channel);
    channel.bind('new-message', addMessage);

</script>

</body>
</html>
