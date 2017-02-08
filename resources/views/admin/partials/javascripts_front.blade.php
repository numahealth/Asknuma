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
@if (count($errors->login) > 0)
<script>
    $(document).ready(function () {
        $("#login_anchor").trigger('click');
    });
</script>
@endif 
@if (count($errors) > 0 || @Session::pull('click')==1))
<script>
    $(document).ready(function () {
        $("#register_anchor").trigger('click');
    });
</script>
@endif 
<script>
    function form_submit()
    {
        var field_value = document.getElementById("dieases").value;
        var typed_text = document.getElementById("typed_text").value;
        if (field_value === '' && (typed_text === '' || typed_text === 'typed_text')) {
            $('.selectize-input').css('border', 'red solid 2px');
            return;
        }
        document.getElementById("form_sumit").submit();
    }

    function show_register()
    {
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

    function scrollToId(id) {
        $('html, body').animate({
            scrollTop: $("#"+ id).offset().top
        }, 500);
    }

</script>