@extends('admin.layouts.master')
@section('content')
<?php
$name = DB::table('users')
        ->select('name', 'profile_pic', 'email', 'age', 'gender')
        ->where('id', '=', @$main_message)
        ->get();
$user_sent = 1;
?>
<!--**************profile details *************-->
<div class="row">
    <style>
        .upload { 
            position: relative;
            cursor: pointer !important;
            background: #5bc0de;
            padding: 8px 15px;
            margin-left: 10px;
            border: 2px solid transparent;
            color: #fff;
            border-radius: 2px;
            float: left;
            margin-top: 10px;
        }

        .upload:hover {background: #fff;

                       border: 2px solid #6ccaa5;
                       color: #6ccaa5;}

        #input-file {
            cursor: pointer;
            display: block;
            position:absolute !important;
            top:0 !important;
            left: 0 !important;
            /* start of transparency styles */
            opacity:0;
            -moz-opacity:0;
            filter:alpha(opacity:0);
            /* end of transparency styles */
            background: red;
            z-index:2; /* bring the real upload interactivity up front */
            width:100%;
            height: 100%;
        }
        .upload:hover #input-file{
            display: block;
        }
    </style>
    <div id="chatbox_female" class="col-md-12 chatbox1">
        <div class="chatboxhead">
            <div class="chatboxtitle">
               <!-- <span class="glyphicon glyphicon-heart-empty pulse"></span> --> Message Thread with
                {{ ucfirst(@$name[0]->name) }} / {{@$name[0]->age}} / {{@$name[0]->gender}}
            </div>
            <!--<div class="chatboxoptions">
                    <div class="dropdown">
                            <a href="javascript:void(0)" id="settings" data-toggle="dropdown" area-haspopup="true" area-expanded="true"><i class="fa fa-gears"></i></a> 
                            <ul class="dropdown-menu dropdown-menu-right"  aria-labelledby="settings">
                                    <li><a href="#"><i class="fa fa-flag"></i> Report</a></li>
                                    <li><a href="#"><i class="fa fa-ban"></i> Block</a></li>
                            </ul>	
                    </div>
                    <a onclick="javascript:toggleChatBoxGrowth('female')" href="javascript:void(0)"><i class="fa fa-minus"></i></a> 	
                    <a onclick="javascript:closeChatBox('female')" href="javascript:void(0)"><i class="fa fa-close"></i></a>
            </div>-->
            <br clear="all">
        </div>
        <div class="chatboxcontent">
            @include('admin.message.chats')
        </div>
        {!! Form::open(array('method'=>'post','files' => true,'route' =>'message.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}
        <div class="chatboxinput">
            <div class="alert alert-danger" style="display: none;"></div>
            <div class="alert alert-info" style="display: none;"></div>
            <textarea name="message" id="message" class="chatboxtextarea form-control" rows="5" placeholder="Please enter message here"></textarea>
            {!! Form::hidden('user_to', @$main_message) !!}
            {!! Form::hidden('parent_id',0) !!}
            <span class="filename">
                <img style="display: none; float: left; margin-top: 10px;" id="placeholder"/>
            </span>
            <span class="upload"><b>Attach picture</b> &nbsp; <i class="fa fa-upload"></i>
                {!! Form::file('profile_pic', array('id'=>'input-file', 'class'=>"chatboxtextareas form-control")) !!}
            </span> 
            {!! Form::text('embedded', old('embedded'), array('class'=>' chatboxtextareas  form-control','placeholder'=>'Embedded video', 'id'=>'embedded')) !!}
            {!! Form::hidden('profile_pic_w', 4096) !!}
            {!! Form::hidden('profile_pic_h', 4096) !!}
            <button style="color: #fff;" id="sendMessageBtn" class="btn btn-default chat_submit">
                 Send 
            </button>
        </div>

        {!! Form::close() !!}
    </div>


</div>

<style>
    .alert li:nth-of-type(2),.alert li:nth-of-type(3) {
        display:none;
    }
    iframe{width:100%!important}
    .chatboxmessagecontent img {
        width: 10%;
        padding-right: 10px;
    }
    .cke_reset_all{
        display:none;
    }
    .chatbox_text {
        float: right;
        width: 90%;
    }
</style>

@endsection

