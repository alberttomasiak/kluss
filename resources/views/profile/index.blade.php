@extends('layouts.app')
@section('content')
    @foreach($userInfo as $user)
        <div class="user--information">
            <img src="/assets{{$user->profile_pic}}" alt="{{$user->name}}'s profile picture">
            <h1>{{$user->name}}</h1>
            <p>{{$user->bio}}</p>
            <div class="star-ratings-sprite"><span style="width:calc({{$reviewScore}} * 20%)" class="star-ratings-sprite-rating"></span></div>
            @if($user->id == \Auth::user()->id)
                <a href="/settings" class="btn-main">Pas aan</a>
            @else
                <form class="" action="/chat/{{$user->id}}" method="post">
                    <input type="submit" name="start-chat" value="Contacteer mij">
                </form>
            @endif
        </div>
        {{-- Rapporteer gebruiker knop --}}
    @endforeach
    <ul class="tabs" data-tabgroup="tab-group">
        <li><a href="#tab1" class="active"><span>{{$activityCounter}}x</span> geklusst</a></li>
        <li><a href="#tab2"><span>{{$reviewCount}}</span> reviews</a></li>
        <li><a href="#tab3"><span>{{$openTaskCounter}}</span> openstaande klusjes</a></li>
    </ul>
    <section id="tab-group" class="profile-tabs tabgroup">
        <div id="tab1">
            @foreach($activities as $ac => $activity)
                <div class="activity {{$ac != 0 ? 'border-top-activity' : ''}}">
                    <h2>{{$activity->title}}</h2>
                    <p>{{$activity->description}}</p>
                    <p class="profile-data-maker">{{$activity->ownerName}}</p>
                    <p class="activity-date">{{substr($activity->date, 0, 10)}}</p>
                </div>
            @endforeach
            {{$activities->links()}}
        </div>
        <div id="tab2">
            @foreach($reviews as $r => $review)
                <div class="review {{$r != 0 ? 'border-top-activity' : ''}}">
                    <h2>{{$review->title}}</h2>
                    <div class="star-ratings-sprite"><span style="width:calc({{$review->score}} * 20%)" class="star-ratings-sprite-rating"></span></div>
                    <p>{{$review->review}}</p>
                    <p class="profile-data-maker">{{$review->writer}}</p>
                    <p class="activity-date">{{$review->created_at}}</p>
                </div>
            @endforeach
            {{$reviews->links()}}
        </div>
        <div id="tab3">
            @foreach($tasks as $task)
                <div class="open-task">
                    <div class="task-information">
                        <h2>{{$task->title}} -<span>max {{$task->time}}u.</span></h2>
                        <p class="price">€ {{$task->price}}</p>
                        {{$task->description}}
                        @if(\Auth::user()->id == $task->user_id)
                            <p class="fixer">Uitgevoerd door: <span>{{$task->accepted_applicant_id}}</span></p>
                        @else
                            <p class="fixer">Uit te voeren voor: <span>{{$task->user_id}}</span></p>
                        @endif
                    </div>
                    <img src="/assets{{$task->kluss_image}}" alt="{{$task->title}} afbeelding">
                    {{-- Btn om kluss af te sloate --}}
                </div>
            @endforeach
            {{$tasks->links()}}
        </div>
    </section>
@endsection
