@extends('layouts.app')
@section('content')
    <div class="main-content-wrap">
        @foreach($kluss as $kl)
            <div class="task--main-image-wrap">
                <img src="/assets{{$kl->kluss_image}}" class="single-img-main" alt="{{$kl->title}} image">
            </div>
            <div class="task--details">
                <span>€ {{$kl->price}}</span>
                <p>{{$kl->description}}</p>
                <a href="#">Apply</a>
            </div>
            <div class="tabs--taks">
                <ul class="tabs task--tabs" data-tabgroup="tab-group">
                    <li><a href="#tab1" data-tabID="1" class="active"><span>Beschrijving</span></a></li>
                    <li><a href="#tab2" data-tabID="2" class=""><span>Locatie</span></a></li>
                    <li><a href="#tab3" data-tabID="3" class=""><span>Klusser</span></a></li>
                </ul>
                <div class="task--main-info">
                    <h1>{{$kl->title}}</h1>
                    <a href="#">Rapporteren</a>
                    <div class="task--maker-details">
                        <img src="/assets{{$kl->profile_pic}}" alt="{{$kl->userName}}'s profile pic">
                        <p>{{$kl->userName}}</p>
                    </div>
                    <p class="category--task">Categorie: {{klussCategory($kl->kluss_category)}}</p>
                </div>
                <section id="tab-group" class="task-tabs tabgroup">
                    <div id="tab1">
                        <h2>Over dit klusje</h2>
                        <p>{{$kl->description}}</p>
                        <form action="/chat/{{$kl->userID}}" method="post">
                            <input type="submit" name="start--chat" value="Contacteer Maker">
                        </form>
                    </div>
                    <div id="tab2">
                        <h2>Locatie van het klussje</h2>
                        <div id="map"></div>
                    </div>
                    <div id="tab3">
                        <h2>Informatie over de Klusser</h2>
                        <p class="owner--name">{{$kl->userName}}</p>
                        <div class="star-ratings-sprite"><span style="width:calc({{$reviewScore}} * 20%)" class="star-ratings-sprite-rating"></span></div>

                        <div class="contact--owner">
                            <img src="/assets{{$kl->profile_pic}}" alt="{{$kl->userName}}'s profile pic">
                            <form action="/chat/{{$kl->userID}}" method="post">
                                <input type="submit" name="start--chat" value="Contacteer Maker">
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>
@endsection
