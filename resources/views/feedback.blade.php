@extends('admin.layouts.front')
@section('content')
<div class="container" style="margin-top: 60px;">
    <style>
        .feedback-info{
            font-weight: 200 !important;
            color: #484848 !important;
            margin: 0px !important;
            word-wrap: break-word !important;
            font-size: 15px !important;
            line-height: 24px !important;
            margin-bottom: 20px !important;
        }
    </style>
    <div class="row">
        <div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
            <ul class="list-group">
                <li class="list-group-item" style="background-color: #75d575; color: #fff;">
                    Popular Questions
                </li>
                <?php
                $faqs = DB::table('faq')
                        ->whereIn('status', ['active', 'Active'])
                        ->inRandomOrder()
                        ->limit(12)
                        ->get();
                ?>  
                <?php foreach ($faqs as $faq) { ?>
                    <li class="list-group-item">
                        <a href="{{@Request::root()}}/FAQ">
                            <?php echo $faq->question; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-offset-1 col-lg-offset-1 col-md-8 col-lg-8">
            <h2>How are we doing?</h2>
            <div class="notice_bar alert alert-warning alert-dismissable" style="display: none; margin: 10px;">
                <!-- Notification Panel -->
            </div>
            <div class="feedback-info">
                We want to hear what you love and what you think we can do better. 
                We always respond to every piece of feedback as soon as we can.
                <br/><br/>
                If you have a question or need help resolving an issue, search our Help Center.
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
                <div class="btn-group hidden-xs" role="group" style="display: none;">
                    <button id="generalBtn" type="button" class="btn btn-default">
                        <span class="fa fa-bug visible-xs" style="color: #000;"> 
                            General 
                        </span>
                        <span class="fa fa-bug hidden-xs" style="color: #000;"> 
                            General Feedback
                        </span>
                    </button>
                </div>
            </div>
            <div id="interest_panel" style="display: none;">
                <h5 style="margin-top: 30px; margin-bottom: 5px;">I'm interested in Numa as a:</h5>
                <div class="form-group">
                    <select class="form-control" id="interest">
                        <option value="">Please select...</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Patient">Patient</option>
                        <option value="Investor">Investor</option>
                        <option value="Partner">Partner</option>
                        <option value="Engineer">Engineer</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
            </div>
            <div id="reason_panel" style="display: none;">
                <h5 style="margin-top: 30px; margin-bottom: 5px;">What's your feedback about?</h5>
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
                <h5 style="margin-top: 30px; margin-bottom: 5px;">Tell us a little more...</h5>
                <textarea id="msg" class="form-control" rows="5" placeholder="Share your experience with us. What went well, what could we have done better?"></textarea>
                <button class="btn btn-success" style="margin-top: 15px;" id="sendFeedbackBtn">
                    <span style="display: inline;" class="fa fa-send"></span> Send Feedback
                </button> 
            </div>
        </div>
    </div>   
</div>
@endsection
