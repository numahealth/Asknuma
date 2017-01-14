@extends('admin.layouts.master')

@section('content')
<style>
.from_to { margin: 0 10px 10px!important;  float: right;    width: 30%;}

</style>
<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::open(array('route' => 'admin.facility.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
   
    {!! Html::decode(Form::label('category_id','Category Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::select('category_id', $category, old('category_id'), array('class'=>'form-control','id'=>'category_id_facility')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('subcatetory_id', 'Sub category', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('subcatetory_id', $subcatetory, old('subcatetory_id'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Html::decode(Form::label('name','Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
        
		{!! Html::decode(Form::label('Contact','Contact ', ['class'=>'col-sm-2 control-label'])) !!}
        <div class="col-sm-10">
            {!! Form::number('contact', old('contact'), ['min'=>1,'class'=>'form-control', 'placeholder'=> 'Contact Number']) !!}
        </div>
    </div>
<div class="form-group">
    {!! Form::label('address', 'Address', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('address', old('address'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
 
    {!! Html::decode(Form::label('latitude','latitude <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('latitude', old('latitude'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    
    {!! Html::decode(Form::label('longitude','longitude <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('longitude', old('longitude'), array('class'=>'form-control')) !!}
        
    </div>
</div>

<?php 
	$times['No']='No'; $times['Yes']='Yes';
?>
<div class="form-group">
    {!! Html::decode(Form::label('open_time','24 Hours Service', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::select('all_time_service', $times, old('all_time_service'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<?php 
for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
    for($mins=0; $mins<60; $mins+=30) // the interval for mins is '30'
       $time[str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT)] =str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT);
	//$time['9:00']='9:00 Am'; $time['9:30']='9:30 Am';
?>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			  <label><input value="1" name="Mon" type="checkbox"> Monday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Mon_close',$time, old('Mon_close'), array('class'=>'form-control')) !!}
			  </div>
			  <div class="form-group from_to">
				<label for="email">From:</label>
					{!! Form::select('Mon_open', $time, old('Mon_open'), array('class'=>'form-control')) !!}
			</div>
	
				</div>
	
        
		
        
    </div>
</div>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			  <label><input value="1" name="Tue" type="checkbox"> Tuesday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Tue_close',$time, old('Tue_close'), array('class'=>'form-control')) !!}
			  </div>
				<div class="form-group from_to">
				<label for="email">From:</label>
					{!! Form::select('Tue_open', $time, old('Tue_open'), array('class'=>'form-control')) !!}
			</div>
				</div>
	
        
		
        
    </div>
</div>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			  <label><input value="1" name="Wed" type="checkbox"> Wednesday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Wed_close',$time, old('Wed_close'), array('class'=>'form-control')) !!}
			  </div>
			<div class="form-group from_to">
				<label for="email">From:</label>
					{!! Form::select('Wed_open', $time, old('Wed_open'), array('class'=>'form-control')) !!}
			</div>
				</div>
	
        
		
        
    </div>
</div>
	<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			  <label><input value="1" name="Thu" type="checkbox"> Thursday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Thu_close',$time, old('Thu_close'), array('class'=>'form-control')) !!}
			  </div>
			  <div class="form-group from_to">
				<label for="email">From:</label>
					{!! Form::select('Thu_open', $time, old('Thu_open'), array('class'=>'form-control')) !!}
			</div>
	
				</div>
	
        
		
        
    </div>
</div>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			  <label><input value="1" name="Fri" type="checkbox"> Friday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Fri_close',$time, old('Fri_close'), array('class'=>'form-control')) !!}
			  </div>
				<div class="form-group from_to">
				<label for="email">From:</label>
					{!! Form::select('Fri_open', $time, old('Fri_open'), array('class'=>'form-control')) !!}
			</div>
				</div>
	
        
		
        
    </div>
</div>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			  <label><input value="1" name="Sat" type="checkbox"> Saturday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Sat_close',$time, old('Sat_close'), array('class'=>'form-control')) !!}
			  </div>
			  <div class="form-group from_to">
				<label for="email">From:</label>
					{!! Form::select('Sat_open', $time, old('Sat_open'), array('class'=>'form-control')) !!}
			</div>
	
				</div>
	
        
		
        
    </div>
</div>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			  <label><input value="1" name="Sun" type="checkbox"> Sunday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Sun_close',$time, old('Sun_close'), array('class'=>'form-control')) !!}
			  </div>
	         <div class="form-group from_to">
				<label for="email">From : </label>
					{!! Form::select('Sun_open', $time, old('Sun_open'), array('class'=>'form-control')) !!}
			</div>
				</div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('status', 'Verified', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('verified', $verified, old('verified'), array('class'=>'form-control')) !!}
        
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
      {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection