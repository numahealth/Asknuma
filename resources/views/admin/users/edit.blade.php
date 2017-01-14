@extends('admin.layouts.master')

@section('content')

    
        <div class="col-sm-10 col-sm-offset-2 admin_subtitle">
        <div class="row">
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
	
    {!! Form::open(['route' => ['users.update', $user->id], 'files' => true, 'class' => 'form-horizontal', 'method' => 'PATCH','id'=>'validation_form']) !!}

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
        {!! Html::decode(Form::label('name','Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
        <div class="col-sm-10">
            {!! Form::text('name', old('name', $user->name), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-edit-name_placeholder')]) !!}
        </div>
    </div>

    <div class="form-group">
       {!! Html::decode(Form::label('email','Email <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
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

    <div class="form-group hide">
        {!! Form::label('role_id', trans('quickadmin::admin.users-edit-role'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('role_id', $roles, old('role_id', $user->role_id), ['class'=>'form-control']) !!}
        </div>
    </div>
	<div class="form-group">
       {!! Html::decode(Form::label('Contact','Contact <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
        <div class="col-sm-10">
		<?php $values=array();
							  $symptom = DB::table('country_code')->get();
							  if(!empty($symptom))
								{
									 foreach($symptom as $records)
									 {
										 
										 $values[$records->phonecode]=$records->nicename.' +'.$records->phonecode;
									}
								}
							
							
				?>
				
			{!! Form::select('phone_code', $values, old('phone_code',$user->phone_code), array('id'=>'phone_code','class'=>'form-control phone_code')) !!}
            {!! Form::number('phone', old('phone', $user->phone), ['min'=>1,'class'=>'form-control', 'placeholder'=> 'Contact Number','style'=>'width:74%']) !!}
        </div>
    </div>
<div class="form-group">
				{!! Html::decode(Form::label('Age','DOB<span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
				<div class="col-sm-10">
					{!! Form::date('dob', old('dob', @$user->dob), ['class'=>'form-control', 'placeholder'=> 'Date of Birth']) !!}
				</div>
			</div>
	<div class="form-group">
        {!! Html::decode(Form::label('Age','Age <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
        <div class="col-sm-10">
            {!! Form::number('age', old('age', $user->age), ['class'=>'form-control', 'placeholder'=> 'Age','min'=>'1']) !!}
        </div>
    </div>
	<div class="form-group">
    {!! Form::label('gender', 'Gender', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('gender', $gender, old('gender',$user->gender), array('class'=>'form-control')) !!}
        
    </div>
	</div>
	<div class="form-group">
        {!! Form::label('Medical History', 'Medical History', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('medical_history', old('medical_history', @$user->medical_history), ['class'=>'form-control','rows'=>5]) !!}
        </div>
    </div>
	<div class="form-group">
        {!! Form::label('Active Medications', 'Active Medications', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('active_medications', old('active_medications', @$user->active_medications), ['class'=>'form-control','rows'=>5]) !!}
        </div>
    </div>
	<div class="form-group">
        {!! Html::decode(Form::label('Address1','Address1 <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
        <div class="col-sm-10">
            {!! Form::text('address1', old('address1', @$location[0]->address1), ['class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
        </div>
    </div>
	<div class="form-group">
       {!! Html::decode(Form::label('Town/City','Town/City <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
        <div class="col-sm-10">
            {!! Form::text('address2', old('address2', @$location[0]->address2), ['id'=>'town','class'=>'form-control', 'placeholder'=> 'Please enter Town/City','required']) !!}
			{!! Form::hidden('lat', old('lat', @$location[0]->lat), ['id'=>'lat','class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
			{!! Form::hidden('long', old('long', @$location[0]->long), ['id'=>'long','class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
        <label id="error" class="errors" style="color:red" for="accept"></label>
		</div>
		
    </div>
	<div class="form-group">
       {!! Html::decode(Form::label('country','Country <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
        <div class="col-sm-10">
		<?php $values=array();
							  $symptom = DB::table('country_code')->get();
							  if(!empty($symptom))
								{
									 foreach($symptom as $records)
									 {
										 
										 $values[$records->nicename]=$records->nicename;
									}
								}
							
							
				?>
				
			{!! Form::select('country', $values, old('country',@$location[0]->country), array('id'=>'phone_code','class'=>'form-control')) !!}
           
        </div>
    </div>
	<div class="form-group">
        {!! Form::label('Teaxtarea', 'Notes', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('notes', old('notes', $user->notes), ['class'=>'form-control', 'placeholder'=> 'Message','rows'=>5]) !!}
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
        {!! link_to_route('users.update_password', 'Reset Password', [$user->id], ['class' => 'btn btn-xs btn-info']) !!}
        
    </div>
	</div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit(trans('quickadmin::admin.users-edit-btnupdate'), ['class' => 'btn btn-danger','id'=>'submit']) !!}
        </div>
    </div>

    {!! Form::close() !!}
    <style>
.phone_code{
width:25%!important;
float:left;
margin-right:3px;
}
</style>

@endsection


