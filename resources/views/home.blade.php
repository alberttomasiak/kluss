@extends('layouts.app')

@section('content')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&callback=load" async deter></script>
    <script type="text/javascript">
      var map;
      var klussjes = {!! json_encode($klussjes) !!};
      var marks = [];

      function load() {
          map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: 51.027575, lng: 4.481958},
              zoom: 15,
              scrollwheel: false,
              navigationControl: false,
              mapTypeControl: false,
              scaleControl: false,
              styles: [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]
          });

          for(var i = 0; i < klussjes.length; i++){
              marks[i] = addMarker(klussjes[i]);
          }
      }

      function addMarker(kluss){
        var title = kluss.title;
        var description = kluss.description;
        var image = kluss.kluss_image;
        var address = kluss.address;
        var price = kluss.price;
        var date = kluss.date;
        var id = kluss.id

        var html = "<div id='iw-container'><img class='map-image' alt='klussje' src='"+image+"'>"+ "<b>" + title + "</b> <br/>" + description.substring(0, 100) + "... </br></br>" + "<b>" + address + "</b> </br>" + "<b>"+ price +" credits </b></br>"+
        "<div class='card-action'><a href='/kluss/"+id+"'>Ga naar de kluss</a></div></div>";


        var klussLatlng = new google.maps.LatLng(parseFloat(kluss.latitude),parseFloat(kluss.longitude));


        var mark = new google.maps.Marker({
            map: map,
            position: klussLatlng,
            icon: "/img/marker_1-klein.png",
        });

        //var infoWindow = new google.maps.InfoWindow;
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
  </script>
<div class="container">
    <div class="row">
        <!-- MAP MET KLUSSJES -->
        <div id="map"></div>
        <!-- KLUSSJES IN DE BUURT -->
        <h2 class="home-h2">Actieve klussjes in uw buurt:</h2>
        <div class="klussjes-wrap">
        @foreach($klussjes as $kluss)
       <div class="col s12 m6 card-wrap">
         <div class="card">
           <div class="card-image">
             <img src="{{$kluss->kluss_image}}" alt="Klussje">
             <span class="card-title">@if($kluss->kluss_image == "/img/klussjes/geen-image.png")
                 <h4 class="card--title-black">{{$kluss->title}}</h4>
             @else
                 <h4>{{$kluss->title}}</h4>
             @endif</span>
           </div>
           <div class="card-content">
             <p>{{substr($kluss->description, 0, 120) . '...'}}</p>
             <p class="card--description"><b>{{$kluss->address}}</b></p>
             <p class="card--price"><b>{{$kluss->price}} credits</b></p>
           </div>
           <div class="card-action">
             <a href="/kluss/{{$kluss->id}}">Ga naar de kluss</a>
           </div>
         </div>
       </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
