@extends('layouts.app')

@section('content')
{!!Form::open(['action' => 'PostsController@store', 'method'=>'post','enctype'=>'multipart/form-data']) !!}
// echo Form::open(['url' => 'foo/bar'])
//echo Form::open(['action' => ['Controller@method', $user->id]])
//echo Form::open(['url' => 'foo/bar', 'files' => true])

<br>
type{{Form::select('type', ['L' => 'Large', 'S' => 'Small'], 'S')}};

<div class="form-group">
    {{Form::label('name', 'Name')}}
    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
</div>
<div class="form-group">
    {{Form::label('user_id', 'User_id')}}
    {{Form::text('user_id', '', ['class' => 'form-control', 'placeholder' => 'UID'])}}
</div>
<div class="form-group">
    {{Form::label('intro', 'Intro')}}
    {{Form::textarea('intro', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'intro Text'])}}
</div>

<div class="form-group">
    {{Form::file('img_name')}}
</div>

<div class="input-group control-group increment" >
  <input type="file" name="img_name[]" class="form-control">
  <div class="input-group-btn"> 
    <button id="add_file" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
  </div>
</div>
<div class="clone hide">
  <div class="control-group input-group" style="margin-top:10px">
    <input type="file" name="img_name[]" class="form-control">
    <div class="input-group-btn"> 
      <button id="remove_file" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
    </div>
  </div>
</div>
 

{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}


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

       
    
@endsection
        
<html lang="en">
<head>
  <title>Laravel Multiple File Upload Example</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
   

  <div class="container">

    <h3 class="jumbotron">Laravel Multiple File Upload</h3>
<form method="post" action="{{url('file')}}" enctype="multipart/form-data">
  {{csrf_field()}}

        <div class="input-group control-group increment" >
          <input type="file" name="filename[]" class="form-control">
          <div class="input-group-btn"> 
            <button id="ad_file" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <div class="clone hide">
          <div class="control-group input-group" style="margin-top:10px">
            <input type="file" name="filename[]" class="form-control">
            <div class="input-group-btn"> 
              <button id="remove_file" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

  </form>        
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


</body>
</html>