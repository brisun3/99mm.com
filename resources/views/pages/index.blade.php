@extends('layouts.app')

@section('content')
    <h1>Posts pages .index</h1>
    <h2> 
{{$ip_country}}

   </h2>
    

@if(count($city_num) > 0)

    
        @foreach($city_num as $city_name)
            <h2>{{$city_name->city}}</h2>
            
            @if(count($posts) > 0)
                <div class="container">
                    <div class="row">
                    @foreach($posts as $post)
                  
                        @if($post->city==$city_name->city)
                        
                            <?php  //convert date to dd/mm
                                $old_date = $post->created_at;              // returns Saturday, January 30 10 02:06:34
                                $str_date = strtotime($old_date);
                                $createDM = date('m月d日', $str_date); 
                            ?>
                                <div class="col-md-4 col-sm-3">
                                    @if($post->img0)
                                        <!-- first word in link misss must be controller's fore part--> 
                                        <a href="/misss/{{$post->id}}">
                                            <img src="/storage/img_name/{{$post->img0}}" style="height:130px; width:200px">
                                        </a>
                                    @else
                                        <a href="/posts/{{$post->id}}">
                                            <img src="/storage/img_name/no-user.jpg" style="height:130px; width:200px">
                                        </a>
                                    @endif
                                        <h3>{{$post->uname}}</h3>
                                        
                                        <small> {{$post->addr1}} </small>
                                        <small>&nbsp&nbsp{{$createDM}}  </small>
                                </div>
                        @endif        
                    @endforeach
                    </div>
                </div>
       
            @else
                <p>No posts found</p>

            @endif

        @endforeach
@else
        <p>无内容</p>
@endif
    

   
    <div id="map" style="height:30%"></div>
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


<?php
/*require 'Geo.php';
$geo=new Geo();
$geo->request('https://www.telize.com/');
echo 'live in'.$geo->city;
*/
?>
