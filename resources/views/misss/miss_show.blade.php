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
          
          <p >半小时价:{{$post->tel}}</p>
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
                    <li>身高:{{$post->height}}</li>
                    <li>胸围:{{$post->chest}}</li>
                    <li>腰围:{{$post->waist}}</li>
                    <li>体重:{{$post->weight}}</li>
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
            <li>半小时价:{{$post->price30}}</li>
            <li>1小时价:{{$post->price1h}}</li>
            <li>外出价:{{$post->price_out}}</li>
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
          <p>该女生不对洋人服务。</p>
      @endif
  </div>
      
    

                
  <div class="container">  
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id==$post->user_id)
            <a href="/misss/{{$post->user_id}}/edit" class="btn btn-primary">edit</a>
            {!!Form::open(['action' => ['PostsController@destroy', $post->user_id], 'method' => 'POST', 'class' => 'float-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
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
    <div id="map" style="height:333px;width:222px;overflow: visible;"></div>
    </div>
  <script>
    /*var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 53.345520, lng: -6.271518},
        zoom: 15
      });
    
    //
    
    
    }*/
    /*
    function initMap() {
    // The location of Uluru
    var uluru = {lat: 53.345520, lng: -6.271518};
    // The map, centered at Uluru
    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 15, center: uluru});
    // The marker, positioned at Uluru
    var marker = new google.maps.Marker({position: uluru, map: map});
}

  */
  </script>
  
    <script>
        function initMap() {
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: -34.397, lng: 150.644}
          });
          var geocoder = new google.maps.Geocoder();
          geocodeAddress(geocoder, map);
          //document.getElementById('submit').addEventListener('click', function() {
            // geocodeAddress(geocoder, map);
          //});
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
      </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi9zEbNbmidV5rNdS3kcM0gEW1oAOYelY&callback=initMap"
    async defer></script>




  @endsection
