@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&callback"></script>
<script type="text/javascript" src="/assets/js/jquery-paginate.min.js"></script>
<div class="container">
    <div class="row">
        <!-- MAP MET KLUSSJES -->
        <div id="map"></div>
        <!-- KLUSSJES IN DE BUURT -->
        <h2 class="home-h2">Actieve klussjes in de omgeving:</h2>
        <div class="klussjes-wrap">
        {{-- Our tasks will be appended here. --}}
        </div>
    </div>
</div>
<script src="//js.pusher.com/3.0/pusher.min.js"></script>
<script type="text/javascript">
  var map;
  var klussjes = {!! json_encode($klussjes) !!};
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
                     $('.klussjes-wrap').append('<div class="col s12 m6 card-wrap"><div class="card"><div class="card-image"><div class="card-image-wrap"><img src="/assets'+this.kluss_image+'" class="card--image" alt="Klussje"> </div> <span class="card-title">@if('this.image' == "assets/img/klussjes/geen-image.png")<h4 class="card--title-black">'+this.title+'</h4>@else<h4>'+this.title+'</h4>@endif</span></div><div class="card-content"><p class="card--description">'+this.description.substring(0, 120)+'...</p><p><b>'+this.address.replace(/\d+/g, "")+'</b></p><p class="card--price"><b>'+this.price+' credits</b></p></div><div class="card-action"><a href="/kluss/'+this.id+'">Ga naar de kluss</a></div></div></div>');
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
          scrollwheel: true,
          navigationControl: false,
          mapTypeControl: false,
          scaleControl: false,
          streetViewControl: false,
          disableDefaultUI: true,
          draggable: true,
          minZoom: 13,
          maxZoom:16,
          styles: [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]
      });
      if(lat != poslatDefault && lng != poslngDefault){
      var mark = new google.maps.Marker({
          map: map,
          position: new google.maps.LatLng(parseFloat(lat),parseFloat(lng))
      });
      }

    // We don't need it here, since we do it in our Ajax request :)
      for(var i = 0; i < klussjes.length; i++){
          marks[i] = addMarker(klussjes[i]);
      }
  }
  var id;
  var markers =  {};
  function addMarker(kluss){
    var title = kluss.title;
    var description = kluss.description;
    var image = kluss.kluss_image;
    var address = kluss.address.replace(/\d+/g, "");
    var price = kluss.price;
    var date = kluss.date;
    var id = kluss.id;
    var accepted = kluss.accepted_applicant_id;
    var account_type = kluss.account_type;
    var html = "<div id='iw-container task-"+id+"'><div class='map-image-wrap'><img class='map-image' alt='klussje' src='/assets"+image+"'></div>"+ "<b>" + title + "</b> <br>" +  description.substring(0, 100) + "... <br><br>" + "<b>" + address + "</b> <br>" + "<b>"+ price +" credits </b><br>"+
    "<div class='card-action'><a href='/kluss/"+id+"'>Ga naar de kluss</a></div></div>";
    var klussLatlng = new google.maps.LatLng(parseFloat(kluss.latitude),parseFloat(kluss.longitude));
    if(accepted == null){
        if(account_type == "normal"){
            var mark = new google.maps.Marker({
                map: map,
                position: klussLatlng,
                icon: "/assets/img/marker_1-klein.png",
            });
            markers[id] = mark;
        }else{
            var mark = new google.maps.Marker({
                map: map,
                position: klussLatlng,
                icon: "/assets/img/marker_gold-klein.png",
            });
            markers[id] = mark;
        }
    }else{
        var mark = new google.maps.Marker({
            map: map,
            position: klussLatlng,
            icon: "/assets/img/marker_2-klein.png",
        });
        markers[id] = mark;
    }

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

// ***************************************************
// Pusher time
// function logTask(data){
//     addMarker(data);
// }
function appendMarker(data){
    addMarker(data);
    $('.klussjes-wrap').append('<div class="col s12 m6 card-wrap"><div class="card"><div class="card-image"><div class="card-image-wrap"><img src="/assets'+data.kluss_image+'" class="card--image" alt="Klussje"> </div> <span class="card-title">@if('data.image' == "assets/img/klussjes/geen-image.png")<h4 class="card--title-black">'+data.title+'</h4>@else<h4>'+data.title+'</h4>@endif</span></div><div class="card-content"><p class="card--description">'+data.description.substring(0, 120)+'...</p><p><b>'+data.address.replace(/\d+/g, "")+'</b></p><p class="card--price"><b>'+data.price+' credits</b></p></div><div class="card-action"><a href="/kluss/'+data.id+'">Ga naar de kluss</a></div></div></div>');
}
function deleteMarker(data){
    markers[data.taskID].setMap(null);
}

function applicantSelected(data){
    markers[data.taskID].setIcon("/assets/img/marker_2-klein.png");
}

var pusher = new Pusher('1a329a7dd69a92834d4d', {
  cluster: 'eu',
  encrypted: true,
  authEndpoint: '/map/auth',
  auth: {
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }
});
var channel = pusher.subscribe("kluss-map");
// channel binds
channel.bind('new-task', appendMarker);
channel.bind('deleted-task', deleteMarker);
channel.bind('applicant-selected-task', applicantSelected);
</script>
@endsection
