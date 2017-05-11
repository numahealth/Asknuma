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
</div> <!-- Container for the entire content on the page -->
</body>
</html>