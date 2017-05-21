
    {{--@extends('layouts.app')--}}
    @section('content')
       {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css"> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&callback"></script>
       <link href="assets/css/edits.css" rel="stylesheet">

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
            <h1 style="float: left; padding: 15px;">Klusjes in de buurt</h1>
            <hr style="background-color: #677578; height: 0.2px; width: 100%; ">

            <h1 style="float: left; padding: 15px; margin-top: -10px; color: black !important;">Filtreer klusjes: </h1>
            <form action="/action_page.php">

                <style>
                    input{
                        width: 20% !important;
                        padding: 7px 20px !important;
                        margin: 0px 0;
                    }

                    .btn{
                        padding: 2px !important;
                    }
                </style>

                <input type="text" name="price" value="Prijs">

                <input type="text" name="time" value="Tijd">

                <input type="text" name="type" value="Soort Klusje">


                <input style="float: right; font-size: 20px;" class="btn" type="submit" value="ZOEK">
            </form>

        <div style="margin-left: 25px; margin-right: 25px;">
            <div class="row">
                <!-- MAP MET KLUSSJES -->
                <div id="map"></div>
                <!-- KLUSSJES IN DE BUURT -->
                <hr style="background-color: #8BC53F; height: 0.2px; width: 100%; ">
                <h1>Actieve klusjes in de omgeving:</h1>
                <div style="width: 50%; float: right;">
                    <h1 style="float: left; padding: 15px; margin-top: -10px; color: black !important;">Sorteer op:</h1>
                    <form action="/action_page.php">
                        <input style="width: 60% !important;" type="text" name="mostrecent" value="Meest recent">
                    </form>
                </div>
                <div class="klussjes-wrap">
                    {{-- Our tasks will be appended here. --}}
                </div>
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

        <script type="text/javascript">
            var map;
            var klussjes; {{-- = {!! json_encode($klussjes) !!}; --}}
            var marks = [];
            var poslat;
            var poslng;
            var poslatDefault = 51.022636;
            var poslngDefault = 4.486062;

            function initGeolocation(){
                if( navigator.geolocation ){
                    // Call getCurrentPosition with success and failure callbacks
                    navigator.geolocation.getCurrentPosition( success, fail );
                }else{ /* Your browser does not support geolocation. */ }
            }
            function success(position){
                var poslng = position.coords.longitude;
                var poslat = position.coords.latitude;
                load(poslat, poslng);
                sendCoords(poslat, poslng);
            }
            function fail(){
                // geolocation doesn't work with this browser / not a secure request
                // perform the load with the coordinates for Mechelen -> our HQ
                load(poslatDefault, poslngDefault);
                sendCoords(poslatDefault, poslngDefault);
            }
            function sendCoords(lat, lng){
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
                });
                jQuery.ajax({
                    url:'/getTasks',
                    type: 'POST',
                    data: {
                        lat: lat,
                        lng: lng
                    },
                    success: function( data ){
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                                // We found tasks in a radius of 2.5km, so we append them to our list here :)
                                $('.klussjes-wrap').append('<div class="col s12 m6 card-wrap"><div class="card"><div class="card-image"><div class="card-image-wrap"><img src="'+this.kluss_image+'" class="card--image" alt="Klussje"> </div> <span class="card-title">@if('this.image' == "assets/img/klussjes/geen-image.png")<h4 class="card--title-black">'+this.title+'</h4>@else<h4>'+this.title+'</h4>@endif</span></div><div class="card-content"><p class="card--description">'+this.description.substring(0, 120)+'...</p><p><b>'+this.address+'</b></p><p class="card--price"><b>'+this.price+' credits</b></p></div><div class="card-action"><a href="/kluss/'+this.id+'">Ga naar de kluss</a></div></div></div>');
                                // And we make our map markers ;)
                                addMarker(this);
                            });
                        });
                    },
                    error: function (xhr, b, c) {
                        // Something went wrong brosephino
                    }
                });
            }
            function load(lat, lng) {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: lat, lng: lng},
                    zoom: 15,
                    scrollwheel: false,
                    navigationControl: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    disableDefaultUI: true,
                    draggable: false,
                    styles: [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]
                });
                if(lat != poslatDefault && lng != poslngDefault){
                    var mark = new google.maps.Marker({
                        map: map,
                        position: new google.maps.LatLng(parseFloat(lat),parseFloat(lng))
                    });
                }

                // We don't need it here, since we do it in our Ajax request :)
                //   for(var i = 0; i < klussjes.length; i++){
                //       marks[i] = addMarker(klussjes[i]);
                //   }
            }
            function addMarker(kluss){
                var title = kluss.title;
                var description = kluss.description;
                var image = kluss.kluss_image;
                var address = kluss.address;
                var price = kluss.price;
                var date = kluss.date;
                var id = kluss.id
                var html = "<div id='iw-container'><div class='map-image-wrap'><img class='map-image' alt='klussje' src='"+image+"'></div>"+ "<b>" + title + "</b> <br>" +  description.substring(0, 100) + "... <br><br>" + "<b>" + address + "</b> <br>" + "<b>"+ price +" credits </b><br>"+
                        "<div class='card-action'><a href='/kluss/"+id+"'>Ga naar de kluss</a></div></div>";
                var klussLatlng = new google.maps.LatLng(parseFloat(kluss.latitude),parseFloat(kluss.longitude));
                var mark = new google.maps.Marker({
                    map: map,
                    position: klussLatlng,
                    icon: "assets/img/marker_1-klein.png",
                });
                var infoWindow = new google.maps.InfoWindow({
                    content: html,
                    maxWidth: 350
                });
                google.maps.event.addListener(mark, 'click', function(){
                    infoWindow.setContent(html);
                    infoWindow.open(map, mark);
                    var iwOuter = $('.gm-style-iw');
                    var iwBackground = iwOuter.prev();
                    iwBackground.children(':nth-child(2)').css({'display' : 'none'});
                    iwBackground.children(':nth-child(4)').css({'display' : 'none'});
                });
                return mark;
            }
            initGeolocation();

        </script>
    @endsection

