@extends('layouts.app')

@section('content')

<div class="container">

  <h3 class="jumbotron">baoyang edit</h3>
  {!!Form::open(['action' => ['PostsController@update',$baoyang->id], 'method'=>'post']) !!}
  

  <div class="form-group">
      {{Form::label('name', 'Name')}}
      {{Form::text('name', $baoyang->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
  </div>
  <div class="form-group">
      {{Form::label('tel', 'Tel')}}
      {{Form::text('tel', $baoyang->tel, ['class' => 'form-control'])}}
  </div>
  <div class="form-group">
    {{Form::label('city', 'City')}}
    {{Form::text('city', $baoyang->city, ['class' => 'form-control', 'placeholder' => 'City'])}}
  </div>
  <div class="form-group">
      {{Form::label('info', 'Info')}}
      {{Form::textarea('info', $baoyang->info, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Info Text'])}}
  </div>
  <label class="text-warning">danger</label>
      <div class="input-group control-group increment" >
        <input type="file" name="filename[]" class="form-control">
      </div>
      

  <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

  {!! Form::close() !!}      

</div>
   
@endsection
        