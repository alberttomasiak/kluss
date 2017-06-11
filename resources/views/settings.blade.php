<html>
<head>
    <meta charset="utf-8">
    <title>KLUSS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link href="/assets/css/edits.css" rel="stylesheet">
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
    <h1 style="float: left; padding: 15px;">Instellingen</h1>
    <hr style="background-color: #677578; height: 0.2px; width: 100%; ">
    <div style="height: 1007px; float: left; width: 20%; margin-left: 30px; margin-top: -10px; border-right: 1px solid #677578;">
        <section style="margin-top: 30px;">
        <a href="#">Persoonlijke informatie <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        <br><br>
        <a href="#">Meldingen <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            <br><br>
            <a href="#">Geblockte gebruikers <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            <br><br>
            <a href="#">Betalingen <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            <br><br>
            <a href="#">Kluss Gold <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            </section>
    </div>

    <div class="page">
        <div class="page-content">
            @yield('content')
        </div>
    </div>

</div>

<footer>
    <div class="footer-content container">
        <section>
            <p>KLUSS</p>
            <ul>
                <li><a style="color: #FFFFFF !important;" href="#">Home</a></li>
                <li><a style="color: #FFFFFF !important;" href="#">Team</a></li>
                <li><a style="color: #FFFFFF !important;" href="#">Algemene Voorwaarden</a></li>
                <li><a style="color: #FFFFFF !important;" href="#">FAQ</a></li>

            </ul>
        </section>
        <section style="margin-right:0px !important;">
            <p>CONTACT</p>
            <ul>
                <li><a style="color: #FFFFFF !important;" href="#">Contact</a></li>
                <li><a style="color: #FFFFFF !important;" href="#">Facebook</a></li>
                <li><a style="color: #FFFFFF !important;" href="#">Twitter</a></li>

            </ul>

        </section>
    </div>
    <div style="clear:both;text-align:center;font-size:10px;position:relative;bottom:-20px;">
        &copy; KLUSS 2017 - Made with &#10084; by our team
    </div>
</footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/assets/js/app.js"></script>
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
</body>
</html>
