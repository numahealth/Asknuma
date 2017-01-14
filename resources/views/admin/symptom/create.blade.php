@extends('admin.layouts.master')

@section('content')

    <div class="col-sm-10 col-sm-offset-2 admin_subtitle">
    <div class="row">

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

{!! Form::open(array('route' => 'admin.symptom.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
	{!! Html::decode(Form::label('symptom_name','Symptom Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('symptom_name', old('symptom_name'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
	{!! Html::decode(Form::label('symptom','Search Keyword <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
		<?php $values=array();
							  $symptom = DB::table('searchkeyword')->where('status', '=','Active')->get();
							  if(!empty($symptom))
								{
									 foreach($symptom as $records)
									 {
										 
										 $values[$records->id]=$records->keyword;
									}
								}
							
							
				?>
	{!! Form::select('search_keyword[]', $values, old('search_keyword'), array('id'=>'search_keyword','multiple'=>'true')) !!}
 
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('symptom_description', 'Symptom Description', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('symptom_description', old('symptom_description'), array('class'=>'form-control')) !!}
        
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
      {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-info')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection