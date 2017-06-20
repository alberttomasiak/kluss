@extends('layouts.app')
@section('content')
    <!-- voor de cards -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.2.0/css/mdb.min.css">
<link rel="stylesheet" href="/assets/css/edits.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.2.0/js/mdb.min.js"></script>
<div class="container">
    <div class="row">
        @foreach($personalData as $pd)
        <div class="col-sm-10 col-sm-offset-1 header--profile">
            <div class="col-sm-3">
                <img src="/assets{{$pd->profile_pic}}" class="profile--pic" alt="{{$pd->name}}'s profile pic">
            </div>
            <div class="col-sm-6">
                <p class="user--name">{{$pd->name}}</p>
                <p>{{$pd->bio}}</p>
            </div>
            <div class="col-sm-3">
                @if($pd->id == \Auth::user()->id)
                    <a href="/profiel/{{$pd->id}}/bewerken" class="btn btn--form">Profiel bewerken</a>
                @else
                    <form class="" action="/chat/{{$pd->id}}" method="post">
                        {!! csrf_field() !!}
                        @if(areWeCool(\Auth::user()->id, $pd->id) != "")
                        <input type="submit" name="chatstart" class="btn btn--form" value="Contacteer mij" disabled>
                        <p>Contact opnemen met deze gebruiker is niet mogelijk.</p>
                        @else
                        <input type="submit" name="chatstart" class="btn btn--form" value="Contacteer mij">
                        @endif
                    </form>
                    <a href="#blockModal" data-toggle="modal" role="button" class="btn blockModal btn-danger">Rapporteer gebruiker</a>
                    @include('profile.modals.block')
                    @if(session('succesful_report'))
                        <div class="succesful_report">
                            <p>{{ session('succesful_report') }}</p>
                        </div>
                    @endif
                    @if(session('already_blocked'))
                        <div class="already_blocked">
                            <p>{{ session('already_blocked') }}</p>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="klussjes-wrap-profile col-sm-12">
            <h2>Openstaande klussjes:</h2>
        @foreach($klussjes as $kl)
            <div class="col-sm-4 card-wrap-profile">
              <div class="card">
                <div class="card-image">
                    <div class="card-image-wrap">
                  <img src="/assets{{$kl->kluss_image}}" alt="{{$kl->title}}">
                  </div>
                  <h4 class="card--title-black">{{$kl->title}}</h4>
                </div>
                <div class="card-content">
                  <p class="card--description">{{substr($kl->description, 0, 120) . '...'}}</p>
              </div>
              <div class="card-action-profile">
                  <a href="/kluss/{{$kl->id}}">Ga naar de kluss</a>
              </div>
              </div>
            </div>
        @endforeach
        {{$klussjes->links()}}
        </div>
        <div class="col-sm-12">
            <div class="col-sm-8">
                <h2 class="profile-history">Historiek klussjes</h2>
            </div>
            <div class="col-sm-4 profile-revs">
                <h2 class="profile-reviews">Reviews ({{$reviewCount}})</h2>
                <div class="star-ratings-sprite"><span style="width:calc({{$reviewScore}} * 20%)" class="star-ratings-sprite-rating"></span></div>
                @foreach($reviews as $review)
                    <div class="notification-box addboxshadow animationout">
                        <h1 style="">{{userNameGet($review->writer)}}</h1>
                        <div class="star-small">
                            <div class="star-ratings-sprite"><span style="width:calc({{$review->score}} * 20%)" class="star-ratings-sprite-rating"></span></div>
                        </div>
                        <p style="">{{$review->review}}</p>
                    </div>
                @endforeach
                {{$reviews->links()}}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
