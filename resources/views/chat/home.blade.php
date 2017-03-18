@extends('layouts.app')
@section('content')
    {{-- <link rel="stylesheet" type="text/css" href="http://d3dhju7igb20wy.cloudfront.net/assets/0-4-0/all-the-things.css" /> --}}

    <div class="container">
        <div class="row">
            <div id="messages">
                @foreach($conversationsLeft as $conversationLeft)
                    <div class="message">
                        <div class="avatar">
                            <img src="/assets{{$conversationLeft->profile_pic}}" alt="{{$conversationLeft->name}}">
                        </div>
                        <div class="text-display">
                            <div class="message-data">
                                <span class="author">{{$conversationLeft->name}}</span>
                                {{-- <span class="timestamp">heyo</span> --}}
                            </div>
                            <form class="" action="/chat/{{$conversationLeft->id}}" method="post">
                                {{ csrf_field() }}
                                <input type="submit" name="chatstart" class="btn btn--form" value="Contacteer mij">
                            </form>
                        </div>
                    </div>
                @endforeach
                @foreach($conversationsRight as $conversationRight)
                    <div class="message">
                        <div class="avatar">
                            <img src="/assets{{$conversationRight->profile_pic}}" alt="{{$conversationRight->name}}">
                        </div>
                        <div class="text-display">
                            <div class="message-data">
                                <span class="author">{{$conversationRight->name}}</span>
                                {{-- <span class="timestamp">heyo</span> --}}
                            </div>
                            <form class="" action="/chat/{{$conversationRight->id}}" method="post">
                                {{ csrf_field() }}
                                <input type="submit" name="chatstart" class="btn btn--form" value="Contacteer mij">
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.rawgit.com/samsonjs/strftime/master/strftime-min.js"></script>
    <script src="//js.pusher.com/3.0/pusher.min.js"></script> --}}
    {{-- <script id="chat_message_template" type="text/template">
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
    </script> --}}
@endsection
