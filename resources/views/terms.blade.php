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
    <hr style="background-color: #677578; height: 0.2px; width: 100%; ">
    <div style="height: 605px; float: left; width: 20%; margin-left: 30px; margin-top: -10px; border-right: 1px solid #677578;">
        <section style="margin-top: 30px;">
        <a href="#">Disclaimer</a>
        <br><br>
        <a href="#">Terug</a>
            </section>
        </div>
    <div style="float: right; width: 60%; margin-right: 50px; color: #677578;">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam velit enim, eleifend non finibus convallis, hendrerit ut diam. Praesent accumsan facilisis elit, ut volutpat lectus. Nulla vestibulum lobortis efficitur. Aliquam ut imperdiet turpis, vel consequat nibh. Phasellus sed eleifend turpis. Pellentesque luctus elementum magna, vitae placerat odio consectetur ut. Nam vehicula lacinia arcu. Donec porttitor odio leo, rhoncus tempus mi dictum non.

            Etiam posuere ex in magna laoreet, vitae malesuada quam ultricies. Duis dignissim scelerisque mollis. Nam dapibus aliquet leo, ut bibendum orci consectetur et. Suspendisse potenti. Integer ultricies tellus dui, in sodales neque molestie ac. Morbi blandit, nisi in cursus vestibulum, lectus erat commodo nisi, sed molestie augue erat et nibh. Morbi ornare ultrices tellus, sed efficitur magna aliquet eu. Praesent faucibus magna sit amet augue egestas, quis porta leo suscipit. Aenean tincidunt, purus at dignissim sodales, tellus lectus rutrum leo, eu consectetur metus nulla non neque. Nulla blandit eleifend vehicula. Curabitur ornare magna sed augue laoreet vulputate. Quisque elementum, velit vel lacinia fringilla, orci tortor suscipit purus, id dignissim ligula justo vel ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec placerat, mi nec pulvinar venenatis, turpis lorem rhoncus felis, non aliquet ligula leo sed mi. Suspendisse porta massa eleifend, euismod velit id, laoreet sem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.

            Sed vel, tortor eget aliquam porttitor, tortor diam aliquam ante, eget bibendum orci metus ut nunc. Maecenas nec sollicitudin felis. Donec vel luctus leo, et consectetur magna. Maecenas faucibus scelerisque nisi, ullamcorper ultrices quam sagittis id. Ut varius lectus ut vestibulum ullamcorper. Nullam vitae nunc metus.
        </p>
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
