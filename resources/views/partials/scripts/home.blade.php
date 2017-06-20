
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

   function initAutocomplete() {
     autocomplete = new google.maps.places.Autocomplete(
         /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
         {types: ['geocode'],
         componentRestrictions: {country: "be"}});
     autocomplete.addListener('place_changed', fillInAddress);
   }

   function fillInAddress() {
     var place = autocomplete.getPlace();
     //console.log(place.geometry.location.lat());
     $('#kluss__lat').val(place.geometry.location.lat());
     $('#kluss__lng').val(place.geometry.location.lng());
   }

   function geolocate() {
     if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(function(position) {
         var geolocation = {
           lat: position.coords.latitude,
           lng: position.coords.longitude
         };
         var circle = new google.maps.Circle({
           center: geolocation,
           radius: position.coords.accuracy
         });
         autocomplete.setBounds(circle.getBounds());
       });
     }
   }

initAutocomplete();
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
 }
 function fail(){
    // geolocation doesn't work with this browser / not a secure request
    // perform the load with the coordinates for Mechelen -> our HQ
    load(poslatDefault, poslngDefault);
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
</script>
