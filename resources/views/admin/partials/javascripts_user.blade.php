<script type="text/javascript" src="{{ URL::asset('public/user/assets/js')}}/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('public/quickadmin/js') }}/main.js"></script>
<script type="text/javascript" src="{{ URL::asset('public/user/assets/js')}}/jquery.ui.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/bootstrap')}}/bootstrap.min.js"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->

<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/mmenu')}}/jquery.mmenu.js"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/form')}}/form.js"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/datetime')}}/datetime.js"></script>
<!-- Library Chart-->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/chart')}}/chart.js"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/pluginsForBS')}}/pluginsForBS.js"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/plugins/miscellaneous')}}/miscellaneous.js"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="{{ URL::asset('public/user/assets/js')}}/caplet.custom.js"></script>
<?php if (Auth::user()->flag == 0) { ?>
    <script>
    $(document).ready(function () {
    $("#welcome_message").trigger("click");
    });
    </script>
<?php } ?>
<script>
    $(document).ready(function () {

        $.ajax({
            url: "<?php echo url('admin/welcome/unread_update') ?>",
            method: 'POST',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
            },
            success: function (result) {


            }});


    });
    $(document).ready(function () {
        $('#close_popup').click(function () {
            var value = ($('#dont_show').prop('checked'))
            var flag = 0;
            if (value)
            {
                flag = 1;
            }
            $.ajax({
                url: "<?php echo url('admin/welcome/message_deny') ?>",
                method: 'POST',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'value': flag,
                },
                success: function (result) {

                }});

        });
    });

    $(document).ready(function () { // feedbackDlg
        $('#feedback,#feedback2').click(function (e) {
            e.preventDefault();
            // $('#feedbackDlg').modal('show');
        });
    });
    
    $("#feedbackBtn").click(function () {
        $("#reason_panel").fadeIn();
        $("#feedbackBtn").css('border', '1px solid #75d575');
        $("#bugBtn").css('border', '1px solid rgb(173, 173, 173)');
        $("#feedBackType").val('Feedback');
    });

    $("#bugBtn").click(function () {
        $("#reason_panel").fadeIn();
        $("#bugBtn").css('border', '1px solid #75d575');
        $("#feedbackBtn").css('border', '1px solid rgb(173, 173, 173)');
        $("#feedBackType").val('Bug');
    });

    $("#reason").change(function () {
        var val = $("#reason").val();
        if (!val || val.trim() === '') {
            $("#msg_panel").fadeOut();
        } else {
            $("#msg_panel").fadeIn();
            $('.modal-scrollable')
                    .animate({scrollTop: $('.modal-scrollable').height() / 3}, 500);
        }
    });

    $('#modalCloseBtn').click(function () {
        $("#msg").val('');
        $("#msg_panel").fadeOut();
        $("#reason_panel").fadeOut();
        $(".notice_bar").fadeOut();
    });

    $("#sendFeedbackBtn").click(function () {
        var val = $("#msg").val();
        if (!val || val.trim() === '') {
            $('.notice_bar').html('<span> Oops! </span>You are yet to enter your message');
            $('.notice_bar').css('display', 'block');
            $('.modal-scrollable')
                    .animate({scrollTop: 0}, 500);
            return;
        }
        $("#sendFeedbackBtn").html('<img src="<?php echo url('public/front/img/6.gif') ?>"\n\
                 style="width: 20px; height: 20px; display: inline;"/> \n\
                <span style="display: inline; text-transform: none; margin-bottom: 50px;">Please wait...</span>');

        $('.panel-body').css('opacity', 0.5);

        var feedBackType = $('#feedBackType').val();
        var interest = 'Patient'; //$('#interest').val();
        var reason = $('#reason').val();
        var satisfaction = $('.range-slider__value').text();

        $.ajax({
            url: "<?php echo url('admin/welcome/feedback') ?>",
            method: 'POST',
            data: {
                _token: '<?php echo csrf_token(); ?>',
                message: val,
                feedback_type: feedBackType,
                purpose: reason,
                satisfaction: satisfaction,
                given_as: interest
            },
            success: function (result) {

                $("#sendFeedbackBtn").html('<span style="display: inline;" class="fa fa-send"></span> Send Feedback');
                $('.panel-body').css('opacity', 1);

                $("#msg").val('');
                $("#msg_panel").fadeOut();
                $("#reason_panel").fadeOut();

                $(".notice_bar").text(result);
                $(".notice_bar").fadeIn();
                $('.modal-scrollable').animate({scrollTop: 0}, 500);

            }
        });

    });

    var rangeSlider = function () {
        var slider = $('.range-slider'),
                range = $('.range-slider__range'),
                value = $('.range-slider__value');
        slider.each(function () {
            value.each(function () {
                var value = $(this).prev().attr('value');
                $(this).html(value);
            });
            range.on('input', function () {
                $(this).next(value).html(this.value);
            });
        });
    };

    rangeSlider();

</script>
