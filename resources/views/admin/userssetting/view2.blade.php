@extends('admin.layouts.user')
@section('content')
<style>
    /* USER PROFILE PAGE */
    .card {
        margin-top: 20px;
        padding: 30px;
        background-color: rgba(214, 224, 226, 0.2);
        -webkit-border-top-left-radius:5px;
        -moz-border-top-left-radius:5px;
        border-top-left-radius:5px;
        -webkit-border-top-right-radius:5px;
        -moz-border-top-right-radius:5px;
        border-top-right-radius:5px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .card.hovercard {
        position: relative;
        padding-top: 0;
        overflow: hidden;
        text-align: center;
        background-color: #fff;
        background-color: rgba(255, 255, 255, 1);
    }
    .card.hovercard .card-background {
        height: 130px;
    }
    .card-background img {
        -webkit-filter: blur(25px);
        -moz-filter: blur(25px);
        -o-filter: blur(25px);
        -ms-filter: blur(25px);
        filter: blur(25px);
        margin-left: -100px;
        margin-top: -200px;
        min-width: 130%;
    }
    .card.hovercard .useravatar {
        position: absolute;
        top: 15px;
        left: 0;
        right: 0;
    }
    .card.hovercard .useravatar img {
        width: 100px;
        height: 100px;
        max-width: 100px;
        max-height: 100px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.5);
    }
    .card.hovercard .card-info {
        position: absolute;
        bottom: 14px;
        left: 0;
        right: 0;
    }
    .card.hovercard .card-info .card-title {
        padding:0 5px;
        font-size: 20px;
        line-height: 1;
        color: #262626;
        background-color: rgba(255, 255, 255, 0.1);
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }
    .card.hovercard .card-info {
        overflow: hidden;
        font-size: 12px;
        line-height: 20px;
        color: #737373;
        text-overflow: ellipsis;
    }
    .card.hovercard .bottom {
        padding: 0 20px;
        margin-bottom: 17px;
    }
    .btn-pref .btn {
        -webkit-border-radius:0 !important;
    }

    button.profile-edit-btn.btn-danger.btn-sm{
        margin-top: -25px; 
        float: right; 
        margin-right: 5px;
    }

    @media (max-width: 479px) {
        button.profile-edit-btn.btn-danger.btn-sm{
            margin-top: 5px; 
            margin-right: 15px;
            display: block;
            clear: both;
        }

    }

    @media (max-width: 360px) {

        span#hide_profile_edit{
            display: none;
        }
    }

    @media (max-width: 300px) {

        button.profile-edit-btn.btn-danger.btn-sm{
            margin-right: 50px;
        }

    }

    @media (max-width: 260px) {

        button.profile-edit-btn.btn-danger.btn-sm{
            margin-right: 100px;
        }

    }


    /* COMMON PRICING STYLES */
    .panel.price,
    .panel.price>.panel-heading{
        border-radius:0px;
        -moz-transition: all .3s ease;
        -o-transition:  all .3s ease;
        -webkit-transition:  all .3s ease;
    }
    .panel.price:hover{
        box-shadow: 0px 0px 30px rgba(0,0,0, .2);
    }
    .panel.price:hover>.panel-heading{
        box-shadow: 0px 0px 30px rgba(0,0,0, .2) inset;
    }


    .panel.price>.panel-heading{
        box-shadow: 0px 5px 0px rgba(50,50,50, .2) inset;
        text-shadow:0px 3px 0px rgba(50,50,50, .6);
    }

    .price .list-group-item{
        border-bottom:1px solid rgba(250,250,250, .5);
    }

    .panel.price .list-group-item:last-child {
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }
    .panel.price .list-group-item:first-child {
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
    }

    .price .panel-footer {
        color: #fff;
        border-bottom:0px;
        background-color:  rgba(0,0,0, .1);
        box-shadow: 0px 3px 0px rgba(0,0,0, .3);
    }


    .panel.price .btn{
        box-shadow: 0 -1px 0px rgba(50,50,50, .2) inset;
        border:0px;
    }

    /* green panel */


    .price.panel-green>.panel-heading {
        color: #fff;
        background-color: #57AC57;
        border-color: #71DF71;
        border-bottom: 1px solid #71DF71;
    }


    .price.panel-green>.panel-body {
        color: #fff;
        background-color: #65C965;
    }


    .price.panel-green>.panel-body .lead{
        text-shadow: 0px 3px 0px rgba(50,50,50, .3);
    }

    .price.panel-green .list-group-item {
        color: #333;
        background-color: rgba(50,50,50, .01);
        text-shadow: 0px 1px 0px rgba(250,250,250, .75);
    }

    #cancelSubDlg{
        top: 30% !important; background-color: transparent !important; box-shadow: none;
    }
    @media (max-width: 979px) {
        #cancelSubDlg{
            top: 10% !important;
        }
    }


