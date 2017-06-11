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
        <h1 style="float: left; padding: 15px;">Schrijf een review</h1>
        <hr style="background-color: #677578; height: 0.2px; width: 100%; ">

        <p>Je schrijft nu een review voor je klusser of opdrachtgever. Bij Kluss willen we een betrouwbare omgeving; wees daarom eerlijk en correct in je beoordeling.</p>
        <br>
        <div class="review_form">
            <form action="">
                <label for="score">Score:</label><input name="score" type="number" value="3" min="1" max="5">
                <label for="reviewmsg">Boodschap:</label><textarea name="reviewmsg" id="review_msg" cols="30" rows="10"></textarea>
                <a href="#">Verstuur</a>
            </form>
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