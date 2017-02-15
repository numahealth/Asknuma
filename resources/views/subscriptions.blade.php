@extends('admin.layouts.front')
@section('content')
<div class="container"> 
    <style>
        .columns {
            float: left;
            width: 33.3%;
            padding: 8px;
        }

        .price {
            list-style-type: none;
            border: 1px solid #eee;
            margin: 0;
            padding: 0;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .price:hover {
            box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
        }

        .price .header {
            background-color: #111;
            color: white;
            font-size: 22px;
        }

        .price li {
            border-bottom: 1px solid #eee;
            padding: 13px;
            text-align: center;
        }

        .price .grey {
            background-color: #eee;
            font-size: 20px;
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 25px;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
        }

        @media only screen and (max-width: 600px) {
            .columns {
                width: 100%;
            }
        }

        .btnPanel {
            width: 100%; 
            clear: both;
            padding-right: 10px;
        }

        @media (max-width: 700px) and (min-width: 600px) {
            .price .header {
                font-size: 17px!important;
            }
        }

        .alert-c {
            padding: 5px;
            padding-top: 15px;
            padding-left: 20px;
            background-color: #ff9800; 
            color: white;
            margin-bottom: 10px;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }


    </style>
    <div class="row" style="overflow: hidden; margin-bottom: 15px;">
        <div class="alert-c">
            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
            <?php
            if (Auth::user() == NULL) {
                echo '<h5 style="color: #fff;">Please login or create an account first!</h5>';
            } else if (Auth::user()->subscribed == TRUE) {
                echo '<h6 style="color: #fff;">You have already subscribed! '
                . ' Please click on \'My Account\' on the menu bar to get started!</h6>';
            } else {
                echo '<h6 style="color: #fff;">Welcome on board, please select your preferred package!</h6>';
            }
            ?>
        </div>
        <div class="col-md-12" style="border: 1px solid #F1F1F1; padding-top: 20px; border-radius: 5px;">
            <div class="columns">
                <ul class="price">
                    <li class="header" style="background-color:#4CAF50">Numa Connect</li>
                    <li class="grey">
                        Free for 1yr
                        <br/>
                        <span style="font-size: 14px; font-style: italic;">
                            &#8358; 7000/month afterwards
                        </span>
                    </li>
                    <li>
                        Confidential consultations with highly trained Numa healthcare professionals
                    </li>
                    <li>
                        48 hour response time
                    </li>
                    <li>
                        Referrals to verified specialists and therapists in the Numa Global 
                        Healthcare Professional Network 
                    </li>
                    <li>
                        Comprehensive video-health check-up with a doctor
                    </li>
                    <li>
                        Secure personal health record
                    </li>
                    <li>
                        Personal Health Library
                    </li>
                    <li class="grey">
                        <button id="connect" class="button">Select</button>
                    </li>
                </ul>
            </div>

            <div class="columns">
                <ul class="price">
                    <li class="header">Numa Protect</li>
                    <li class="grey">Available soon</li>
                    <li>
                        All of the features of Numa <span style="font-weight: bold;">Connect</span>
                    </li>
                    <li>
                        24 hour response time 
                    </li>
                    <li>
                        Yearly system-by-system check ups, eye and hearing tests, fitness 
                        and goal planning consultations.
                    </li>
                    <li>
                        Comprehensive <span style="font-weight: bold;">in person</span > health check up with a doctor's
                    </li>
                    <li class="grey"><a style="cursor: not-allowed; background-color: #ddd;" class="button">Select</a></li>
                </ul>
            </div>

            <div class="columns" id="columns">
                <ul class="price">
                    <li class="header">Numa Comprehensive</li>
                    <li class="grey">Available soon</li>
                    <li>
                        All of the features of Numa 
                        <span style="font-weight: bold;">Connect</span > and 
                        <span style="font-weight: bold;">Protect</span >  
                    </li>
                    <li>
                        2 hour response time
                    </li>
                    <li>
                        Name up to four children on your Numa plan for comprehensive health checks. 
                    </li>
                    <li>
                        Your very own, named Numa Doctor and nurse.
                    </li>
                    <li class="grey"><a style="cursor: not-allowed; background-color: #ddd;" class="button">Select</a></li>
                </ul>
            </div>
            <div class="btnPanel">
                <span style="font-style: italic; float: right;">* Cost of consultations and travel for specialist appointments not included.</span> 
            </div>
        </div><!-- .col-md-12 end --> 
        <div class="btnPanel">
            <div class="checkbox" style="text-align: right; padding-top: 20px;">
                <label id="t_and_c_label">
                    <input type="checkbox" id="t_and_c" checked/> 
                    Stay updated about Numa services.
                </label>
            </div>
        </div>
        <div class="btnPanel">
            <button style="margin-top: 20px;" class="btn btn-medium btn-success"
                    id="subscriptionBtn">
                <span style="display: inline;">Continue</span>
                <span class="fa fa-arrow-right" style="display: inline;"> </span> 
            </button> 
        </div>
    </div>
</div>
@endsection
