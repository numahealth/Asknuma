@extends('admin.layouts.master')
@section('content')
<div class="modal fade" id="newCategoryDlg" role="dialog" 
     style="top: 10% !important; background-color: transparent !important;">
    <div class="modal-dialog">
        <div class="panel panel-info">
            <div class="panel-heading" style="background-color: #75d575; color: #fff; border: 1px solid #fff;">
                <div class="panel-title" style="overflow: hidden;">
                    Add New Category
                    <button id="modalCloseBtn" style="float: right;" type="button" 
                            class="btn btn-warning" data-dismiss="modal">
                        <i class="fa fa-close"></i> Close
                    </button>
                </div>
            </div>
            <div class="panel-body">
                <div class="notice_bar alert alert-warning alert-dismissable" 
                     style="display: none; margin: 10px;">
                    <!-- Notification Panel -->
                </div>
                <div class="form-group">
                    <label for="category">Name of category:</label>
                    <input type="text" class="form-control" id="categoryName"
                           required="true"/>
                </div>
                <button class="btn btn-lg btn-success" style="margin-top: 15px; float: right;" 
                        id="addCategoryBtn">
                    <span style="display: inline;" class="fa fa-save"></span> Save
                </button> 
            </div>

        </div>
    </div>
</div>
<div class="col-sm-10 col-sm-offset-2 admin_subtitle">
    <div class="row">
        <h1>
            {{ trans('quickadmin::templates.templates-view_create-add_new') }}
            <span style="float: right;">
                <a style="outline: none;" href="#" id="feedback" ></a>​
                <button class="btn btn-success" id="newCategoryBtn" 
                        data-toggle="modal" data-target="#newCategoryDlg">
                    <span class="fa fa-plus"></span> New Category
                </button>
            </span>
        </h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
            </ul>
        </div>
        @endif
    </div>
</div>

{!! Form::open(array('route' => 'admin.faq.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">

    {!! Html::decode(Form::label('question','Question <span class="required">*</span>', ['class'=>'col-sm-2 control-label'])) !!}
    <div class="col-sm-10">
        {!! Form::text('question', old('question'), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('answer', 'Answer', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('answer', old('answer'), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('category_id', 'Category', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        <select class="form-control" name="category_id" id="category_id">
            @foreach($categories as $cat)
            <option value="{{$cat->id}}">{{$cat->category_name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    {!! Form::label('status', 'Status', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('status', $status, old('status'), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2" style="text-align: right;">
        {!! Form::submit( trans('Save') , array('class' => 'btn btn-lg btn-success')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection