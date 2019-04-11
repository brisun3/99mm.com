<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>geo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <!-- Styles -->
        
    </head>
    <body>
        
            

        <div class="container">
            <h2 id="text-center">Enter Location: </h2>
            <form id="location-form">
              <input type="text" id="location-input" class="form-control form-control-lg">
              <br>
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
            <div class="card-block" id="formatted-address"></div>
            <div class="card-block" id="address-components"></div>
            <div class="card-block" id="geometry"></div>
          </div>
        
          <script>
            // Call Geocode
            //geocode();
        
            // Get location form
            var locationForm = document.getElementById('location-form');
        
            // Listen for submiot
            locationForm.addEventListener('submit', geocode);
        
            function geocode(e){
              // Prevent actual submit
              e.preventDefault();
        
              var location = document.getElementById('location-input').value;
        
              axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
                params:{
                  address:location,
                  key:'AIzaSyCi9zEbNbmidV5rNdS3kcM0gEW1oAOYelY'
                }
              })
              .then(function(response){
                // Log full response
                console.log(response);
        
                // Formatted Address
                var formattedAddress = response.data.results[0].formatted_address;
                var formattedAddressOutput = `
                  <ul class="list-group">
                    <li class="list-group-item">${formattedAddress}</li>
                  </ul>
                `;
        
                // Address Components
                var addressComponents = response.data.results[0].address_components;
                var addressComponentsOutput = '<ul class="list-group">';
                for(var i = 0;i < addressComponents.length;i++){
                  addressComponentsOutput += `
                    <li class="list-group-item"><strong>${addressComponents[i].types[0]}</strong>: ${addressComponents[i].long_name}</li>
                  `;
                }
                addressComponentsOutput += '</ul>';
        
                // Geometry
                var lat = response.data.results[0].geometry.location.lat;
                var lng = response.data.results[0].geometry.location.lng;
                var geometryOutput = `
                  <ul class="list-group">
                    <li class="list-group-item"><strong>Latitude</strong>: ${lat}</li>
                    <li class="list-group-item"><strong>Longitude</strong>: ${lng}</li>
                  </ul>
                `;
        
                // Output to app
                document.getElementById('formatted-address').innerHTML = formattedAddressOutput;
                document.getElementById('address-components').innerHTML = addressComponentsOutput;
                document.getElementById('geometry').innerHTML = geometryOutput;
              })
              .catch(function(error){
                console.log(error);
              });
            }
          </script>    
          ////
          <div id="map"></div>
          <script>
            /*var map;
            function initMap() {
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 53.345520, lng: -6.271518},
                zoom: 15
              });
            
            //
            
            
            }*/
             nm                                             
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 15, center: uluru});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: uluru, map: map});
}


          </script>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi9zEbNbmidV5rNdS3kcM0gEW1oAOYelY&callback=initMap"
          async defer></script>
        
      ////
        
    </body>
</html>




@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    
        
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        
                    </div>
                    </div></div>
                    <hr>
                    
                <h1></h1>
                
                <!--google maps -->
               
            
                
                
                    <div id="map"></div>
                    <script>
                      /*var map;
                      function initMap() {
                        map = new google.maps.Map(document.getElementById('map'), {
                          center: {lat: 53.345520, lng: -6.271518},
                          zoom: 15
                        });
                      
                      //
                      
                      
                      }*/
                      function initMap() {
                      // The location of Uluru
                      var uluru = {lat: 53.345520, lng: -6.271518};
                      // The map, centered at Uluru
                      var map = new google.maps.Map(
                          document.getElementById('map'), {zoom: 15, center: uluru});
                      // The marker, positioned at Uluru
                      var marker = new google.maps.Marker({position: uluru, map: map});
}


                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi9zEbNbmidV5rNdS3kcM0gEW1oAOYelY&callback=initMap"
                    async defer></script>


                    
                  
                
       
    
@endsection