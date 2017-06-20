@extends('layouts.app')
@section('content')
    <div class="main-content-wrap error-page">
        <h1>500: Er is iets misgelopen</h1>
        <div class="not-found-main">
            <img src="/assets/img/error.png" alt="500 Error">
            <h2>Er is iets misgelopen!</h2>
            <p>Klik <a href="{{ url()->previous() }}">hier</a> om terug te gaan naar de vorige pagina.</p>
        </div>
    </div>
@endsection
