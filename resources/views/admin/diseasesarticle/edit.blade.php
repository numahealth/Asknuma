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

{!! Form::model($diseasesarticle, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.diseasesarticle.update', $diseasesarticle->id))) !!}

<div class="form-group">
    {!! Html::decode(Form::label('diseases_id','Diseases Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::select('diseases_id', $diseases, old('diseases_id',$diseasesarticle->diseases_id), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Html::decode(Form::label('article_title','Article Name <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('article_title', old('article_title',$diseasesarticle->article_title), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
   {!! Html::decode(Form::label('meta_title','Meta Title <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_title', old('meta_title',$diseasesarticle->meta_title), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('meta_description', 'Meta Description', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('meta_description', old('meta_description',$diseasesarticle->meta_description), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('keyword', 'Keyword', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('keyword', old('keyword',$diseasesarticle->keyword), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
        {!! Form::label('Disclaimer', 'Disclaimer', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('disclaimer', old('disclaimer',$diseasesarticle->disclaimer), ['class'=>'form-control','rows'=>'5']) !!}
        </div>
    </div>
	<div class="form-group">
        {!! Form::label('references', 'References', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('references', old('references',$diseasesarticle->references), ['class'=>'form-control','rows'=>'5']) !!}
        </div>
    </div>
<div class="form-group">
    {!! Form::label('article_description', 'Article Description', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('article_description', old('article_description',$diseasesarticle->article_description), array('class'=>'form-control ckeditor')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('article_profile', 'Article Image', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('article_profile') !!}
        {!! Form::hidden('article_profile_w', 4096) !!}
        {!! Form::hidden('article_profile_h', 4096) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('article_video', 'Article Video', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('article_video', old('article_video',$diseasesarticle->article_video), array('class'=>'form-control','Placeholder'=>'Please enter embedded code')) !!}
        
    </div>
</div>
<div class="form-group">
    {!! Form::label('status', 'Status', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('status', $status, old('status',$diseasesarticle->status), array('class'=>'form-control')) !!}
        
    </div>
</div>
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-info')) !!}
      {!! link_to_route('admin.diseasesarticle.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-danger')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection