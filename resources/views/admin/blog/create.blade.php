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

{!! Form::open(array('files' => true, 'route' => 'admin.blog.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">

	{!! Html::decode(Form::label('blog_name','Blog Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('blog_name', old('blog_name'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
	{!! Html::decode(Form::label('meta_title','Meta Title <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_title', old('meta_title'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('meta_description', 'Meta Description', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_description', old('meta_description'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('keyword', 'Keyword', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('keyword', old('keyword'), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
        {!! Form::label('Disclaimer', 'Disclaimer', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('disclaimer', old('disclaimer'), ['class'=>'form-control','rows'=>'5']) !!}
        </div>
    </div>
	<div class="form-group">
        {!! Form::label('references', 'References', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('references', old('references'), ['class'=>'form-control','rows'=>'5']) !!}
        </div>
    </div>
<div class="form-group">
    {!! Form::label('description', 'Blog Description', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('description', old('description'), array('class'=>'form-control ckeditor')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('blog_image', 'Blog Photo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('blog_image') !!}
        {!! Form::hidden('blog_image_w', 4096) !!}
        {!! Form::hidden('blog_image_h', 4096) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('blog_video', 'Blog Video', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('blog_video', old('blog_video'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
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