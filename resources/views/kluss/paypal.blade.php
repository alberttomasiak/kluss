{{--@extends('layouts.app')--}}
@section('content')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&callback"></script>
    <link href="/assets/css/edits.css" rel="stylesheet">
    <div class="addboxshadow" id='cssmenu'>
        <ul>
            <li><a href='#'><img class="animationout" style="height: 35px; padding-right: 15px;" src="/assets/img/logo-kluss.png"></a></li>
            <li><a href='#'><img class="animationout" style="height: 35px; padding-right: 15px;" src="/assets/img/home-logo.png">Home</a></li>
            <li><a href='#'><img class="animationout" style="height: 35px; padding-right: 15px;" src="/assets/img/plaats-logo.png">Plaats een klusje</a></li>
            <li><a href='#'><img class="animationout" style="height: 35px; padding-right: 15px;" src="/assets/img/bell-logo.png">Meldingen</a></li>
            <li><a href='#'><img class="animationout" style="height: 25px; padding-right: 15px;" src="/assets/img/berichten-logo.png">Berichten</a></li>
            <li class='active'><a href='#'><img class="animationout" style="height: 35px; padding-right: 15px;" src="/assets/img/settings-logo.png">Instellingen</a>
                <ul>
                    <li><a href='#'>Profiel</a>
                        <ul>
                            <li><a href='#'>Bewerk Profiel</a></li>
                            <li><a href='#'>Kluss Gold</a></li>
                        </ul>
                    </li>
                    <li><a href='#'>Meldingen en gebruikers</a>
                        <ul>
                            <li><a href='#'>Demp meldingen</a></li>
                            <li><a href='#'>Geblokkeerde gebruikers</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="addboxshadow container" style="display:block; overflow:auto;">
        <h1 style="float: left; padding: 15px;">Kluss: "{{$task[0]->title}}" afbetalen.</h1>
        <hr style="background-color: #677578; height: 0.2px; width: 100%; ">
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
                    {{csrf_field()}}
                    <input type="submit" name="payment" value="Betaling bevestigen">
                </form>
            @else
                <p>Je hebt al voor het klusje betaald. <a href="/kluss/{{$task[0]->id}}">Terug naar het klussje.</a></p>
            @endif
        </div>
    </div>
    <script>
        (function($) {
            $.fn.menumaker = function(options) {
                var cssmenu = $(this), settings = $.extend({
                    title: "Menu",
                    format: "dropdown",
                    sticky: false
                }, options);
                return this.each(function() {
                    cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
                    $(this).find("#menu-button").on('click', function(){
                        $(this).toggleClass('menu-opened');
                        var mainmenu = $(this).next('ul');
                        if (mainmenu.hasClass('open')) {
                            mainmenu.hide().removeClass('open');
                        }
                        else {
                            mainmenu.show().addClass('open');
                            if (settings.format === "dropdown") {
                                mainmenu.find('ul').show();
                            }
                        }
                    });
                    cssmenu.find('li ul').parent().addClass('has-sub');
                    multiTg = function() {
                        cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                        cssmenu.find('.submenu-button').on('click', function() {
                            $(this).toggleClass('submenu-opened');
                            if ($(this).siblings('ul').hasClass('open')) {
                                $(this).siblings('ul').removeClass('open').hide();
                            }
                            else {
                                $(this).siblings('ul').addClass('open').show();
                            }
                        });
                    };
                    if (settings.format === 'multitoggle') multiTg();
                    else cssmenu.addClass('dropdown');
                    if (settings.sticky === true) cssmenu.css('position', 'fixed');
                    resizeFix = function() {
                        if ($( window ).width() > 768) {
                            cssmenu.find('ul').show();
                        }
                        if ($(window).width() <= 768) {
                            cssmenu.find('ul').hide().removeClass('open');
                        }
                    };
                    resizeFix();
                    return $(window).on('resize', resizeFix);
                });
            };
        })(jQuery);
        (function($){
            $(document).ready(function(){
                $("#cssmenu").menumaker({
                    title: "Menu",
                    format: "multitoggle"
                });
            });
        })(jQuery);
    </script>
@endsection
