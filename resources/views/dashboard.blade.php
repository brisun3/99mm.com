@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">账户管理</div>
                <div class="card-body">
                    
                    @if(isset($status))
                        <?php
                        $expire=$status->expire_at;
                        $discount_to=$status->discount_to;
                        $date1=date_create($discount_to);
                        $date2=date_create(date('Y-m-d'));
                        $discount_gap=date_diff($date2,$date1)->format("%R%a");
                        
                        //$dis_gap->format("%R%a days");
                        $noteday=date('Y-m-d', strtotime(date('Y-m-d'). ' + 11days'));
                        
                        ?>
                        @if($noteday>$expire)
                        <div id="pay">
                            @if($status->status=='free')
                                <span>你的免费使用期将于{{$expire}}结束，此后你享有一个月的优惠价。</span>
                            @else 
                            <span>你的付款将于{{$expire}}到期。</span>
                            @endif
                            
                                <a id="show-price"  class="btn btn-info" >
                                        查看价格
                                </a>
                            <hr>
                        </div>
                        @endif
                    
                        <div id="pricelist" style="display:none">
                            
                            @if($discount_gap>27)
                                <h6>优惠价格</h6>
                                <div>
                                    <span>付款一周：{{$price->week_price/2}}欧元</span>
                                    <span><a href="/listprice/{{$price->week_price/2}}/7days" class="btn btn-secondary ">选择</a></span>
                                </div>
                                <br>
                                <div >
                                    <span>付款两周：{{$price->dweeks_price/2}}欧元</span>
                                    <span><a href="/listprice/{{$price->dweeks_price/2}}/14days" class="btn btn-secondary ">选择</a></span>
                                </div>
                                <br>
                                <div>
                                    <span> 付款一个月：{{$price->month_price/2}}欧元</span>

                                <span><a  href="/listprice/{{$price->month_price/2}}/month" class="btn btn-secondary  ">选择</a></span>
                                </div>
                                <hr>
                                
                            @elseif($discount_gap>13)
                                <h6>部分优惠价格</h6>
                                <div>
                                    <span>付款一周：{{$price->week_price/2}}欧元</span>
                                    <span><a href="/listprice/{{$price->week_price/2}}/7days" class="btn btn-secondary ">选择</a></span>
                                </div>
                                <br>
                                <div class>
                                    <span>付款两周：{{$price->dweeks_price/2}}欧元</span>
                                    <span><a href="/listprice/{{$price->dweeks_price/2}}/14days" class="btn btn-secondary ">选择</a></span>
                                </div>
                                <br>
                                <div>
                                    <span>付款一个月：{{$price->month_price*3/4}}欧元</span>

                                <span><a  href="/listprice/{{$price->month_price*3/4}}/month" class="btn btn-secondary  " >选择</a></span>
                                </div>
                                <hr>
                                @elseif($discount_gap>3)
                                <h6>部分优惠价格</h6>
                                <div>
                                    <span>付款一周：{{$price->week_price/2}}</span>
                                    <span><a href="/listprice/{{$price->week_price/2}}/7days" class="btn btn-secondary ">选择</a></span>
                                </div>
                                <br>
                                <div class>
                                    <span>付款两周：{{$price->dweeks_price*3/4}}欧元</span>
                                    <span><a href="/listprice/{{$price->dweeks_price*3/4}}/14days" class="btn btn-secondary ">选择</a></span>
                                </div>
                                <br>
                                <div>
                                    <span>付款一个月：{{$price->month_price}}欧元</span>

                                <span><a  href="/listprice/{{$price->month_price}}/month" class="btn btn-secondary  ">选择</a></span>
                                </div>
                                <hr>
                            
                            @else
                                <h6></h6>
                                <div>
                                    <span>付款一周：{{$price->week_price}}欧元</span>
                                    <span><a href="/listprice/{{$price->week_price}}/7days" class="btn btn-secondary ">选择</a></span>
                                </div>
                                <br>
                                <div >
                                    <span>付款两周{{$price->dweeks_price}}欧元</span>
                                    <span><a href="/listprice/{{$price->dweeks_price}}/14days" class="btn btn-secondary ">选择</a></span>
                                </div>
                                <br>
                                <div>
                                    <span>付款一个月：{{$price->month_price}}欧元</span>
                                    <span><a  href="/listprice/{{$price->month_price}}/month" class="btn btn-secondary  ">选择</a></span>
                                </div>
                                <hr>
                            
                                
                            @endif
                        </div>
                    @endif
                    
                
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    @endif
                        
                                                    
                        
                        
                        @if(count($posts)>0)
                        <h6>你已上传的资料</h6>
                        
                        <table class="table table-striped">
                            <tr>
                                    <th></th>
                                <th>所在栏目</th>
                                <th>创建日期</th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                            <?php $i=0;
                                    $i++;
                            ?>
                            <tr>
                            <td>{{$i}}</td>
                            
                            @switch($utype)
                                @case('miss')
                                    <td>专业小姐</td>
                                    @break
                                @case('ptmiss')
                                    <td>业余客串</td>
                                    @break
                                @case('massage')
                                    <td>按摩</td>
                                    @break
                                @case('contract')
                                    <td>移民婚约</td>
                                    @break
                                @case('more')
                                    <td>更多</td>
                                    @break
                                @case('baoyang')
                                    <td>包养</td>
                                    @break
                                @case('escorth')
                                    <td>伴游</td>
                                    @break
                                @case('escortb')
                                    <td>商务陪伴</td>
                                    @break
                                                              
                                    
                            @endswitch
                                
                                <td>{{$post->created_at}}</td>
                            <td><a class="btn btn-primary" href="/{{$utype}}s/{{$post->id}}/edit">修改</a></td>
                            {{--@if(($utype!='baoyang')&&($utype!='escorth')&&($utype!='escortb'))
                                <td>{!!Form::open(['action' => ['BaoyangsController@destroy', $post->id,$utype], 'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('删除', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}</td>
                            @endif--}}
                            </tr>
                            
                            @endforeach
                            
                        </table>
                        @if(($utype=='miss')|($utype=='massage'))
                                <a href="misss/create" class="btn btn-primary">再创建文档</a>
                                        
                            @endif
                        @else
                        <p>你没有上传的资料。
                        </p>
                        <a href="misss/create" class="btn btn-primary">创建文档</a>
                        
                        @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
      $("#show-price").click(function(){
        
        
          var x = document.getElementById("pricelist");
          
          if (x.style.display === "none") {
              x.style.display = "block";
              
              //amt.val()=$(this).val();
          } else {
              x.style.display = "none";
          }
          
      });
    });
    </script>

@endsection
