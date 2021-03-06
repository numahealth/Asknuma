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
                '_token': '<?php echo csrf_token(); ?>'
            },
            success: function (result) {


            }});


    });
    $(document).ready(function () {
        $('#close_popup').click(function () {
            var value = ($('#dont_show').prop('checked'));
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
                    'value': flag
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
            if ($('#disableAccountBtn').length) {
                $("#disableAccountBtn").attr('disabled', true);
            }
        } else {
            $("#msg_panel").fadeIn();
            $('.modal-scrollable')
                    .animate({scrollTop: $('.modal-scrollable').height() / 3}, 500);
            if ($('#disableAccountBtn').length) {
                $("#disableAccountBtn").attr('disabled', false);
            }
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



    $("#sendMessageBtn").click(function (e) {
        e.preventDefault();
        var val = $("#message").val();
        if (!val || val.trim() === '') {
            $(".alert.alert-info").fadeOut();
            $('.alert.alert-danger').html('<span> Oops! </span>You are yet to enter your message');
            $('.alert.alert-danger').css('display', 'block');
            $("#chatboxcontent").animate({scrollTop: $('#chatboxcontent').prop("scrollHeight")}, 1000);
            $('html, body').animate({
                scrollTop: $("#site-footer").offset().top
            }, 500);
            return;
        }
        $("#sendMessageBtn").html('<img src="<?php echo url('public/front/img/6.gif') ?>"\n\
                 style="width: 20px; height: 20px; display: inline;"/> \n\
                <span style="display: inline; text-transform: none; margin-bottom: 50px;">Please wait...</span>');

        $('.chatboxinput').css('opacity', 0.5);

        $.ajax({
            url: "<?php echo url('admin/usermessage/store') ?>",
            type: 'post',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: new FormData($("#form-with-validation")[0]),
            success: function (result) {

                $("#sendMessageBtn").html('<span style="display: inline;" class="fa fa-send"></span> Send');
                $('.chatboxinput').css('opacity', 1);

                $("#message").val('');
                $('.chatboxcontent').html(result.html);

                $(".alert.alert-danger").fadeOut();
                $(".alert.alert-info").text(result.message);
                $(".alert.alert-info").fadeIn();
                $('#input-file').val('');
                $('#embedded').val('');
                setTimeout(function () {
                    $(".alert.alert-info").fadeOut();
                    $('#placeholder')
                            .attr('src', '');
                    $('#placeholder').fadeOut();
                }, 5000);
                //$('.modal-scrollable').animate({scrollTop: 0}, 500);

            }
        });

    });


    $("#disableAccountBtn").click(function (e) {
        e.preventDefault();
        var message = $("#msg").val();
        var delete_data = $("#delete_data").is(':checked') ? 'Yes' : 'No';
        var reason = $('#reason').val();
        $('#disableAccountBtn').prop('disabled', true);
        $('#disableAccountBtn').css('opacity', '0.4');

        $.ajax({
            url: "<?php echo url('admin/setting/removeAccount') ?>",
            method: 'POST',
            data: {
                _token: '<?php echo csrf_token(); ?>',
                message: message,
                delete_data: delete_data,
                reason: reason
            },
            success: function (result) {
                window.location.href = '<?php echo url('/') ?>' + '?data=' + result;
            }
        });
    });



    $('input[type=file]').on('change', readURL);

    function readURL() {
        input = event.target;
        window.URL = window.URL || window.webkitURL;
        useBlob = false && window.URL; // `true` to use Blob instead of Data-URL
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = new Image();
                image.addEventListener("load", function () {
                    var imageInfo =
                            image.width + '×' +
                            image.height + ' ';
                    //alert('Size -->  ' + imageInfo);
                });
                image.src = useBlob ? window.URL.createObjectURL(input.files[0]) : reader.result;
                $('#placeholder')
                        .attr('src', e.target.result)
                        .attr('display', 'inline')
                        .width(40)
                        .height(40);
                $('#placeholder').fadeIn();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ajaxStart(function () {
        //$('.ajaxLoader').css('display', 'inline');
        //$(':button').prop('disabled', true);
        //$('body').css('opacity', '0.6');
    });
    $(document).ajaxComplete(function () {
        //$('.ajaxLoader').css('display', 'none');
        //$(':button').prop('disabled', false);
        //$('body').css('opacity', '1');
    });

    $('#submit').click(function (event) {
        $('#notice_panel').css('display', 'none');
        var current_password = $.trim($('input[name=current_password]').val());
        var new_password = $.trim($('input[name=password]').val());
        var retyped_password = $.trim($('input[name=confirm_password]').val());
        if (current_password.length < 1) {
            $('#notice_panel').html('Please enter your current password!');
            $('#notice_panel').css('display', 'block');
            event.preventDefault();
            return;
        }
        if (new_password.length < 6) {
            $('#notice_panel').html('Password must be at least 6 characters');
            $('#notice_panel').css('display', 'block');
            event.preventDefault();
            return;
        }
        if (new_password !== retyped_password) {
            $('#notice_panel').html('Inconsistent password');
            $('#notice_panel').css('display', 'block');
            event.preventDefault();
            return;
        }
        
    });

</script>
