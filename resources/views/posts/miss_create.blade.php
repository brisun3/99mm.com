@extends('layouts.app')

@section('content')

<div class="container">

  <h3 class="jumbotron">Miss controlform</h3>
  {!!Form::open(['action' => 'MisssController@store', 'method'=>'post','enctype'=>'multipart/form-data']) !!}
  type{{Form::select('type', ['L' => 'Large', 'S' => 'Small'], 'S')}};

  <div class="form-group">
      {{Form::label('uname', 'uName')}}
      {{Form::text('uname', '', ['class' => 'form-control', 'placeholder' => 'uName'])}}
  </div>
  <div class="form-group">
    {{Form::label('city', 'City')}}
    {{Form::text('city', '', ['class' => 'form-control', 'placeholder' => 'City'])}}
  </div>
  <div class="form-group">
      {{Form::label('tel', 'Tel')}}
      {{Form::text('tel', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <div class="form-group">
    {{Form::label('addr1', 'Addr1')}}
    {{Form::text('addr1', '', ['class' => 'form-control', 'placeholder' => 'Addr line1'])}}
  </div>
  <div class="form-group">
    {{Form::label('addr2', 'Addr2')}}
    {{Form::text('addr2', '', ['class' => 'form-control', 'placeholder' => 'Addr line2'])}}
  </div>
  <input id="address" type="textbox" value="Dublin">
  <input id="show_marker" type="button" value="在地图中查看位置是否正确">
  <div id="map" style="height:333px;width:222px;overflow: visible;"></div>
  <div class="form-group">
      {{Form::label('user_id', 'User_id')}}
      {{Form::text('user_id', '', ['class' => 'form-control', 'placeholder' => 'UID'])}}
  </div>
  <div class="form-group">
      {{Form::label('intro', 'Intro')}}
      {{Form::textarea('intro', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Intro Text'])}}
  </div>
  	
  <h4>personal</h4>
  <div class="form-group">
    {{Form::label('age', 'age')}}
    {{Form::text('age', '', ['class' => 'form-control', 'placeholder' => 'ge'])}}
  </div>
  <div class="form-group">
    {{Form::label('national', 'national')}}
    {{Form::text('national', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <div class="form-group">
    {{Form::label('shape', 'shape')}}
    {{Form::text('shape', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  
  <div class="form-group">
    {{Form::label('skin', 'skin')}}
    {{Form::text('skin', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <div class="form-group">
    {{Form::label('height', 'height')}}
    {{Form::text('height', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <div class="form-group">
    {{Form::label('chest', 'chest')}}
    {{Form::text('chest', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <div class="form-group">
    {{Form::label('waist', 'waist')}}
    {{Form::text('waist', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  
  <div class="form-group">
    {{Form::label('weight', 'weight')}}
    {{Form::text('weight', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <h3>communication</h3>
  <div class="form-group">
    {{Form::label('lan1', 'lan1')}}
    {{Form::text('lan1', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <div class="form-group">
    {{Form::label('lan2', 'lan2')}}
    {{Form::text('lan2', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <h3>price</h3>
  <div class="form-group">
    {{Form::label('price30', 'price30')}}
    {{Form::text('price30', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <div class="form-group">
    {{Form::label('price1h', 'price1h')}}
    {{Form::text('price1h', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <div class="form-group">
    {{Form::label('price_out', 'price_out')}}
    {{Form::text('price_out', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  
  <div class="form-group">
    {{Form::label('price_note', 'price_note')}}
    {{Form::text('price_note', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <h3>services</h3>
  <div class="form-group">
    {{Form::label('service_des', 'service_des')}}
    {{Form::text('service_des', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  <div class="form-group">
    {{Form::label('special_serv', 'special_serv')}}
    {{Form::text('special_serv', '', ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
  
  <div class="form-group">
    {{Form::label('western_serv', 'western_serv')}}
    {{Form::checkbox('western_serv', '',null, ['class' => 'form-control,checkbox'])}}
  </div>
  
 
  <label class="text-warning">danger</label>
      <div class="input-group control-group increment" >
        <input type="file" name="filename[]" class="form-control">
        <div class="input-group-btn"> 
          <button id="add_file" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
        </div>
        
      </div>
      <div class="clone hide">
        <div class="control-group input-group" style="margin-top:10px">
          <input type="file" name="filename[]" class="form-control" multiple>
          <div class="input-group-btn"> 
            <button id="remove_file" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

      {!! Form::close() !!}      

</div>

<script type="text/javascript">

  $(document).ready(function() {

    $("#add_file").click(function(){ 
        var html = $(".clone").html();
        $(".increment").after(html);
    });

    $("body").on("click","#remove_file",function(){ 
      
        $(this).parents(".control-group").remove();
    });

  });

</script>
///geocode
<div id="floating-panel">
  <input id="address" type="textbox" value="Sydney, NSW">
  <input id="submit" type="button" value="Geocode">
</div>

<script>
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: {lat: -34.397, lng: 150.644}
    });
    var geocoder = new google.maps.Geocoder();

    document.getElementById('show_marker').addEventListener('click', function() {
      geocodeAddress(geocoder, map);
    });
  }

  function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('addr2').value;
    geocoder.geocode({'address': address}, function(results, status) {
      if (status === 'OK') {
        resultsMap.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          map: resultsMap,
          position: results[0].geometry.location
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi9zEbNbmidV5rNdS3kcM0gEW1oAOYelY&callback=initMap">
</script>

<link rel= "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">   
   
@endsection
        


    <? php
    /*
    $tags = get_meta_tags('http://www.geobytes.com/IpLocator.htm?GetLocation&template=php3.txt&IpAddress=' . $_SERVER['REMOTE_ADDR']);
    echo $tags['country'];
    echo $tags['city']; 
    **/
    ?>
                    