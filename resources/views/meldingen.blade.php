@extends('layouts.app')
    @section('content')
       {{-- <link href="/assets/css/edits.css" rel="stylesheet"> --}}
        <div class="main-content-wrap">
            <h1>Meldingen</h1>
            <div class="notifications-wrap">
            @foreach($notifications as $key => $notification)
                @if($notification->url != "")<a href="{{$notification->url}}"> @endif
                    @if($notification->type == "chat")
                        <div class="notification addboxshadow animationout {{$key == 0 ? 'new-notification' : ''}}">
                            <h6>Nieuw bericht van: {{$notification->name}}</h6>
                            <p class="notification-msg">{{$notification->message}}</p>
                            <p class="notification-date">{{timeAgo($notification->date)}}</p>
                        </div>
                    @elseif($notification->type == "task")
                        <div class="notification addboxshadow animationout {{$key == 0 ? 'new-notification' : ''}}">
                            <h6>Klus activiteit: {{taskTitle($notification->kluss_id)}}</h6>
                            <p class="notification-msg">{{$notification->message}}</p>
                            <p class="notification-date">{{timeAgo($notification->date)}}</p>
                        </div>
                    @elseif($notification->type == "global")
                        <div class="notification addboxshadow animationout {{$key == 0 ? 'new-notification' : ''}}">
                            <h6>Globale melding</h6>
                            <p class="notification-msg">{{$notification->message}}</p>
                            <p class="notification-date">{{timeAgo($notification->date)}}</p>
                        </div>
                    @endif
                @if($notification->url != "")</a> @endif
            @endforeach
            {{$notifications->links()}}
        </div>
        </div>
    @endsection
