@extends('admin.layouts.master')

@section('content')
<?php /* echo '<pre>';
  print_r($group);
  echo '</pre>'; */ ?>

@if(1)
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        <p>{!! link_to_route('admin.group.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}
            {!! link_to_route('group.bulk_upload', 'Bulk Uplaod',null, array('class' => 'btn btn-success')) !!}</p>
    </div>
    <div class="portlet-body">
        <table class="no-more-tables table table-striped table-hover table-responsive datatable" id="datatables">
            <thead>
                <tr>
                    <!--th>
                        {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                    </th-->
                    <th>
                        Id
                    </th>
                    <th class="no-sort">Name</th>
                    <th class="no-sort">Diseases Name</th>
                    <th class="no-sort">Status</th>			

                    <th class="no-sort">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($group as $row)
                <tr>
                    <!--td>
                        {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                    </td-->
                    <td data-title="Id">#{{ $row->dieases }}</td>
                    <td data-title="Name">{{ $row->name }}</td>
                    <td data-title="Disease Name">
                        <?php
                        $name_dieseases = DB::table('diseases')
                                ->select('disease_name')
                                ->where('id', '=', @$row->dieases)
                                ->get();
                        //print_r($name_dieseases);
                        ?>
                        {{ @$name_dieseases[0]->disease_name }}</td>
                    <td data-title="Status">{{ @$row->status }}</td>


                    <td data-title="Action">
                        {!! link_to_route('admin.group.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                        <!--{!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array('admin.group.destroy', $row->id))) !!}
                        {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!--div class="row">
            <div class="col-xs-12">
                <button class="btn btn-danger" id="delete">
                    {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                </button>
            </div>
        </div-->
        {!! Form::open(['route' => 'admin.group.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
        <input type="hidden" id="send" name="toDelete">
        {!! Form::close() !!}
    </div>
</div>
@else
{{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

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