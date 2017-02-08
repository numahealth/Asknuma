@extends('admin.layouts.master')
@section('content')
<div>
    <div style="text-align: center; display: none;">
        <h3>Frequently asked questions. View all, View One, Edit etc.</h3>
        <img src="{{@Request::root()}}/public/user/images/helmet.png"/>
        <h4>Under construction</h4>
    </div>
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
            <p>{!! link_to_route('admin.faq.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>
        </div>
        <div class="portlet-body">
            <table class="no-more-tables table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        <th style="min-width: 200px;" class="no-sort">Question</th>
                        <th class="no-sort">Answer</th>
                        <th class="no-sort">Category</th>
                        <th>
                            <span class="fa fa-cogs"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($faqs as $faq) { ?>
                        <tr>
                            <td style="min-width: 200px;"><?php echo $faq->question; ?></td>
                            <td><?php echo $faq->answer; ?></td>
                            <td><?php echo $faq->category->category_name; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                                        <span style="color: #005B21; font-size: 16px;" class="fa fa-cog"></span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 10px; max-width: 100px;">
                                        <li>
                                            <a href="<?php echo url('admin/faq/edit/?id=') . $faq->id; ?>">
                                                <span class="fa fa-edit"></span> Edit
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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