{{--@extends('layouts.app')--}}
@section('content')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&callback"></script>
    <link href="assets/css/edits.css" rel="stylesheet">

    <div class="addboxshadow" id='cssmenu'>
        <ul>
            <li><a href='#'><img class="animationout" style="height: 35px; padding-right: 15px;" src="../assets/img/logo-kluss.png"></a></li>
            <li><a href='#'><img class="animationout" style="height: 35px; padding-right: 15px;" src="../assets/img/home-logo.png">Home</a></li>
            <li><a href='#'><img class="animationout" style="height: 35px; padding-right: 15px;" src="../assets/img/plaats-logo.png">Plaats een klusje</a></li>
            <li><a href='#'><img class="animationout" style="height: 35px; padding-right: 15px;" src="../assets/img/bell-logo.png">Meldingen</a></li>
            <li><a href='#'><img class="animationout" style="height: 25px; padding-right: 15px;" src="../assets/img/berichten-logo.png">Berichten</a></li>
            <li class='active'><a href='#'><img class="animationout" style="height: 35px; padding-right: 15px;" src="../assets/img/settings-logo.png">Instellingen</a>
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
        <h1 style="float: left; padding: 15px;">Kluss Gold</h1>
        <hr style="background-color: #677578; height: 0.2px; width: 100%; ">

        <p>Klaar om nog meer te klussen en je beleving naar een hoger niveau te tillen? Maak dan kennis met Kluss Gold, een premium formule die je toelaat om ongelimiteerd te klussen of te laten klussen, je zoekradius vergroot, en nog veel meer! Ontdek hier alle voordelen van Kluss Gold en bestel meteen!</p>
        <p>Meer details over Kluss Gold vindt u in de <a href="#">algemene voorwaarden</a>.</p>
        <div style="width: 80%; display: block; margin-left: auto; margin-right: auto;"><img src="/assets/img/prices.png" alt="prijzentabel" style="width: 100%;"></div>
        <br>
        <div>
                @if($gold == true)
                    <p>Je bent nog geabonneerd voor KLUSS Gold tot: {{substr(goldEnd(\Auth::user()->id), 0, 10)}}</p>
                @else
                <p>Overtuigd? Bestel dan hier je premiumformule! Probeer één enkele maand of bestel ineens voor enkele maanden!</p>
                <div class="pricetable">
                    <div class="pricetable_header">
                        <div class="pricetable_row" style="display: flex; justify-content: space-around;">
                            <div>Periode</div>
                            <div>Prijs</div>
                            <div>Bestel hier!</div>
                        </div>
                    </div>
                    <div class="pricetable_content">
                        <div class="pricetable_row" style="display: flex; justify-content: space-around;">
                            <div>1 maand</div>
                            <div>€ 3.99/maand = € 3.99</div>
                            <div><a href="/bestel?months=1">Bestel</a></div>
                        </div>
                        <div class="pricetable_row" style="display: flex; justify-content: space-around;">
                            <div>3 maanden</div>
                            <div>€ 3.99/maand = € 11.97</div>
                            <div><a href="/bestel?months=3">Bestel</a></div>
                        </div>
                        <div class="pricetable_row" style="display: flex; justify-content: space-around;">
                            <div>6 maanden</div>
                            <div><strike>€ 3.99</strike> € 2.99/maand = € 17.94</div>
                            <div><a href="/bestel?months=6">Bestel</a></div>
                        </div>
                        <div class="pricetable_row" style="display: flex; justify-content: space-around;">
                            <div>12 maanden</div>
                            <div><strike>€ 3.99</strike> € 2.99/maand = € 35.88</div>
                            <div><a href="/bestel?months=12">Bestel</a></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <br>
        <br>

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
