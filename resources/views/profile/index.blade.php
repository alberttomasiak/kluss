@extends('layouts.app')
@section('content')
    <div class="content--wrap">
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
                    {{csrf_field()}}
                    <label for="start-chat"></label>
                    <input type="submit" id="start-chat" name="start-chat" value="Contacteer mij">
                </form>
            @endif
        </div>
        {{-- Rapporteer gebruiker knop --}}
    @endforeach
    <div class="tabs--content">
    <ul class="tabs profile--tabs" data-tabgroup="tab-group">
        <?php $url = Request::url()?>
        <li><a href="#tab1" data-tabID="1" class="{{Request::fullUrl() == $url || Request::get('activiteiten') ? 'active' : ''}}"><span>{{$activityCounter}}x</span> geklusst</a></li>
        <li><a href="#tab2" data-tabID="2" class="{{Request::get('reviews') ? 'active' : ''}}"><span>{{$reviewCount}}</span> {{$reviewCount > 1 ? 'reviews' : 'review'}}</a></li>
        <li><a href="#tab3" data-tabID="3" class="{{Request::get('klusjes') ? 'active' : ''}}"><span>{{$openTaskCounter}}</span> openstaande klusjes</a></li>
    </ul>
    <section id="tab-group" class="activity-tabs tabgroup">
        <div id="tab1">
            @if(count($activities) != 0)
                @foreach($activities as $ac => $activity)
                    <div class="activity">
                        <div class="{{$ac != 0 ? 'border-top-activity' : ''}}"></div>
                        <h2>{{$activity->title}}</h2>
                        <p>{{$activity->description}}</p>
                        <p class="profile-data-maker">{{$activity->ownerName}}</p>
                        <p class="activity-date">{{substr($activity->date, 0, 10)}}</p>
                    </div>
                @endforeach
                {{$activities->links()}}
            @else
                <div class="activity">
                    <h2>Deze gebruiker heeft momenteel nog geen activiteiten.</h2>
                </div>
            @endif
        </div>
        <div id="tab2">
            @if(count($reviews) != 0)
                @foreach($reviews as $r => $review)
                    <div class="review">
                        <div class="{{$r != 0 ? 'border-top-activity' : ''}}"></div>
                        <h2>{{taskTitle($review->kluss_id)}}</h2>
                        <div class="star-ratings-sprite"><span style="width:calc({{$review->score}} * 20%)" class="star-ratings-sprite-rating"></span></div>
                        <p>{{$review->review}}</p>
                        <p class="profile-data-maker">{{userNameGet($review->writer)}}</p>
                        <p class="activity-date">{{substr($review->created_at, 0, 10)}}</p>
                    </div>
                @endforeach
                {{$reviews->links()}}
            @else
                <div class="review">
                    <h2>Deze gebruiker heeft nog geen reviews.</h2>
                </div>
            @endif
        </div>
        <div id="tab3">
            @if(count($tasks) != 0)
                @foreach($tasks as $t => $task)
                    <div class="open-task">
                        <div class="{{$t != 0 ? 'border-top-activity' : ''}}"></div>
                        <div class="task-information">
                            <h2>{{$task->title}} -<span> max {{$task->time}}u.</span></h2>
                            <p class="price">€ {{$task->price}}</p>
                            <p class="task-description">{{$task->description}}</p>
                            @if(\Auth::user()->id == $task->user_id)
                                <p class="fixer">Uitgevoerd door: <span>{{userNameGet($task->accepted_applicant_id)}}</span></p>
                            @else
                                <p class="fixer">Uit te voeren voor: <span>{{userNameGet($task->user_id)}}</span></p>
                            @endif
                        </div>
                        <img src="/assets{{$task->kluss_image}}" alt="{{$task->title}} afbeelding">
                        {{-- Btn om kluss af te sloate --}}
                    </div>
                @endforeach
                {{$tasks->links()}}
            @else
                <div class="open-task">
                    <h2>Deze gebruiker heeft geen openstaande klusjes.</h2>
                </div>
            @endif
        </div>
    </section>
    </div>
    </div>
@endsection
