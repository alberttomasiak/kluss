@extends('layouts.app')
@section('content')
    <!-- voor de cards -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.2.0/css/mdb.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.2.0/js/mdb.min.js"></script>
<div class="container">
    <div class="row">
        @foreach($personalData as $pd)
        <div class="col-sm-10 col-sm-offset-1 header--profile">
            <div class="col-sm-3">
                <img src="{{$pd->profile_pic}}" class="profile--pic" alt="{{$pd->name}}'s profile pic">
            </div>
            <div class="col-sm-6">
                <p class="user--name">{{$pd->name}}</p>
                <p>{{$pd->bio}}</p>
            </div>
            <div class="col-sm-3">
                @if($pd->id == \Auth::user()->id)
                    <a href="/profiel/{{$pd->id}}/bewerken" class="btn btn--form">Profiel bewerken</a>
                @else
                    <a href="#" class="btn btn--form">Contacteer mij</a>
                @endif
            </div>
        </div>
        <div class="klussjes-wrap-profile col-sm-12">
            <h2>Openstaande klussjes:</h2>
        @foreach($klussjes as $kl)
            <div class="col-sm-4 card-wrap-profile">
              <div class="card">
                <div class="card-image">
                  <img src="{{$kl->kluss_image}}" alt="{{$kl->title}}">
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
        </div>
        @if($pd->id == \Auth::user()->id)
            <div class="col-sm-12">
                <!-- Applicants -->
            </div>
        @endif
        <div class="col-sm-12">
            <div class="col-sm-8">
                <!-- Historiek -->
            </div>
            <div class="col-sm-4">
                <!-- Reviews -->
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection