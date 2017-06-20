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
                        <li><a href='#'>BEWERK PROFIEL</a></li>
                        <li><a href='#'>KLUSS GOLD</a></li>
                    </ul>
                </li>
                <li><a href='#'>Meldingen en gebruikers</a>
                    <ul>
                        <li><a href='#'>DEMP MELDINGEN</a></li>
                        <li><a href='#'>GEBLOKKEERDE GEBRUIKERS</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>

<div class="addboxshadow container" style="display:block; overflow:auto;">
    <h1 style="float: left; padding: 15px;">Plaats een klusje op de kaart</h1>
    <hr style="background-color: #677578; height: 0.2px; width: 100%; ">

    <div class="plaatsklusje-div" style="width: 50%; float: left">
        <form class="form-container">
            <div class="form-title">Titel</div>
            <input class="form-field" type="text" name="titel" /><br />
            <div class="form-title">Prijs</div>
            <input class="form-field" type="text" name="prijs" /><br />
            <div class="form-title">Tijd</div>
            <input class="form-field" type="text" name="tijd" /><br />
            <div class="form-title">Soort Klusje</div>
            <input class="form-field" type="text" name="soort klusje" /><br />
            <div class="form-title">Beschrijving</div>
            <input class="form-field" type="text" name="beschrijving" /><br />
        </form>
    </div>

    <div class="plaatsklusje-div" style="width: 40%; float: left; margin-right: 10px;">
        <form class="box" method="post" action="" enctype="multipart/form-data">
            <div class="box__input">
                <input class="box__file" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected" multiple />
                <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
                <button class="box__button btn" type="submit">UPLOAD</button>
            </div>
            <div class="box__uploading">Uploading&hellip;</div>
            <div class="box__success">Done!</div>
            <div class="box__error">Error! <span></span>.</div>
        </form>
    </div>

    <div class="submit-container" style="width: 20%; float: right; margin-right: 20px;">
        <input class="btn" type="submit" value="Plaats" />
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
