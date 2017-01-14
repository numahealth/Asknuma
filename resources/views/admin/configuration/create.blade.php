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

{!! Form::open(array('route' => 'admin.configuration.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
    {!! Html::decode(Form::label('page_title','Page Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::select('title', $symptom, old('title'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('type', 'Type', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('type', $type, old('type'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('position', 'Position', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('position', $position, old('position'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
 
     {!! Html::decode(Form::label('code','Code <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::textarea('code', old('code'), array('class'=>'form-control')) !!}
        
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