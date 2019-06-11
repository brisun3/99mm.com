@extends('layouts.app')

@section('content')

<div class="container">
  <h4 class="text-center" >移民婚约修订表</h4>
  <div class="jumbotron">
  <h5>主要资料</h5>
  <label>居住国家:{{$ucountry}}</label>
  <label>  &nbsp&nbsp &nbsp 用户名:{{$contract->uname}}</label>
  {!!Form::open(['action' => ['ContractsController@update',$contract->id], 'method'=>'post','enctype'=>'multipart/form-data']) !!}
  
  <div class="form-group form-inline">
    {{Form::label('tel', '电话 :  ')}}
    {{Form::text('tel', $contract->tel, ['class' => 'form-control', 'placeholder' => '电话'])}}
  </div>
    
  <div class="form-group form-inline ">
    {{Form::label('visa', ' 现有签证或身份:  ')}}
    {{Form::text('visa', $contract->visa, ['class' => 'form-control ', 'placeholder' => '现有签证或身份'])}}
  </div>

  <div class="form-group form-inline">
    {{Form::label('city', '居住城市 :  ')}}
    {{Form::text('city', $contract->city, ['class' => 'form-control', 'placeholder' => '城市'])}}
  </div>
  
  <div class="form-group ">
      {{Form::label('topic', '征求标题 :')}}
      {{Form::text('topic', $contract->topic, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '征求标题'])}}
  </div>
  <div class="form-group ">
    {{Form::label('info', '征求内容 :')}}
    {{Form::textarea('info', $contract->info, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '征求内容'])}}
  </div>

  <h5>个人详情</h5>
  
  <div class="form-group form-inline">
    {{Form::label('national', '来自国家或地区 :')}}
    {{Form::text('national', $contract->national, ['class' => 'form-control', 'placeholder' => '来自国家'])}}
  </div>
  
  <div class="form-group form-inline">
    {{Form::label('gender', '性别 :')}}
    <select id="gender"  class="{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" required autofocus>
      <?php 
        echo "<option value='女'", $contract->gender=='女'? 'selected' : '', ">女</option>";
        echo "<option value='男'", $contract->gender=='男'? 'selected' : '', ">男</option>";
      ?>
    </select>
  </div>

  <div class="form-group form-inline">
    {{Form::label('mstatus', '婚姻状况 :')}}
    {{Form::text('mstatus', $contract->mstatus, ['class' => 'form-control', 'placeholder' => '婚姻状况'])}}
  </div>
  <div class="form-group form-inline {{ $errors->has('age') ? 'has-error' : ''}}">
      {{Form::label('age', '年龄 :')}}
      {{Form::number('age', $contract->age, ['class' => 'form-control', 'min' => '18','placeholder' => '年龄'])}}
    </div>

  

  <div class="form-group form-inline">
    {{Form::label('look', '相貌 :')}}
    {{Form::text('look', $contract->look, ['class' => 'form-control', 'placeholder' => '相貌'])}}
  </div>
  
  
  <div class="form-group form-inline">
    {{Form::label('price', '可能价格范围 ：')}}
    {{Form::text('price', $contract->price, ['class' => 'form-control', 'placeholder' => '可能价格范围'])}}
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
      <button type="submit" class="btn btn-primary" style="margin-top:10px">提交</button>

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

