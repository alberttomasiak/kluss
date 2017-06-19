<html>
<head>
    <meta charset="utf-8">
    <title>KLUSS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="assets/css/app.css" rel="stylesheet">
    <link rel="icon" id="favicon" type="image/png" href="/assets/img/favicon.ico" sizes="48x48">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&libraries=places"></script>
</head>
<body id="landing-body">

    <div class="landing_header">
        <div class="landing_logo"><img src="/assets/img/logo-kluss.png" alt="Logo kluss"></div>
        <div class="landing_headerbtns">
            <a href="/register" class="landing_headerbtn"><div class="landing_btngreen">Registreer</div></a>
            <a href="/login" class="landing_headerbtn"><div class="landing_btnwhite">Log in</div></a>
        </div>
    </div>

    <div class="landing_container">
        <div class="landing_content_intro">
            <div class="intro_wrapper">
                <h1 class="landing_title">Betrouwbaar klussen voor en door buurtbewoners</h1>
                <hr class="intro_ruler">
                <p class="intro_headtxt">
                    KLUSS is een betrouwbaar online platform dat je toelaat om klusjes in de buurt kunt aannemen en zo bijklussen om wat bij te verdienen.
                    <br><br>
                    Zo brengen we mensen dichter bij elkaar, en lossen we elkaars problemen op!
                    Voor de fanatieke klussers hebben we ook een speciaal premiumpakket waarmee je gemakkelijker klusjes vindt en meer kunt gaan klussen.
                </p>
                {{-- <div class="landing_map">
                    <img src="/assets/img/landingkaart.png" alt="mappie">
                </div> --}}
                <div class="map-wrapperino">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div class="landing_content_traits">
            <div class="landing_trait">
                <img src="/assets/img/betrouwbaar.png" alt="betrouwbaar" class="landing_traitimg">
                <h1 class="landing_title">Betrouwbaar</h1>
                <p class="trait_headtxt">Op ons platorm werken we aan de veiligheid van de omgeving, om je een optimale ervaring te bieden.</p>
            </div>
            <div class="landing_trait">
                <img src="/assets/img/snel.png" alt="snel" class="landing_traitimg">
                <h1 class="landing_title">Snel</h1>
                <p class="trait_headtxt">Kluss is vliegensvlug en efficiënt. Vind binnen enkele kliks klusjes op maat in de buurt.</p>
            </div>
            <div class="landing_trait">
                <img src="/assets/img/uniek.png" alt="uniek" class="landing_traitimg">
                <h1 class="landing_title">Uniek</h1>
                <p class="trait_headtxt">Een unieke ervaring; we zijn de eersten op de markt die op deze manier klusjes aanbieden.</p>
            </div>
        </div>
        <div class="landing_content_actions">
            <div class="intro_wrapper">
                <h1 class="landing_title">KLUSS proberen? Het is GRATIS!</h1>
                <hr class="intro_ruler">
                <div class="landing_ctas">
                    <div class="landing_ctabox ctabox1">
                        <p class="landing_ctatitle">Ik wil bijklussen in de buurt!</p>
                        <a href="/register"><div class="landing_ctabtn btngreen">Start!</div></a>
                    </div>
                    <div class="landing_ctabox ctabox2">
                        <p class="landing_ctatitle ctatitle2">Ik zoek een klusser!</p>
                        <a href="/register"><div class="landing_ctabtn btnwhite">Zoek!</div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="main--footer">
        <div class="footer_list">
            <a href="/" class="landing_footer_link">KLUSS</a>
            <a href="/team" class="landing_footer_link">Team</a>
            <a href="/terms" class="landing_footer_link">Algemene Voorwaarden</a>
            <a href="/FAQ" class="landing_footer_link">FAQ</a>
            <a href="/contact" class="landing_footer_link">Contact</a>
            <a href="/klussgold" class="landing_footer_link">Kluss Gold</a>
            <a href="https://www.facebook.com/klussapp/" class="landing_footer_link">Facebook</a>
            <a href="https://twitter.com/Klussapp" class="landing_footer_link">Twitter</a>
        </div>
        <div class="extra--info">
            <a href="mailto:hi@kluss.be">hi@kluss.be</a>
            <p>&copy; Kluss - All Rights Reserved</p>
            <p>Lange Ridderstraat 44, 2800 Mechelen</p>
        </div>
    </footer>
    @include('partials.scripts.home')
</body>
</html>
