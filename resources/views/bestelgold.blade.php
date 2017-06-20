@extends('layouts.app')
@section('content')
    <div class="main-content-wrap">
        <div class="gold-container" >
            <h1>Kluss Gold</h1>
            <p class="contentpage_paragraph">Opgelet! u staat op het punt om Kluss Gold te bestellen voor</p>
            <p class="gold--duration">{{$duration}} maanden</p>
            <p class="contentpage_paragraph">Bent u zeker?</p>
            <div class="order--form">
                <form action="/bestel/{{\Auth::user()->id}}/{{$duration}}" id="purchaseGold" name="purchaseGold" method="post">
                    {!! csrf_field() !!}
                    <input type="submit" form="purchaseGold" name="purchase--btn" value="Ja, bevestig mijn betaling" class="purchasegold--btn">
                </form>
                <a href="/klussgold" class="refusegoldlink">Nee, annuleer mijn bestelling</a>
            </div>
            <br>
            <p class="contentpage_paragraph">Meer details over Kluss Gold vindt u in de <a href="/terms">algemene voorwaarden</a>.</p>

            <br>

            <br>
            <br>

        </div>
    </div>

@endsection