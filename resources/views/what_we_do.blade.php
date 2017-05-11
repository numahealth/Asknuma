@extends('admin.layouts.front')
@section('content')
<img alt="Services" src="{{ URL::asset('public/images')}}/services_background.jpg"
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
    }
    div.col-md-6.col-lg-6.col-sm-6.col-xs-12.col-lg-pull-6.col-md-pull-6.col-sm-pull-6
    {
        padding-top: 100px;
        text-align: center;
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
                <img src="{{ URL::asset('public/images')}}/icon_1.jpg" alt=""
                     class="service-image"/>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 col-lg-pull-6 col-md-pull-6 col-sm-pull-6">
                <h1 style="color: #75d575;">Instant and straightforward </h1>
<!--                Try the AskNuma Facebook Messenger 
                    bot -->
                <h2>
                    health advice from AskNuma, your artificially intelligent personal health 
                    assistant. 
                    <p style="margin-top: 20px; display: none;">
                        <a target="_blank" href="https://www.messenger.com/t/numahealth">
                            <img src="{{ URL::asset('public/images/')}}/bot_for_messenger.png" alt=""
                                 style="min-width: 250px; height: 60px; margin: 0px auto;"/>
                        </a>
                    </p>
                </h2>
            </div>
        </div>
    </div>
</div>
<div style="width: 100%; margin-top: 0px; background-color: #fff;">
    <div class="container">
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <img src="{{ URL::asset('public/images')}}/icon_2.jpg" alt=""
                     class="service-image"/>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <h1 style="color: #75d575;">A growing network </h1>
                <h2>
                    of verified healthcare professionals local to you and overseas. 
                    Speak to one of our doctors confidentially about your health problems quickly. 
                    <p style="margin-top: 20px;">
                        <a href="#" data-toggle='modal' data-target='#myModal2'
                           class="btn btn-lg btn-success">
                            Signup Now
                        </a>
                    </p>
                </h2>
            </div>
        </div>
    </div>
</div>
<div style="width: 100%; margin-top: 0px; background-color: #FAFAFA;">
    <div class="container">
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 col-lg-push-6 col-md-push-6 col-sm-push-6">
                <img class="service-image" src="{{ URL::asset('public/images')}}/icon_3.png" alt=""/>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 col-lg-pull-6 col-md-pull-6 col-sm-pull-6">
                <h1 style="color: #75d575;">Your family’s own</h1>
                <h2>
                    secure health record: take it with you anywhere and stay on top of your care 
                    from your mobile phone. 
                    <p style="margin-top: 20px;">
                        <a href="#" data-toggle='modal' data-target='#myModal2'
                           class="btn btn-lg btn-success">
                            Get Started Now
                        </a>
                    </p>
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="container home_about">
    <div class="row">
        <div class="col-md-12"> 
            <!-- .fancy-heading start -->
            <section class="fancy-heading center">
                <h2 style="color: #53b553;">About Us</h2>
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
