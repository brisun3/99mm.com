@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">账户管理</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="posts/create" class="btn btn-primary">创建文档</a>
                        <hr>
                        <h5>你已上传的资料</h5>
                        @if(count($posts)>0)
                        <?php
                            if ($utype=='miss')
                            $utype="专业小姐";
                        ?>
                        <table class="table table-striped">
                            <tr>
                                    <th></th>
                                <th>所在栏目</th>
                                <th>创建日期</th>
                                
                            </tr>
                            @foreach($posts as $post)
                            <?php $i=0;
                                    $i++;
                            ?>
                            <tr>
                            <td>{{$i}}</td>
                                <td>{{$utype}}</td>
                                <td>{{$post->created_at}}</td>
                                <td><a class="btn btn-primary" href="/misss/{{$post->id}}/edit">修改</a></td>
                                <td>{!!Form::open(['action' => ['MisssController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('删除', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}</td>
                            </tr>
                            
                            @endforeach

                        </table>
                        @else
                        you have no post
                        @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
