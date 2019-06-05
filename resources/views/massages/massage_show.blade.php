@extends('layouts.app')

@section('content')
  
  
  <div class="container">
    <br>
    <div class="row">
      <div class="col-sm">
        <img src="/storage/img_name/{{$post->img0}}" style="height:130px; width:200px">
      </div>
      <div class="col-sm">
        @if($post->img1)
        <img src="/storage/img_name/{{$post->img1}}" style="height:130px; width:200px">
        @endif
      </div>
      <div class="col-sm">
        @if($post->img2)
          <img src="/storage/img_name/{{$post->img2}}" style="height:130px; width:200px"><br>
        @endif
      </div>
      <div class="col-sm">
        @if($post->img3)
          <img src="/storage/img_name/{{$post->img3}}" style="height:130px; width:200px"><br>
        @endif
      </div>
      <div class="col-sm">
        @if($post->img4)
          <img src="/storage/img_name/{{$post->img4}}" style="height:130px; width:200px"><br>
        @endif
      </div>
      <div class="col-sm">
        @if($post->img5)
          <img src="/storage/img_name/{{$post->img5}}" style="height:130px; width:200px"><br>
        @endif
      </div>
      <div class="col-sm">
        @if($post->img6)
          <img src="/storage/img_name/{{$post->img6}}" style="height:130px; width:200px"><br>
        @endif
      </div>
      <div class="col-sm">
        @if($post->img7)
          <img src="/storage/img_name/{{$post->img7}}" style="height:130px; width:200px"><br>
        @endif
      </div>
    </div>
  </div>
    
  
  <div class="container">
            
    <div class="row">
      <div class="col-6">
          <h6>{{$post->uname}}</h6>
          
          <p>电话:<a href="tel:{{$post->tel}}">{{$post->tel}}</a></p>
          
          
          
      </div>
      <div class="col-6">
        <div class="float-right">
          <p >位置:{{$post->addr1}}<b>,{{$post->city}}</b></p>
          
          <p >半小时价:{{$post->price30}}欧元</p>
        </div>
          
      </div>
    </div>
    <hr>
  </div>
              
  <div class="container">
    <h6>自我介绍：</h6>
    <p>{{$post->intro}}</p>
    <hr>
  </div>
                        
  <div class="container">
    <div class="row">
      <div class="col-md-5">
            <h6>个人资料：</h6>
            <div class="row">
              <div class="col-md-6">

                <ul>
                  <li>年龄:{{$post->age}}</li>
                  <li>国籍:{{$post->national}}</li>
                  <li>身材:{{$post->shape}}</li>
                  <li>皮肤:{{$post->skin}}</li>
                </ul>
              </div>
              <div class="col-md-6">

                  <ul>
                    <li>身高:{{$post->height}}m</li>
                    <li>胸围:{{$post->chest}}cm</li>
                    <li>腰围:{{$post->waist}}cm</li>
                    <li>体重:{{$post->weight}}kg</li>
                  </ul>
              </div>
            </div>
      </div>
      <div class="col-md-3">
        <h6>语言交流</h6>
        <ul>
            <li>第一语言:{{$post->lan1}}</li>
            <li>其它语言方言:{{$post->lan2}}</li>
            <li>语言说明:{{$post->lan_des}}</li>
            
          </ul>
      </div>
      <div class="col-md-4">      
        <h6>价格</h6>
        <ul>
          @if($post->price30)
            <li>半小时价:€{{$post->price30}}</li>
            <li>1小时价:€{{$post->price1h}}</li>
            <li>外出价:€{{$post->price_out}}</li>
            <li>备注：{{$post->price_note}}</li>
            
          @else
            <li>价格没有透露，请电话咨询！</li>
          @endif
            
            
          </ul>
      </div>
            
    </div>
  </div>


    

  <div class="container">
      <hr>
      <h6>服务内容</h6>
      <p>主要服务：{{$post->service_des}}</p>
      <p>特色服务：{{$post->special_serv}}</p>
      @if($post->western_serv==0)
          <p>该女生不接待西方人。</p>
      @endif
  </div>
      
    

                
  <div class="container">  
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id==$post->user_id)
            <a href="/massages/{{$post->id}}/edit" class="btn btn-primary">修改</a>
            {!!Form::open(['action' => ['MassagesController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('删除', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
  </div>

  <div class="container">
      <hr>
      <small>刷新日期： {{date('Y-m-d', strtotime($post->updated_at))}}  </small>
  </div>
        
    
    <!--google maps -->
                
              
                  
    <div class="container">           
    <div id="map" style="height:333px;width:500px;overflow: visible;"></div>
    <button id="dirBtn" class="btn-primary">导航路线</button>
    </div>
  
  
    <script>
        function initMap() {
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            //center: {lat: -34.397, lng: 150.644}
          });
          var geocoder = new google.maps.Geocoder();
          geocodeAddress(geocoder, map);
          //document.getElementById('submit').addEventListener('click', function() {
            // geocodeAddress(geocoder, map);
          //});
          //for directions added
          var directionsService = new google.maps.DirectionsService;
          var directionsDisplay = new google.maps.DirectionsRenderer;
          directionsDisplay.setMap(map);
          document.getElementById('dirBtn').onclick= function(){
            navigator.geolocation.getCurrentPosition(function(position) {
              var latit = position.coords.latitude;
              var lngit = position.coords.longitude;
              var myLatLng={
                lat:latit,
                lng:lngit
              };
              calculateAndDisplayRoute(directionsService, directionsDisplay,myLatLng);                            // or something similar
          });
          
        };
        }

        function geocodeAddress(geocoder, resultsMap) {
          //var address = document.getElementById('loc').value;
          var address='{{$post->addr2}}';
          
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
        function calculateAndDisplayRoute(directionsService, directionsDisplay,myLatLng) {
                   
          directionsService.route({
            origin: myLatLng,
            destination:  '{{$post->addr2}}',
            travelMode: 'DRIVING'
            }, function(response, status) {
              if (status === 'OK') {
                directionsDisplay.setDirections(response);
              } else {
                window.alert('Directions request failed due to ' + status);
              }
            }
          );
        }
      </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi9zEbNbmidV5rNdS3kcM0gEW1oAOYelY&callback=initMap"
    async defer></script>




  @endsection
