@extends('layouts.app')
@section('content')

    <div class="profile_userinfo col-s12-m6">
        <div class="profile_avatar col-md-4"><img src="{{ $profiel->profile_pic }}" alt="avatar"></div>
        <div class="profile_overview col-md-8">
            <h2>{{ $profiel->name }}</h2>
            <p class="profile_bio">{{ $profiel->bio }}</p>
        </div>
    </div>
    <div class="profile_klussjes">
        @foreach($openkluss as $kl)
            <div class="">
                <div class="col-md-6">
                    <img class="col-md-12 individual--image" src="../{{$kl->kluss_image}}" alt="{{$kl->title}}">
                </div>
                <div class="col-md-6">
                    <h1>{{$kl->title}}</h1>
                    <p>{{$kl->description}}</p></br></br>
                    <b>{{$kl->address}}</b></br>
                    <b>{{$kl->price}} Credits</b></br></br>
                </div>
            </div>

        @endforeach
    </div>

@endsection