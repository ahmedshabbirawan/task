@extends('layouts.app')

<?php $title = 'Issuance Stock Report'; ?>

@section('title')
{{ $title }}
@endsection

@section('content')


<main role="main">

  

    <section class="jumbotron text-center" style="margin-bottom: 5px;" >
      <div class="container" id="map" style="height: 300px;">
        
      </div>
    </section>

    <section class="jumbotron text-center" style="padding: 5px; margin-bottom: 5px;" >
      <div class="container">
        <p style="margin:0px;">
            <?php 
            

            
            if( isset( auth()->user()->id ) ){
              if(auth()->user()->role == 'business_owner'){
            if( session('business_id') != '' ){ ?>
              <a href="{{ route('businesses.detail', session('business_id')); }}" class="btn btn-secondary my-2">Goto Business</a>
            <?php }else{ ?>
              <a href="{{ route('businesses.create'); }}" class="btn btn-secondary my-2">Add Business</a>
            <?php 
            }
            }else{ 
            ?>
              <a href="{{ route('order.by_customer'); }}" class="btn btn-secondary my-2">Orders List</a>
            <?php }
            }else{ ?>
                <a href="{{ route('login'); }}" class="btn btn-secondary my-2">Login</a>
            <?php } 
            ?>
        </p>
      </div>
    </section>

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">
          
          
            <?php foreach($business as $row): ?>
          
            <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <div class="card-header" style="  color: #fff;
                background-color: #212529;
                border-color: #32383e;
              " >
                    {{ $row->name }}
                  </div>
              <div class="card-body">
                {{-- <h5 class="card-title"></h5> --}}
                <p class="card-text">{{ $row->address }}</p>
                <p class="card-text">{{ $row->info }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="{{ route('businesses.detail',$row->id); }}" class="btn btn-sm btn-outline-secondary">View</a>
                    {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                  </div>
                  {{-- <small class="text-muted">9 mins</small> --}}
                </div>
              </div>
            </div>
            </div>

            <?php endforeach; ?> 
         
        

        
        
         


         
        </div>
      </div>
    </div>

  </main>
  @endsection
  @section('javascript')


  <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_key') }}&callback=initMap"></script>

  <script>


var i = 1;
var qualifications = [];
var programs = [];
var degrees = [];
var subjects = [];
var map, infoWindow, marker;
var latitude = 31.4854897; // YOUR LATITUDE VALUE
var longitude = 74.3470055; // YOUR LONGITUDE VALUE
var markerArr = [];
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
}
   
    
  


function initMap() {
  var myLatLng = {lat: latitude, lng: longitude};
  map = new google.maps.Map(document.getElementById('map'), {
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
  @endsection


  