@extends('admin.layouts.user')

@section('content')
<div class="row" style="background:#fff; padding-top:30px; margin-bottom:25px;">
    <div class="col-md-8">
		<div class="col-sm-10 col-sm-offset-2 admin_subtitle">
			<div class="row">
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							{!! implode('', $errors->all('
								<li class="error">:message</li>
							')) !!}
						</ul>
					</div>
				@endif
			</div>
		</div>
		{!! Form::open(['route' => ['admin.userssetting.pass_update'], 'files' => true, 'class' => 'form-horizontal', 'method' => 'post','id'=>'validation_form']) !!}
			
			
			
			
			<div class="form-group">
				{!! Form::label('password', 'Password', ['class'=>'col-sm-2 control-label']) !!}
				<div class="col-sm-10">
						{!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Change Password']) !!}
				</div>
			</div>

			<div class="form-group">
				{!! Form::label('password', 'Confirm Password', ['class'=>'col-sm-2 control-label']) !!}
				<div class="col-sm-10">
						{!! Form::password('confirm_password', ['class'=>'form-control', 'placeholder'=>'Change Password']) !!}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					{!! Form::submit(trans('quickadmin::admin.users-edit-btnupdate'), ['class' => 'btn btn-danger','id'=>'submit']) !!}
				</div>
			</div>
	</div>
</div>
    {!! Form::close() !!}
    <script>
    function dobs(id)
    {
    var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
     var firstDate = new Date(id);
    var secondDate = new Date();

   var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
   var year=diffDays/365;
   $('#age').val(year.toFixed(0));
 
   
    }
    </script>

@endsection
<style>
.phone_code{
width:25%!important;
float:left;
margin-right:3px;
}
.required{
color:red;
}
</style>

