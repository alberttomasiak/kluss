@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{-- Looping all conversations we had that we gathered in the controller ;) --}}
            {{-- {{$lastMessages}} --}}
            {{-- {{$conversationsLeft}} --}}
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
                                @foreach($lastMessages as $lastmessage)
                                    {{ $conversationLeft->convid == $lastmessage->conversation_id ? $lastmessage->message : ''}}
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
                        <div class="avatar">
                            <img src="/assets{{$conversationRight->profile_pic}}" alt="{{$conversationRight->name}}">
                        </div>
                        <div class="text-display">
                            <div class="message-data">
                                <span class="author">{{$conversationRight->name}}</span>
                                {{-- <span class="timestamp">heyo</span> --}}
                                @foreach($lastMessages as $lastmessage)
                                    {{ $conversationRight->convid == $lastmessage->conversation_id ? $lastmessage->message : ''}}
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
