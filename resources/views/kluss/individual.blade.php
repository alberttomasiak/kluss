@extends('layouts.app')
@section('content')
    @foreach($kluss as $kl)
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&callback=load" async deter></script>
    <script type="text/javascript">
      var map;
      var kluss = {!! json_encode($kluss) !!};
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
         calculateDistance(poslat, poslng, {!! json_encode($kl->latitude) !!}, {!! json_encode($kl->longitude) !!});
     }
     function fail(){
        // geolocation doesn't work with this browser / not a secure request
        // perform the load with the coordinates for Mechelen -> our HQ
        calculateDistance(poslatDefault, poslngDefault, {!! json_encode($kl->latitude) !!}, {!! json_encode($kl->longitude) !!});
     }

     function calculateDistance(userlat, userlng, tasklat, tasklng){
         $.ajaxSetup({
             headers: {'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content')}
         });
         jQuery.ajax({
             url: '/calculateDistance',
             type: 'POST',
             data: {
                 userlat: userlat,
                 userlng: userlng,
                 tasklat: tasklat,
                 tasklng: tasklng,
                 userID: {{\Auth::user()->id}}
             },
             success: function( data ){
                 $account_type = data.account_type;
                 $distance = data.distance;
                 if($account_type == "normal"){
                     if($distance > {{ spillvalue("limit_starter")}} ){
                         // 2 km for standard users
                         $('.apply-btn a').remove();
                         $('.apply-btn').append('<div class="notInRange"><p>Het spijt ons, maar je bent niet dicht genoeg bij het klusje om te solliciteren. <a href="#">Upgrade naar GOLD</a> om een groter bereik te hebben.</p></div>');
                     }
                 }else{
                     // Distance of 5KM for all Gold Users + admins
                     if($distance > {{ spillvalue("limit_gold")}}){
                         $('.apply-btn a').remove();
                         $('.apply-btn').append('<div class="notInRange"><p>Het spijt ons, maar je bent niet dicht genoeg bij het klusje om te solliciteren.</p></div>');
                     }
                 }

             },
             error: function(xhr, b, c){
                 console.log('oh no broski, you dungoofd');
             }
         });
     }

      function load() {
          map = new google.maps.Map(document.getElementById('map--individual'), {
              center: {lat: {!! json_encode($kl->latitude) !!}, lng: {!! json_encode($kl->longitude)!!}},
              zoom: 15,
              scrollwheel: false,
              navigationControl: false,
              mapTypeControl: false,
              scaleControl: false,
              streetViewControl: false,
              disableDefaultUI: true,
              draggable: false,
              setClickable: false,
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
        var accepted = kluss.accepted_applicant_id;
        var account_type = kluss.account_type;

        var html = "<div id='iw-container task-"+id+"'><img class='map-image' alt='klussje' src='../assets/"+image+"'>"+ "<b>" + title + "</b> <br/>" + description.substring(0, 100) + "... </br></br>" + "<b>" + address + "</b> </br>" + "<b>"+ price +" credits </b></br></div>";
        var klussLatlng = new google.maps.LatLng(parseFloat(kluss.latitude),parseFloat(kluss.longitude));

        if(accepted == null){
            if(account_type == "normal"){
                var mark = new google.maps.Marker({
                    map: map,
                    position: klussLatlng,
                    icon: "/assets/img/marker_1-klein.png",
                });
            }else{
                var mark = new google.maps.Marker({
                    map: map,
                    position: klussLatlng,
                    icon: "/assets/img/marker_gold-klein.png",
                });
            }
        }else{
            var mark = new google.maps.Marker({
                map: map,
                position: klussLatlng,
                icon: "/assets/img/marker_2-klein.png",
            });
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
        google.maps.event.addListener(infoWindow, 'domready', function() {
            console.log('eyo');
        });
    }
    initGeolocation();
    @endforeach
    </script>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <div id="map--individual"></div></div>
            @foreach($kluss as $kl)
            <div class="col s12 m6">
                <div class="col-md-6">
                    <img class="individual--image" src="../assets/{{$kl->kluss_image}}" alt="{{$kl->title}}">
                </div>
                <div class="col-md-6">
                    <h1>{{$kl->title}}</h1>
                    <p>{{$kl->description}}</p></br></br>
                    <b>{{$kl->address}}</b></br>
                    <b>{{$kl->price}} Credits</b></br></br>
                    @if(\Auth::user()->id == $kl->user_id)
                        <a class="btn btn--form" href="/kluss/{{$kl->id}}/bewerken">Bewerk deze Kluss</a>
                        <a href="/kluss/{{$kl->id}}/verwijderen" class="btn btn-danger">Deze kluss verwijderen</a>
                    @else
                        <div class="apply-btn">
                            @if($kluss_applicant->first())
                                <a class="btn btn-danger" href="/kluss/{{$kl->id}}/solliciteren">Applicatie verwijderen</a>
                            @else
                                <a class="btn btn--form" href="/kluss/{{$kl->id}}/solliciteren">Solliciteer voor deze kluss</a>
                            @endif
                        </div>
                    @endif
                </div>
                {{-- User applicants --}}
                @if($kl->user_id == \Auth::user()->id)
                    <div class="col-sm-12 applicants">
                        <h2>Sollicitanten voor klussjes:</h2>
                        <table class="table table-applicants">
                          <thead>
                            <tr>
                              <th></th>
                              <th>Naam</th>
                              <th>Contact</th>
                              <th>Opties</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($kluss_applicants as $sol)
                                <tr>
                                    <th scope="row"><img class="applicant-image" src="/assets{{$sol->profile_pic}}" alt="{{$sol->name}}'s profile picture"></th>
                                    <td><a href="/profiel/{{$sol->id}}/{{$sol->name}}">{{$sol->name}}</a></td>
                                    <td><form action="/chat/{{$sol->id}}" method="post">
                                        {{csrf_field()}}
                                        <input type="submit" name="chatstart" class="btn btn-info" value="Contact">
                                    </form></td>
                                    <td>
                                        {{-- Gebruiker accepteren --}}
                                        <form action="/kluss/{{$kl->id}}/sollicitant/{{$sol->id}}/accepteren" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="kluss_id" id="kluss_id" value="{{$kl->id}}">
                                            <input type="hidden" name="user_id" id="user_id" value="{{$sol->id}}">
                                            <input type="submit" name="" class="btn btn-success" value="Accepteren">
                                        </form>
                                        {{-- Gebruiker weigeren --}}
                                        <form action="/kluss/{{$kl->id}}/sollicitant/{{$sol->id}}/weigeren" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="kluss_id" id="kluss_id" value="{{$kl->id}}">
                                            <input type="hidden" name="user_id" id="user_id" value="{{$sol->id}}">
                                            <input type="submit" name="" class="btn btn-danger" value="Weigeren">
                                            {{-- <a href="" role="button" class="btn btn-danger">Weigeren</a> --}}
                                        </form>
                                </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {!! $kluss_applicants->appends(Request::except('sollicitanten'))->render() !!}
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
@endsection
