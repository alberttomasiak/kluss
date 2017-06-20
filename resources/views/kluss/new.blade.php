@extends('layouts.app')
@section('content')
    <div class="main-content-wrap">
        <div>
            <h1>Plaats een klussje op de kaart</h1>
            @if($account_type == "normal" && $task_history >= 3)
                <div class="task-limit">
                    <h2>Het spijt ons maar u hebt uw maandelijks limiet van klusjes bereikt.</h2>
                    <h3>Door een Gold subscriptie aan te schaffen kunt u maandelijks meer klusjes plaatsen.</h3>
                </div>
            @else
                <form action="/kluss/add" id="kluss--toevoegen" method="post" enctype="multipart/form-data">
                    <div class="kluss-left">
                        {!! csrf_field() !!}
                        <div class="form-group{{$errors->has('title') ? ' has-error' : ''}}">
                            <input type="text" name="title" class="form-control kluss--title" value="" placeholder="Titel:">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="price-group">
                            {{-- <label for="price">Prijs</label> --}}
                            <input type="number" name="price" class="kluss--price form-control {{ $errors->has('price') ? ' has-error' : '' }}" value="" placeholder="Prijs:">
                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group time-group">
                            <select class="form-control" name="kluss_time" id="kluss_time">
                                <option value="0:30">30 min.</option>
                                <option value="1:00">1 uur</option>
                                <option value="1:30">1 uur 30 min.</option>
                                <option value="2:00">2 uur</option>
                                <option value="2:30">2 uur 30 min.</option>
                                <option value="3:00">3 uur</option>
                                <option value="3:30">3 uur 30 min.</option>
                                <option value="4:00">4 uur</option>
                            </select>
                        </div>

                        <div class="form-group category-group">
                            <select class="form-control" name="kluss_category" id="kluss_category">
                                @foreach($kluss_categories as $kluss_category)
                                    <option value="{{$kluss_category->id}}">{{$kluss_category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            {{-- <label for="address">Adres</label> --}}
                            <input id="autocomplete" name="address" class="form-control" placeholder="Adres:"
                                   onFocus="geolocate()" type="text"></input>
                           @if ($errors->has('address'))
                               <span class="help-block">
                                   <strong>{{ $errors->first('address') }}</strong>
                               </span>
                           @endif
                        </div>

                        <div class="form-group">
                            {{-- <label for="description">Beschrijving</label> --}}
                            <textarea name="description" class="form-control kluss--description" rows="3" placeholder="Beschrijving:"></textarea>
                        </div>
                    </div>

                    <div class="kluss-right">
                        <div class="form-group {{ $errors->has('kluss_image') ? ' has-error' : '' }}">
                            <label for="kluss--input" class="kluss-file-upload">Drag &amp; drop uw foto of klik hier.</label>
                            <input type="file" class="kluss--image" name="kluss_image" id="kluss--input">
                            {{-- <img id="preview--kluss" src="" alt=""> --}}
                            <div class="user--img" id="preview--kluss"></div>
                            @if ($errors->has('kluss_image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kluss_image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group kluss-fullwidth">
                        <input type="hidden" name="latitude" id="kluss--lat" value="">
                        <input type="hidden" name="longitude" id="kluss--lng" value="">
                    </div>

                    <input type="submit" name="submit" id="klussAdd_submit" value="Voeg kluss toe">
                @endif
                </form>
        </div>
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

      $("input#kluss--input").on("change", function(){
         var file = this.files[0];
         var fileType = file["type"];
         var allowedFileTypes = ["image/jpeg", "image/png"];
         if($.inArray(fileType, allowedFileTypes) < 0){
             // invalid familia
         }else{
             $('.kluss-file-upload').css('color', 'transparent');
             var reader = new FileReader();
             reader.onload = function(e){
                 $(".user--img").css('background-image', "url('"+e.target.result+"')");
             };
             reader.readAsDataURL(this.files[0]);
         }
      });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2c16NAFhcBb9tR3jquHYKuKaebGPnn8&libraries=places&callback=initAutocomplete"
      async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
@endsection
