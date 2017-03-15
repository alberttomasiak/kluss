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
                <img src="/{{$pd->profile_pic}}" class="profile--pic" alt="{{$pd->name}}'s profile pic">
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
                        {{ csrf_field() }}
                        <input type="submit" name="chatstart" class="btn btn--form" value="Contacteer mij">
                    </form>
                    <!--<a href="#" class="btn btn--form">Contacteer mij</a>-->
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
                  <img src="{{$kl->kluss_image}}" alt="{{$kl->title}}">
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
        </div>
        @if($pd->id == \Auth::user()->id)
            <div class="col-sm-12 applicants">
                <h2>Sollicitanten voor klussjes:</h2>
                <table class="table table-applicants">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Naam</th>
                      <th>Contact</th>
                      <th>Opties</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($sollicitanten as $sol)
                        <tr>
                          <th scope="row"><img class="applicant-image" src="{{$sol->profile_pic}}" alt="{{$sol->name}}'s profile picture"></th>
                          <td>{{$sol->name}}</td>
                          <td><a href="#" class="btn btn-info">Contacteer deze persoon</a></td>
                          <td><a href="#" class="btn btn-success">Accepteren</a><a href="#" class="btn btn-danger">Weigeren</a></td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {!! $sollicitanten->appends(Request::except('sollicitanten'))->render() !!}
            </div>
        @endif
        <div class="col-sm-12">
            <div class="col-sm-8">
                <h2 class="profile-history">Historiek klussjes</h2>
            </div>
            <div class="col-sm-4">
                <h2 class="profile-reviews">Reviews</h2>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
