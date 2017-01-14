@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            <h1>{{ trans('quickadmin::admin.users-create-create_user') }}</h1>

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

    {!! Form::open(['route' => 'users.store', 'files' => true, 'class' => 'form-horizontal']) !!}
		<div class="form-group">
    {!! Form::label('profile_pic', 'Profile Photo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('profile_pic') !!}
        {!! Form::hidden('profile_pic_w', 4096) !!}
        {!! Form::hidden('profile_pic_h', 4096) !!}
        {!! Form::hidden('updated_by', Auth::user()->id) !!}
    </div>
</div>
	
    <div class="form-group">
        {!! Form::label('name', trans('quickadmin::admin.users-create-name'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-create-name_placeholder')]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('email', trans('quickadmin::admin.users-create-email'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-create-email_placeholder')]) !!}
        </div>
    </div>


    <div class="form-group">
        {!! Form::label('role_id', trans('quickadmin::admin.users-create-role'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('role_id', $roles, old('role_id'), ['class'=>'form-control']) !!}
        </div>
    </div>
	<div class="form-group">
        {!! Form::label('Contact', 'Contact', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::number('phone', old('phone'), ['class'=>'form-control', 'placeholder'=> 'Contact Number']) !!}
        </div>
    </div>
	<div class="form-group">
        {!! Form::label('Age', 'Age', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::number('age', old('age'), ['class'=>'form-control', 'placeholder'=> 'Age']) !!}
        </div>
    </div>
	<div class="form-group">
    {!! Form::label('gender', 'Gender', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('gender', $gender, old('gender'), array('class'=>'form-control')) !!}
        
    </div>
	</div>
	<div class="form-group">
        {!! Form::label('Address1', 'Address1', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('address1', old('address1'), ['class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
        </div>
    </div>
	<div class="form-group">
        {!! Form::label('Address2', 'Address2', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('address2', old('address2'), ['id'=>'address2','class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
			{!! Form::hidden('lat', old('lat'), ['id'=>'lat','class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
			{!! Form::hidden('long', old('long'), ['id'=>'long','class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
        <label id="error" class="error" style="color:red" for="accept"></label>
		</div>
		
    </div>
	<div class="form-group">
        {!! Form::label('Teaxtarea', 'Notes', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('notes', old('notes'), ['class'=>'form-control', 'placeholder'=> 'Message']) !!}
        </div>
    </div>
	<div class="form-group">
    {!! Form::label('status', 'Status', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('status', $status, old('status'), array('class'=>'form-control')) !!}
        
    </div>
</div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit(trans('quickadmin::admin.users-create-btncreate'), ['class' => 'btn btn-primary' ,'id'=>'submit']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection


