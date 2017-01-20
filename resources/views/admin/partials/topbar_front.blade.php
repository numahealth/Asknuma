<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog col-md-4" style="box-shadow:0px 2px 16px 0px #000;">   
        <!-- Modal content-->   
        <div class="col-md-12 an_login">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign In</div>
                </div>
                <div class="panel-body" style="padding-top:30px;">
                    <div class="alert alert-danger col-sm-12" id="login-alert" style="display:none"></div>

                    @if (count($errors->login) > 0)
                    <div class="alert alert-danger">

                        <ul>
                            @foreach ($errors->login->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif 
                    <form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">        
                        <div style="margin-bottom: 25px;" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="email"
                                   class="form-control"
                                   name="email" placeholder="Username*"
                                   value="{{ old('email') }}">                                     
                        </div>

                        <div style="margin-bottom: 25px;" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock "></i></span>

                            <input type="password"
                                   class="form-control" placeholder="Password*"
                                   name="password">
                        </div>

                        <div class="form-inline login_check">

                            <button type="submit"
                                    class="btn btn-info"
                                    style="margin-right: 15px;">
                                {{ trans('quickadmin::auth.login-btnlogin') }}
                            </button>





                            <input type="checkbox" class=""
                                   name="remember">{{ trans('quickadmin::auth.login-remember_me') }}



                        </div>



                        <div class="login_submint">
                            Don't have an account! 
                            <a href="#" onclick="show_register();">
                                Sign Up Here
                            </a> | 
                            <a href="{{url('forget')}}">
                                Forgot password
                            </a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog col-md-4" style="box-shadow:0px 2px 16px 0px #000;">   
        <!-- Modal content-->   
        <div class="col-md-12 an_login">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign Up</div>
                </div>
                <div class="oops">Oops - you don’t seem to have a Numa account. Register below to speak to one our doctors and build your health profile</div>

                <div class="panel-body" >
                    <div class="alert alert-danger col-sm-12" id="login-alert" style="display:none"></div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">

                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (Session::has('message'))
                    {{--*/ $forclicknregistration = 1 /*--}}
                    <div class="alert alert-success">
                        <ul><li>
                                {{ Session::get('message') }}


                            </li></ul>
                    </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" id='validation_form'>
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}"> 





                        <div class="input-group" > <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            {!! Form::text('first_name', old('first_name'), ['class'=>'form-control', 'placeholder'=> 'First Name*']) !!}
                        </div>
                        <label for="first_name" generated="true" class="error error_reg" style="display:none" ></label>
                        <div style="margin-top: 15px; " class="input-group" > <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            {!! Form::text('last_name', old('last_name'), ['class'=>'form-control', 'placeholder'=> 'Surname*']) !!}
                        </div>
                        <label for="last_name" generated="true" class="error error_reg" style="display:none" ></label>
                        <div class="input-group" style="margin-top: 15px; "> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            {!! Form::number('age', old('age'), ['class'=>'form-control', 'placeholder'=> 'Age*','min'=>'1']) !!}
                        </div>
                        <label for="age" generated="true" class="error error_reg" style="display:none;"></label>
                        <div class="input-group" style="margin-top: 15px;"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <?php
                            $gender = Array(
                                'Male' => 'Male',
                                'Female' => 'Female',
                                'Other' => 'Other'
                            );
                            ?>
                            {!! Form::select('gender', $gender, old('gender'), array('class'=>'form-control')) !!}
                        </div>
                        <label  generated="true" class="" style="display:none"></label>
                        <div class="input-group" style="margin-top: 15px; "> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            {!! Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=> 'Email*']) !!}
                        </div>
                        <label for="email" generated="true" class="error error_reg" style="display:none"></label>
                        <div class="input-group" style="margin-top: 15px; "> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <?php
                            $values = array();
                            $symptom = DB::table('country_code')->get();
                            if (!empty($symptom)) {
                                foreach ($symptom as $records) {

                                    $values[$records->phonecode] = $records->nicename . ' +' . $records->phonecode;
                                }
                            }
                            ?>
                            {!! Form::select('phone_code', $values, old('phone_code',234), array('id'=>'search_keyword','class'=>'form-control phone_code phpn_drops')) !!}

                            {!! Form::number('phone', old('phone'), ['min'=>1,'class'=>'form-control', 'placeholder'=> 'Contact Number*','style'=>'width:55%']) !!}
                        </div>

                        <label for="phone" generated="true" class="error error_reg" style="display:none"></label>
                        <div class="form-inline login_check" style="margin-top: 15px; ">
                            <button style="margin-right: 15px;  border:0;" class="btn btn-info" type="submit"> Submit </button>
                        </div>

                        {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
<div id="header-wrapper"> 
    <!-- #header.header-type-1 start -->
    <header id="header" class="header-type-1 dark"> 
        <!-- #top-bar-wrapper start -->
        <div id="top-bar-wrapper" class="clearfix"> 
            <!-- #top-bar start -->
            <div id="top-bar" class="clearfix"> 
                <!-- #quick-links start -->

                <!-- #quick-links end --> 

                <!-- #social-links start -->

                <!--ul id="social-links">
                <?php if (\Auth::check()) { ?>
                                            @if(\Auth::user()->role_id==1)
                                                    {{--*/ $href = url('users') /*--}}
                                                    
                                            @else
                                                    {{--*/ $href = url('admin/usermessage') /*--}}
                                            @endif
                                     <li> <i class="fa fa-user"></i> <a href="{{$href}}" >My Account </a> </li>
                                     @if(\Auth::user()->role_id==2)
                                                    <li> <i class="fa fa-wechat"></i> <a href="{{$href}}" id="mesg" >Message(0) </a> </li>
                                                    
                                            @endif
                                     
                <?php } else { ?>
                              <li> <i class="fa fa-lock"></i> <a id="login_anchor" href="javascript:void(0)"  data-toggle="modal" data-target="#myModal">Login </a> </li>
                              <li> <i class="fa fa-user"></i> <a id="register_anchor" href="javascript:void(0)"  data-toggle="modal" data-target="#myModal2">Sign Up</a> </li>
                <?php } ?>
                </ul-->
                <!-- #social-links end --> 
            </div>
            <!-- #top-bar end --> 
        </div>
        <!-- #top-bar-wrapper end --> 

        <!-- Main navigation and logo container -->
        <div class="header-inner"> 
            <!-- .container start -->
            <div class="container"> 
                <!-- .main-nav start -->
                <div class="main-nav"> 
                    <!-- .row start -->
                    <div class="row">
                        <div class="col-md-12"> 
                            <!-- .navbar.pi-mega start -->
                            <nav class="navbar navbar-default nav-left pi-mega" role="navigation"> 

                                <!-- .navbar-header start -->
                                <div class="navbar-header"> 
                                    <!-- .logo start -->
                                    <div class="logo"> <a href="{{url('')}}"><img src="{{ URL::asset('public/front') }}/img/Numa_logo.png" alt="AskNuma"></a> </div>
                                    <!-- logo end --> 
                                </div>
                                <!-- .navbar-header end --> 

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse">
                                    <ul class="nav navbar-nav pi-nav">
                                        <li class="<?php
                                        if (url()->current() == url('')) {
                                            echo 'dropdown pi-mega-fw current-menu-item';
                                        }
                                        ?>"> <a href="{{url('')}}">Home</a> 
                                            <!-- .dropdown-menu end --> 
                                        </li>
                                        <!-- MENU ITEM .dropdown end -->
                                        <li class="<?php
                                        if (url()->current() == url('/services')) {
                                            echo 'dropdown pi-mega-fw current-menu-item';
                                        }
                                        ?>"><a  href="{{url('/services')}}">Services</a></li>
                                        <li class="<?php
                                        if (url()->current() == url('/about ')) {
                                            echo 'dropdown pi-mega-fw current-menu-item';
                                        }
                                        ?>" ><a href="{{url('/about')}}">About</a> 
                                            <!-- .dropdown-menu end --> 
                                        </li>

                                        <!-- MENU ITEM .dropdown.pi-mega-fw end -->


                                        <li class="<?php
                                        if (url()->current() == url('/FAQ')) {
                                            echo 'dropdown pi-mega-fw current-menu-item';
                                        }
                                        ?>"><a href="{{url('/FAQ')}}">FAQs</a></li>
                                        <li class="<?php
                                        if (url()->current() == url('/blog')) {
                                            echo 'dropdown pi-mega-fw current-menu-item';
                                        }
                                        ?>"><a href="{{url('/blog')}}">Blog</a></li>
                                            <?php if (\Auth::check()) { ?>
                                            @if(\Auth::user()->role_id==1)
                                            {{--*/ $href = url('users') /*--}}

                                            @else
                                            {{--*/ $href = url('admin/usermessage') /*--}}
                                            @endif
                                            <li>  <a href="{{$href}}" >My Account </a> </li>
                                            @if(\Auth::user()->role_id==2)
                                            <li>  <a href="{{$href}}" class="mesg" >Message(0) </a> </li>

                                            @endif

                                        <?php } else { ?>
                                            <li>  <a id="login_anchor" href="javascript:void(0)"  data-toggle="modal" data-target="#myModal">Login </a> </li>
                                            <li> <a id="register_anchor" href="javascript:void(0)"  data-toggle="modal" data-target="#myModal2">Sign Up</a> </li>
                                        <?php } ?>
                                        <!--li class="<?php
                                        if (url()->current() == url('/contact_us')) {
                                            echo 'dropdown pi-mega-fw current-menu-item';
                                        }
                                        ?>"><a href="{{url('/contact_us')}}">Contact Us</a></li-->
                                    </ul>
                                    <!-- .nav.navbar-nav.pi-nav end --> 

                                    <!-- Responsive menu start -->
                                    <div id="dl-menu" class="dl-menuwrapper">
                                        <button class="dl-trigger"> </button>
                                        <ul class="dl-menu">
                                            <li> <a href="{{url('')}}">Home</a>
                                            <li class="<?php
                                            if (url()->current() == url('/services')) {
                                                echo 'dropdown pi-mega-fw current-menu-item';
                                            }
                                            ?>"><a  href="{{url('/services')}}">Services</a></li>
                                            <li class="<?php
                                            if (url()->current() == url('/about ')) {
                                                echo 'dropdown pi-mega-fw current-menu-item';
                                            }
                                            ?>" ><a href="{{url('/about')}}">About</a> 
                                            <li class="<?php
                                            if (url()->current() == url('/FAQ')) {
                                                echo 'dropdown pi-mega-fw current-menu-item';
                                            }
                                            ?>"><a href="{{url('/FAQ')}}">FAQs</a></li>
                                            <li class="<?php
                                            if (url()->current() == url('/blog')) {
                                                echo 'dropdown pi-mega-fw current-menu-item';
                                            }
                                            ?>"><a href="{{url('/blog')}}">Blog</a></li>
                                                <?php if (\Auth::check()) { ?>
                                                @if(\Auth::user()->role_id==1)
                                                {{--*/ $href = url('users') /*--}}

                                                @else
                                                {{--*/ $href = url('admin/usermessage') /*--}}
                                                @endif
                                                <li>  <a href="{{$href}}" >My Account </a> </li>
                                                @if(\Auth::user()->role_id==2)
                                                <li>  <a href="{{$href}}" class="mesg" >Message(0) </a> </li>

                                                @endif

                                            <?php } else { ?>
                                                <li>  <a id="login_anchor" href="{{url('/signin')}}"  data-toggle="modal" data-target="#myModal">Login </a> </li>
                                                <li> <a id="register_anchor" href="{{url('/signup')}}"  data-toggle="modal" data-target="#myModal2">Sign Up</a> </li>
                                            <?php } ?>



                                            <!-- Portfolio li end -->


                                            <!-- Blog li end --> 

                                            <!-- Elements li end -->


                                            <!-- COntact li end -->
                                        </ul>
                                        <!-- .dl-menu end --> 
                                    </div>
                                    <!-- (Responsive menu) #dl-menu end --> 

                                    <!-- #search-box start -->
                                    <div id="search">
                                        <form action="#" method="get">
                                            <input class="search-submit" type="submit" />
                                            <input id="m_search" name="s" type="text" placeholder="Type and hit enter..." />
                                        </form>
                                    </div>
                                    <!-- #search-box end --> 
                                </div>
                                <!-- .navbar.navbar-collapse end --> 
                            </nav>
                            <!-- .navbar.pi-mega end --> 
                        </div>
                        <!-- .col-md-12 end --> 
                    </div>
                    <!-- .row end --> 
                </div>
                <!-- .main-nav end --> 
            </div>
            <!-- .container end --> 
        </div>
        <!-- .header-inner end --> 
    </header>
    <!-- #header.header-type-1.dark end --> 
</div>
<style>
    .phone_code{
        width:44%!important;
        float:left;
        margin-right:3px;
    }
</style>