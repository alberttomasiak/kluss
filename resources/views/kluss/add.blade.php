@extends('layouts.app')
@section('content')
    <div class="kluss--add container col-md-4 col-md-offset-4 center">
            <form class="row flex-row add-kluss" enctype="multipart/form-data" id="kluss--toevoegen" action="{{ URL('/kluss/add')}}" method="post">
                <h1>Voeg een kluss toe:</h1>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group title-group">
                    <label for="title">Titel</label>
                    <input type="text" name="title" class="form-control kluss--title" value="" placeholder="Stofzuigen kot" required>
                </div>

                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <textarea name="description" class="form-control kluss--description" rows="3" placeholder="Klein kot, 2 uurtjes werk max!"></textarea>
                </div>

                <div class="form-group">
                    <label for="address">Adres</label>
                    <input id="autocomplete" name="address" class="form-control" placeholder="Geef uw adres in:"
                           onFocus="geolocate()" type="text" required></input>
                </div>

                <div class="form-group">
                    <label for="kluss_image">Foto toevoegen</label>
                    <input type="file" class="kluss--image" name="file" id="kluss--input">
                </div>

                <div class="form-group price-group">
                    <label for="price">Credits</label>
                    <input type="number" name="price" class="kluss--price form-control" value="" placeholder="15" required>
                </div>

                <div class="form-group">
                    <input type="hidden" name="latitude" id="kluss--lat" value="">
                    <input type="hidden" name="longitude" id="kluss--lng" value="">
                </div>

                <input type="submit" name="submit" class="btn btn-success" id="klussAdd_submit" value="Voeg kluss toe">
            </form>
        </div>
        <script type="text/javascript">
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
            $('#kluss--lat').val(place.geometry.location.lat());
            $('#kluss--lng').val(place.geometry.location.lng());
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
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&libraries=places&callback=initAutocomplete"
          async defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="/js/app.js"></script>
@endsection