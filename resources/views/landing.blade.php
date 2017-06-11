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

<div style="height: 80px;">
    <div style="float: left; width: 35%;">
        <img class="animationout" style="height: 60px; padding: 10px;" src="../assets/img/logo-kluss.png">
    </div>

    <div style="float: right; width: 20%;">
        <a href="#"><h1>Inloggen/Registreren</h1></a>
    </div>

</div>

<div class="addboxshadow" style=" margin-top: 15px; margin-bottom: 20px; height: 730px; background-color: #FFFFFA;">
<h1 style="text-align: center; padding-top: 40px;">Betrouwbaar klussen voor en door buurtbewoners</h1>
     <hr style="border-width: 1px; border-color: #8BC53F; width: 35%;">

    <p style="text-align:center; width: 100%;">
        KLUSS is een betrouwbaar online platform dat je toelaat om klusjes in de buurt kunt aannemen en zo bijklussen om wat bij te verdienen.
<br><br>
        Zo brengen we mensen dichter bij elkaar en lossen we elkaars problemen op.  Voor de fanatieke klussers hebben we ook een betalend Gold pakket waarmee je gemakkelijker klusjes vindt en meer kunt gaan klussen.
    </p>

    <div style="display: block; margin-left: auto; margin-right: auto;">
        <img class="animationout" src="../assets/img/landingkaart.png">
    </div>

</div>

<div style="height: 500px;">

    <section style="width: 25%; float: left;">
        <img class="animationout" style="display: block; margin-left: auto; margin-right: auto;" src="../assets/img/betrouwbaar.png">
        <h1 style="text-align: center;">Betrouwbaar</h1>
        <p style="text-align: center; padding: 20px;">
            Op ons platform werken
            we aan de veiligheid van
            de omgeving, om jouw een
            optimale ervaring te bieden.
        </p>
    </section>

     <section style="width: 25%; float: left">
         <img class="animationout" style="display: block; margin-left: auto; margin-right: auto;" src="../assets/img/snel.png">
         <h1 style="text-align: center;">Snel</h1>
         <p style="text-align: center; padding: 20px;">
             Snel is het een kernwoord
             van KLUSS! We bieden dan
             ook de snelste ter wereld
             voor het vinden van klusjes.
         </p>
     </section>

    <section style="width: 25%; float: left;">
        <img class="animationout" style="display: block; margin-left: auto; margin-right: auto;" src="../assets/img/uniek.png">
        <h1 style="text-align: center;">Uniek</h1>
        <p style="text-align: center; padding: 20px;">
            Ons platform is uniek
            we zijn de eerste ter wereld
            die dit soort platform lanceren.
            We maken de eravringen uniek
        </p>
    </section>


</div>

<div class="addboxshadow" style="margin-top: 15px; margin-bottom: 20px; height: 500px; background-color: #FFFFFA;">
    <h1 style="text-align: center; padding-top: 40px;">Probeer eens! Het is GRATIS!</h1>
    <hr style="border-width: 1px; border-color: #8BC53F; width: 20%;">


    <div style="margin:0 auto;">
    <div class="addboxshadow" style="height: 320px; width: 30%; background-color: #ffffff; float: left">
        <h1 style="text-align: left; padding: 20px; font-size: 40px;">Ik wil klussen bij KLUSS!</h1>
        <a class="btn">START</a>
    </div>
    <div class="addboxshadow" style="height: 200px; margin-top: 70px; width: 25%; background-color: #2E9C4E; float: left;">
 <h1 style="text-align: center; color: #ffffff;">Ik zoek een klusser!</h1>
        <a class="btn" style="background-color: #ffffff;">ZOEK</a>
    </div>
    </div>



</div>

<hr style="border-width: 1px; border-color: #8BC53F; width: 80%;">


<footer>

    <div style="clear:both;text-align:center;font-size:10px;position:relative;bottom:-20px;">
        &copy; KLUSS 2017 - Made with &#10084; by our team
    </div>
</footer>


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
