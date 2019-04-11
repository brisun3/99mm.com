@extends('layouts.app')

@section('content')

<div class="container">
  <h4 class="text-center" >专业小姐update表</h4>
  <div class="jumbotron">
  <h5>主要资料</h5>
  <label>国家:{{$ucountry}}</label>
  <label>  &nbsp&nbsp &nbsp 用户名:{{$miss->uname}}</label>
  {!!Form::open(['action' => ['MisssController@update',$miss->id], 'method'=>'post','enctype'=>'multipart/form-data']) !!}
  type{{Form::select('type', ['L' => 'Large', 'S' => 'Small'], 'S')}};

  
  <div class="form-group form-inline">
    {{Form::label('city', '城市 :  ')}}
    {{Form::text('city', $miss->city, ['class' => 'form-control', 'placeholder' => '城市'])}}
  </div>
  <div class="form-group form-inline ">
      {{Form::label('tel', '电话 :  ')}}
      {{Form::text('tel',$miss->tel, ['class' => 'form-control ', 'placeholder' => '电话'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('addr1', '大慨位置 :  ')}}
    {{Form::text('addr1', '', ['class' => 'form-control', 'placeholder' => '如：七区，Smithfield。'])}}
  </div>
  <div class="form-group form-inline ">
    {{Form::label('addr2', '详细地址 :  ')}}
    {{Form::text('addr2', '', ['class' => 'form-control', 'class' => 'input-1000', 'placeholder' => '地址'])}}
    
    <input id="show_marker" type="button" class="btn btn-primary" value="在地图中查看位置是否正确">
    <label class="label-note">注：本地址用于在地图上标出，以方便顾客查找。因此要实际存在地址，可误差20-30米，地址文字不在网页上显示.</label>
  </div>
  
  
  <input id="address" type="textbox" value="Dublin">
  
  <div id="map" style="height:333px;width:222px;overflow: visible;"></div>
  
  <div class="form-group ">
      {{Form::label('intro', '自我介绍 :')}}
      {{Form::textarea('intro', $miss->intro, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '文字自述'])}}
  </div>
  	
  <h5>个人详情</h5>
  <div class="form-group form-inline">
    {{Form::label('age', '年龄 :')}}
    {{Form::text('age', '', ['class' => 'form-control', 'placeholder' => '年龄'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('national', '来自国家或地区 :')}}
    {{Form::text('national', '', ['class' => 'form-control', 'placeholder' => '来自国家'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('shape', '身材型 :')}}
    {{Form::text('shape', '', ['class' => 'form-control', 'placeholder' => '如：苗条，丰满，匀称'])}}
  </div>
  
  <div class="form-group form-inline">
    {{Form::label('skin', '皮肤 :')}}
    {{Form::text('skin', '', ['class' => 'form-control', 'placeholder' => '皮肤'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('height', '身高 :  ')}}
    {{Form::text('height', '', ['class' => 'form-control', 'placeholder' => '身高'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('chest', '胸围 :')}}
    {{Form::text('chest', '', ['class' => 'form-control', 'placeholder' => '胸围'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('waist', '腰围 :')}}
    {{Form::text('waist', '', ['class' => 'form-control', 'placeholder' => '腰围'])}}
  </div>
  
  <div class="form-group form-inline">
    {{Form::label('weight', '体重 :')}}
    {{Form::text('weight', '', ['class' => 'form-control', 'placeholder' => '体重'])}}
  </div>
  <h5>语言沟通</h5>
  <div class="form-group form-inline">
    {{Form::label('lan1', '第一语言 :')}}
    {{Form::text('lan1', '', ['class' => 'form-control', 'placeholder' => '第一语言'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('lan2', '其它语言或方言 :')}}
    {{Form::text('lan2', '', ['class' => 'form-control', 'placeholder' => '其它语言'])}}
  </div>
  <h5>价格</h5>
  <div class="form-group form-inline">
    {{Form::label('price30', '30分钟价格 ：')}}
    {{Form::text('price30', '', ['class' => 'form-control', 'placeholder' => '30分钟价格'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('price1h', '1小时价格 ：')}}
    {{Form::text('price1h', '', ['class' => 'form-control', 'placeholder' => '1小时价格'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('price_out', '上门服务价格 ：')}}
    {{Form::text('price_out', '', ['class' => 'form-control', 'placeholder' => '上门服务价格'])}}
  </div>
  
  <div class="form-group form-inline">
    {{Form::label('price_note', '价格说明：')}}
    {{Form::text('price_note', '', ['class' => 'form-control', 'placeholder' => '价格说明'])}}
  </div>
  <h5>服务内容</h5>
  <div class="form-group form-inline">
    {{Form::label('service_des', '主要服务：')}}
    {{Form::text('service_des', '', ['class' => 'form-control', 'placeholder' => '主要服务'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('special_serv', '特色服务：')}}
    {{Form::text('special_serv', '', ['class' => 'form-control', 'placeholder' => '特色服务'])}}
  </div>
  
  <div class="form-group form-inline">
    {{Form::label('western_serv', '是否接待洋人：')}}
    {{Form::checkbox('western_serv', '',null, ['class' => 'form-control,checkbox'])}}
  </div>
  
 
  <h5>上传图片</h5>
      <div class="input-group control-group increment" >
        <input type="file" name="filename[]" class="form-control">
        
        <div class="input-group-btn"> 
          <button id="add_file" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>加载更多图片</button>
        </div>
        
      </div>
      <div class="clone hide">
        <div class="control-group input-group" style="margin-top:10px">
          <input type="file" name="filename[]" class="form-control" multiple>
          <div class="input-group-btn"> 
            <button id="remove_file" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> 取消本图片</button>
          </div>
        </div>
      </div>
      {{Form::hidden('_method','PUT')}}
      <button type="submit" class="btn btn-primary" style="margin-top:10px">登记</button>

      {!! Form::close() !!}     
  </div> 

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
        


    
                    