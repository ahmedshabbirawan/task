@extends('layouts.app')

<?php $title = 'Create Business'; ?>

@section('title')
{{ $title }}
@endsection

@section('content')


<main role="main">

  <section class="jumbotron text-center" style="margin-bottom: 5px;" >
    <div class="container">
      <h1 class="jumbotron-heading">Create Business</h1>
    
    </div>
  </section>



  <div class="album py-5 bg-light">
    <div class="container">

      @include('layouts.alerts')
   
      <form action="{{ route('businesses.store'); }}" method="post">
        @csrf
        <div class="form-group">
          <label for="usr">Name:</label>
          <input type="text" class="form-control" id="b_name" name="name" value="{{ old('name') }}" >
        </div>

        <div class="form-group">
          <label for="usr">Info:</label>
          <textarea class="form-control" rows="2" id="info" name="info">{{ old('info') }}</textarea>
        </div>

        <div class="form-group">
          <label for="usr">Address:</label>
          <textarea class="form-control" rows="2" id="address" name="address">{{ old('address') }}</textarea>
        </div>


        <div class="form-group">
          <label for="usr">Address:</label>
          <div id="map" style="height: 200px; background-color:burlywood;" >
        </div>

        

        <div class="form-group">
          <label for="usr">Latitude:</label>
          <input type="text" class="form-control" id="latitude" name="lat" value="{{ old('lat') }}" >
        </div>

        <div class="form-group">
          <label for="usr">longitude:</label>
          <input type="text" class="form-control" id="longitude" name="lng" value="{{ old('lng') }}" >
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>



      <div class="row">
       
      </div>
    </div>
  </div>

</main>




@endsection
@section('javascript')
<script type="text/javascript" src="{{ asset('js/lightbox.min.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_key') }}&callback=initMap"></script>
<script>
  

  var i = 1;

var map, infoWindow, marker;
var latitude = 31.4854897; // YOUR LATITUDE VALUE
var longitude = 74.3470055; // YOUR LONGITUDE VALUE

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
}


$(document).ready(function () {
    
    $("#latitude").val(latitude);
    $("#longitude").val(longitude);
    


  });
  
function initMap() {
    var myLatLng = {lat: latitude, lng: longitude};
    map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 12
    });
    marker = new google.maps.Marker({
        position: myLatLng, map: map,
        title: 'Set lat/lon values for this',
        draggable: true
    });
    google.maps.event.addListener(marker, 'dragend', function (event) {
        $("#latitude").val(this.getPosition().lat());
        $("#longitude").val(this.getPosition().lng());
    });
    infoWindow = new google.maps.InfoWindow();
    const locationButton = document.createElement("button");
    locationButton.textContent = "Move to Current Location";
    locationButton.classList.add("custom-map-control-button");

    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

    locationButton.addEventListener("click", ($e) => {
        // Try HTML5 geolocation.
        $e.preventDefault();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                    (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                $("#latitude").val(position.coords.latitude);
                $("#longitude").val(position.coords.longitude);
                
                marker.setPosition(pos);
                map.setCenter(pos);
            }, () => {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    });

}

function showPosition(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
            browserHasGeolocation
            ? "Error: The Geolocation service failed. Please move your marker by dragging on the map."
            : "Error: Your browser doesn't support geolocation. Please move your marker by dragging on the map."
            );
    infoWindow.open(map);
}

</script>
@endsection



