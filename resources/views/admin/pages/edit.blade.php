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

{!! Form::model($pages, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.pages.update', $pages->id))) !!}

<div class="form-group">
    {!! Html::decode(Form::label('page_title','Page Title <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('page_title', old('page_title',$pages->page_title), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Html::decode(Form::label('meta_title','Meta Title <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_title', old('meta_title',$pages->meta_title), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('meta_description', 'Meta Desription', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_description', old('meta_description',$pages->meta_description), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('keyword', 'Keyword', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('keyword', old('keyword',$pages->keyword), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('description', 'Page Description', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('description', old('description',$pages->description), array('class'=>'form-control ckeditor')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('status', 'Status', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('status', $status, old('status',$pages->status), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-info')) !!}
      {!! link_to_route('admin.pages.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-danger')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection