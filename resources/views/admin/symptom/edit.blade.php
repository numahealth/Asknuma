@extends('admin.layouts.master')

@section('content')


    <div class="col-sm-10 col-sm-offset-2 admin_subtitle">
    <div class="row">
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

{!! Form::model($symptom, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.symptom.update', $symptom->id))) !!}

<div class="form-group">
    {!! Html::decode(Form::label('symptom_name','Symptom Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('symptom_name', old('symptom_name',$symptom->symptom_name), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Html::decode(Form::label('symptom','Search Keyword <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        
        <?php $values=array();
							  $symptoms = DB::table('searchkeyword')->where('status','=','Active')->get();
							  
							  if(!empty($symptoms))
								{
									 foreach($symptoms as $records)
									 {
										 
										 $values[$records->id]=$records->keyword;
									}
								}
							
							
				?>
	{!! Form::select('search_keyword[]', $values, old('search_keyword',json_decode(@$maps->mapping)), array('id'=>'search_keyword','placeholder'=>'Select a search keyword...','multiple'=>'true')) !!}
 
    </div>
</div>
<div class="form-group">
    {!! Form::label('symptom_description', 'Symptom Description', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('symptom_description', old('symptom_description',$symptom->symptom_description), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('status', 'Status', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('status', $status, old('status',$symptom->status), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-info')) !!}
      {!! link_to_route('admin.symptom.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-danger')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection