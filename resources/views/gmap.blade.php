
@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    
    
        <div id="test">test my color</div>
        <div id="map" ></div>
        <script>
            var map;
            function initMap() {
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
              });
            }
          </script>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi9zEbNbmidV5rNdS3kcM0gEW1oAOYelY&callback=initMap"
          async defer></script>
      
            
@endsection


