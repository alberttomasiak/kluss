@extends('layouts.app')
@section('content')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&callback"></script>
    <div class="main-content-wrap">
        <div class="wrapper-task-single">
        @foreach($kluss as $kl)
            <div class="individual-task">
                <div class="task--main-image-wrap">
                    <img src="/assets{{$kl->kluss_image}}" class="single-img-main" alt="{{$kl->title}} image">
                </div>
                <div class="quick-recap-wrap">
                    <div class="task--details">
                        <span>€ {{$kl->price}}</span>
                        <p>{{$kl->description}}</p>
                        <div class="apply-btn">
                            @if($kluss_applicant->first() && $kl->accepted_applicant_id == "")
                                <a class="remove-appl" href="/kluss/{{$kl->id}}/solliciteren">Remove Application</a>
                            @else
                                @if(areWeCool(\Auth::user()->id, $kl->user_id) != "")
                                    <p>Je hebt of bent door de gebruiker geblokkeerd. Solliciteren voor dit klusje is niet mogelijk.</p>
                                @elseif($kl->accepted_applicant_id != "")
                                    <p>De maker van het klusje heeft <b>{{userNameGet($kl->accepted_applicant_id)}}</b> gekozen voor zijn/haar klusje.</p>
                                @elseif(\Auth::user()->id != $kl->user_id)
                                    <a href="/kluss/{{$kl->id}}/solliciteren">Apply</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tabs--task">
                    <ul class="tabs task--tabs" data-tabgroup="tab-group">
                        <li><a href="#tab1" data-tabID="1" class=" active"><span>Beschrijving</span></a></li>
                        <li><a href="#tab2" data-tabID="2" class="tab2 "><span>Locatie</span></a></li>
                        <li><a href="#tab3" data-tabID="3" class=""><span>Klusser</span></a></li>
                    </ul>
                    <div class="task--main-info">
                        <h1>{{$kl->title}}</h1>
                        @if(blockChecker($kl->id, \Auth::user()->id) == "" && \Auth::user()->id != $kl->user_id)
                            <a href="#kluss-{{$kl->id}}-report" data-toggle="modal" role="button" data-id="{{$kl->id}}" class="">RAPPORTEERr</a>
                        @elseif(blockChecker($kl->id, \Auth::user()->id) != "" && \Auth::user()->id != $kl->user_id)
                            <a href="#kluss-{{$kl->id}}-report" data-toggle="modal" role="button" data-id="{{$kl->id}}" class="" disabled>RAPPORTEER</a>
                            <p>Dit klusje werd door u al gerapporteerd. De beheerders zijn dit aan het onderzoeken.</p>
                        @endif
                        <div class="task--maker-details">
                            <div class="task--user-image" style="background-image: url('/assets{{$kl->profile_pic}}')"></div>
                            {{-- <img src="/assets{{$kl->profile_pic}}" class="task--user-image" alt="{{$kl->userName}}'s profile pic"> --}}
                            <p>{{$kl->userName}}</p>
                        </div>
                        <p class="category--task">Categorie: {{klussCategory($kl->kluss_category)}}</p>
                        @if($kl->user_id == \Auth::user()->id)
                            <div class="owner--btns">
                                <a href="/kluss/{{$kl->id}}/bewerken">Kluss bewerken</a>
                                <a href="#kluss-{{$kl->id}}-verwijderen" data-toggle="modal" role="button" class="deletebtn">VERWIJDEREN</a>
                                @include('kluss.modals.delete')
                            </div>
                        @endif
                    </div>
                    <section id="tab-group" class="task-tabs tabgroup">
                        <div id="tab1">
                            <h2>Over dit klusje</h2>
                            <p>{{$kl->description}}</p>
                            <form action="/chat/{{$kl->userID}}" method="post">
                                {!! csrf_field() !!}
                                <input type="submit" name="start--chat" value="Contacteer {{$kl->userName}}">
                            </form>
                            @include('kluss.includes.related')
                        </div>
                        <div id="tab2">
                            <h2>Locatie van het klussje</h2>
                        @endforeach
                        <div class="map--wrap">
                            <div id="map--individual"></div>
                            @include('kluss.includes.map')
                        </div>
                        @foreach($kluss as $kl)
                        </div>
                        <div id="tab3">
                            <h2>Informatie over de Klusser</h2>
                            <div class="owner--wrap">
                                <div class="owner--wrap-left">
                                    <p class="owner--name">{{$kl->userName}}</p>
                                    <p class="owner--bio">{{$kl->userBio}}</p>
                                    <div class="star-ratings-sprite"><span style="width:calc({{$reviewScore}} * 20%)" class="star-ratings-sprite-rating"></span></div>
                                </div>
                                <div class="contact--owner">
                                    <img src="/assets{{$kl->profile_pic}}" class="task--user-image" alt="{{$kl->userName}}'s profile pic">
                                    <form action="/chat/{{$kl->userID}}" method="post">
                                        {!! csrf_field() !!}
                                        <label for="start--chat"></label>
                                        <input type="submit" id="start--chat" name="start--chat" value="Contacteer {{$kl->userName}}">
                                    </form>
                                </div>
                            </div>
                            @include('kluss.includes.applicant')
                        </div>
                    </section>
                </div>
            </div>
        @endforeach
    </div>
</div>
@include('kluss.modals.report', ['id' => $kl->id])
@endsection
