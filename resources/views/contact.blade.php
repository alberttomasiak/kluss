@extends('layouts.app')
@section('content')
    <div class="main-content-wrap">
            <h1 class="contentpage_pagetitle">Contact</h1>
            <div class="contact_wrapper">
                <p class="contentpage_paragraph">
                    Indien u vragen hebt, kan u hier terecht om ons personeel te contacteren in verband met technische problemen,
                    vragen, suggesties, problematische gebruikers of aanstootgevend gedrag.<br><br>
                    Vooraleer u ons contacteert, zouden we u vriendelijk willen verzoeken om te controleren of uw vraag niet in de
                    <a href="/FAQ" class="emaillink">FAQ</a> te vinden is.<br><br>
                    Algemene e-mail: <a href="mailto:hi@kluss.be" class="emaillink">hi@kluss.be</a><br><br>
                    Technische ondersteuning: <a href="mailto:contact@kluss.be" class="emaillink">contact@kluss.be</a><br><br>
                    U kan ook gebruik maken van onderstaand contactformulier.
                </p>
                <div class="contact_form">
                    <form action="/contact/send" id="contact_form">
                        <input type="text" name="auteur" placeholder="Naam of bedrijf" class="contact_textinput">
                        <select name="contact_categorie" form="contact_form" class="contact_textinput">
                            <option value="select">Kies een categorie...</option>
                            <option value="suggesties">Suggesties voor verbeteringen van het platform</option>
                            <option value="misbruik">Misbruik of aanstootgevend gedrag</option>
                            <option value="technisch">Technische problemen</option>
                            <option value="samenwerken">Samenwerken met KLUSS</option>
                            <option value="andere">Andere</option>
                        </select>
                        <input type="text" name="email" placeholder="E-mailadres" class="contact_textinput">
                        <input type="text" name="subject" placeholder="Onderwerp" class="contact_textinput">
                        <textarea name="commentaar" id="contact_comment" cols="30" rows="10" placeholder="Schrijf hier uw boodschap..." class="contact_textfield"></textarea>
                        <button class="contact_send">VERZENDEN</button>
                    </form>
                </div>
            </div>
    </div>

@endsection
