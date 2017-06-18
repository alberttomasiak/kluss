@extends('layouts.app')
@section('content')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css"> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&callback"></script>
    <!--<link href="/assets/css/edits.css" rel="stylesheet">-->
    <div class="main-content-wrap">
        <div class="">
            <h1>Schrijf een review</h1>
            @if($review == "")
                <p class="reviewguide">Je schrijft nu een review voor <b>{{$for}}</b>. Bij Kluss willen we een betrouwbare omgeving; wees daarom eerlijk en correct in je beoordeling!</p>
                <br>
                <div class="review_form">
                    <form action="/review/{{$task->id}}" id="write-review" method="post" class="reviewform">
                        {{csrf_field()}}
                        <input type="hidden" id="task_id" name="task_id" value="{{$task->id}}">
                        <input type="hidden" id="maker_id" name="maker_id" value="{{$task->user_id}}">
                        <input type="hidden" id="fixer_id" name="fixer_id" value="{{$task->accepted_applicant_id}}">
                        {{-- <label for="score">Score:</label><input name="score" type="number" id="review_score" name="review_score" placeholder="Score tussen 1 en 5" min="1" max="5"> --}}

                        <fieldset>
                      <span class="star-cb-group">
                        <input type="radio" id="rating-5" name="score" value="5"  /><label for="rating-5">5</label>
                        <input type="radio" id="rating-4" name="score" value="4" /><label for="rating-4">4</label>
                        <input type="radio" id="rating-3" name="score" value="3" /><label for="rating-3">3</label>
                        <input type="radio" id="rating-2" name="score" value="2" /><label for="rating-2">2</label>
                        <input type="radio" id="rating-1" name="score" value="1" checked="checked" /><label for="rating-1">1</label>
                          {{-- <input type="radio" id="rating-0" name="score" value="0" class="star-cb-clear" /><label for="rating-0">0</label> --}}
                      </span>
                        </fieldset>

                        <label class="reviewlabel" for="reviewmsg">Boodschap:</label><textarea class="review_txt"  name="review_msg" id="review_msg" cols="30" rows="10"></textarea>
                        <input type="submit" name="submit" form="write-review" value="Verzenden" class="btn-sendreview">
                    </form>
                </div>
            @else
                <p>Je hebt al een review voor dit klusje geschreven. Hartelijk bedankt daarvoor. Klik <a href="/home">hier</a> om terug te gaan naar de homepage.</p>
            @endif
            <br>
            <br>

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
