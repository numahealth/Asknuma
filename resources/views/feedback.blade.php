@extends('admin.layouts.front')
@section('content')
<div class="container" style="margin-top: 60px;">
    <style>
        .feedback-info{
            font-weight: 200 !important;
            color: #484848 !important;
            margin: 0px !important;
            word-wrap: break-word !important;
            font-size: 17px !important;
            line-height: 24px !important;
            margin-bottom: 20px !important;
        }
    </style>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <ul class="list-group">
                <li class="list-group-item" style="background-color: #75d575; color: #fff;">Popular Questions</li>
                <li class="list-group-item"><a href="#">Can i speak with real doctors?</a></li>
                <li class="list-group-item"><a href="#">Can i pay in Naira?</a></li>
                <li class="list-group-item"><a href="#">Are their hidden charges</a></li>
                <li class="list-group-item"><a href="#">Is my information safe</a></li>
            </ul>
        </div>
        <div class="col-md-offset-1 col-lg-offset-1 col-md-8 col-lg-8">
            <h2>How are we doing?</h2>
            <div class="feedback-info">
                We want to hear what you love and what you think we can do better. 
                We always respond to every piece of feedback as soon as we can.
                <br/><br/>
                If you have a question or need help resolving an issue, search our Help Center.
            </div>
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default">
                        <span class="fa fa-commenting-o" style="color: #000;"> 
                            Give us product feedback 
                        </span>
                    </button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default">
                        <span class="fa fa-bug" style="color: #000;"> 
                            Report a bug 
                        </span>
                    </button>
                </div>
            </div>
            <h5 style="margin-top: 30px; margin-bottom: 5px;">I'm interested in Numa as a:</h5>
            <div class="form-group">
                <select class="form-control" id="asPerson">
                    <option>Please select...</option>
                    <option>Doctor</option>
                    <option>Patient</option>
                    <option>Investor</option>
                    <option>Partner</option>
                    <option>Software Engineer</option>
                    <option>Others</option>
                </select>
            </div>
            <h5 style="margin-top: 30px; margin-bottom: 5px;">What's your feedback about?</h5>
            <div class="form-group">
                <select class="form-control" id="asPerson">
                    <option>Please select...</option>
                    <option>Doctor</option>
                    <option>Patient</option>
                    <option>Investor</option>
                    <option>Partner</option>
                    <option>Software Engineer</option>
                    <option>Others</option>
                </select>
            </div>
            <h5 style="margin-top: 30px; margin-bottom: 5px;">Tell us a little more...</h5>
            <textarea class="form-control" rows="5" placeholder="Share your experience with us. What went well, what could we have done better?"></textarea>
        </div>
    </div>   
</div>
@endsection
