@extends('admin.layouts.master')

@section('content')



@if (1)
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
			<p><a href="{{url('/admin/history/excel_download')}}" class="btn btn-success">Download Excel</a></p>
        </div>
        <div class="portlet-body">
            <table class="no-more-tables table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        <th>Id</th>
						<th class="no-sort">User Id</th>
						<th class="no-sort">Type</th>
						<th class="no-sort">User Name</th>
						<th class="no-sort">Serach Keyword</th>
                        <th class="no-sort">IP address</th>
                          <th class="no-sort">Location</th>
						<th class="no-sort">Date</th>
                    </tr>
                </thead>

                <tbody>
				
                    @foreach ($history as $row)
                        <tr>
                            <td data-title="Id">{{ $row->id }}</td>
							
							<td data-title="User ID">{{ $row->user_id }}</td>
							<td data-title="Type">@if($row->login_status ==1) User
							@else
							Guest
							@endif
							</td>
							<td data-title="User Name">
							{{ @$row->user_name->name }}</td>
							<td data-title="Search Keyword">{{ $row->seach_keyword }}</td>
							<td data-title="IP Address">{{ $row->ip_address }}</td>
							<td data-title="IP Address">{{ $row->location }}</td>

							<td data-title="IP Address"><? echo date('d M Y h:iA',strtotime($row->created_date)); ?></td>

                        </tr>
						
                    @endforeach
                </tbody>
            </table>
            
            {!! Form::open(['route' => 'admin.history.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
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