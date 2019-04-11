@extends('layouts.app')

@section('content')
    
    <h2>Posts.index</h2>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->name}}</a></h3>
                        <!--<small>Written on {{$post->created_at}} by </small>-->
                        <small>add :{{$post->addr1}} by </small>
                    </div>
                </div>
            </div>
        @endforeach
       
    @else
        <p>No posts found</p>
    @endif
    <!--google maps-->
    where is code
@endsection

