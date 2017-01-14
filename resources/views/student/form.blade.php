<!DOCTYPE html>
<html>
    <head>
        <title>Form Laravel</title>  
    </head>
    <body>
		
		@if(Session::has('message'))
			<div class="alert alert-{{ Session::get('message-type') }} alert-dismissable">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<i class="glyphicon glyphicon-{{ Session::get('message-type') == 'success' ? 'ok' : 'remove'}}"></i> {{ Session::get('message') }}
			</div>
		@endif
		{!! Form::open(['url' => '/insert']) !!}
			<input type="text" name="first_name" placeholder="First Name" /> 
			@if($errors->has())
				<span style="color:red;">{!! $errors->first('first_name')!!} </span>
			@endif <br/>
			<input type="text" name="last_name" placeholder="Last Name" /> @if($errors->has())
				<span style="color:red;">{!! $errors->first('last_name')!!} </span>
			@endif <br/>
			<textarea name="address" placeholder="Address"></textarea> @if($errors->has())
				<span style="color:red;">{!! $errors->first('address')!!} </span>
			@endif <br/>
			<input type="submit" value="Submit" />
		{!!Form::close();!!}
		
       
    </body>
</html>
