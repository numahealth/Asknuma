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

{!! Form::model($faq, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.faq.update', $faq->id))) !!}

<div class="form-group">
    {!! Html::decode(Form::label('question','Question <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('question', old('question',$faq->question), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('answer', 'Answer', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('answer', old('answer',$faq->answer), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('category_id', 'Category', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('category_id', $categories, old('category_id', $faq->category_id), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('status', 'Status', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('status', $status, old('status',$faq->status), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-success')) !!}
        {!! link_to_route('admin.faq.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection