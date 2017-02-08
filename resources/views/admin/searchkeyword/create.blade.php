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

{!! Form::open(array('route' => 'admin.searchkeyword.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">

    {!! Html::decode(Form::label('keyword','Keyword <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('keyword', old('keyword'), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('description', 'Description', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('description', old('description'), array('class'=>'form-control')) !!}

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