@extends('admin.layouts.user')
@section('content')
<?php
$name = DB::table('users')
        ->select('name', 'profile_pic', 'email', 'age', 'gender')
        ->where('id', '=', @$main_message)
        ->get();
?>
<style>
    .range-slider {
        margin: 0px 0 0 0%;
    }

    .range-slider {
        width: 100%;
    }

    .range-slider__range {
        -webkit-appearance: none;
        width: calc(100% - (73px));
        height: 10px;
        border-radius: 5px;
        background: #d7dcdf;
        outline: none;
        padding: 0;
        margin: 0;
    }
    .range-slider__range::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #75d575;
        cursor: pointer;
        -webkit-transition: background .15s ease-in-out;
        transition: background .15s ease-in-out;
    }
    .range-slider__range::-webkit-slider-thumb:hover {
        background: #1abc9c;
    }
    .range-slider__range:active::-webkit-slider-thumb {
        background: #1abc9c;
    }
    .range-slider__range::-moz-range-thumb {
        width: 20px;
        height: 20px;
        border: 0;
        border-radius: 50%;
        background: #75d575;
        cursor: pointer;
        -webkit-transition: background .15s ease-in-out;
        transition: background .15s ease-in-out;
    }
    .range-slider__range::-moz-range-thumb:hover {
        background: #1abc9c;
    }
    .range-slider__range:active::-moz-range-thumb {
        background: #1abc9c;
    }

    .range-slider__value {
        display: inline-block;
        position: relative;
        width: 30px;
        color: #fff;
        line-height: 20px;
        text-align: center;
        border-radius: 3px;
        background: #75d575;
        padding: 5px 10px;
        margin-left: 8px;
        font-weight: bold;
    }
    .range-slider__value:after {
        position: absolute;
        top: 8px;
        left: -7px;
        width: 0;
        height: 0;
        border-top: 7px solid transparent;
        border-right: 7px solid #75d575;
        border-bottom: 7px solid transparent;
        content: '';
    }

    ::-moz-range-track {
        background: #d7dcdf;
        border: 0;
    }

    input::-moz-focus-inner,
    input::-moz-focus-outer {
        border: 0;
    }
</style>
<!-- Feedback form modal -->
<div class="modal fade" id="feedbackDlg" role="dialog" 
     style="top: 30% !important; background-color: transparent !important;
     margin-bottom: 500px;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="panel panel-info">
            <div class="panel-heading" style="background-color: #75d575; color: #fff; border: 1px solid #fff;">
                <div class="panel-title">Feedback Form</div>
            </div>
            <div class="panel-body">
                <h2 style="text-align: center;">How are we doing?</h2>
                <div style="text-align: center; margin-bottom: 20px;" class="feedback-info">
                    We want to hear what you love and what you think we can do better. 
                </div>
                <div class="notice_bar alert alert-warning alert-dismissable" 
                     style="display: none;">
                    <!-- Notification Panel -->
                </div>
                <div style="margin-bottom: 4px;">
                    If you have a question or need help resolving an issue, search our 
                    <a target="_blank" href="{{ Request::root()}}/FAQ"> FAQ</a>.
                </div>
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <input type="hidden" value="" id="feedBackType"/>
                    <div class="btn-group" role="group">
                        <button id="feedbackBtn" type="button" class="btn btn-default">
                            <span class="fa fa-commenting-o visible-xs" style="color: #000;"> 
                                Feedback 
                            </span>
                            <span class="fa fa-commenting-o hidden-xs" style="color: #000;"> 
                                Give us product feedback 
                            </span>
                        </button>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="bugBtn" type="button" class="btn btn-default">
                            <span class="fa fa-bug visible-xs" style="color: #000;"> 
                                Bug 
                            </span>
                            <span class="fa fa-bug hidden-xs" style="color: #000;"> 
                                Report a bug 
                            </span>
                        </button>
                    </div>
                </div>
                <div id="reason_panel" style="display: none;">
                    <h5 style="margin-top: 30px; margin-bottom: 5px; color: #000;">
                        How satisfied are you currently?
                    </h5>
                    <span>10 means you're satisfied</span>
                    <div class="range-slider">
                        <input style="float: left; width: 90%; margin-top: 10px;" class="range-slider__range" type="range" value="8" min="0" max="10">
                        <span  class="range-slider__value">8</span>
                    </div>
                    <h5 style="margin-top: 30px; margin-bottom: 5px; color: #000;">
                        What's your feedback about?
                    </h5>
                    <div class="form-group">
                        <select class="form-control" id="reason">
                            <option value="">Please select...</option>
                            <option value="I don't understand the platform">I don't understand the platform</option>
                            <option value="I want to invest">I want to invest</option>
                            <option value="I want to partner">I want to partner</option>
                            <option value="Looking for employment">Looking for employment</option>
                            <option value="The system didn't work like i expected">The system didn't work like i expected</option>
                            <option value="I want to report a doctor">I want to report a doctor</option>
                            <option value="Complaint of our customer support">Complaint of our customer support</option>
                            <option value="Did not find what i came here for">Did not find what i came here for</option>
                        </select>
                    </div>
                </div>
                <div id="msg_panel" style="display: none;">
                    <h5 style="margin-top: 30px; margin-bottom: 5px; color: #000;">Tell us a little more...</h5>
                    <textarea id="msg" class="form-control" rows="5" placeholder="Share your experience with us. What went well, what could we have done better?"></textarea>
                    <button class="btn btn-success" style="margin-top: 15px;" id="sendFeedbackBtn">
                        <span style="display: inline;" class="fa fa-send"></span> Send Feedback
                    </button> 
                </div>

            </div>
            <div class="panel-footer" style="padding: 10px; overflow: hidden">
                <button id="modalCloseBtn" style="float: right;" type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-close"></i> Close
                </button>
            </div>
        </div>

    </div>
