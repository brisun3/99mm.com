@extends('layouts.app')

@section('content')
    <h1>Baoyang</h1>
    
    

@if(count($city_num) > 0)
    
        @foreach($city_num as $city_name)
<h2>{{$city_name->city}}</h2>
@if(count($posts) > 0)
    <div class="container">
        <div class="row">
        @foreach($posts as $post)
            
            @if($post->city==$city_name->city)
            
                        
                    <div class="col-md-4 col-sm-3">
                        @if($post->img_name)
                        <a href="/posts/{{$post->id}}">
                            <img src="/storage/img_name/{{$post->img_name}}" style="height:130px; width:200px">
                        </a>
                            @else
                            <a href="/posts/{{$post->id}}">
                                <img src="/storage/img_name/no-user.jpg" style="height:130px; width:200px">
                            </a>
                                @endif
                            <h3>{{$post->name}}</h3>
                                
                                    <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            {{$post->subject}}
                                    </a>
                                    
                                  
                                  <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                            {{$post->info}}
                                    </div>
                                  </div>
                                  <div class="button-group">
                                        <a href="" class="btn btn-primary">email me</a>
                                        <button class="next"> find tel</button>
                                        </div>
                            
                            <h3></h3>
                        <small>{{$post->created_at}}  </small>
                        
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
        <p>No posts found hee</p>
@endif
    

   
    
    
    
@endsection

