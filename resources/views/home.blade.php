@extends('layouts.app')
@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&libraries=places"></script>
<script type="text/javascript" src="/assets/js/jquery-paginate.min.js"></script>
<div class="main-content-wrap">
    @if(checkAccountType(\Auth::user()->id) != "gold")
        <div class="goldad">Zo te zien heb je nog geen Kluss Gold... Ontdek het <a href="/klussgold">hier</a>!</div>
    @endif
    <div class="">
        <h1>Klusjes in de buurt</h1>
        <!-- MAP MET KLUSSJES -->
        <div id="map"></div>
        <!-- KLUSSJES IN DE BUURT -->
        <h2 class="home-h2">Beschikbare Klusjes:</h2>
        <form class="home--filter" action="/home/filter" method="get">
            <h3>Filtreer klusjes:</h3>
            <input type="text" name="prijs" placeholder="Prijs" value="">
            <select name="tijd" id="kluss_time">
                <option value="null">Duur van het klusje</option>
                <option value="0:30">30 min.</option>
                <option value="1:00">1 uur</option>
                <option value="1:30">1 uur 30 min.</option>
                <option value="2:00">2 uur</option>
                <option value="2:30">2 uur 30 min.</option>
                <option value="3:00">3 uur</option>
                <option value="3:30">3 uur 30 min.</option>
                <option value="4:00">4 uur</option>
            </select>
            <select id="kluss_categorie" name="category">
                <option value="null">Categorie</option>
                @foreach($category as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
            {{-- <input id="autocomplete" name="locatie" placeholder="Adres:"
                   onFocus="geolocate()" type="text"></input> --}}
            <input type="hidden" name="lat" id="kluss__lat" value="">
            <input type="hidden" name="lng" id="kluss__lng" value="">
            <input type="submit" class="filter-btn" value="Zoek">
        </form>
        <div class="klussjes-wrap">
        @if(!isset($filtered))
            @foreach($cards as $card)
                <a href="/kluss/{{$card->id}}" class="animationout">
                    <div class="task-card">
                        <div class="task-image" style="background-image: url('/assets{{$card->kluss_image}}');"></div>
                        <div class="task-details">
                            <div class="task-title-time">
                                <p class="task-title">{{$card->title}}</p>
                                <p class="task-time">- max {{$card->time}}u.</p>
                            </div>
                            <div class="task-price">
                                <p>€ {{$card->price}}</p>
                            </div>
                            <div class="task-description">
                                <p>{{substr($card->description, 0, 100)}} ...</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            {{$cards->links()}}
        @else
            @if(count($filtered) == 0)
                <h2>Er werden geen klusjes gevonden voor je zoekcriteria.</h2>
            @else
                @foreach($filtered as $fil)
                    <a href="/kluss/{{$fil->id}}">
                        <div class="task-card">
                            <div class="task-image" style="background-image: url('/assets{{$fil->kluss_image}}');"></div>
                            <div class="task-details">
                                <div class="task-title-time">
                                    <p class="task-title">{{$fil->title}}</p>
                                    <p class="task-time">- max {{$fil->time}}u.</p>
                                </div>
                                <div class="task-price">
                                    <p>€ {{$fil->price}}</p>
                                </div>
                                <div class="task-description">
                                    <p>{{substr($fil->description, 0, 100)}} ...</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                {{$filtered->links()}}
            @endif
        @endif
        </div>
    </div>
    @if(checkAccountType(\Auth::user()->id) != "gold")
        <div class="goldad">Wil je meer uit je Kluss-belevenis halen? Ontdek het <a href="/klussgold">hier</a>!</div>
    @endif
</div>
<script type="text/javascript">
  var map;
  var klussjes = {!! json_encode($klussjes) !!};
  var marks = [];
  var poslat;
  var poslng;
  var poslatDefault = 51.022636;
  var poslngDefault = 4.486062;
   var placeSearch, autocomplete;
   var componentForm = {
     street_number: 'short_name',
     route: 'long_name',
     locality: 'long_name',
     administrative_area_level_1: 'short_name',
     country: 'long_name',
     postal_code: 'short_name'
   };

   // function initAutocomplete() {
   //   autocomplete = new google.maps.places.Autocomplete(
   //       /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
   //       {types: ['geocode'],
   //       componentRestrictions: {country: "be"}});
   //   autocomplete.addListener('place_changed', fillInAddress);
   // }
   //
   // function fillInAddress() {
   //   var place = autocomplete.getPlace();
   //   //console.log(place.geometry.location.lat());
   //   $('#kluss__lat').val(place.geometry.location.lat());
   //   $('#kluss__lng').val(place.geometry.location.lng());
   // }

   // function geolocate() {
   //   if (navigator.geolocation) {
   //     navigator.geolocation.getCurrentPosition(function(position) {
   //       var geolocation = {
   //         lat: position.coords.latitude,
   //         lng: position.coords.longitude
   //       };
   //       var circle = new google.maps.Circle({
   //         center: geolocation,
   //         radius: position.coords.accuracy
   //       });
   //       autocomplete.setBounds(circle.getBounds());
   //     });
   //   }
   // }

// initAutocomplete();
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
     $('#kluss__lat').val(poslat);
     $('#kluss__lng').val(poslng);
 }
 function fail(){
    // geolocation doesn't work with this browser / not a secure request
    // perform the load with the coordinates for Mechelen -> our HQ
    load(poslatDefault, poslngDefault);
    $('#kluss__lat').val(poslatDefault);
    $('#kluss__lng').val(poslngDefault);
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
          icon: "/assets/img/currentposition2.png",
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
    var html = "<div id='iw-container task-"+id+"'><div class='map-image-wrap'><img class='map-image' alt='klussje' src='/assets"+image+"'></div>"+ "<div class='markerinfo'><p class='markertitle'>" + title + "</p>" +  description.substring(0, 100) + "... <br><br>" + "<div class='markeraddress'><b>" + address + "</b> <br>" + "<b>"+ price +" credits </b></div><br></div>"+
    "<div class='card-action'><a href='/kluss/"+id+"' class='markercta'>Ga naar de kluss</a></div></div>";
    var klussLatlng = new google.maps.LatLng(parseFloat(kluss.latitude),parseFloat(kluss.longitude));
      var open = false;
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
        maxWidth: 400
    });
    google.maps.event.addListener(mark, 'click', function(){
        if(open == true){
            console.log(open);
            infoWindow.close();
            open = false;
        } else {
            console.log(open);
            infoWindow.setContent(html);
            infoWindow.open(map, mark);
            var iwOuter = $('.gm-style-iw');
            var iwBackground = iwOuter.prev();
            iwBackground.children(':nth-child(2)').css({'display' : 'none'});
            iwBackground.children(':nth-child(4)').css({'display' : 'none'});
            open = true;
        }

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

// channel subscriptions
var channel = pusher.subscribe("kluss-map");
// channel binds
channel.bind("test", notifyUser);
channel.bind('new-task', appendMarker);
channel.bind('deleted-task', deleteMarker);
channel.bind('applicant-selected-task', applicantSelected);
</script>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&libraries=places&callback=initAutocomplete"
  async defer></script> --}}
@endsection
