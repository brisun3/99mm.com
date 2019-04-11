@extends('layouts.app')

@section('content')
{!!Form::open(['action' => ['PostsController@update',$post->id], 'method'=>'post']) !!}
// echo Form::open(['url' => 'foo/bar'])
//echo Form::open(['action' => ['Controller@method', $user->id]])
//echo Form::open(['url' => 'foo/bar', 'files' => true])

<br>
type{{Form::select('type', ['L' => 'Large', 'S' => 'Small'], 'S')}};

<div class="form-group">
    {{Form::label('name', 'Name')}}
    {{Form::text('name', $post->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
</div>
<div class="form-group">
    {{Form::label('user_id', 'User_id')}}
    {{Form::text('user_id', $post->user_id, ['class' => 'form-control', 'placeholder' => 'UID'])}}
</div>
<div class="form-group">
    {{Form::label('intro', 'Intro')}}
    {{Form::textarea('intro', $post->intro, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Intro Text'])}}
</div>

<div class="form-group">
    {{Form::file('cover_image')}}
</div>
{{Form::hidden('_method','PUT')}}
{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
       
    
@endsection
        
    