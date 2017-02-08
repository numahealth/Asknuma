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
                $('#categoryName').val('');

                $(".notice_bar").text('Record saved successfully');
                $(".notice_bar").fadeIn();
            }
        });

    });

</script>