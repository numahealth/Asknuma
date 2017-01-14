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

{!! Form::model($group, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.group.update', $group->id))) !!}

<div class="form-group">
   {!! Html::decode(Form::label('name','Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name',$group->name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
   {!! Html::decode(Form::label('dieases','Dieases Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
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
        
		{!! Form::select('dieases', $values, old('dieases',$group->dieases), array('id'=>'dieases','placeholder'=>'Select a dieases...')) !!}
        
    </div>
</div><div class="form-group">
    {!! Html::decode(Form::label('symptom','Symptom Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
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
	{!! Form::select('symptom[]', $values, old('symptom',json_decode($group->mapping)), array('id'=>'symptom','placeholder'=>'Select a symptom...','multiple'=>'true')) !!}
 
    </div>
</div>
<div class="form-group">
    {!! Form::label('status', 'Status', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('status', $status, old('status',$group->status), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-info')) !!}
      {!! link_to_route('admin.group.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-danger')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection