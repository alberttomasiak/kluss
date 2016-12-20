@extends('layouts.app')
@section('content')
    @foreach($kluss as $kl)
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&callback=load" async deter></script>
    <script type="text/javascript">
      var map;
      var kluss = {!! json_encode($kluss) !!};
      var marks = [];

      function load() {
          map = new google.maps.Map(document.getElementById('map--individual'), {
              center: {lat: {!! json_encode($kl->latitude) !!}, lng: {!! json_encode($kl->longitude)!!}},
              zoom: 15,
              scrollwheel: false,
              navigationControl: false,
              mapTypeControl: false,
              scaleControl: false,
              draggable: false,
              styles: [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]
          });

          for(var i = 0; i < kluss.length; i++){
              marks[i] = addMarker(kluss[i]);
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

        var html = "<div id='iw-container'><img class='map-image' alt='klussje' src='../"+image+"'>"+ "<b>" + title + "</b> <br/>" + description.substring(0, 100) + "... </br></br>" + "<b>" + address + "</b> </br>" + "<b>"+ price +" credits </b></br></div>";


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
        google.maps.event.addListener(infoWindow, 'domready', function() {
            alert('eyo');

        });
    }
    @endforeach
    </script>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <div id="map--individual"></div></div>
            @foreach($kluss as $kl)
            <div class="col s12 m6">
                <div class="col-md-6">
                    <img class="col-md-12 individual--image" src="../{{$kl->kluss_image}}" alt="{{$kl->title}}">
                </div>
                <div class="col-md-6">
                    <h1>{{$kl->title}}</h1>
                    <p>{{$kl->description}}</p></br></br>
                    <b>{{$kl->address}}</b></br>
                    <b>{{$kl->price}} Credits</b></br></br>
                    @if(\Auth::user()->id == $kl->user_id)
                        <a class="btn btn--form" href="/kluss/{{$kl->id}}/bewerken">Bewerk deze Kluss</a>
                    @else
                        @if($kluss_applicant->first())
                            <a class="btn btn-danger" href="/kluss/{{$kl->id}}/solliciteren">Applicatie verwijderen</a>
                        @else
                            <a class="btn btn--form" href="/kluss/{{$kl->id}}/solliciteren">Solliciteer voor deze kluss</a>
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection