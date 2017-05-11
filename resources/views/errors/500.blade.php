<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0"/>
        <title>@yield('title', 'Numa Health')</title>
        @yield('page_meta', '')
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-83018761-1', 'auto');
            ga('send', 'pageview');
        </script>
        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/style.css"/>
        <!-- template styles -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/color-default.css"/>
        <!-- default template color styles -->

        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/responsive.css"/>
        <!-- responsive styles -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/animate.css"/>
        <!-- animation for content -->

        <!-- Google Web fonts -->
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,100,200,500,600,800,700,900' rel='stylesheet' type='text/css'>
        <!-- Raleway font -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;.subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
        <!-- Open Sans -->
        <link rel="shortcut icon" href="{{ URL::asset('public/front/img') }}/favicon.ico" type="image/x-icon" sizes="16x16">
        <!-- Font icons -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/font-awesome/css/font-awesome.min.css"/>
        <!-- Font awesome icons -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/pixons/style.css" />
        <!-- Social icons font - -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/numa_style.css" />
        <!-- Social icons font -  -->
        <link rel="stylesheet" href="{{ URL::asset('public/front') }}/css/numa_media_query.css" />

    </head>
    <body>

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
        {{--*/ $breadcum = ucwords(str_replace(array("_","/"),' ',str_replace(url(''),'',url()->current()))) /*--}}

        <div style="width: 100%; height: 20px; display: none; margin-top: 118px; background: red;"> </div>
        <div class="page-title-3" id="page-title" style="margin-top:0px!important;">
            <!--div class="page-title-inner who_wr_img light">
               
                <div class="container">
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <section class="title-container clearfix">
                                <div class="pt-title">
            <?php
            $position = strpos($breadcum, "Search");
            $detail = strpos($breadcum, "Article Details");
            $details = strpos($breadcum, "Blog");

            if ($position == 1) {
                $keyword = DB::table('searchkeyword')
                        ->select('searchkeyword.keyword')
                        ->where('searchkeyword.id', '=', @Session::get('key'))
                        ->get();

                if ($keyword == NULL || empty($keyword)) {
                    $key = @Session::get('key');
                } else {
                    $key = $keyword[0]->keyword;
                }

                if (Auth::check()) {
                    $user_id = Auth::user()->id;
                    $login_status = 1;
                } else {
                    $user_id = Session::getId();
                    $login_status = 0;
                }
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                //$ip = "103.225.42.90";
                try {
                    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
                } catch (Exception $e) {
                    $details = json_encode(new stdClass);
                }

                $location = property_exists($details, 'city') ? $details->city : 'Lagos ';
                $location .= property_exists($details, 'region') ? ', ' . $details->region : ', Nigeria ';

                DB::table('numa_search_history')->insert(
                        ['location' => $location, 'login_status' => $login_status,
                            'status' => 'Active', 'user_id' => $user_id,
                            'ip_address' => $_SERVER['REMOTE_ADDR'],
                            'seach_keyword' => $key == NULL ? "unknown" : $key,
                            'created_date' => date('Y-m-d H:i:s')]
                );
                echo '<h1>Your symptoms point towards <strong>"' . $key . '"</strong></h1>';
            } else if ($detail == 1) {
                $details = DB::table('diseasesarticle')
                        ->select('article_title')
                        ->where('diseasesarticle.status', '=', 'Active')
                        ->where('id', '=', @Request::segment(2))
                        ->get();
                if (empty($detail)) {
                    return Redirect::to('search_result')->send();
                }
                echo '<h1>Article Detail <strong>"' . $details[0]->article_title . '"</strong></h1>';
                $breadcum = '<a href="' . url('') . '">Article</a> / ' . $details[0]->article_title;
            } else if ($details == 1) {
                if (@Request::segment(2) != '') {
                    $details = DB::table('blog')
                            ->select('blog_name')
                            ->where('blog.status', '=', 'Active')
                            ->where('id', '=', @Request::segment(2))
                            ->get();
                    if (empty($details)) {
                        return Redirect::to('search_result')->send();
                    }
                    echo '<h1>Article Detail <strong>"' . $details[0]->blog_name . '"</strong></h1>';
                    $breadcum = '<a href="' . url('/our_blog') . '">Blog</a>  /  ' . $details[0]->blog_name;
                } else {
                    ?>
                                                                                                                                                                <h1>{{ $breadcum  }}</h1>
                <?php } ?>
                                                                                                                }
                                                                                                                else {?>
                                                                                                                <h1>{{ $breadcum  }}</h1>
            <?php } ?>
                                                                
                              
        
                                
                            </section>
                        </div>
                    </div>         
                </div>
            </div>-->

            <!--.breadcrumbs-container start -->
            <div class="breadcrumbs-container theme-color">
                <!-- .CONTAINER START -->
                <div class="container">
                    <!-- .row start -->
                    <div class="row">
                        <!-- .col-md-12 start -->
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li><a href="{{url('')}}">Home</a></li>
                                <li> <span class="fa fa-angle-right"></span> <span class="active"><?php echo $breadcum ?></span></li>
                            </ul><!-- .breadcrumb end -->
                        </div><!-- .col-md-12 end -->
                    </div><!-- .row end -->
                </div><!-- .container end -->
            </div><!-- .breadcrumb-container end -->
        </div>   
        
        <div style="width: 100%; height: 400px; text-align: center;">
            <h1>500: Internal Server Error</h1>
        </div>


        <script src="{{ URL::asset('public/front') }}/js/jquery-2.1.1.min.js"></script><!-- jQuery library --> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <script src="{{ URL::asset('public/front') }}/js/jquery.srcipts.min.js"></script><!-- modernizr, retina, stellar for parallax --> 
        <script src="{{ URL::asset('public/front') }}/js/jquery.tweetscroll.js"></script><!-- Tweetscroll plugin --> 
        <script src="{{ URL::asset('public/front') }}/rs-plugin/js/jquery.themepunch.tools.min.js"></script><!-- Revolution slider script --> 
        <script src="{{ URL::asset('public/front') }}/rs-plugin/js/jquery.themepunch.revolution.min.js"></script><!-- Revolution slider script --> 
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
        <script src="{{ URL::asset('public/front') }}/js/jquery.countTo.js"></script><!-- Number counter animations --> 
        <script src="{{ URL::asset('public/front') }}/js/jquery.dlmenu.min.js"></script><!-- for responsive menu -->
        <script src="{{ URL::asset('public/front') }}/js/include.js"></script><!-- custom js functions --> 
        <script src="{{ URL::asset('public/quickadmin/js') }}/validate.js"></script>
        <script src="{{ URL::asset('public/quickadmin/js') }}/user_valid.js"></script>
        <script>
            $(document).ready(function () {
                $("#shows_dis").click(function () {
                    $("#refr").toggle(500);
                });
                $("#register_anchor").click(function () {
                    $(".oops").html('');
                });
                $("#ask_doc").click(function () {
                    $(".oops").html('Oops - you don’t seem to have a Numa account. Register below to speak to one our doctors and build your health profile.');
                });
            });
        </script>
        <script>
            /* <![CDATA[ */
            jQuery(document).ready(function ($) {
                'use strict';

                jQuery('#rev-slider').revolution(
                        {
                            dottedOverlay: "none",
                            delay: 9000,
                            startwidth: 1170,
                            startheight: 700,
                            hideThumbs: 200,
                            thumbWidth: 100,
                            thumbHeight: 50,
                            thumbAmount: 3,
                            navigationType: "none",
                            navigationArrows: "solo",
                            navigationStyle: "preview4",
                            touchenabled: "on",
                            onHoverStop: "off",
                            swipe_velocity: 0.7,
                            swipe_min_touches: 1,
                            swipe_max_touches: 1,
                            drag_block_vertical: false,
                            keyboardNavigation: "on",
                            navigationHAlign: "center",
                            navigationVAlign: "bottom",
                            navigationHOffset: 0,
                            navigationVOffset: 20,
                            soloArrowLeftHalign: "left",
                            soloArrowLeftValign: "center",
                            soloArrowLeftHOffset: 20,
                            soloArrowLeftVOffset: 0,
                            soloArrowRightHalign: "right",
                            soloArrowRightValign: "center",
                            soloArrowRightHOffset: 20,
                            soloArrowRightVOffset: 0,
                            shadow: 0,
                            fullWidth: "on",
                            fullScreen: "off",
                            spinner: "spinner0",
                            stopLoop: "off",
                            stopAfterLoops: -1,
                            stopAtSlide: -1,
                            shuffle: "off",
                            forceFullWidth: "off",
                            fullScreenAlignForce: "off",
                            minFullScreenHeight: "400",
                            hideThumbsOnMobile: "off",
                            hideNavDelayOnMobile: 1500,
                            hideBulletsOnMobile: "off",
                            hideArrowsOnMobile: "off",
                            hideThumbsUnderResolution: 0,
                            hideSliderAtLimit: 0,
                            hideCaptionAtLimit: 0,
                            hideAllCaptionAtLilmit: 0,
                            startWithSlide: 0,
                            hideTimerBar: "on"
                        });

                $('.numbers-counter').waypoint(function () {
                    // NUMBERS COUNTER START
                    $('.numbers').data('countToOptions', {
                        formatter: function (value, options) {
                            return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
                        }
                    });
                    // start timer
                    $('.timer').each(count);

                    function count(options) {
                        var $this = $(this);
                        options = $.extend({}, options || {}, $this.data('countToOptions') || {});
                        $this.countTo(options);
                    } // NUMBERS COUNTER END
                },
                        {
                            offset: '70%',
                            triggerOnce: true
                        }
                );


                //Unyscape code ( Mark)

                $("#header-wrapper").animate({left: '250px', opacity: '1'}, 500);
                $(".numa_banner").animate({marginTop: '0', opacity: '1'}, 1000);
                //alert(" Aasknuma");

                $(window).load(function () {

                    //$("#header-wrapper").animate({left: '250px', opacity: '1'});	

                });


            });



            $(window).scroll(function () {

                var blog_animate = function () {
                    $(".blog-post-box:eq(0)").delay(500).animate({opacity: '1', right: '0'}, 'slow');
                    $(".blog-post-box:eq(1)").delay(750).animate({opacity: '1', right: '0'}, 'slow');
                    $(".blog-post-box:eq(2)").delay(1000).animate({opacity: '1', right: '0'}, 'slow');

                };

                var windowWidth = $(this).width();

                if (windowWidth >= 992) {
                    if ($(this).scrollTop() > 400) {

                        //$(".blog_section").css('background','red');
                        blog_animate();
                        //alert(mk);
                    }

                    if ($(this).scrollTop() > 1100) {
                        $(".home_about").animate({opacity: '1', top: '0'}, 1000);

                    }

                    //var mk = $(".mkg").offset().top;

                    //$(".mkg").text(mk);

                    if ($(this).scrollTop() > 1400) {
                        $(".have_any_more").animate({opacity: '1', right: '0'}, 1000);
                        $(".home_contact").animate({opacity: '1', left: '0'}, 1000);

                    }
                }

            });

            // makes sure the whole site is loaded
            jQuery(window).load(function () {
                // will first fade out the loading animation
                jQuery("#status_ok").fadeOut();
                // will fade out the whole DIV that covers the website.
                jQuery("#preloader").fadeOut("fast");
            });


            /* ]]> */
        </script>

        <script>
            function form_submit() {
                var field_value = document.getElementById("dieases").value;
                var typed_text = document.getElementById("typed_text").value;
                if (field_value === '' && (typed_text === '' || typed_text === 'typed_text')) {
                    $('.selectize-input').css('border', 'red solid 2px');
                    return;
                }
                document.getElementById("form_sumit").submit();
            }

            function show_register() {
                $('#myModal').modal('hide');
                $("#register_anchor").trigger('click');
            }
            function yes_no(id, view)
            {

                if (view == 'Yes')
                {
                    var reason_id = $('#y_reason_id').val();
                    var reasons = $('#y_reasons').val();
                } else {
                    var reason_id = $('#reason_id').val();
                    var reasons = $('#reasons').val();

                }
                $.ajax({
                    url: "<?php echo url('admin/welcome/yes_no') ?>",
                    method: 'POST',
                    data: {
                        message: view,
                        '_token': '<?php echo csrf_token(); ?>',
                        'id': id,
                        'type': 'article',
                        'reason_id': reason_id,
                        'reasons': reasons
                    },
                    success: function (result) {
                        $("#thanks").trigger('click');
                    }});
            }
            function yes_no_blog(id, view)
            {

                if (view == 'Yes')
                {
                    var reason_id = $('#y_reason_id').val();
                    var reasons = $('#y_reasons').val();
                } else {
                    var reason_id = $('#reason_id').val();
                    var reasons = $('#reasons').val();

                }
                $.ajax({
                    url: "<?php echo url('admin/welcome/yes_no') ?>",
                    method: 'POST',
                    data: {
                        message: view,
                        '_token': '<?php echo csrf_token(); ?>',
                        'id': id,
                        'type': 'blog',
                        'reason_id': reason_id,
                        'reasons': reasons
                    },
                    success: function (result) {
                        $("#thanks").trigger('click');
                    }});
            }
            function query_to_doc(id)
            {
                //;

                var age = $('#age').val();
                var gender = $('#gender').val();
                var comment = $('#comment').val();
                if (age == '' || comment == '')
                {
                    $('#click_here').trigger('click');
                    return;
                }
                if (age < 0)
                {
                    $('#click_here').trigger('click');
                    return;
                }

                $.ajax({
                    url: "<?php echo url('admin/welcome/question') ?>",
                    method: 'POST',
                    data: {
                        comment: comment,
                        '_token': '<?php echo csrf_token(); ?>',
                        'article_id': id,
                        'age': age,
                        'gender': gender
                    },
                    success: function (result) {
                        $("#thanks_question").trigger('click');
                        $('#dismiss').trigger('click');
                    }});
            }
            function bookmark(id, status)
            {

                $.ajax({
                    url: "<?php echo url('admin/welcome/bookmark') ?>",
                    method: 'POST',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'article_id': id,
                        'type': 'article',
                        'status': status

                    },
                    success: function (result) {
                        if (status == 'Active')
                        {
                            $("#text_change").text('This article has bookmarked.');
                        } else {
                            $("#text_change").text('This article has Unbookmarked.');
                        }
                        $("#thanks").trigger('click');
                        $('#dismiss').trigger('click');
                        location.reload();

                    }});
            }
            function bookmark_blog(id, status)
            {

                $.ajax({
                    url: "<?php echo url('admin/welcome/bookmark') ?>",
                    method: 'POST',
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'article_id': id,
                        'type': 'blog',
                        'status': status

                    },
                    success: function (result) {
                        if (status == 'Active')
                        {
                            $("#text_change").text('This article has been Bookmarked.');
                        } else {
                            $("#text_change").text('This article has been Unboomarked.');
                        }
                        $("#thanks").trigger('click');
                        $('#dismiss').trigger('click');
                        location.reload();

                    }});
            }
            function newsletter()
            {
                var news = $('#news_letter_email').val();
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (regex.test(news) == 0) // dont change to ===
                {
                    $("#news_text_change").text('Please enter a valid email address.');
                    $("#news_click").trigger('click');
                } else {
                    $("#newsLetterBtn").html('<img src="<?php echo url('public/front/img/6.gif') ?>"\n\
                         style="width: 30px; height: 30px; margin-left: 6px;"/>');
                    //return;
                    $.ajax({
                        url: "<?php echo url('admin/welcome/newsletter') ?>",
                        method: 'POST',
                        data: {
                            '_token': '<?php echo csrf_token(); ?>',
                            'email': news
                        },
                        success: function (result) {

                            $("#news_text_change").text('You’ve been subscribed & we’ll be sure to keep you up to date!');
                            $("#news_click").trigger('click');

                            $("#newsLetterBtn").html('');
                            $('#news_letter_email').val('');

                        }});

                }
            }
            $(document).ready(function () {
                $("#dieases").change(function () {
                    if (this.value == '')
                    {
                        $('.selectize-input').css('border', 'red solid 2px');
                    } else {
                        $('.selectize-input').css('border', '');
                    }
                });
            });

            $("#feedbackBtn").click(function () {
                $("#interest_panel").fadeIn();
                $("#feedbackBtn").css('border', '1px solid #75d575');
                $("#bugBtn").css('border', '1px solid rgb(173, 173, 173)');
                $("#feedBackType").val('Feedback');
            });

            $("#bugBtn").click(function () {
                $("#interest_panel").fadeIn();
                $("#bugBtn").css('border', '1px solid #75d575');
                $("#feedbackBtn").css('border', '1px solid rgb(173, 173, 173)');
                $("#feedBackType").val('Bug');
            });

            $("#interest").change(function () {
                var val = $("#interest").val();
                if (!val || val.trim() === '') {
                    $("#msg_panel").fadeOut();
                    $("#reason_panel").fadeOut();
                } else {
                    $("#reason_panel").fadeIn();
                    $('html, body').animate({
                        scrollTop: $("#reason_panel").offset().top
                    }, 1000);
                }
            });

            $("#reason").change(function () {
                var val = $("#reason").val();
                if (!val || val.trim() === '') {
                    $("#msg_panel").fadeOut();
                } else {
                    $("#msg_panel").fadeIn();
                    $('html, body').animate({
                        scrollTop: $("#msg_panel").offset().top
                    }, 1000);
                }
            });

            $("#sendFeedbackBtn").click(function () {
                var val = $("#msg").val();
                if (!val || val.trim() === '') {
                    $('.notice_bar').html('<span> Oops! </span>You are yet to enter your message');
                    $('.notice_bar').css('display', 'block');
                    $('html, body').animate({
                        scrollTop: $(".container").offset().top
                    }, 600);
                    return;
                }
                $("#sendFeedbackBtn").html('<img src="<?php echo url('public/front/img/6.gif') ?>"\n\
                         style="width: 20px; height: 20px; display: inline;"/> \n\
                        <span style="display: inline; text-transform: none; margin-bottom: 50px;">Please wait...</span>');

                $('.col-md-offset-1.col-lg-offset-1.col-md-8.col-lg-8').css('opacity', 0.5);

                var feedBackType = $('#feedBackType').val();
                var interest = $('#interest').val();
                var reason = $('#reason').val();

                $.ajax({
                    url: "<?php echo url('admin/welcome/feedback') ?>",
                    method: 'POST',
                    data: {
                        _token: '<?php echo csrf_token(); ?>',
                        message: val,
                        feedback_type: feedBackType,
                        purpose: reason,
                        satisfaction: '-',
                        given_as: interest
                    },
                    success: function (result) {

                        $("#sendFeedbackBtn").html('<span style="display: inline;" class="fa fa-send"></span> Send Feedback');
                        $('.col-md-offset-1.col-lg-offset-1.col-md-8.col-lg-8').css('opacity', 1);

                        $("#msg").val('');
                        $("#msg_panel").fadeOut();
                        $("#reason_panel").fadeOut();
                        $("#interest_panel").fadeOut();

                        $('html, body').animate({
                            scrollTop: $(".container").offset().top
                        }, 600);
                        $(".notice_bar").text(result);
                        $(".notice_bar").fadeIn();

                    }
                });


            });

            $("#connect").click(function () {
                $("#connect").css('border', '1px solid yellow');
                $('html, body').animate({
                    scrollTop: $("#columns").offset().top + 100
                }, 700);
            });

            $('#subscriptionBtn').click(function () {
                $("#subscriptionBtn").html('<img src="<?php echo url('public/front/img/6.gif') ?>"\n\
                         style="width: 20px; height: 20px; display: inline;"/> \n\
                        <span style="display: inline; text-transform: none; margin-bottom: 50px;">Please wait...</span>');

                $('.col-md-12').css('opacity', 0.5);
                $.ajax({
                    url: "<?php echo url('admin/welcome/subscribe') ?>",
                    method: 'POST',
                    data: {
                        _token: '<?php echo csrf_token(); ?>',
                    },
                    success: function (result) {
                        //console.log('Redirecting ---> ' + result);
                        window.location.href = result;
                    }
                });


            });

            function scrollToId(id) {
                $('html, body').animate({
                    scrollTop: $("#" + id).offset().top
                }, 500);
            }



        </script>

        <div id="copyright-container"> 
            <!-- .container start -->
            <div class="container"> 
                <!-- .col-md-6 start -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="footer-title">
                        SOCIAL
                    </div>
                    <ul class="list-inline social-icon">
                        <li><a class="icon vhm" href="https://www.facebook.com/numahealth/" target="_blank">
                                <i class="fa fa-facebook vhm-item1"></i></a></li>
                        <li><a class="icon vhm" href="https://twitter.com/numa_health" target="_blank">
                                <i class="fa fa-twitter vhm-item1"></i>
                            </a></li>
                        <li>
                            <a class="icon vhm" href="https://www.snapchat.com/add/numahealth" target="_blank">
                                <i class="fa fa-snapchat-ghost vhm-item1"></i>
                            </a>
                        </li> 
                        <li>
                            <a class="icon vhm" href="https://www.instagram.com/numahealth/" target="_blank">
                                <i class="fa fa-instagram vhm-item1"></i>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- .ocl-md-6 end -->

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="footer-title" >Contact</div>
                    <ul class="list-unstyled">
                        <li style="">
                            <!-- <span class="icon icon-chat-messages-14" style="color: black;"></span> -->
                            <span><i class="fa fa-envelope-o"></i></span>
                            info@numa.io
                            <!-- <a href="mailto:info@drugstoc.biz" style="color: black;">info@drugstoc.biz</a> -->
                        </li>
                        <li style="">
                            <!-- <span class="icon icon-seo-icons-34"></span> -->
                            <span><i class="fa fa-map-marker"></i></span>
                            Lagos, Nigeria / London, UK
                        </li>
                        <li style="">
                            <!-- <span class="icon icon-seo-icons-17"></span> -->
                            <span><i class="fa fa-phone"></i></span>
                            <!-- +234.810.460.8748 -->
                            +234 812 917 2998
                        </li>
                        <li style="padding-top: 10px; font-size: 13px;">
                            <!-- <span class="icon icon-seo-icons-17"></span> -->
                            <span><i class="fa fa-envelope-square"></i></span>
                            <!-- +234.810.460.8748 -->
                            <a href="{{ Request::root()}}/feedback">Send us feedback</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 widget_newsletterwidget ">
                    <div class="footer-title">
                        Numa Newsletter
                    </div>
                    <div class="newsletter">
                        <input name="newsletter" id="news_letter_email" class="email" type="email" 
                               placeholder="enter your email address here*">
                        <button onclick="newsletter();" type="submit" class="submit" id="newsLetterBtn">
                        </button>
                    </div>

                    <div class="footer-title links" style="margin-top: -2px!important;">

                    </div>                

                    <ul class="breadcrumb footer-breadcrumb" style=" float:left; width:100%;">
                        <li><a href="{{ url('/term_condition')}}">Terms of Service</a></li>
                        <li><a href="{{ url('/privacy_policy')}}">Privacy Policy</a></li>
                    </ul>

                </div>


            </div>
            <!-- .container end --> 
        </div>

        <div class="col-md-12 copyright2016">
            &copy;2017 All Rights Reserved by Numa Health

        </div>

        <a href="#" id="news_click" class="btn btn-success hide" data-toggle="modal" data-target="#yes_helpfuls">Yes</a>
        <div class="modal fade" id="yes_helpfuls" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header" style="background:#75d575">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class=""> </i> </h4>
                    </div>
                    <div class="modal-body">
                        <p><h5 id="news_text_change">Thank you for your feedback</h5></p>
                    </div>

                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ Request::root() }}/public/quickadmin/dist/js/standalone/selectize.js"></script>
        <script type="text/javascript" src="{{ Request::root() }}/public/quickadmin/js/index.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
        <?php if (\Auth::check()) { ?>
            <script>
                                $(document).ready(function () {
                                    setInterval(function () {
                                        $.ajax({
                                            url: "<?php echo url('admin/welcome/unread') ?>",
                                            method: 'POST',
                                            data: {
                                                '_token': '<?php echo csrf_token(); ?>'
                                            },
                                            success: function (result) {
                                                $('.mesg').html('Message(' + result + ')');
                                            }});

                                    }, 5000);

                                });
            </script>

        <?php } ?>
        <script>
            $('#dieases').selectize({
                maxItems: 1
            });
            $('.phpn_drop').selectize({
                maxItems: 1
            });

        </script>
        <script>
            $('.selectize-input.items.has-options.not-full  input').on('keyup', function () {
                //console.log('clicked ---');
                $('#typed_text').val($('.selectize-input.items.has-options.not-full  input').val());
            });
        </script>

    </body>
</html>