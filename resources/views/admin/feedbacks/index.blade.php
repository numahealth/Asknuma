@extends('admin.layouts.master')
@section('content')
<div>
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="no-more-tables table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        <th class="no-sort" style="max-width: 300px;">Feedback</th>
                        <th class="no-sort">Type</th>
                        <th class="no-sort">I'm a/an</th>
                        <th class="no-sort">Satisfaction</th>
                        <th class="no-sort">Date</th>
                        <th>
                            <span class="fa fa-cogs"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedbacks as $feed) { ?>
                        <tr>
                            <td style="max-width: 300px;"><?php echo $feed->feedback_message; ?></td>
                            <td><?php echo $feed->feedback_type; ?></td>
                            <td><?php echo $feed->feedback_given_as; ?></td>
                            <td><?php echo $feed->satisfaction_level; ?></td>
                            <td><?php echo $feed->created_at; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                                        <span style="color: #005B21; font-size: 16px;" class="fa fa-cog"></span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 10px; max-width: 100px;">
                                        <li>
                                            <a href="<?php echo url('admin/feedbacks/view_reply/') . '/'. $feed->id; ?>">
                                                <span class="fa fa-book"></span> Open
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            {!! Form::open(['route' => 'admin.feedback.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
            <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function () {
        $('#delete').click(function () {
            if (window.confirm('{{ trans('quickadmin::templates.templates - view_index - are_you_sure') }}')) {
                var send = $('#send');
                var mass = $('.mass').is(":checked");
                if (mass == true) {
                    send.val('mass');
                } else {
                    var toDelete = [];
                    $('.single').each(function () {
                        if ($(this).is(":checked")) {
                            toDelete.push($(this).data('id'));
                        }
                    });
                    send.val(JSON.stringify(toDelete));
                }
                $('#massDelete').submit();
            }
        });
    });
</script>
@stop