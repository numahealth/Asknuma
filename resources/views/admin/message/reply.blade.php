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

{!! Form::open(array('method'=>'post','files' => true,'route' =>'message.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal','id'=>'validation_form')) !!}
									{!! Form::hidden('parent_id',0) !!}
									{!! Form::hidden('sent_by',1) !!}
									<?php $values=array();
									  $symptom = DB::table('users')->where('role_id', '!=','1')->get();
									  if(!empty($symptom))
										{
											 foreach($symptom as $records)
											 {
												 
												 $values[$records->id]=$records->name;
											}
										}
									
									?>
									<div class="form-group">
										{!! Form::label('UserName', 'User Name', array('class'=>'col-sm-2 control-label')) !!}
										<div class="col-sm-10">
											{!! Form::select('user_to', $values, old('user_to'), array('class'=>'','id'=>"dieases")) !!}
											
										</div>
									</div>
									<div class="form-group">
										{!! Html::decode(Form::label('message','Message <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
										<div class="col-sm-10">
											{!! Form::textarea('message', old('message'), array('class'=>'form-control ckeditor')) !!}
											
										</div>
									</div>
									<div class="form-group">
										{!! Form::label('', '', array('class'=>'col-sm-2 control-label')) !!}
										<div class="col-sm-10">
											{!! Form::file('profile_pic') !!}
		       		                                                        {!! Form::hidden('profile_pic_w', 4096) !!}
                                                                                        {!! Form::hidden('profile_pic_h', 4096) !!}
											
										</div>
									</div>
                                                                           <div class="form-group">
                                                                             {!! Form::label('disease_name', 'Embedded video', array('class'=>'col-sm-2 control-label')) !!}
                                                                             <div class="col-sm-10">
                                                                             {!! Form::text('embedded', old('embedded'), array('class'=>'form-control')) !!}
        
                                                                            </div>
                                                                           </div>
									<div class="form-group">
										<div class="col-sm-10 col-sm-offset-2">
										  {!! Form::submit( 'Send' , array('class' => 'btn btn-info')) !!}
										</div>
									</div>

									{!! Form::close() !!}
<style>
.alert li:nth-of-type(2),.alert li:nth-of-type(3) {
  display:none;
}
.cke_reset_all{
	display:none;
}
</style>

@endsection