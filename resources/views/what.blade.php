<html>
<head>
    <meta charset="utf-8">
    <title>KLUSS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="assets/css/edits.css" rel="stylesheet">
</head>
<body>

<nav class="primary-nav addboxshadow">
<div class="primary-nav-left">
    <a href="#"><img class="animationout" style="height: 35px; padding-right: 15px;" src="../assets/img/home-logo.png">HOME</a>
    <a href="#"><img class="animationout" style="height: 35px; padding-right: 15px;" src="../assets/img/bell-logo.png">MELDINGEN</a>
    <a href="#"><img class="animationout" style="height: 25px; padding-right: 15px;" src="../assets/img/berichten-logo.png">BERICHTEN</a>
</div>
    <div class="primary-nav-center">
    <a href="#"><img class="animationout" style="height: 40px; margin-top: 7px;" src="../assets/img/logo-kluss.png"></a>
    </div>
    <div class="primary-nav-right">
        <a href="#"> ACCOUNT </a>
        <a href="#" class="btn">POST</a>
    </div>
</nav>

<div class="addboxshadow container" style="height: 900px;">
    <h1 style="float: left; padding: 15px;">Wat is KLUSS?</h1>
    <hr style="background-color: #677578; height: 0.2px; width: 100%; ">
    <div>
        <div style="width: 40%; margin-left: 20px; float: left;">
            <img style="height: 300px;" src="../assets/img/watiskluss1.png">
        </div>

        <div style="width: 50%; margin-right: 20px; float: right">
            <p style="margin-bottom: 30px;">
                Heeft u ooit te weinig tijd of te weinig zin gehad om uw klusjes te doen? Hier bij Kluss hebben we de perfecte oplossing voor u gevonden. Dankzij onze dienst kan u uw klusjes online zetten op uw profiel om ze aan anderen over te laten.

                Bovendien, als u graag klusjes aflegt en een beetje geld wil verdienen, kan Kluss u ook helpen aangezien we met Klussers uit heel Vlaanderen werken om Kluss zo krachtig mogelijk te maken.

                We bieden ook extra leuke features aan met Kluss Gold. Met een maandelijkse bijdrage zorgen wij dat uw klusjes bovenaan de lijst staan en een groter bereik hebben, waardoor uw klusjes zeker in een oogwenk afgelegd zullen worden.
            </p>

            <a class="btn">Aan de slag!</a>

        </div>

        </div>

    <h1 style="float: left; padding: 15px;">Hoe werkt het?</h1>
    <hr style="background-color: #677578; height: 0.2px; width: 100%; ">
    <div>

        <div style="width: 50%; margin-left: 30px; float: left">
            <p style="margin-bottom: 30px;">
                Door een profiel aan te maken op Kluss, komt u in aanmerking om uw eigen klusjes op de kaart te pinnen, zodat andere Klussers zich hiervoor kunnen aanmelden, of kan u zelf een aanvraag sturen om een klusje af te leggen.

                Zodra dit gebeurd is, is het alleen wachten voor de perfecte match.
            </p>
            </div>

            <div style="width: 30%; margin-left: 40px; float: right;">
                <img style="height: 300px;" src="../assets/img/watiskluss2.png">
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
    <script src="assets/js/app.js"></script>
    <script>
        $(".landing_body").css("height", window.innerHeight-60 + "px");

        window.onresize=function(){
            $(".landing_body").css("height", window.innerHeight-60 + "px");
        };
    </script>
</body>
</html>
