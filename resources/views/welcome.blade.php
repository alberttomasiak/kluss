<html>
<head>
    <meta charset="utf-8">
    <title>KLUSS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="assets/css/app.css" rel="stylesheet">
</head>
<body id="landing-body">

    <div class="landing_container">
        <div class="col-sm-12">
        <div class="col-sm-5 col-sm-offset-1">
            <div class="landing_intro_map">
                <img src="assets/img/Map2.jpg" alt="logo" class="landing-image-map">
            </div>
        </div>
            <div class="col-sm-5">
                <img src="assets/img/logo-klusswit.png" alt="logo" class="landing_intro_logo">
                <br>
                <p class="landing_intro_welcometxt col-sm-12">KLUSS laat je toe om alle overblijvende klusjes open te stellen aan klussers uit de buurt, of om zelf klusjes uit de buurt te vinden en op te knappen voor een beloning. Vanaf nu hoeven er nooit meer klusjes te blijven liggen tot later!    Get KLUSS'ing!</p>
                <div class="landing_intro_ctas col-sm-12">
                    <a href="{{ url('/register') }}" class="btn btn--form landing_cta">REGISTREER</a>
                    <a href="{{ url('/login') }}" class="btn btn--form landing_cta">LOG IN</a>
                </div>
            </div>
        </div>
        <footer class="landing_footer">
            <div class="footer_list">
                <a href="#" class="landing_footer_link">Wat is KLUSS</a>
                &#124;
                <a href="#" class="landing_footer_link">Team</a>
                &#124;
                <a href="#" class="landing_footer_link">Partners</a>
                &#124;
                <a href="#" class="landing_footer_link">Privacy</a>
                &#124;
                <a href="#" class="landing_footer_link">Contact</a>
            </div>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        $(".landing_body").css("height", window.innerHeight-60 + "px");

        window.onresize=function(){
            $(".landing_body").css("height", window.innerHeight-60 + "px");
        };
    </script>
</body>
</html>
