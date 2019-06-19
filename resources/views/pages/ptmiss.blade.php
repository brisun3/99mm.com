@extends('layouts.app')

@section('content')
    <div class="container">
    <h4 class="text-center">业余客串</h4>
        <hr>
@if(count($city_num) > 0)
    
    @foreach($city_num as $city_name)
    
        <div class="col-md-1 col-sm-1">
            <h2>{{$city_name->city}}</h2>
        </div>
        @if(count($posts) > 0)
    
            @foreach($posts as $post)
                
                @if($post->city==$city_name->city)
                    @if(($post->status)=='free'|($post->status)=='paid')
                
                        <?php  //convert date to dd/mm
                        $old_date = $post->created_at;             
                        $str_date = strtotime($old_date);
                        $createDM = date('Y-m-d', $str_date); 
                        ?>
                        <div class="row">
                            <div class="col-md-1 col-sm-1">
                                    
                            </div>
                        
                            <div class="col-md-3 col-sm-2">
                                @if($post->img0)
                                    <div class="ptimg">
                                        <img src="/storage/img_name/{{$post->img0}}" style="height:130px; width:250px" atl="无图片">
                                    </div>
                                
                                @endif
                                <div class="row">
                                
                                @if($post->img1)
                                    <div class="col-md-6 col-sm-6">
                                        
                                        <img src="/storage/img_name/{{$post->img1}}" style=" height:70px; width:100px">
                                        
                                    </div>

                                @endif
                                @if($post->img2)
                                    <div class="col-md-6 col-sm-6">
                                    
                                        <img src="/storage/img_name/{{$post->img2}}" style=" height:70px; width:100px">
                                        
                                    </div>
                                @endif
                                </div>
                                <h3 class="text-center font-weight-bold">{{$post->uname}}</h3>
                                
                            </div>
                            
                            
                            
                            <div class="col-md-5">
                                
                                <div>
                                    <p>
                                            {{$post->intro}}
                                    </p>
                                </div>
                                
                                <div class="btn-group">
                                    <input type="hidden" class="msg" value={{$post->msg}}>

                                    <button class="btn btn-outline-primary number" data-last="{{$post->tel}}" data-tel_on="{{$post->tel_on}}">
                                            <span><a class="see">电话 </a></span>
                                    </button>
                                    
                                
                                    </div>
                                @if($post->venue)
                                    
                                    <div class="smaller">
                                        <br>
                                        提供服务场所</div>
                                    @else
                                    <div class="smaller">
                                        <br>
                                        不提供服务场所
                                    </div>
                                @endif
                                @if($post->serv_start && $post->serv_end)
                                        <p>营业时间:{{$post->serv_start}}-{{$post->serv_end}}</p>
                                    @endif
                    
                            </div>
                            
                            <div class="col-md-3">
                                <ul>
                                        <li>位置:{{$post->addr}}</li>
                                    @if($post->age)
                                        <li>年龄:{{$post->age}}</li>
                                    @endif
                                    @if($post->price)
                                        <li>价格:{{$post->price}}</li>
                                    @endif
                                    @if($post->price_out)
                                        <li>上门服务:{{$post->price_out}}</li>
                                    @endif
                                    @if($post->lan)
                                        <li>语言:{{$post->lan}}</li>
                                    @endif
                                
                                    @if($post->service_des)
                                        <li>服务内容:{{$post->service_des}}</li>
                                    @endif
                                    
                                </ul>
                                
                                <small>&nbsp&nbsp刷新日期：{{$createDM}}  </small>
                            </div>
                            
                        </div>
                        <hr>

                    @endif
                @endif  
                
                
            @endforeach
    
                    
       
        @else
            <p>没有业余客串人员的资料。</p>

        @endif
        
    

    @endforeach
    
@else
        <p>没有业余客串人员的资料。</p>
@endif
 
    </div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('.number').click(function() {
        var tel = $(this).data('last');
        var tel_on= $(this).data('tel_on');
        if(tel_on){
            $(this).find('span').html( '<a href="tel:' + tel + '">' + tel + '</a>' );
        }else{
            var msg=$(this).closest('.btn-group').find('.msg').val();
            if(!msg){
                msg="对不起，不在服务时间范围内，请以后再打。"

            }
            alert(msg);
        }
    });
    </script>
@endsection





    