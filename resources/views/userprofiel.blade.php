<html>
<head>
    <meta charset="utf-8">
    <title>KLUSS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="assets/css/edits.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/6caa87bbb8.js"></script>
</head>
<body>

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
    <h1 style="float: left; padding: 15px;">Profiel</h1>
    <hr style="background-color: #677578; height: 0.2px; width: 100%; ">
    <div style="display:block; overflow:auto; float: left; width: 20%; margin-left: 30px; margin-top: -10px; margin-bottom: 30px; border-right: 1px solid #677578;">
        <section style="margin-top: 30px;">
        <a href="#" class="persoonlijkeinformatie"> Persoonlijke informatie <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        <br><br>
        <a href="#" class="uitgevoerdeklusjes">Uitgevoerde klusjes <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            <br><br>
            <a href="#" class="reviews">Reviews <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            <br><br>
            <a href="#" class="openstaandeklusjes">Openstaande klusjes <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            <br><br>
            <a href="#"><i style="margin-right: 10px;" class="fa fa-wrench" aria-hidden="true"></i>Pas profiel aan</a>
            <br><br>
            <a style="color:#911137;" href="#"><i style="margin-right: 10px;" class="fa fa-ban" aria-hidden="true"></i>Blokkeer</a>
            </section>
        </div>



    <div style="float: left; width: 60%; margin-right: 20px; margin-left: 40px; color: #677578;">

        <div class="profiel-one">
            <a style="background-image: url(../assets/img/default_profilepic.png);"  class="project-block-user-image"></a>

            <h1>Samuel Sieben</h1>

            <p>20 jaar, Leuven</p>

            <section style="float: right;">
                <a class="animationout"><img class="animationout" src="../assets/img/like.png">32 likes</a>
                <a class="animationout"><img class="animationout" src="../assets/img/dislike.png">24 dislikes</a>
            </section>

            <section style="width: 100%">
                <a><img class="animationout" style="height: 30px;" src="../assets/img/chat.png">Contacteer mij</a>
            </section>

        </div>

        </div>
    <hr style="background-color: #677578; height: 0.2px; width: 100%; ">


    <div class="profiel-two">
        <h1 style="float: left; padding: 15px;"> Uitgevoerde Klusjes </h1>
        <a href="#">
            <div class="notification-box addboxshadow animationout">

                <h1 style="float: left; font-size: 20px; padding-left: 30px; color: grey;">Grote afwas</h1>

                <p style="float: right;">door Thomas Albertio</p>

                <p style="float: left; display: inline; font-size: 15px; padding-left: 30px;">Afwassen vn metalen potten en pannen en afschrapen van verbrandingslaag</p>

                <p style="float: right;">5 dagen geleden</p>
                <!--Als eigen profiel is, en klus is nog niet geclosed-->
                <a href="/finishklus?id=1">Klus afronden</a>
                <a href="https://www.paypal.com/signin?country.x=BE&locale.x=en_BE">Betaal via PayPal</a>
            </div>
        </a>


        <a href="#">
            <div class="notification-box addboxshadow animationout">

                <h1 style="float: left; font-size: 20px; padding-left: 30px; color: grey;">Grote afwas</h1>

                <p style="float: right;">door Thomas Albertio</p>

                <p style="float: left; display: inline; font-size: 15px; padding-left: 30px;">Afwassen vn metalen potten en pannen en afschrapen van verbrandingslaag</p>

                <p style="float: right;">5 dagen geleden</p>
                <!--Als eigen profiel is, en klus is nog niet geclosed-->
                <a href="/finishklus?id=2">Klus afronden</a>
                <a href="https://www.paypal.com/signin?country.x=BE&locale.x=en_BE">Betaal via PayPal</a>
            </div>
        </a>

    </div>

    <div class="profiel-three">
        <h1 style="float: left; padding: 15px; width: 100%;"> Reviews </h1>
        <a href="#">
            <div class="notification-box addboxshadow animationout">

                <h1 style="font-size: 20px;">Review<i style="margin-left: 10px;" class="fa fa-pencil" aria-hidden="true"></i></h1>

                <h1 style="float: left; font-size: 20px; padding-left: 30px; color: grey;">Erg Matige Shit</h1>

                <p style="float: right;">door Lolbroekje 8000</p>

                <p style="float: left; display: inline; font-size: 15px; padding-left: 30px;">Het was allemaal kutteslecht gedaan, wtf is dit voor service? Volgende keer vraag ik geld terug!</p>

                <p style="float: right;">5 dagen geleden</p>
            </div>
        </a>

    </div>

    <div class="profiel-four">
        <h1 style="float: left; padding: 15px; width: 100%;"> Openstaande Klusjes </h1>
        <a href="#">
            <div class="notification-box addboxshadow animationout">

                <h1 style="font-size: 20px;">Openstaand<i style="margin-left: 10px;" class="fa fa-eye" aria-hidden="true"></i></h1>

                <h1 style="float: left; font-size: 20px; padding-left: 30px; color: grey;">Hulp met grasmaaien</h1>

                <p style="float: right;">door Miranda Swings</p>

                <p style="float: left; display: inline; font-size: 15px; padding-left: 30px;">Wie wilt even op mijn boerderij het gras komen maaien? Ik geef een goede vergoeding!</p>

                <p style="float: right;">1 maand geleden</p>
            </div>
        </a>

    </div>

</div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        $(".landing_body").css("height", window.innerHeight-60 + "px");

        window.onresize=function(){
            $(".landing_body").css("height", window.innerHeight-60 + "px");
        };
    </script>
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


<script>
    $('.persoonlijkeinformatie').click(function() {
        $('.profiel-two').css('display','none');
        $('.profiel-three').css('display','none');
        $('.profiel-four').css('display','none');
        $('.profiel-one').css('display', 'block');
    });
</script>
<script>
    $('.uitgevoerdeklusjes').click(function() {
        $('.profiel-three').css('display', 'none');
        $('.profiel-four').css('display', 'none');
        $('.profiel-one').css('display', 'block');
        $('.profiel-two').css('display', 'block');
    });
</script>
<script>
    $('.reviews').click(function() {
        $('.profiel-two').css('display', 'none');
        $('.profiel-four').css('display', 'none');
        $('.profiel-one').css('display', 'block');
        $('.profiel-three').css('display', 'block');
    });
</script>
<script>
    $('.openstaandeklusjes').click(function() {
        $('.profiel-three').css('display', 'none');
        $('.profiel--two').css('display', 'none');
        $('.profiel-one').css('display', 'block');
        $('.profiel-four').css('display', 'block');
    });
</script>
</body>
</html>
