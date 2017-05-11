<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>

<!--script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script-->
<script src="{{ URL::asset('public/user/assets/plugins/ckeditor') }}/ckeditor.js"></script>
<script src="{{ URL::asset('public/quickadmin/js') }}/bootstrap.min.js"></script>
<script src="{{ URL::asset('public/quickadmin/js') }}/main.js"></script>
<script src="{{ URL::asset('public/quickadmin/js') }}/validate.js"></script>
<script src="{{ URL::asset('public/quickadmin/js') }}/user_valid.js"></script>
<script>
    function slack(id)
    {
        var message = ($('#message_for_slack' + id).text());

        $.ajax({
            url: "<?php echo url('admin/message/slack') ?>",
            method: 'POST',
            data: {
                message: message,
                '_token': '<?php echo csrf_token(); ?>',
                'id': id
            },
            success: function (result) {
                if (result)
                {
                    $('#text_of_anchor' + id).text('Sent to slack');
                } else {
                    $('#text_of_anchor' + id).text('Try again');
                }
            }});

    }
    $(document).ready(function () {
        $("#category_id_facility").change(function () {
            var id = this.value;
            if (id == '')
            {
                return;
            }
            $.ajax({
                url: "<?php echo url('admin/welcome/sub_cat') ?>",
                method: 'POST',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                },
                success: function (result) {
                    if (result == '')
                    {
                        $('#subcatetory_id').html('<option value="" selected="selected">Please select</option>');
                    } else {
                        $('#subcatetory_id').html(result);
                    }
                }});
        });
    });

    $('#replyBtn').click(function () {
        $("#msg_panel").toggle(500);
        if ($(window).scrollTop() + $(window).height() === $(document).height()) {
            $('html, body').animate({
                scrollTop: 0
            }, 200);
        } else {
            $('html, body').animate({
                scrollTop: 9999
            }, 500);
        }
        $(".notice_bar").fadeOut();
    });

    $("#sendReplyBtn").click(function () {
        var val = $("#msg").val();
        if (!val || val.trim() === '') {
            $('.notice_bar').html('Please enter your reply');
            $('.notice_bar').css('display', 'block');
            return;
        }
        $("#sendReplyBtn").html('<img src="<?php echo url('public/front/img/6.gif') ?>"\n\
                 style="width: 20px; height: 20px; display: inline;"/> \n\
                <span style="display: inline; text-transform: none; margin-bottom: 50px;">Please wait...</span>');

        $('.panel-body').css('opacity', 0.5);

        var feedback_id = $('#feedback_id').val();
        $.ajax({
            url: "<?php echo url('admin/feedbacks/response') ?>",
            method: 'POST',
            data: {
                _token: '<?php echo csrf_token(); ?>',
                message: val,
                feedback_id: feedback_id
            },
            success: function (result) {

                $("#sendReplyBtn").html('<span style="display: inline;" class="fa fa-send"></span> Send Reply');
                $('.panel-body').css('opacity', 1);

                $("#msg").val('');
                $("#msg_panel").fadeOut();

                $(".notice_bar").text(result);
                $(".notice_bar").fadeIn();
            }
        });

    });

    $('#addCategoryBtn').click(function (e) {
        e.preventDefault();
        var category = $('#categoryName').val();
        if (!category || category.trim() === '') {
            $('.notice_bar').text('Please enter category name');
            $('.notice_bar').fadeIn();
            return;
        }
        $('.notice_bar').text('');
        $('.notice_bar').fadeOut();

        $("#addCategoryBtn").html('<img src="<?php echo url('public/front/img/6.gif') ?>"\n\
                 style="width: 20px; height: 20px; display: inline;"/> \n\
                <span style="display: inline; text-transform: none; margin-bottom: 50px;">Please wait...</span>');

        $('.panel-body').css('opacity', 0.5);

        $.ajax({
            url: "<?php echo url('admin/faqCategory/category') ?>",
            method: 'POST',
            data: {
                _token: '<?php echo csrf_token(); ?>',
                category: category.trim()
            },
            success: function (result) {
                $("#addCategoryBtn").html('<span style="display: inline;" class="fa fa-save"></span> Save');
                $('.panel-body').css('opacity', 1);
                result = JSON.parse(result);
                $('#category_id').append($("<option></option>")
                        .attr("value", result['id'])
                        .attr('selected', 'selected')
                        .text(result['name']));
                var newRow = "<tr><td>" + result['name'] + "</td><td> " +
                        '<button class="btn btn-danger" '
                        + 'onclick="deleteCategory(' + result['id']
                        + ') type="button"><span class="fa fa-trash"></span></button>'
                        +
                        "</td></tr>";
                $('#cat_table tbody').append(newRow);

                $('#categoryName').val('');

                $(".notice_bar").text('Record saved successfully');
                $(".notice_bar").fadeIn();
            }
        });

    });

    function deleteCategory(id) {
        $('.panel-body').css('opacity', 0.8);
        $.ajax({
            url: "<?php echo url('admin/faqCategory/deleteCategory') ?>",
            method: 'POST',
            data: {
                _token: '<?php echo csrf_token(); ?>',
                id: id
            },
            success: function (result) {
                $('.panel-body').css('opacity', 1);
                result = JSON.parse(result);
                if (result['status'] == 'error') {
                    $(".notice_bar").removeClass('alert-warning');
                    $(".notice_bar").addClass('alert-danger');
                }
                $(".notice_bar").text(result['msg']);
                $(".notice_bar").fadeIn();
            }
        });
    }


    $("#sendMessageBtn").click(function (e) {
        e.preventDefault();
        var val = $("#message").val();
        if (!val || val.trim() === '') {
            alert(val);
            $(".alert.alert-info").fadeOut();
            $('.alert.alert-danger').html('<span> Oops! </span>You are yet to enter your message');
            $('.alert.alert-danger').css('display', 'block');
            $("#chatboxcontent").animate({scrollTop: $('#chatboxcontent').prop("scrollHeight")}, 1000);
            $('html, body').animate({
                scrollTop: 9999
            }, 500);
            return;
        }
        $("#sendMessageBtn").html('<img src="<?php echo url('public/front/img/6.gif') ?>"\n\
                 style="width: 20px; height: 20px; display: inline;"/> \n\
                <span style="display: inline; text-transform: none; margin-bottom: 50px;">Please wait...</span>');

        $('.chatboxinput').css('opacity', 0.5);

        $.ajax({
            url: "<?php echo url('admin/message/store') ?>",
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

    $('#addChatFlowBtn').click(function (e) {
        e.preventDefault();
        var flowName = $('#flowName').val();
        if (!flowName || flowName.trim() === '') {
            $('.notice_bar').text('Please enter flow name');
            $('.notice_bar').fadeIn();
            return;
        }

        var flowDesc = $('#flowDesc').val();
        if (!flowDesc || flowDesc.trim() === '') {
            flowDesc = "";
        }

        $('.notice_bar').text('');
        $('.notice_bar').fadeOut();

        $("#addChatFlowBtn").html('<img src="<?php echo url('public/front/img/6.gif') ?>"\n\
                 style="width: 20px; height: 20px; display: inline;"/> \n\
                <span style="display: inline; text-transform: none; margin-bottom: 50px;">Please wait...</span>');

        $('.panel-body').css('opacity', 0.5);

        $.ajax({
            url: "<?php echo url('admin/bot/saveChatFlow') ?>",
            method: 'POST',
            data: {
                _token: '<?php echo csrf_token(); ?>',
                flowName: flowName.trim(),
                flowDesc: flowDesc.trim()
            },
            success: function (result) {
                $("#addChatFlowBtn").html('<span style="display: inline;" class="fa fa-save"></span> Save');
                $('.panel-body').css('opacity', 1);
                response = JSON.parse(result);

                $('#flowName').val('');
                $('#flowDesc').val('');
                $('#newCategoryDlg').modal('hide');
                $('#flowTableBody').fadeOut();
                $('#flowTableBody').html(response.html);
                $('#flowTableBody').fadeIn();
                // update ChatFlow table here
                $(".notice_bar").text(response.message);
                $(".notice_bar").fadeIn();
            }
        });

    });



</script>