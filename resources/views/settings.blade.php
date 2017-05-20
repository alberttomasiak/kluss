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

<nav class="primary-nav addboxshadow">
<div class="primary-nav-left">
    <a href="#"><img style="height: 35px; padding-right: 15px;" src="../assets/img/home-logo.png">HOME</a>
    <a href="#"><img style="height: 35px; padding-right: 15px;" src="../assets/img/bell-logo.png">MELDINGEN</a>
    <a href="#"><img style="height: 25px; padding-right: 15px;" src="../assets/img/berichten-logo.png">BERICHTEN</a>
</div>
    <div class="primary-nav-center">
    <a href="#"><img style="height: 40px; margin-top: 7px;" src="../assets/img/logo-kluss.png"></a>
    </div>
    <div class="primary-nav-right">
        <a href="#"> ACCOUNT </a>
        <a href="#" class="btn">POST</a>
    </div>
</nav>

<div class="addboxshadow container" style="height: 1100px;">
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
    <div style="float: right; width: 60%; margin-right: 50px; color: #677578;">
        <form action="/action_page.php">
            <h1>Ik ben</h1> <br>
            Voornaam:<br>
            <input type="text" name="firstname" value="Mickey"><br>
            Familienaam:<br>
            <input type="text" name="lastname" value="Mouse"><br><br>
            Geslacht: <br>
            <input type="radio" name="gender" value="male" checked> Man
            <input type="radio" name="gender" value="female"> Vrouw<br>

            <h1>Ik woon in</h1> <br>
            Straat:<br>
            <input type="text" name="street" value="Disney Avenue"><br>
            Huisnummer:<br>
            <input type="text" name="housenumber" value="69"><br>
            Postcode:<br>
            <input type="text" name="postcode" value="3000"><br>
            Gemeente:<br>
            <input type="text" name="city" value="Paris"><br>
            Land:<br>
            <input type="text" name="street" value="France"><br>
            Dit is ook mijn wettelijk adres: <br>
            <input type="radio" name="gender" value="" checked>

            <input style="float: right; font-size: 20px;" class="btn" type="submit" value="OPSLAAN">
        </form>
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
