@extends('layouts.app')
@section('content')
@include('kluss.includes.map')
    <div class="main-content-wrap">
        @foreach($kluss as $kl)
            <div class="individual-task">
                <div class="task--main-image-wrap">
                    <img src="/assets{{$kl->kluss_image}}" class="single-img-main" alt="{{$kl->title}} image">
                </div>
                <div class="quick-recap-wrap">
                    <div class="task--details">
                        <span>€ {{$kl->price}}</span>
                        <p>{{$kl->description}}</p>
                        <a href="/kluss/{{$kl->id}}/solliciteren">Apply</a>
                    </div>
                </div>
                <div class="tabs--task">
                    <ul class="tabs task--tabs" data-tabgroup="tab-group">
                        <li><a href="#tab1" data-tabID="1" class="active"><span>Beschrijving</span></a></li>
                        <li><a href="#tab2" data-tabID="2" class=""><span>Locatie</span></a></li>
                        <li><a href="#tab3" data-tabID="3" class=""><span>Klusser</span></a></li>
                    </ul>
                    <div class="task--main-info">
                        <h1>{{$kl->title}}</h1>
                        @if(blockChecker($kl->id, \Auth::user()->id) == "" && \Auth::user()->id != $kl->user_id)
                            <a href="#kluss-{{$kl->id}}-report" data-toggle="modal" role="button" data-id="{{$kl->id}}" class="">Rapporteer</a>
                            @include('kluss.modals.report', ['id' => $kl->id])
                        @elseif(blockChecker($kl->id, \Auth::user()->id) != "" && \Auth::user()->id != $kl->user_id)
                            <a href="#kluss-{{$kl->id}}-report" data-toggle="modal" role="button" data-id="{{$kl->id}}" class="" disabled>Rapporteer</a>
                            @include('kluss.modals.report', ['id' => $kl->id])
                            <p>Dit klusje werd door u al gerapporteerd. De beheerders zijn dit aan het onderzoeken.</p>
                        @endif
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
                            @if($kl->user_id == \Auth::user()->id)
                                <div class="for--related">
                                    <div class="full-width">
                                        @if($accepted_applicant == null)
                                            @if($kl->user_id == \Auth::user()->id)
                                                <div class="applicants">
                                                    <h3>Sollicitanten</h3>
                                                      @foreach($kluss_applicants as $s => $sol)
                                                          <div class="applicant {{$s != 0 ? 'first-app' : ''}}">
                                                              <img class="applicant-image" src="/assets{{$sol->profile_pic}}" alt="{{$sol->name}}'s profile picture">
                                                              <a class="applicant-name" href="/profiel/{{$sol->id}}/{{$sol->name}}">{{$sol->name}}</a>
                                                              <form action="/chat/{{$sol->id}}" method="post">
                                                                  {{csrf_field()}}
                                                                  <input type="submit" name="chatstart" class="btn-contact" value="Contact">
                                                              </form>
                                                                  {{-- Gebruiker accepteren --}}
                                                                  <form action="/kluss/{{$kl->id}}/sollicitant/{{$sol->id}}/accepteren" method="post">
                                                                      {{csrf_field()}}
                                                                      <input type="hidden" name="kluss_id" id="kluss_id" value="{{$kl->id}}">
                                                                      <input type="hidden" name="user_id" id="user_id" value="{{$sol->id}}">
                                                                      <input type="submit" name="" class="btn-accept" value="Accept">
                                                                  </form>
                                                                  {{-- Gebruiker weigeren --}}
                                                                  <form action="/kluss/{{$kl->id}}/sollicitant/{{$sol->id}}/weigeren" method="post">
                                                                      {{csrf_field()}}
                                                                      <input type="hidden" name="kluss_id" id="kluss_id" value="{{$kl->id}}">
                                                                      <input type="hidden" name="user_id" id="user_id" value="{{$sol->id}}">
                                                                      <input type="submit" name="" class="btn-deny" value="Weigeren">
                                                                      {{-- <a href="" role="button" class="btn btn-danger">Weigeren</a> --}}
                                                                  </form>
                                                          </div>
                                                    @endforeach
                                                {!! $kluss_applicants->appends(Request::except('sollicitanten'))->render() !!}
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="left-side">
                                        @if(didIPay($kl->id) == "")
                                            <p>Voor dat het klusje afgesloten kan worden moet er nog betaald worden.</p>
                                            <a href="/kluss/{{$kl->id}}/betalen">Kluss betalen</a>
                                        @else
                                            <p>Je hebt al voor dit klusje betaald. Deze kan je nu afsluiten.</p>
                                            <a href="/kluss/{{$kl->id}}/betalen" disabled>Reeds betaald</a>
                                        @endif
                                    </div>
                                    <div class="right-side">
                                        @if(didIPay($kl->id) == "")
                                            <p>Je kan de andere gebruiker een review geven nadat het klusje afgesloten werd.</p>
                                            <form action="/kluss/{{$kl->id}}/{{\Auth::user()->id}}/finished" method="post">
                                                {{csrf_field()}}
                                                <input type="submit" name="finishtask" class="btn-finish" value="Kluss beëindigen" disabled>
                                            </form>
                                        @elseif(didIPay($kl->id) != "" && didIMark(\Auth::user()->id, $kl->id) == "")
                                            <p>Je kan de andere gebruiker een review geven nadat het klusje afgesloten werd.</p>
                                            <form action="/kluss/{{$kl->id}}/{{\Auth::user()->id}}/finished" method="post">
                                                {{csrf_field()}}
                                                <input type="submit" name="finishtask" class="btn-finish" value="Kluss beëindigen">
                                            </form>
                                        @elseif(didIPay($kl->id) != "" && didIMark(\Auth::user()->id, $kl->id) != "")
                                            <p>Je hebt het klusje gemarkeerd als afgewerkt en je hebt er al voor betaald. Je kan de gebruiker nu een review geven.</p>
                                            <a href="/review/{{$kl->id}}" class="review-btn">Review schrijven</a>
                                        @endif
                                    </div>
                                </div>
                            @elseif($kl->accepted_applicant_id == \Auth::user()->id)
                                <div class="for--related">
                                    <div class="right-side full-width">
                                        @if(didIMark(\Auth::user()->id, $kl->id) == "")
                                            <p>Voor dat het klusje afgesloten kan worden moet deze gemarkeerd worden als afgerond. Je kan dit doen door op de knop hieronder te klikken.</p>
                                            <form action="/kluss/{{$kl->id}}/{{\Auth::user()->id}}/finished" method="post">
                                                {{csrf_field()}}
                                                <input type="submit" name="finishtask" class="btn-finish" value="Kluss beëindigen">
                                            </form>
                                        @else
                                            <p>Je hebt dit klusje al gemarkeerd als afgerond. Je kan de gebruiker nu een review schrijven:</p>
                                            <a href="/review/{{$kl->id}}">Review Schrijven</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div id="tab2">
                            <h2>Locatie van het klussje</h2>
                            <div id="map-single"></div>
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
            </div>
        @endforeach
    </div>
@endsection
