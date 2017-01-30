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

</script>