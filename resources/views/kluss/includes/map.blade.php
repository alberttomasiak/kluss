@foreach($kluss as $kl)
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&callback=initGeolocation" async deter></script>
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
     load();
 }
 function fail(){
    // geolocation doesn't work with this browser / not a secure request
    // perform the load with the coordinates for Mechelen -> our HQ
    calculateDistance(poslatDefault, poslngDefault, {!! json_encode($kl->latitude) !!}, {!! json_encode($kl->longitude) !!});
    load();
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
            //  console.log('oh no broski, you dungoofd');
         }
     });
 }

  function load() {
      var Plat = {!! json_encode($kl->latitude) !!};
      var Plng = {!! json_encode($kl->longitude)!!};
      var latiLngi = new google.maps.LatLng(Plat, Plng);
      map = new google.maps.Map(document.getElementById('map-single'), {
          center: latiLngi,
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
      console.log($('#map-single'));
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

    var html = "<div id='iw-container task-"+id+"'><img class='map-image' alt='klussje' src='/assets"+image+"'>"+ "<b>" + title + "</b> <br/>" + description.substring(0, 100) + "... </br></br>" + "<b>" + address.replace(/\d+/g, "") + "</b> </br>" + "<b>"+ price +" credits </b></br></div>";
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
