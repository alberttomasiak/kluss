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
                         $('.apply-btn').append('<div class="notInRange"><p>Het spijt ons, maar je bent niet dicht genoeg bij het klusje om te solliciteren. <a href="/klussgold">Upgrade naar GOLD</a> om een groter bereik te hebben.</p></div>');
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
          console.log(map);

          for(var i = 0; i < kluss.length; i++){
              marks[i] = addMarker(kluss[i]);
          }
          center = map.getCenter();
          google.maps.event.addDomListener(window, 'resize', function() {

              map.setCenter(center);
          });
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

        var html = "<div id='iw-container task-"+id+"'><img class='map-image' alt='klussje' src='../assets/"+image+"'>"+ "<b>" + title + "</b> <br/>" + description.substring(0, 100) + "... </br></br>" + "<b>" + address.replace(/\d+/g, "") + "</b> </br>" + "<b>"+ price +" credits </b></br></div>";
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
    }
    initGeolocation();
    @endforeach

    function selectedApplicant(data){
        $('.apply-btn').remove();
        $('.master-btns').remove();
        $('.kluss-data').append('<div class="selected--applicant"><h3>Gekozen klusser:</h3><div class="applicant--info"><img class="applicant-image" src="/assets'+data.userImage+'" alt="'+data.userName+'s profile pic"> <a href="/profiel/'+data.userID+'/'+data.userName+'">'+data.userName+'</a></div></div>');
    }

    var channel = pusher.subscribe("kluss-map");
    // channel binds
    channel.bind('applicant-selected-task', selectedApplicant);

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
                <div class="col-md-6 kluss-data">
                    <h1>{{$kl->title}}</h1>
                    <p>{{$kl->description}}</p></br></br>
                    @if(blockChecker($kl->id, \Auth::user()->id) == "" && \Auth::user()->id != $kl->user_id)
                        <a href="#kluss-{{$kl->id}}-report" data-toggle="modal" role="button" data-id="{{$kl->id}}" class="btn btn-danger">RAPPORTEREN</a>
                        @include('kluss.modals.report', ['id' => $kl->id])
                    @elseif(blockChecker($kl->id, \Auth::user()->id) != "" && \Auth::user()->id != $kl->user_id)
                        <a href="#kluss-{{$kl->id}}-report" data-toggle="modal" role="button" data-id="{{$kl->id}}" class="btn btn-danger" disabled>RAPPORTEREN</a>
                        @include('kluss.modals.report', ['id' => $kl->id])
                        <p>Dit klusje werd door u al gerapporteerd. De beheerders zijn dit aan het onderzoeken.</p>
                    @endif
                    <b>{{preg_replace('/[0-9]+/', '', $kl->address)}}</b></br>
                    <b>{{$kl->price}} Credits</b></br></br>
                    @if($accepted_applicant == null)
                        @if(\Auth::user()->id == $kl->user_id)
                            <div class="master-btns">
                                <a class="btn btn--form" href="/kluss/{{$kl->id}}/bewerken">BEWERK DEZE KLUSS</a>
                                <a href="/kluss/{{$kl->id}}/verwijderen" class="btn btn-danger">DEZE KLUSS VERWIJDEREN</a>
                            </div>
                        @else
                            <div class="apply-btn">
                                @if($kluss_applicant->first())
                                    <a class="btn btn-danger" href="/kluss/{{$kl->id}}/solliciteren">APPLICATIE VERWIJDEREN</a>
                                @else
                                    @if(areWeCool(\Auth::user()->id, $kl->user_id) != "")
                                        <p>Je hebt of bent door de gebruiker geblokkeerd. Solliciteren voor dit klusje is niet mogelijk.</p>
                                    @else
                                        <a class="btn btn--form" href="/kluss/{{$kl->id}}/solliciteren">SOLLICITEER VOOR DEZE KLUSS</a>
                                    @endif
                                @endif
                            </div>
                        @endif
                    @else
                        @if(\Auth::user()->id == $kl->user_id && $paid == "")
                            <p>Er moet nog betaald worden voor het klusje. Je kan dit doen door op de knop hieronder te klikken.</p>
                            <a href="/kluss/{{$kl->id}}/betalen">Kluss betalen</a>
                        @endif
                        <div class="selected--applicant">
                            <h3>Gekozen klusser:</h3>
                            <div class="applicant--info">
                                <img class="applicant-image" src="/assets{{$accepted_applicant->profile_pic}}" alt="{{$accepted_applicant->name}}'s profile pic'">
                                <a href="/profiel/{{$accepted_applicant->id}}/{{$accepted_applicant->name}}">{{$accepted_applicant->name}}</a>
                                <div class="applicant--btn-tab">
                                    @if($kl->user_id == \Auth::user()->id)
                                        <form action="/chat/{{$accepted_applicant->id}}" method="post">
                                            {!! csrf_field() !!}
                                            <input type="submit" name="chatstart" class="btn btn-info" value="Contact">
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="selected--applicant-close">
                            @if(\Auth::user()->id == $kl->user_id || \Auth::user()->id == $kl->accepted_applicant_id)
                                <form action="/kluss/{{$kl->id}}/{{\Auth::user()->id}}/finished" method="post">
                                    {!! csrf_field() !!}
                                    @if(\Auth::user()->id == $kl->user_id)
                                        <input type="submit" name="finishtask" class="btn-finish" value="Kluss beëindigen" {{didIMark(\Auth::user()->id, $kl->id) == "" && $paid != "" ? '' : 'disabled'}}>
                                    @else
                                        <input type="submit" name="finishtask" class="btn-finish" value="Kluss beëindigen" {{didIMark(\Auth::user()->id, $kl->id) == "" ? '' : 'disabled'}}>
                                    @endif
                                    @if(didIMark(\Auth::user()->id, $kl->id))
                                        <p>Je hebt dit klusje al gemarkeerd als afgesloten. Je kan een review over de gebruiker hier schrijven:</p>
                                        <a href="/review/{{$kl->id}}" class="btn btn-success">Review schrijven</a>
                                    @endif
                                    @if(session('thanksfam'))
                                        <p>{{session('thanksfam')}}</p>
                                    @endif
                                </form>
                            @endif
                        </div>
                    @endif
                </div>
                {{-- User applicants --}}
                @if($accepted_applicant == null)
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
                                            {!! csrf_field() !!}
                                            <input type="submit" name="chatstart" class="btn btn-info" value="Contact">
                                        </form></td>
                                        <td>
                                            {{-- Gebruiker accepteren --}}
                                            <form action="/kluss/{{$kl->id}}/sollicitant/{{$sol->id}}/accepteren" method="post">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="kluss_id" id="kluss_id" value="{{$kl->id}}">
                                                <input type="hidden" name="user_id" id="user_id" value="{{$sol->id}}">
                                                <input type="submit" name="" class="btn btn-success" value="Accepteren">
                                            </form>
                                            {{-- Gebruiker weigeren --}}
                                            <form action="/kluss/{{$kl->id}}/sollicitant/{{$sol->id}}/weigeren" method="post">
                                                {!! csrf_field() !!}
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
                @endif
            </div>
            @endforeach
        </div>
    </div>
@endsection