</div>
<!-- end Feedback form modal -->
<!--**************profile details *************-->
<div class="row">
    <div id="chatbox_female" class="col-md-12 chatbox1">
        <div class="chatboxhead">
            <a style="outline: none;" href="#" id="feedback" data-toggle="modal" data-target="#feedbackDlg"></a>​
            <div class="chatboxtitle">
                <span class="glyphicon glyphicon-question-sign pulse"></span> Type your medical question below to get an answer from one of our doctors
            </div>
            <div class="chatboxoptions">
                <div class="dropdown">
                    <a href="javascript:void(0)" id="settings" data-toggle="dropdown" area-haspopup="true" area-expanded="true">
                        <i class="fa fa-gears"></i>
                    </a> 
                    <ul class="dropdown-menu dropdown-menu-right"  aria-labelledby="settings">
                        <li>
                            <a id="feedback2" href="#" data-toggle="modal" data-target="#feedbackDlg">
                                <i class="fa fa-bullhorn" style="color: green;"></i> Feedback
                            </a>
                        </li>
                    </ul>	
                </div>
            </div>
            <br clear="all">
        </div>
        <div class="chatboxcontent">

            <?php foreach ($message as $value) { ?>
                <div class="chatboxmessage <?php echo $value->user_id == 1 ? 'ltr' : ''; ?>">
                    <span class="chatboxmessagefrom">
                        <?php if ($value->user_id == 1) { ?> 
                            <img style="width:50px;" src="{{ URL::asset("public")}}/quickadmin/images/asknuma.png" /> <?php
                        } else {
                            if (@$main_message->profile_pic != '') {
                                $url = URL::asset('public/uploads/thumb') . '/' . @$main_message->profile_pic;
                            } else {

                                $url = URL::asset('public/quickadmin/images/user_profile.jpg');
                            }
                            ?> 
                            <img style="width:50px;" src="<?php echo $url; ?>" /> 
                        <?php } ?>
                    </span>
                    <div class="chatboxmessagecontent"><time datetime="2009-11-13T20:00"><?php
                            if ($value->age !== 0) {
                                echo 'Age : ' . $value->age . ' | ' . $value->gender . ' | ';
                            }
                            ?><? echo date('d M Y h:i:sA',strtotime($value->created_at)); ?> | @if($value->embedded != '')
                            <a style="cursor:pointer" data-toggle="modal" data-target="#myModalv{{ $value->id }}"> Video attachment </a>
                            @endif </time> </time> 
                        @if($value->profile_pic != '')<img style="cursor:pointer" data-toggle="modal" data-target="#myModal{{ $value->id }}" src="{{ URL::asset('public/uploads/thumb') . '/'.  $value->profile_pic }}">
                        <div class="chatbox_text">
                            <p> 
                                <?php echo $value->message; ?>
                            </p>
                        </div>
                        @else
                        <?php echo $value->message; ?>	
                        @endif
                        <div class="cl"></div>
                    </div>
                </div>
                <div class="modal fade" id="myModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Attachment</h4>
                            </div>
                            <div class="modal-body">
                                @if($value->profile_pic != '')<img  style="width: 100%; cursor:pointer" src="{{ URL::asset('public/uploads') . '/'.  $value->profile_pic }}">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myModalv{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Video Attachment</h4>
                            </div>
                            <div class="modal-body">
                                <?php echo $value->embedded ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Attachment</h4>
                            </div>
                            <div class="modal-body">
                                @if($value->profile_pic != '')<img  style="width: 100%; cursor:pointer" src="{{ URL::asset('public/uploads') . '/'.  $value->profile_pic }}">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myModalv{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Video Attachment</h4>
                            </div>
                            <div class="modal-body">
                                <?php echo $value->embedded ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        {!! Form::open(array('method'=>'post','route' =>'admin.usermessage.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal','files'=>'true')) !!}
        <div class="chatboxinput">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    {!! implode('', $errors->all('
                    <li class="error">:message</li>
                    ')) !!}
                </ul>
            </div>
            @endif


            <textarea name="message" id="message" class="chatboxtextarea form-control ckeditor" rows="5" placeholder=" Write your question, comment, or request here" ></textarea>
            {!! Form::hidden('user_to',1) !!}
            {!! Form::hidden('parent_id',0) !!}
            <span class="upload"><b>Attach picture</b> &nbsp; <i class="fa fa-upload"></i>

                {!! Form::file('profile_pic',array('id'=>'input-file', 'class'=>"chatboxtextareas form-control")) !!}
                <span class="filename"></span></span> 
            {!! Form::text('embedded', old('embedded'), array('class'=>' chatboxtextareas  form-control','placeholder'=>'Embedded video')) !!}
            {!! Form::hidden('profile_pic_w', 4096) !!}
            {!! Form::hidden('profile_pic_h', 4096) !!}
            <button type="submit" class="btn btn-default chat_submit">Submit</button>
        </div>

        {!! Form::close() !!}
    </div>


</div>
<style>
    .alert li:nth-of-type(2),.alert li:nth-of-type(3) {
        display:none;
    }
    iframe{width:100%!important;}
    .chatboxmessagecontent img {
        width: 10%;
        padding-right: 10px;
    }

    .chatbox_text {
        float: right;
        width: 90%;
    }
</style>
<a href="#" id="welcome_message" class="btn btn-info hide"  data-toggle="modal" data-target="#ask_doctor"  >Ask A Doctor</a>
<div class="modal fade" id="ask_doctor" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:#75d575;"> Welcome, {{ ucwords(Auth::user()->name) }}</h4>
            </div>
            <div class="modal-body">
                Welcome to your personal Numa Account! This is where you can chat to one of our healthcare professionals, fill our your personal health profile & find healthcare products and services that you need. Before you get going, there are a few things you can do to make your experience awesome.
                <br/>  <br/>Firstly, go to My Profile and change your password to something secure and memorable then tell us a bit more about yourself. You can upload a picture and note down and diseases or allergies you have had in the past. This all helps us to create a more personalised service for you. Go to your Messages and tell one of our doctors that this is your first time logging on so we can set up your first appointment. If you have any questions, send us an email on info@numa.io for a quick response!

                <div class="form-group">
                    </br>
                    <label><input id="dont_show" type="checkbox" value=""> Don't show this message again.</label>
                </div>
                <button id="close_popup" type="button" class="btn btn-success" style=" float:none" data-toggle="modal" data-dismiss="modal" >Submit</button>



            </div>

        </div>
    </div>
</div>
<style>
    .cke_reset_all {
        display: none;
    }
    .cke_chrome
    {
        margin-bottom:3px;
    }
</style>
<script src="<?php url('public/user/assets/plugins/ckeditor/ckeditor.js'); ?>"></script>			
@endsection


