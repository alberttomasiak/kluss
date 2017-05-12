@extends('layouts.app')
@section('content')
<style media="screen">
    .chat-wrap{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        height: calc(100vh - 145px);
    }
    .chat-overview{
        width: 25%;
        display:block;
        height: 100%;
    }

    .chat-overview a{
        display: block;
    }

    .chat-overview h3{
        display: block;
        width: 100%;
        height: 50px;
        text-align: center;
        background-color: #eee;
        margin-top: -10px;
        padding-top: 10px;
        margin-bottom: 0;
    }

    .chat-details{
        width: 75%;
        height: 10px;
        display:block;
    }

    .user{
        padding-top: 1em;
        padding-bottom: 1em;
        height: 75px;
        width: 100%;
        display: block;
        border-bottom: 1px solid #eee;
    }

    .user img{
        width: 50px;
        height: 50px;
        float: left;
        margin-right: 1em;
        margin-left: 1em;
    }

    .user .author{
        display: block;
        margin-top: .5em;
    }

    .active{
        background-color: #f7f7f7;
    }
</style>
<div class="chat-wrap">
    <div class="chat-overview" style="">
        <h3>Recente gesprekken</h3>
        @foreach($conversationsLeft as $conversationLeft)
                <div class="user {{$conversationLeft->chatname == $firstConversation->chatname ? 'active' : ''}}">
                    <div class="avatar">
                        <img src="/assets{{$conversationLeft->profile_pic}}" class="img-circle" alt="{{$conversationLeft->name}}">
                    </div>
                    <div class="text-display">
                        <div class="message-data">
                            <span class="author">{{$conversationLeft->name}}</span>
                        </div>
                        <form class="" action="/chat/{{$conversationLeft->user_one == \Auth::user()->id ? $conversationLeft->user_two : $conversationLeft->user_one}}" method="post">
                            {{ csrf_field() }}
                            <input type="submit" name="" value="Chat">
                        </form>
                    </div>
                </div>
        @endforeach
        @foreach($conversationsRight as $conversationRight)
                <div class="user {{$conversationRight->chatname == $firstConversation->chatname ? 'active' : ''}}">
                    <div class="avatar">
                        <img src="/assets{{$conversationRight->profile_pic}}" class="img-circle" alt="{{$conversationRight->name}}">
                    </div>
                    <div class="text-display">
                        <div class="message-data">
                            <span class="author">{{$conversationRight->name}}</span>
                        </div>
                        <form class="" action="/chat/{{$conversationRight->user_one == \Auth::user()->id ? $conversationRight->user_two : $conversationRight->user_one}}" method="post">
                            {{ csrf_field() }}
                            <input type="submit" name="" value="Chat">
                        </form>
                    </div>
                </div>
        @endforeach
    </div>
    <div class="chat-details" style="">
        @include('chat.partials.chat', array('firstConversation', $firstConversation))
    </div>
</div>
@endsection
