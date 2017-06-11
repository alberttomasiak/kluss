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

    <img class="klusspage-img" src="../assets/img/wasserette.jpg">
    <div class="klusspage-block addboxshadow">
        <h1 style="text-align: center; font-size: 40px;">€ 15</h1>
        <p style="margin: 15px; text-align: center;">Hulp nodig om leefruimte om te ruimen en versieren voor feestje, dank.</p>
        <div style="padding-top: 20px;" class="centerize">
        <a href="#" class="btn">Neem aan</a>
            </div>
    </div>
    <h1 style="float: left; padding: 15px; color: grey;">Wassen van mijn kleren</h1>
    <a href="#" class="btn" style="display: inline-block; margin: 25px;">Rapporteer</a>
    <hr style="background-color: #677578; height: 0.2px; width: 100%; ">

    <p style="padding: 15px;"> Categorie: Opruimen </p>

    <h1 style="padding-left: 15px;">Over dit klusje</h1>
    <p style="padding-left: 15px;">Hulp nodig om leefruimte op te ruimen en versieren voor feestje, dank.</p>
    <a><img class="animationout" style="height: 30px;" src="../assets/img/chat.png">Contacteer klusser</a>
    <hr style="background-color: #677578; height: 0.2px; width: 80%; ">

    <h1 style="padding-left: 15px;">Locatie van Klusje</h1>

    <div class="addboxshadow" id="map"></div>

    <hr style="background-color: #677578; height: 0.2px; width: 80%; ">

    <h1 style="padding-left: 15px;">Informatie over de klusser</h1>

    <a href="#">
        <div class="notification-box addboxshadow animationout">

            <a style="background-image: url(../assets/img/default_profilepic.png); float: left; width: 10%;"  class="project-block-user-image-kluss"></a>

            <h1 style="float: left; font-size: 20px; padding-left: 30px; width: 30%; color: grey;">Albert Tomasiak</h1>

            <p style="float: left; display: inline; padding-left: 30px; width: 60%;">20 jaar, Leuven</p>

            <section style="float: left; width: 50%">
                <a class="animationout"><img class="animationout" src="../assets/img/like.png">32 likes</a>
                <a class="animationout"><img class="animationout" src="../assets/img/dislike.png">24 dislikes</a>
            </section>


            <p style="float: right; width: 20%;">Bekijk volledige profiel</p>
        </div>
    </a>

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
    if (isAdvancedUpload) {

        var droppedFiles = false;

        $form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                })
                .on('dragover dragenter', function() {
                    $form.addClass('is-dragover');
                })
                .on('dragleave dragend drop', function() {
                    $form.removeClass('is-dragover');
                })
                .on('drop', function(e) {
                    droppedFiles = e.originalEvent.dataTransfer.files;
                });

    }
</script>
</body>
</html>
