


@extends('layouts.app')

@section('content')
<div class="container">
	<h1 class="mb-2 text-center">联系我们</h1>
	
	@if(session('message'))
	<div class='alert alert-success'>
		{{ session('message') }}
	</div>
	@endif
	
	<div class="col-12 col-md-6">
		<form class="form-horizontal" method="POST" action="{{ action('HelpsController@email') }}">
			{{ csrf_field() }} 
			<div class="form-group form-inline">
			<label for="Name">姓名： </label>
			<input type="text" class="form-control" id="name" value="{{$ename}}" placeholder="{{$ename}}" name="name" required>
		</div>

		<div class="form-group form-inline">
			<label for="email">Email或电话: </label>
			<input type="text" class="form-control" id="email" value="{{$email}}" placeholder="{{$email}}" name="email" required>
		</div>

		<div class="form-group">
			<label for="message">内容: </label>
			<textarea type="text" rows="12" class="form-control luna-message" id="help_msg" placeholder="Type your messages here" name="message" required></textarea>
		</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary" value="Send">Send</button>
            </div>
            <a href="{{route('sendEmail')}}" class="btn btn-blockbtn-primary">send email</a>
		</form>
	</div>
 </div> <!-- /container -->
@endsection