@extends('admin.layouts.master')

@section('content')
<style>
.from_to { margin: 0 10px 10px!important;  float: right;    width: 30%;}

</style>
<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($facility, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.facility.update', $facility->id))) !!}

<div class="form-group">
    {!! Html::decode(Form::label('category_id','Category Name<span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::select('category_id', $category, old('category_id',$facility->category_id), array('class'=>'form-control','id'=>'category_id_facility')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('subcatetory_id', 'Sub category', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('subcatetory_id', $subcatetory, old('subcatetory_id',$facility->subcatetory_id), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
   {!! Html::decode(Form::label('name','Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name',$facility->name), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
        
		{!! Html::decode(Form::label('Contact','Contact', ['class'=>'col-sm-2 control-label'])) !!}
        <div class="col-sm-10">
            {!! Form::number('contact', old('contact'), ['min'=>1,'class'=>'form-control', 'placeholder'=> 'Contact Number']) !!}
        </div>
    </div>
<div class="form-group">
    {!! Form::label('address', 'Address', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('address', old('address',$facility->address), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
   {!! Html::decode(Form::label('latitude','latitude <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('latitude', old('latitude',$facility->latitude), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Html::decode(Form::label('longitude','longitude <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('longitude', old('longitude',$facility->longitude), array('class'=>'form-control')) !!}
        
    </div>
</div>
<?php 
	$times['No']='No'; $times['Yes']='Yes';
?>
<div class="form-group">
    {!! Html::decode(Form::label('open_time','24 Hours Service', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::select('all_time_service', $times, old('all_time_service',$facility->all_time_service), array('class'=>'form-control')) !!}
        
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
<?php 
 $timing=json_decode($facility->timing);
 //print_r()
	$sunday= (array)$timing->Sun;
	 
?>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			<?php $monday= (array)$timing->Mon;
			?>
			  <label>
			<?php   if(!empty($monday))
			{ ?>
				{!! Form::checkbox('Mon', '1', true)!!}
			<?php }
			else{?>
				{!! Form::checkbox('Mon', '1', false)!!}
			<?php }?> Monday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Mon_close',$time, old('Mon_close',@$monday[key($monday)]), array('class'=>'form-control')) !!}
			  </div>
	            <div class="form-group from_to">
				<label for="email">From:</label>
			
					{!! Form::select('Mon_open', $time, old('Mon_open',@key($monday)), array('class'=>'form-control')) !!}
			</div>
				</div>
	
        
		
        
    </div>
</div>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			<?php $tuesday= (array)$timing->Tue;
			?>
			  <label>
			<?php   if(!empty($tuesday))
			{ ?>
				{!! Form::checkbox('Tue', '1', true)!!}
			<?php }
			else{?>
				{!! Form::checkbox('Tue', '1', false)!!}
			<?php }?> Tuesday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Tue_close',$time, old('Tue_close',@$tuesday[key($tuesday)]), array('class'=>'form-control')) !!}
			  </div>
			  <div class="form-group from_to">
				<label for="email">From:</label>
				
					{!! Form::select('Tue_open', $time, old('Tue_open',@key($tuesday)), array('class'=>'form-control')) !!}
			</div>
	
				</div>
	
        
		
        
    </div>
</div>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			<?php $wednesday= (array)$timing->Wed;
			?>
			  <label>
			<?php   if(!empty($wednesday))
			{ ?>
				{!! Form::checkbox('Wed', '1', true)!!}
			<?php }
			else{?>
				{!! Form::checkbox('Wed', '1', false)!!}
			<?php }?> Wednesday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Wed_close',$time, old('Wed_close',@$wednesday[key($wednesday)]), array('class'=>'form-control')) !!}
			  </div>
			  <div class="form-group from_to">
				<label for="email">From:</label>
		
					{!! Form::select('Wed_open', $time, old('Wed_open',@key($wednesday)), array('class'=>'form-control')) !!}
			</div>
	
				</div>
	
        
		
        
    </div>
</div>
	<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			<?php $thursday= (array)$timing->Thu;  
			?>
			  <label>
			<?php   if(!empty($thursday))
			{ ?>
				{!! Form::checkbox('Thu', '1', true)!!}
			<?php }
			else{?>
				{!! Form::checkbox('Thu', '1', false)!!}
			<?php }?> Thursday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Thu_close',$time, old('Thu_close',@$thursday[key($thursday)]), array('class'=>'form-control')) !!}
			  </div>
			  <div class="form-group from_to">
				<label for="email">From:</label>
				
					{!! Form::select('Thu_open', $time, old('Thu_open',@key($thursday)), array('class'=>'form-control')) !!}
			</div>
	
				</div>
	
        
		
        
    </div>
</div>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			<?php $friday= (array)$timing->Fri;  
			?>
			  <label>
			<?php   if(!empty($friday))
			{ ?>
				{!! Form::checkbox('Fri', '1', true)!!}
			<?php }
			else{?>
				{!! Form::checkbox('Fri', '1', false)!!}
			<?php }?> Friday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Fri_close',$time, old('Fri_close',@$friday[key($friday)]), array('class'=>'form-control')) !!}
			  </div>
			  <div class="form-group from_to">
				<label for="email">From:</label>
					{!! Form::select('Fri_open', $time, old('Fri_open',@key($friday)), array('class'=>'form-control')) !!}
			</div>
	
				</div>
	
        
		
        
    </div>
</div>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			<?php $saturday= (array)$timing->Sat;  
			?>
			  <label>
			<?php   if(!empty($saturday))
			{ ?>
				{!! Form::checkbox('Sat', '1', true)!!}
			<?php }
			else{?>
				{!! Form::checkbox('Sat', '1', false)!!}
			<?php }?> Saturday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Sat_close',$time, old('Sat_close',@$saturday[key($saturday)]), array('class'=>'form-control')) !!}
			  </div>
			  <div class="form-group from_to">
				<label for="email">From:</label>
				
					{!! Form::select('Sat_open', $time, old('Sat_open',@key($saturday)), array('class'=>'form-control')) !!}
			</div>
	
				</div>
	
        
		
        
    </div>
</div>
<div class="form-group">
		{!! Html::decode(Form::label('open_time','Timing', ['class'=>'col-sm-2 control-label'])) !!}
		<div class="col-sm-10">
		<div class="form-inline">
  
			<div class="checkbox">
			<?php $Sunday= (array)$timing->Sun; 
			?>
			  <label>
			<?php   if(!empty($Sunday))
			{ ?>
				{!! Form::checkbox('Sun', '1', true)!!}
			<?php }
			else{?>
				{!! Form::checkbox('Sun', '1', false)!!}
			<?php }?> Sunday</label>
			</div>
	
			
			  <div class="form-group from_to">
				<label for="email"> To : </label>
				{!! Form::select('Sun_close',$time, old('Sun_close',@$Sunday[key($Sunday)]), array('class'=>'form-control')) !!}
			  </div>
			  <div class="form-group from_to">
				<label for="email">From:</label>
				
					{!! Form::select('Sun_open', $time, old('Sun_open',@key($Sunday)), array('class'=>'form-control')) !!}
			</div>
	
				</div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('status', 'Verified', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('verified', $verified, old('status',$facility->verified), array('class'=>'form-control')) !!}
        
    </div>
	</div>
<div class="form-group">
    {!! Form::label('status', 'Status', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('status', $status, old('verified',$facility->status), array('class'=>'form-control')) !!}
        
    </div>
	</div>
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.facility.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection