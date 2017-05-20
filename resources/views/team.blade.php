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

<div class="addboxshadow container" style="height: 1300px;">
    <h1 style="float: left; padding: 15px;">Wie zijn we?</h1>
    <hr style="background-color: #677578; height: 0.2px; width: 100%; ">
    <div style="padding: 30px;">
        <p style="text-align: left; ">
            Wij zijn een team van 4 studenten uit Interactive Multimedia Design aan Thomas More Mechelen. In het kader van ons eindwerk hebben we Kluss gecreëerd. <br><br>

            Samen zorgen we ervoor dat Kluss een werkend online dienst is, die over alles beschikt waarover het moet beschikken. Van coderen tot design en marketing, we doen alles. <br><br>

            Albert Tomasiak en Thomas Van Malderen zorgen voor de project management en back-end development van ons project, terwijl Saska Pallayova en Samuel Sieben aan UX, UI en front-end development werken.
        </p>
        </div>

    <div style="width: 45%; display: block; margin-left: auto; margin-right: auto;">
        <img class="animationout" style="float: left; margin-top: 30px;" src="../assets/img/albert.png">
        <img class="animationout" style="float: right; margin-top: 30px;" src="../assets/img/samuel.png">
        <img class="animationout" style="float: left; margin-top: 30px;" src="../assets/img/saska.png">
        <img class="animationout" style="float: right; margin-top: 30px;" src="../assets/img/thomas.png">
        </div>

    <h1 style="float: left; padding: 15px;">Jobs</h1>
    <hr style="background-color: #677578; height: 0.2px; width: 100%; ">

    <div style="padding: 30px;">
        <p style="text-align: left; margin-bottom: 40px; ">
           Denk jij ons team te kunnen versterken? Of ben je gewoon een super enthousiaste jobzoekende ultra superdeluxe persoon?
        </p>
        <a class="btn" href="#">Contacteer ons!</a>
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
