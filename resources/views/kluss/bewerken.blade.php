@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($kluss as $kl)
                @if($kl->user_id == \Auth::user()->id)
            <div class="col s12 m6 kluss--edit">
                <div class="col-sm-7">
                    <img src="../../{{$kl->kluss_image}}" class="individual--image" alt="{{$kl->title}}">
                </div>
                <div class="col-sm-5">
                    <form class="kluss--add individual--image container right" action="{{URL('/kluss/'.$kl->id.'/bewerken')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group title-group">
                            <label for="title">Titel</label>
                            <input type="text" name="title" class="form-control kluss--title" value="{{$kl->title}}" placeholder="Stofzuigen kot" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Beschrijving</label>
                            <textarea name="description" class="form-control kluss--description" rows="3" placeholder="Klein kot, 2 uurtjes werk max!">{{$kl->description}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="address">Adres</label>
                            <input id="autocomplete" name="address" class="form-control" placeholder="Geef uw adres in:"
                            onFocus="geolocate()" value="{{$kl->address}}" type="text" required></input>
                        </div>

                        <div class="form-group">
                            <label for="kluss_image">Foto toevoegen</label>
                            <input type="file" class="kluss--image" name="kluss_image" id="kluss--input">
                        </div>

                        <div class="form-group price-group">
                            <label for="price">Credits</label>
                            <input type="number" name="price" class="kluss--price form-control" value="{{$kl->price}}" placeholder="15" required>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="latitude" id="kluss--latB" value="{{$kl->latitude}}">
                            <input type="hidden" name="longitude" id="kluss--lngB" value="{{$kl->longitude}}">
                        </div>

                        <input type="submit" name="submit" class="btn btn-success" id="klussAdd_submit" value="Opslaan">
                    </form>
                </div>
            </div>
            @else
                <div class="col-sm-12">
                    <h1>U hebt geen toegang tot deze pagina</h1>
                    <a href="/home" class="btn btn--form">Terugkeren</a>
                </div>
            @endif
            @endforeach
        </div>
    </div>

    <script type="text/javascript">
    $('#autocomplete').focus();
    $('.kluss--title').focus();
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
        console.log(place);
        $('#kluss--latB').val(place.geometry.location.lat());
        $('#kluss--lngB').val(place.geometry.location.lng());
      }

      //fillInAddress();

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
    <script type="text/javascript" src="assets/js/app.js"></script>
@endsection
