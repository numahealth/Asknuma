@extends('admin.layouts.user')

@section('content')
<div class="row" style="background:#fff; padding-top:30px; margin-bottom:25px;">
    <div class="col-md-8">
        <div class="col-sm-10 col-sm-offset-2 admin_subtitle">
            <div class="row">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {!! implode('', $errors->all('
                        <li class="error">:message</li>
                        ')) !!}
                    </ul>
                </div>
                @endif
            </div>
        </div>
        {!! Form::open(['route' => ['admin.userssetting.pass_update'], 'files' => true, 'class' => 'form-horizontal', 'method' => 'post','id'=>'password_reset_form']) !!}
        <div class="row">
            <div class="col-md-2 col-sm-2"></div>
            <div style="display: none;" class="alert alert-danger col-md-10 col-sm-10" id="notice_panel"></div>
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Current Password', ['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::password('current_password', ['class'=>'form-control', 'placeholder'=>'Current password']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('password', 'New Password', ['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'New password']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Retype New Password', ['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::password('confirm_password', ['class'=>'form-control', 'placeholder'=>'Retype new password']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                {!! Form::submit(trans('quickadmin::admin.users-edit-btnupdate'),
                ['class' => 'btn btn-danger','id'=>'submit']) !!}
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
<script>
    
    function dobs(id)
    {
        var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var firstDate = new Date(id);
        var secondDate = new Date();

        var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime()) / (oneDay)));
        var year = diffDays / 365;
        $('#age').val(year.toFixed(0));

    }
</script>
@endsection
@section('page_title')
<span>Change your password</span>
@endsection
@section('page_subtitle')
<span>A strong password includes a mix of Numbers, Symbols, Capital Letters, and Lower-Case Letters.</span>
@endsection
<style>
    .phone_code{
        width:25%!important;
        float:left;
        margin-right:3px;
    }
    .required{
        color:red;
    }
</style>

