@extends('layouts.app')

<?php $title = 'Issuance Stock Report'; ?>

@section('title')
{{ $title }}
@endsection

@section('content')


<main role="main">

    <section class="jumbotron text-center" style="margin-bottom: 5px; padding:10px 2rem; " >
      <div class="container">
        <h1 class="jumbotron-heading">{{ $business->name }}</h1>
        <p class="lead text-muted">{{ $business->address }}</p>
        <p class="lead text-muted">{{ $business->info }}</p>
        {{-- <p>
          <a href="#" class="btn btn-primary my-2">Main call to action</a>
          <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p> --}}
      </div>
    </section>

    <section class="jumbotron text-center" style="padding: 5px; margin-bottom: 5px;" >
      <div class="container" id="map" style="height:200px;">
        
      </div>
    </section>

    <?php if(isset(auth()->user()->id)){  if(auth()->user()->role == 'customer'){?>
      @include('business.customer_section')
    <?php }elseif(auth()->user()->role == 'business_owner'){ ?>
      @include('business.owner_section')
   
    <?php } } ?>

    





  </main>





  @endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('js/lightbox.min.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_key') }}&callback=initMap"></script>
@yield('customer_script')
@yield('owner_script')
<script>
 
  

 
var i = 1;
var map, infoWindow, marker;
var latitude = 31.4854897; // YOUR LATITUDE VALUE
var longitude = 74.3470055; // YOUR LONGITUDE VALUE
var markerArr = [];
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
}
   
    
  


function initMap() {
  var myLatLng  = {lat: latitude, lng: longitude};
  map           = new google.maps.Map(document.getElementById('map'), {
      center: myLatLng,
      zoom: 12
  });

  var locations = JSON.parse('<?= json_encode($business) ?>');
  $( locations ).each(function(index, obj){
      addMarker({
        coordinates: {
          lat: parseFloat(obj.lat),
          lng: parseFloat(obj.lng)
        },
        location_id:{'loc_id' :obj.id, 'loc_name' : obj.name +', '+ obj.address},
        iconImage: '',
        content: obj.name
      });
  });




  function addMarker(prop) {
    var marker = new google.maps.Marker({
      position: prop.coordinates, // Passing the coordinates
      map: map, //Map that we need to add
      location_id : prop.location_id,
      draggarble: false // If set to true you can drag the marker
    });
    markerArr.push(marker);
    if (prop.iconImage) {
      marker.setIcon(prop.iconImage);
    }
    if (prop.content) {
        var information = new google.maps.InfoWindow({
          content: prop.content
        });
        marker.addListener('click', function() {
          $('#location_id_select').val(marker.location_id.loc_id);
        //  $('#loc_title').html(marker.location_id.loc_name);
          $('.gm-ui-hover-effect').click();
          information.open(map, marker);
          if(table){
            $('#yajra-table').DataTable().ajax.reload();
          }else{
            show_Location_LineListing();
          }
        });
    }
  }
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

</script>
@endsection



