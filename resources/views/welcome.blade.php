<html>
<head>
    <meta charset="utf-8">
    <title>KLUSS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>

    <div class="landing_container">
        <div class="landing_body">
        <div class="landing_intro">
            <div class="landing_intro_map">
                <img src="/img/Map2.jpg" alt="logo" class="landing_intro_map">
            </div>
            <div class="landing_intro_text">
                <img src="/img/logo-klusswit.png" alt="logo" class="landing_intro_logo">
                <br>
                <p class="landing_intro_welcometxt">KLUSS laat je toe om alle overblijvende klusjes open te stellen aan klussers uit de buurt, of om zelf klusjes uit de buurt te vinden en op te knappen voor een beloning. Vanaf nu hoeven er nooit meer klusjes te blijven liggen tot later! Get KLUSS'ing!</p>
                <div class="landing_intro_ctas">
                    <a href="{{ url('/home') }}" class="btn btn-success landing_cta">REGISTEER</a>
                    <a href="{{ url('/home') }}" class="btn btn-success landing_cta">LOG IN</a>
                </div>
            </div>
        </div>

        </div>
        <footer class="landing_footer">
            <div class="footer_list">
                <a href="www.google.com" class="landing_footer_link">Wat is KLUSS</a>
                &#124;
                <a href="www.facebook.com" class="landing_footer_link">Team</a>
                &#124;
                <a href="www.twitter.com" class="landing_footer_link">Partners</a>
                &#124;
                <a href="www.instagram.com" class="landing_footer_link">Privacy</a>
                &#124;
                <a href="www.weareimd.be" class="landing_footer_link">Contact</a>
            </div>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/js/app.js"></script>
    <script>
        $(".landing_body").css("height", window.innerHeight-60 + "px");

        window.onresize=function(){
            $(".landing_body").css("height", window.innerHeight-60 + "px");
        };
    </script>
</body>
</html>