</style>
<div class="row" style="background: #fff; padding-top: 30px; margin-bottom: 25px;">
    {!! Form::open(['route' => ['admin.userssetting.edit'], 'class' => 'form-horizontal', 'method' => 'get']) !!}
    <button type="submit" class="profile-edit-btn btn-danger btn-sm">
        <span class="fa fa-pencil-square-o"></span>
        <span id="hide_profile_edit">Edit Profile</span>
    </button>
    {!! Form::close() !!}
    <?php
    $name = explode(' ', $user->name, 2);
    //print_r($name);
    ?>
    <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
        <div class="card hovercard">
            <div class="card-background">
<!--                <img class="card-bkimg" alt="" src="http://lorempixel.com/100/100/people/9/">-->
            </div>
            <div class="useravatar">
                <?php
                if (@$main_message->profile_pic != '') {
                    $url = URL::asset('public/uploads/thumb') . '/' . @$main_message->profile_pic;
                } else {
                    $url = URL::asset('public/quickadmin/images/user_profile.jpg');
                }
                ?> 
                <img alt="" src="{{$url}}"/>
            </div>
            <div class="card-info"> 
                <span class="card-title">
                    <?php echo @$name[0] . ' ' . @$name[1]; ?>
                </span>
            </div>
        </div>
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" id="profile" class="btn btn-success" href="#tab1" data-toggle="tab">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <div class="hidden-xs">My Profile</div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="subscriptions" class="btn btn-default" href="#tab2" data-toggle="tab">
                    <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                    <div class="hidden-xs">My Subscriptions</div>
                </button>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1">
                <div style="border: 1px solid #ddd;">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td style="border: none;">Patient ID</td>
                                    <td style="border: none;"><?php echo $user->id; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $user->email; ?></td>
                                </tr>
                                <tr>
                                    <td>Contact</td>
                                    <td>
                                        <?php echo $user->phone_code . '-' . $user->phone; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td>
                                        <?php echo $user->dob; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Age</td>
                                    <td>
                                        <?php echo $user->age; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>
                                        <?php echo $user->gender; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Medical History</td>
                                    <td>
                                        <?php echo $user->medical_history; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Active Medications</td>
                                    <td>
                                        <?php echo $user->active_medications; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>
                                        <?php echo @$location[0]->address1; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Town/City</td>
                                    <td>
                                        <?php echo @$location[0]->address2; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>
                                        <?php echo @$location[0]->country; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td>
                                        <?php echo $user->notes; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade in" id="tab2">
                <hr/>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="panel price panel-green">
                        <div class="panel-heading arrow_box text-center">
                            <h3>
                                Numa Connect
                                <br/>
                                <span style="font-size: 14px; font-style: italic;">
                                    Free for 1yr
                                </span>
                            </h3>
                        </div>
                        <div class="panel-body text-center">
                            <p class="lead" style="font-size:20px"><strong>
                                    &#8358; 7000/month afterwards
                                </strong>
                            </p>
                        </div>
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">
                                <i class="icon-ok text-success"></i> 
                                Confidential consultations with highly trained Numa healthcare professionals
                            </li>
                            <li class="list-group-item">
                                <i class="icon-ok text-success"></i> 
                                48 hour response time
                            </li>
                            <li class="list-group-item">
                                <i class="icon-ok text-success"></i> 
                                Referrals to verified specialists and therapists in the Numa Global 
                                Healthcare Professional Network 
                            </li>
                            <li class="list-group-item">
                                <i class="icon-ok text-success"></i> 
                                Comprehensive video-health check-up with a doctor
                            </li>
                            <li class="list-group-item">
                                <i class="icon-ok text-success"></i> 
                                Secure personal health record
                            </li>
                            <li class="list-group-item">
                                <i class="icon-ok text-success"></i> 
                                Personal Health Library
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th style="text-align: left; border: none;">Subscription Date</th>
                            </tr>
                            <tr>
                                <td style="border: none;"><?php echo date('D M j, Y h:i A', strtotime($user->created_at)); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left; border: none;">Expiry Date</th>
                            </tr>
                            <tr>
                                <td style="border: none;"><?php echo date('D M j, Y h:i A', strtotime('+1 year', strtotime($user->created_at))); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <button id="connect" onclick="showCancelSubDlg();" class="btn btn-lg btn-block btn-danger">
                            <span class="fa fa-times"></span>
                            Cancel Subscription
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancelSubDlg" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="panel panel-info">
                <div class="panel-heading" style="background-color: #75d575; color: #fff; border: 1px solid #fff;">
                    <div class="panel-title" style="overflow: hidden;">
                        Canceling Subscription
                        <button id="modalCloseBtn" style="float: right;" type="button" 
                                class="btn btn-warning" data-dismiss="modal">
                            <i class="fa fa-close"></i> Close
                        </button>
                    </div>
                </div>
                <div class="panel-body">
                    <div
                        style="margin-top: 2px; margin-bottom: 10px; padding: 10px; background-color: #cc0000; color: #fff;">
                        <span class="fa fa-ban"></span> Stop
                    </div>
                    <p>
                        Canceling subscription is like disabling your Numa account and the process 
                        might not be reversible.
                    </p>
                    <p style="text-align: center;">
                        Do you want to disable your Numa account?
                    </p>
                    <h5 style="margin-top: 30px; margin-bottom: 5px; color: #000;">
                        Please tell us why you want to leave us
                    </h5>
                    <div class="form-group">
                        <select class="form-control" id="reason">
                            <option value="">Please select...</option>
                            <option value="I don't know how to use Numa">I don't know how to use Numa</option>
                            <option value="Something did not work">Something did not work</option>
                            <option value="I didn't enjoy the quality of service">
                                I didn't enjoy the quality of service
                            </option>
                            <option value="No particular reason">
                                No particular reason
                            </option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div id="msg_panel" style="display: none;">
                        <h5 style="margin-top: 30px; margin-bottom: 5px;">Tell us a little more...</h5>
                        <textarea id="msg" class="form-control" rows="5" placeholder="Confidentially share your comments with us"></textarea>
                        <div class="checkbox">
                            <label><input id="delete_data" type="checkbox" value=""/>Delete all my data with Numa</label>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-danger" style="margin-top: 15px; float: right;" 
                            id="disableAccountBtn" disabled>
                        <span style="display: inline;" class="fa fa-save"></span> Yes, disable my account
                    </button> 
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script>
                            $(document).ready(function () {
                                $("#profile").click(function () {
                                    $(this).removeClass("btn-default").addClass("btn-success");
                                    $("#subscriptions").removeClass("btn-success").addClass("btn-default");
                                });
                                $("#subscriptions").click(function () {
                                    $(this).removeClass("btn-default").addClass("btn-success");
                                    $("#profile").removeClass("btn-success").addClass("btn-default");
                                });
                            });

                            function showCancelSubDlg() {
                                $('#cancelSubDlg').modal('show');
                            }

    </script>
</div>
@endsection
@section('page_header_hider')
<style>
    #breadcrumb{
        display: none;
    }
    #panel_header{
        display: none;
    }

</style>
@endsection
