@extends('admin.layouts.master')
@section('content')
<div class="col-sm-12 admin_subtitle">
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .card-container {
            padding: 2px 16px;
        }

        .card img{
            margin-left: 20px;
            margin-top: 5px;
        }

    </style>

    <div class="row" style="margin-bottom: 30px; margin-right: -20px;">
        <?php if ($selectedFeedback != null) { ?>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <input type="hidden" name="feedback_id" id="feedback_id" value="<?php echo $selectedFeedback[0]->id; ?>"/>
                <div class="card">
                    <?php if ($selectedFeedback[0]->profile_pic != null && $selectedFeedback[0]->profile_pic != '') { ?>
                        <img src="<?php echo url('public/uploads/thumb') . '/' . $selectedFeedback[0]->profile_pic; ?>">
                    <?php } else { ?>
                        <img style="width:50px" src="{{ URL::asset('public/quickadmin/images/user_profile.jpg') }}">
                    <?php } ?>
                    <div class="card-container">
                        <h4><b><?php echo $selectedFeedback[0]->name; ?></b></h4> 
                        <p><?php echo '<b>Email:   </b><span style="margin-left: 33px;">' . $selectedFeedback[0]->email . '</span>'; ?></p> 
                        <p><?php echo '<b>Phone: </b><span style="margin-left: 25px;">' . $selectedFeedback[0]->phone . '</span>'; ?></p>
                        <p><?php echo '<b>Age:  </b><span style="margin-left: 41px;">' . $selectedFeedback[0]->age . '</span>'; ?></p> 
                        <p><?php echo '<b>Gender:  </b><span style="margin-left: 20px;">' . $selectedFeedback[0]->gender . '</span>'; ?></p> 
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <blockquote>
                    <p><?php echo $selectedFeedback[0]->feedback_message; ?></p>
                    <footer><?php echo $selectedFeedback[0]->created_at; ?></footer>
                </blockquote>
                <h3 style="padding-left: 25px;"><?php echo 'Satisfaction Level: ' . $selectedFeedback[0]->satisfaction_level . '/10'; ?></h3>
            </div>
        <?php } else { ?>
        <div style="margin-top: 100px; text-align: center;">
            <span class="alert alert-danger">Unathorized Operation: Please back out!</span>
        </div>
        <?php } ?>
    </div>
    <div class="row" style="margin-bottom: 20px;">
        <button class="btn btn-success" style="float: right;" id="replyBtn">
            <span style="display: inline;" class="fa fa-reply"></span> Reply
        </button> 
    </div>
    <div class="notice_bar alert alert-warning alert-dismissable" 
         style="display: none;">
        <!-- Notification Panel -->
    </div>
    <div class="row" style="margin-bottom: 20px;">
        <div id="msg_panel" style="display: none;">
            <h5 style="margin-top: 30px; margin-bottom: 5px; color: #000;">Message</h5>
            <textarea id="msg" class="form-control" rows="5" placeholder="Type your reply here"></textarea>
            <button class="btn btn-success" style="margin-top: 15px; float: right;" id="sendReplyBtn">
                <span style="display: inline;" class="fa fa-send"></span> Send Reply
            </button> 
        </div>
    </div>
</div>
@endsection