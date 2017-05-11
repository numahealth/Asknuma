@extends('admin.layouts.front')
@section('content')
<img alt="About Numa" src="{{ URL::asset('public/images')}}/about_icon1.jpg"
     style="width: 100%; max-height: 700px; margin-top: -25px;"/>
<style>
    .service-image{
        max-width: 300px; 
        max-height: 500px; 
        margin: 0px auto;
    }

    @media(max-width: 350px){
        .service-image{
            max-width: 200px; 
            max-height: 400px;
        }
    }

    @media(max-width: 260px){
        .service-image{
            max-width: 150px; 
            max-height: 350px;
        }
    }

    div.col-md-6.col-lg-6.col-sm-6.col-xs-12, 
    div.col-md-6.col-lg-6.col-sm-6.col-xs-12.col-lg-push-6.col-md-push-6.col-sm-push-6{
        padding: 50px;
        text-align: justify;
    }
    div.col-md-6.col-lg-6.col-sm-6.col-xs-12.col-lg-pull-6.col-md-pull-6.col-sm-pull-6
    {
        padding-top: 50px;
        text-align: justify;
    }

    @media(max-width: 768px){
        div.col-md-6.col-lg-6.col-sm-6.col-xs-12, 
        div.col-md-6.col-lg-6.col-sm-6.col-xs-12.col-lg-push-6.col-md-push-6.col-sm-push-6,
        div.col-md-6.col-lg-6.col-sm-6.col-xs-12.col-lg-pull-6.col-md-pull-6.col-sm-pull-6
        {
            padding: 15px;
        }
    }

</style>
<div style="width: 100%; margin-top: 0px; background-color: #FAFAFA;">
    <div class="container">
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 col-lg-push-6 col-md-push-6 col-sm-push-6"
                 style="padding: 50px;">
                <img src="{{ URL::asset('public/images')}}/about_icon2.png" alt=""
                     class="service-image"/>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 col-lg-pull-6 col-md-pull-6 col-sm-pull-6">
                <h1 style="color: #75d575; text-align: left;">Numa is a digital</h1>
                <h5>
                     health company run by technology experts and a dedicated team of healthcare 
                     professionals. Our carefully selected doctors have decades of experience 
                     providing high quality care to patients from every continent.
                    <p style="margin-top: 20px;">
                        <a href="#" data-toggle='modal' data-target='#myModal2'
                           class="btn btn-lg btn-success">
                            Signup Now
                        </a>
                    </p>
                </h5>
            </div>
        </div>
    </div>
</div>
<div style="width: 100%; margin-top: 0px; background-color: #fff;">
    <div class="container">
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <img src="{{ URL::asset('public/images')}}/about_icon3.png" alt=""
                     class="service-image"/>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <h1 style="color: #75d575; text-align: left;">Numa was born</h1>
                <h5>
                     out of a frustration with how difficult to understand, expensive and 
                     scary healthcare can be. With the Numa platform, patients take back 
                     control of their health, healthcare professionals offer higher quality 
                     services to their clients, healthcare organisations become more responsive
                     to their population’s needs.
                    <p style="margin-top: 20px;">
                        <a href="#" data-toggle='modal' data-target='#myModal2'
                           class="btn btn-lg btn-success">
                            Signup Now
                        </a>
                    </p>
                </h5>
            </div>
        </div>
    </div>
</div>
<div class="container home_about">
    <div class="row">
        <div class="col-md-12"> 
            <!-- .fancy-heading start -->
            <section class="fancy-heading center">
                <h2 style="color: #53b553;">Numa at a glance</h2>
            </section>
            <!-- .fancy-heading end -->

            <p class="text-center"> 
                Numa Health builds delightful healthcare tools, made specially for busy achievers,
                that puts healthcare back in your hands. 
            </p>

            <div class="col-md-12 home_about1"> 
                <div class="col-md-4 col-sm-4 col-xs-12"> <img src="{{ URL::asset('public/front/img') . '/girl.png' }}"> 

                    <p> Your very own artificially intelligent health assistant</p>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12"> <img src="{{ URL::asset('public/front/img') . '/book.png' }}">

                    <p> High quality health advice </p>
                </div>         

                <div class="col-md-4 col-sm-4 col-xs-12"> <img src="{{ URL::asset('public/front/img') . '/hospital.png' }}"> 
                    <p> Find vetted specialists, pharmacies and health facilities near you</p>
                </div>

            </div>

        </div>
        <!-- .col-md-12 end --> 
    </div>
    <!-- .row end --> 

</div>   
@endsection
