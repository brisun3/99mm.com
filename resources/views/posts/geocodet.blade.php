
@extends('layouts.app')

@section('content')

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


    <h1>ip look up</h1>
  </div>
  
  
  <div id="map"></div>

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
    ///gmap
    function initMap() {
      // The location of Uluru
      var uluru = {lat: lat, lng: lng};
      // The map, centered at Uluru
      var map = new google.maps.Map(
          document.getElementById('map'), {zoom: 15, center: uluru});
      // The marker, positioned at Uluru
      var marker = new google.maps.Marker({position: uluru, map: map});
  }
///end of gmap
  </script>

  //////
  
    
    <script>
      /*var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 53.345520, lng: -6.271518},
          zoom: 15
        });
      
      //
      
      
      }*/
      


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi9zEbNbmidV5rNdS3kcM0gEW1oAOYelY&callback=initMap"
    async defer></script>



                    ///////
                    <div id="mcountry">see me</div>
                    <?php

                    $jsonurl = "http://ip-api.com/json/?lang=zh-CN";
        $json = file_get_contents($jsonurl);
        //var_dump(json_decode($json));
        $djason=json_decode($json);
        echo $djason->country;
        //$ip_country=$json->country;
                    ?>                    
                      
                      <div id="city">city</div>
                    <script>
                    var requestUrl = "http://ip-api.com/json/?lang=zh-CN";

$.ajax({
  url: requestUrl,
  type: 'GET',
  success: function(json)
  {
    $("#mcountry").html("my country is: "+json.country);
    $("#city").html("my city is: "+json.city);
    console.log("My city is: " + json.country);
  },
  error: function(err)
  {
    console.log("Request failed, error= " + err);
  }
});
  </script>
@endsection