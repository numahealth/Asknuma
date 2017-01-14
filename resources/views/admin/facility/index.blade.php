@extends('admin.layouts.master')

@section('content')



@if (1)
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
            <p>{!! link_to_route('admin.facility.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th class="no-sort">Category Name</th>
<th class="no-sort">Sub category</th>
<th class="no-sort">Name</th>
<th class="no-sort">Latitude</th>
<th class="no-sort">Longitude</th>

<th class="no-sort">Status</th>

                        <th class="no-sort">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($facility as $row)
                        <tr>
                            <td data-title="Id">
                               {{$row->id}}
                            </td>
                            <td data-title="Category Name">{{ isset($row->category->category_name) ? $row->category->category_name : '' }}</td>
<td data-title="Sub category">{{ isset($row->subcatetory->sub_category_name) ? $row->subcatetory->sub_category_name : '' }}</td>
<td data-title="Name">{{ $row->name }}</td>
<td data-title="Latitude">{{ $row->latitude }}</td>
<td data-title="Longitude">{{ $row->longitude }}</td>

<td data-title="Status">{{ $row->status}}</td>

                            <td data-title="Action">
                                {!! link_to_route('admin.facility.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                               
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
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