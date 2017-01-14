@extends('admin.layouts.master')

@section('content')



@if (1)
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
			<p>{!! link_to_route('admin.configuration.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>
        </div>
        <div class="portlet-body">
            <table class="no-more-tables table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th class="no-sort">Page Name</th>
                        <th class="no-sort">Type</th>
                        <th class="no-sort">Position</th>
                        <th class="no-sort">Code</th>
			<th class="no-sort">Status</th>
                        <th class="no-sort">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($configuration as $row)
                        <tr>
                            <td data-title="Id">
                                {{ $row->id}}
                            </td>
                            <td data-title="Page Name">{{ isset($row->menus->title) ? $row->menus->title : '' }}</td>
                             <td data-title="Type">{{ isset($row->Type) ? $row->Type : '' }}</td>
                             <td data-title="Position">{{ isset($row->position) ? $row->position: '' }}</td>
                             <td data-title="Code">
                             <a  class="" data-toggle="modal" data-target="#myModal{{ $row->id }}">
							Code
							</a>
							<div class="modal fade" id="myModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Configuration Code</h4>
									  </div>
								<div class="modal-body">
								<?php echo  $row->code ?>
								</div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
									
								  </div>
											</div>
								</div>
							</div>
                            </td>
							<td data-title="Status">
                                {{ $row->status}}
                            </td>
                            <td data-title="Action">
                                {!! link_to_route('admin.configuration.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array('admin.configuration.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          
            {!! Form::open(['route' => 'admin.configuration.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
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