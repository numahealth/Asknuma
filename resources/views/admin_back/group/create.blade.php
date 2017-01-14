@extends('admin.layouts.master')

@section('content')

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

{!! Form::open(array('route' => 'admin.group.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
    {!! Form::label('name', 'Name*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('dieases', 'Dieases Name*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
	<?php $values=array();
							  $symptom = DB::table('diseases')->where('status', '=','Active')->get();
							  if(!empty($symptom))
								{
									 foreach($symptom as $records)
									 {
										 
										 $values[$records->id]=$records->disease_name;
									}
								}
							
							
				?>
        
		{!! Form::select('dieases', $values, old('dieases'), array('id'=>'dieases','placeholder'=>'Select a dieases...')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('symptom', 'Symptom Name*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
		<?php $values=array();
							  $symptom = DB::table('symptom')->where('status', '=','Active')->get();
							  if(!empty($symptom))
								{
									 foreach($symptom as $records)
									 {
										 
										 $values[$records->id]=$records->symptom_name;
									}
								}
							
							
				?>
	{!! Form::select('symptom[]', $values, old('symptom'), array('id'=>'symptom','placeholder'=>'Select a symptom...','multiple'=>'true')) !!}
 
        
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