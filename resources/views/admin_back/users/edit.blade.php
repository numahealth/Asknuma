@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            <h1>{{ trans('quickadmin::admin.users-edit-edit_user') }}</h1>

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
	
    {!! Form::open(['route' => ['users.update', $user->id], 'files' => true, 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

	<div class="form-group">
    {!! Form::label('profile_pic', 'Profile Photo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('profile_pic') !!}
        {!! Form::hidden('profile_pic_w', 4096) !!}
        {!! Form::hidden('profile_pic_h', 4096) !!}
        {!! Form::hidden('updated_by', Auth::user()->id) !!}
		{!! Form::hidden('locaton_check', @$location[0]->id) !!}
    </div>
</div>
	<div class="form-group">
        {!! Form::label('Patient', 'Patient ID', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('Patient', old('name', $user->id), ['class'=>'form-control', 'placeholder'=> 'Patient ID','readonly']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('name', trans('quickadmin::admin.users-edit-name'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('name', old('name', $user->name), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-edit-name_placeholder')]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('email', trans('quickadmin::admin.users-edit-email'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::email('email', old('email', $user->email), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-edit-email_placeholder')]) !!}
        </div>
    </div>

    <!--div class="form-group">
        {!! Form::label('password', trans('quickadmin::admin.users-edit-password'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-edit-password_placeholder')]) !!}
        </div>
    </div-->

    <div class="form-group">
        {!! Form::label('role_id', trans('quickadmin::admin.users-edit-role'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('role_id', $roles, old('role_id', $user->role_id), ['class'=>'form-control']) !!}
        </div>
    </div>
	<div class="form-group">
        {!! Form::label('Contact', 'Contact', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::number('phone', old('phone', $user->phone), ['class'=>'form-control', 'placeholder'=> 'Contact Number']) !!}
        </div>
    </div>
	<div class="form-group">
        {!! Form::label('Age', 'Age', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::number('age', old('age', $user->age), ['class'=>'form-control', 'placeholder'=> 'Age']) !!}
        </div>
    </div>
	<div class="form-group">
    {!! Form::label('gender', 'Gender', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('gender', $gender, old('gender',$user->gender), array('class'=>'form-control')) !!}
        
    </div>
	</div>
	<div class="form-group">
        {!! Form::label('Address1', 'Address1', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('address1', old('address1', @$location[0]->address1), ['class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
        </div>
    </div>
	<div class="form-group">
        {!! Form::label('Address2', 'Address2', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('address2', old('address2', @$location[0]->address2), ['id'=>'address2','class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
			{!! Form::hidden('lat', old('lat', @$location[0]->lat), ['id'=>'lat','class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
			{!! Form::hidden('long', old('long', @$location[0]->long), ['id'=>'long','class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
        <label id="error" class="error" style="color:red" for="accept"></label>
		</div>
		
    </div>
	<div class="form-group">
        {!! Form::label('Teaxtarea', 'Notes', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('notes', old('notes', $user->notes), ['class'=>'form-control', 'placeholder'=> 'Message']) !!}
        </div>
    </div>
	<div class="form-group">
    {!! Form::label('status', 'Status', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('status', $status, old('status',$user->status), array('class'=>'form-control')) !!}
        
    </div>
	</div>
	<div class="form-group">
    {!! Form::label('reset password', 'Reset Password', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! link_to_route('users.update_password', 'Reset Password', [$user->id], ['class' => 'btn btn-xs btn-warning']) !!}
        
    </div>
	</div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit(trans('quickadmin::admin.users-edit-btnupdate'), ['class' => 'btn btn-primary','id'=>'submit']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection


