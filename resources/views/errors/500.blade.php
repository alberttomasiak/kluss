@extends('layouts.app')
@section('content')
    <div class="main-content-wrap error-page">
        <h1>500: Er is iets misgelopen</h1>
        <div class="not-found-main">
            <img src="/assets/img/error.png" alt="500 Error">
            <h2>Er is iets misgelopen!</h2>
            <p>Klik <a href="/">hier</a> om terug naar de homepagina van kluss.be te gaan</p>
        </div>
    </div>
@endsection
