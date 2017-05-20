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

<div class="addboxshadow container" style="height: 700px;">
    <h1 style="float: left; padding: 15px;">Algemene Voorwaarden</h1>
    <hr style="background-color: #4C4C4B; height: 1px; width: 100%; opacity: 0.3; ">
    <div style="float: left; width: 20%; border-right: 1px solid #4C4C4B;">
        <a href="#">Disclaimer</a>
        <br><br>
        <a href="#">Terug</a>
        </div>
    <div style="float: left; width: 80%">
        </div>

</div>




<footer>
    <div class="footer-content container">
        <section>
            <p>KLUSS</p>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Team</a></li>
                <li><a href="#">Algemene Voorwaarden</a></li>
                <li><a href="#">FAQ</a></li>

            </ul>
        </section>
        <section style="margin-right:0px !important;">
            <p>CONTACT</p>
            <ul>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>

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
