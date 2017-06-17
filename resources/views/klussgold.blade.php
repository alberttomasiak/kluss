@extends('layouts.app')
@section('content')
    <div class="main-content-wrap">
        <div class="addboxshadow">
            <h1 class="contentpage_pagetitle">KLUSS Gold</h1>
            <div>
                <p class="contentpage_paragraph">
                    Klaar om nog meer te klussen en je beleving naar een hoger niveau te tillen?
                    Maak dan kennis met Kluss Gold, een premium formule die je toelaat om ongelimiteerd te klussen of te laten klussen,
                    je zoekradius vergroot, en nog veel meer! Ontdek hier alle voordelen van Kluss Gold en bestel meteen!<br><br>
                    Meer details over Kluss Gold vindt u in de <a href="/terms">algemene voorwaarden</a>.
                </p>
                <div class="pricetable_features">
                    <img src="/assets/img/price_table.jpg" alt="Prijzentabel">
                </div>
                <div class="pricetable_wrapper">
                    @if($gold == true)
                        <p>Je bent nog geabonneerd voor KLUSS Gold tot: {{substr(goldEnd(\Auth::user()->id), 0, 10)}}</p>
                    @else
                        <p>Overtuigd? Bestel dan hier je premiumformule! Probeer één enkele maand of bestel ineens voor enkele maanden!</p>
                        <div class="pricetable">
                            <div class="pricetable_content">
                                <div class="pricetable_row" style="">
                                    <div class="klussgold-duration"><span>1</span> <p>maand</p></div>
                                    <div class="klussgold_pricing">€ 3.99/maand = € 3.99</div>
                                    <div><form action="/klussgold/bestellen/1" method="post">
                                            {{ csrf_field() }}
                                            <input type="submit" name="btn-bestel" class="klussgold-bestel" value="Bestel">
                                        </form></div>
                                </div>
                                <div class="pricetable_row" style="">
                                    <div class="klussgold-duration"><span>3</span> <p>maanden</p></div>
                                    <div class="klussgold_pricing">€ 3.99/maand = € 11.97</div>
                                    <div><form action="/klussgold/bestellen/3" method="post">
                                            {{ csrf_field() }}
                                            <input type="submit" name="btn-bestel" class="klussgold-bestel" value="Bestel">
                                        </form></div>
                                </div>
                                <div class="pricetable_row" style="">
                                    <div class="klussgold-duration"><span>6</span> <p>maanden</p></div>
                                    <div class="klussgold_pricing"><strike>€ 3.99</strike> € 2.99/maand = € 17.94</div>
                                    <div><form action="/klussgold/bestellen/6" method="post">
                                            {{ csrf_field() }}
                                            <input type="submit" name="btn-bestel" class="klussgold-bestel" value="Bestel">
                                        </form></div>
                                </div>
                                <div class="pricetable_row" style="">
                                    <div class="klussgold-duration"><span>12</span> <p>maanden</p></div>
                                    <div class="klussgold_pricing"><strike>€ 3.99</strike> € 2.99/maand = € 35.88</div>
                                    <div><form action="/klussgold/bestellen/12" method="post">
                                            {{ csrf_field() }}
                                            <input type="submit" name="btn-bestel" class="klussgold-bestel" value="Bestel">
                                        </form></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>


        </div>
    </div>

@endsection
