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
		{!! Form::open(['route' => ['admin.userssetting.update'], 'files' => true, 'class' => 'form-horizontal', 'method' => 'post','id'=>'validation_form']) !!}
			<div class="form-group">
				{!! Form::label('profile_pic', 'Profile Photo', array('class'=>'col-sm-2 control-label')) !!}
				<div class="col-sm-10">
						{!! Form::file('profile_pic') !!}
						{!! Form::hidden('profile_pic_w', 40960) !!}
						{!! Form::hidden('profile_pic_h', 40960) !!}
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
			<?php 
			$name = explode(' ',$user->name,2);
			//print_r($name);
			?>
			<div class="form-group">
				{!! Html::decode(Form::label('Firstname','First Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
				<div class="col-sm-10">
					{!! Form::text('first_name', old('first_name', @$name[0]), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-edit-name_placeholder')]) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Html::decode(Form::label('name','Last Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
				<div class="col-sm-10">
					{!! Form::text('last_name', old('last_name', @$name[1]), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-edit-name_placeholder')]) !!}
				</div>
			</div>
			<div class="form-group">
				  {!! Html::decode(Form::label('email','Email <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
				<div class="col-sm-10">
					{!! Form::email('email', old('email', @$user->email), ['readonly'=>'true','class'=>'form-control', 'placeholder'=> trans('quickadmin::admin.users-edit-email_placeholder')]) !!}
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
			
				{!! Form::number('phone', old('phone', $user->phone), ['class'=>'form-control', 'placeholder'=> 'Contact Number','style'=>'width:74%']) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Html::decode(Form::label('Age','Date of Birth<span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
				<div class="col-sm-10">
					{!! Form::date('dob', old('dob', @$user->dob), ['class'=>'form-control', 'placeholder'=> 'Date of Birth','id'=>'dob','onchange'=>'dobs(this.value)']) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Html::decode(Form::label('Age','Age <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
				<div class="col-sm-10">
					{!! Form::number('age', old('age', $user->age), ['id'=>'age','class'=>'form-control', 'placeholder'=> 'Age','min'=>'1']) !!}
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
				{!! Form::textarea('medical_history', old('medical_history', @$user->medical_history), ['placeholder'=>'Enter any medical conditions, allergies or important information about your health that makes you unique','class'=>'form-control','rows'=>5]) !!}
			</div>
			</div>
			<div class="form-group">
				{!! Form::label('Active Medications', 'Active Medications', ['class'=>'col-sm-2 control-label']) !!}
				<div class="col-sm-10">
					{!! Form::textarea('active_medications', old('active_medications', @$user->active_medications), ['class'=>'form-control','rows'=>5,'placeholder'=> 'Note down any medication you are currently taking']) !!}
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
					{!! Form::text('address2', old('address2', @$location[0]->address2), ['id'=>'towm','class'=>'form-control', 'placeholder'=> 'Town/City']) !!}
					{!! Form::hidden('lat', old('lat', @$location[0]->lat), ['id'=>'lat','class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
					{!! Form::hidden('long', old('long', @$location[0]->long), ['id'=>'long','class'=>'form-control', 'placeholder'=> 'Please enter address']) !!}
					<label id="error" class="error" style="color:red" for="accept"></label>
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
					{!! Form::textarea('notes', old('notes', $user->notes), ['class'=>'form-control', 'placeholder'=> 'You can make a note here of anything else important you would like to remember about your health']) !!}
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

