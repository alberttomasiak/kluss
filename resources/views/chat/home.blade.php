@extends('layouts.app')
@section('content')
    <script src="https://use.fontawesome.com/68a21dc6e7.js"></script>
    <style media="screen">
        .text-display{
            margin-bottom: 5em;
        }

        .message img{
            width: 60%;
        }
    </style>
    <div class="container">
        <div class="row">
            {{-- Looping all conversations we had that we gathered in the controller ;) --}}
            {{-- {{$lastMessages}} --}}
            {{-- {{$conversationsLeft}} --}}
            <div id="messages">
                @foreach($conversationsLeft as $conversationLeft)
                    <div class="message">
                        <div class="avatar col-sm-4 col-md-3 col-lg-2">
                            <img src="/assets{{$conversationLeft->profile_pic}}" class="img-circle" alt="{{$conversationLeft->name}}">
                        </div>
                        <div class="text-display">
                            <div class="message-data">
                                <span class="author">{{$conversationLeft->name}}</span>
                                {{-- <span class="timestamp">heyo</span> --}}
                                @foreach($lastMessages as $lastmessage)
                                    @if($conversationLeft->convid == $lastmessage->conversation_id)
                                        @if($lastmessage->user_id == \Auth::user()->id)
                                            <p><i class="fa fa-reply" aria-hidden="true" style="margin-right: 1em;"></i>{{$lastmessage->message}}</p>
                                        @else
                                            <p><i class="fa fa-share" aria-hidden="true" style="margin-right: 1em;"></i>{{$lastmessage->message}}</p>
                                        @endif
                                    @endif
                                    {{-- {{ $conversationLeft->convid == $lastmessage->conversation_id ? $lastmessage->message : ''}} --}}
                                @endforeach
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
                        <div class="avatar col-sm-4 col-md-3 col-lg-2">
                            <img src="/assets{{$conversationRight->profile_pic}}" class="img-circle" alt="{{$conversationRight->name}}">
                        </div>
                        <div class="text-display">
                            <div class="message-data">
                                <span class="author">{{$conversationRight->name}}</span>
                                {{-- <span class="timestamp">heyo</span> --}}
                                @foreach($lastMessages as $lastmessage)
                                    @if($conversationRight->convid == $lastmessage->conversation_id)
                                        @if($lastmessage->user_id == \Auth::user()->id)
                                            <p><i class="fa fa-reply" aria-hidden="true" style="margin-right: 1em;"></i>{{$lastmessage->message}}</p>
                                        @else
                                            <p><i class="fa fa-share" aria-hidden="true" style="margin-right: 1em;"></i>{{$lastmessage->message}}</p>
                                        @endif
                                    @endif
                                    {{-- {{ $conversationRight->convid == $lastmessage->conversation_id ? $lastmessage->message : ''}} --}}
                                    {{-- {{ $conversationRight->convid == $lastmessage->conversation_id ? ($lastmessage->user_id == \Auth::user()->id ? '<p><i class="fa fa-reply" aria-hidden="true"></i>{{$lastmessage->message}}</p>' : '<p><i class="fa fa-share" aria-hidden="true"></i>{{$lastmessage->message}}</p>') : ''}} --}}
                                @endforeach
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
@endsection
