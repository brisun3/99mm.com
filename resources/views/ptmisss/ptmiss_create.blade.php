@extends('layouts.app')

@section('content')

<div class="container">
  <h4 class="text-center" >pt小姐登记表</h4>
  <div class="jumbotron">
  <h5>主要资料</h5>
  <label>国家:{{$ucountry}}</label>
  <label>  &nbsp&nbsp &nbsp 用户名:{{$uname}}</label>
  {!!Form::open(['action' => 'PtmisssController@store', 'method'=>'post','enctype'=>'multipart/form-data']) !!}
  

  <div class="form-group form-inline ">
    {{Form::label('tel', '电话 :  ')}}
    {{Form::text('tel', '', ['class' => 'form-control ', 'placeholder' => '电话'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('city', '城市 :  ')}}
    {{Form::text('city', '', ['class' => 'form-control', 'placeholder' => '城市'])}}
  </div>
  
  <div class="form-group form-inline">
    {{Form::label('addr', '大慨位置 :  ')}}
    {{Form::text('addr', '', ['class' => 'form-control', 'placeholder' => '如：市中心'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('venue', '是否提供场所：')}}
    {{Form::checkbox('venue', '',null, ['class' => 'form-control,checkbox'])}}
  </div>
 
  <div class="form-group ">
      {{Form::label('intro', '自我介绍 :')}}
      {{Form::textarea('intro', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '文字自述'])}}
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
    {{Form::label('lan', '语言 :')}}
    {{Form::text('lan', '', ['class' => 'form-control', 'placeholder' => '语言'])}}
  </div>
  
  <div class="form-group form-inline">
    {{Form::label('lan_des', '语言说明 :')}}
    {{Form::text('lan_des', '', ['class' => 'form-control', 'placeholder' => '语言说明'])}}
  </div>
  <h5>服务和价格</h5>
  <div class="form-group form-inline">
    {{Form::label('price', '价格 ：')}}
    {{Form::text('price', '', ['class' => 'form-control', 'placeholder' => '价格'])}}
  </div>
  
  <div class="form-group form-inline">
    {{Form::label('price_out', '上门服务价格 ：')}}
    {{Form::text('price_out', '', ['class' => 'form-control', 'placeholder' => '上门服务价格'])}}
  </div>

  <div class="form-group form-inline">
    {{Form::label('price_note', '价格说明：')}}
    {{Form::text('price_note', '', ['class' => 'form-control', 'placeholder' => '价格说明'])}}
  </div>
  
  <div class="form-group form-inline">
    {{Form::label('service_des', '服务范围：')}}
    {{Form::text('service_des', '', ['class' => 'form-control', 'placeholder' => '服务范围'])}}
  </div>

  <div class="form-group form-inline">
    {{Form::label('serv_start', '服务开始时间：')}}
    {{Form::text('serv_start', '', ['class' => 'form-control', 'placeholder' => '服务开始时间'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('serv_end', '服务结束时间：')}}
    {{Form::text('serv_end', '', ['class' => 'form-control', 'placeholder' => '服务结束时间'])}}
  </div>
  <div class="form-group form-inline">
    {{Form::label('msg', '隐蔽电话时留言：')}}
    {{Form::text('msg', '', ['class' => 'form-control', 'placeholder' => '服务结束时间'])}}
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






<!--

<link rel= "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
-->
@endsection

