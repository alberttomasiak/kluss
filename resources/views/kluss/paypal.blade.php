@extends('layouts.app')
@section('content')
    <div class="main-content-wrap">
        <div>
            <h1>Kluss: "{{$task[0]->title}}" afbetalen.</h1>
            <h2>Details klussje:</h2>
            <div class="task-details-payment">
                <div class="col-md-6">
                    <img class="individual--image" src="/assets/{{$task[0]->kluss_image}}" alt="{{$task[0]->title}}">
                </div>
                <div class="col-md-6 kluss-data">
                    <h1>{{$task[0]->title}}</h1>
                    <p>{{$task[0]->description}}</p></br></br>
                    <b>{{preg_replace('/[0-9]+/', '', $task[0]->address)}}</b></br>
                    <b>{{$task[0]->price}} Credits</b></br></br>
                    @if($accepted_applicant == null)
                        @if(\Auth::user()->id == $task[0]->user_id)
                            <div class="master-btns">
                                <a class="btn btn--form" href="/kluss/{{$task[0]->id}}/bewerken">Bewerk deze Kluss</a>
                                <a href="/kluss/{{$task[0]->id}}/verwijderen" class="btn btn-danger">Deze kluss verwijderen</a>
                            </div>
                        @else
                            <div class="apply-btn">
                                @if($kluss_applicant->first())
                                    <a class="btn btn-danger" href="/kluss/{{$task[0]->id}}/solliciteren">Applicatie verwijderen</a>
                                @else
                                    @if(areWeCool(\Auth::user()->id, $task[0]->user_id) != "")
                                        <p>Je hebt of bent door de gebruiker geblokkeerd. Solliciteren voor dit klusje is niet mogelijk.</p>
                                    @else
                                        <a class="btn btn--form" href="/kluss/{{$task[0]->id}}/solliciteren">Solliciteer voor deze kluss</a>
                                    @endif
                                @endif
                            </div>
                        @endif
                    @else
                        <div class="selected--applicant">
                            <h3>Gekozen klusser:</h3>
                            <div class="applicant--info">
                                <img class="applicant-image" src="/assets{{$accepted_applicant->profile_pic}}" alt="{{$accepted_applicant->name}}'s profile pic'">
                                <a href="/profiel/{{$accepted_applicant->id}}/{{$accepted_applicant->name}}">{{$accepted_applicant->name}}</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="confirm-payment">
                @if($paid == "")
                    <p>Je staat op het punt om het klusje "{{$task[0]->title}}" af te betalen. Dit is nodig om het klusje te markeren als afgewerkt en de andere gebruiker te kunnen betalen.</p>
                    <form class="" action="/kluss/{{$task[0]->id}}/betalen" method="post">
                        {!! csrf_field() !!}
                        <input type="submit" name="payment" value="BETALING BEVESTIGEN" class="btn btn--form">
                    </form>
                @else
                    <p>Je hebt al voor het klusje betaald. <a href="/kluss/{{$task[0]->id}}">Terug naar het klussje.</a></p>
                @endif
            </div>
        </div>
    </div>
@endsection
