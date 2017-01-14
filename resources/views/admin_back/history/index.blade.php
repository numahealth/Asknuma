@extends('admin.layouts.master')

@section('content')



@if ($history->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        <th>Id</th>
						<th class="no-sort">User Id</th>
						<th class="no-sort">Type</th>
						<th class="no-sort">User Name</th>
						<th class="no-sort">Serach Keyword</th>
                        <th class="no-sort">IP address</th>
                    </tr>
                </thead>

                <tbody>
				
                    @foreach ($history as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
							
							<td>{{ $row->user_id }}</td>
							<td>@if($row->login_status ==1) User
							@else
							Guest
							@endif
							</td>
							<td><?php $name = DB::table('users')
									->select('name')
									->where('id', '=',$row->user_id)
									->get();
									//print_r($name_dieseases);?>
							{{ @$name[0]->name }}</td>
							<td>{{ $row->seach_keyword }}</td>
							<td>{{ $row->ip_address }}</td>

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