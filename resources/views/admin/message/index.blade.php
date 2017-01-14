@extends('admin.layouts.master')

@section('content')



@if (1)
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
			<p>{!! link_to_route('message.new_message', 'New Message' , null, array('class' => 'btn btn-success')) !!}</p>
        </div>
		
        <div class="portlet-body">
            <table class="no-more-tables table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        <!--th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th-->
                        <th style="display:none">Id</th>
						<th>Id</th>
                        <th class="no-sort">User Name</th>

						<!--th class="no-sort">Diseases Name</th-->

                        <th class="no-sort">Profile Image</th>
                         <th class="no-sort">Message</th>
						<th class="no-sort">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($message as $row)
					<?
                        $id_data=$row->user;
						if($row->user==1)
						{
							$id_data=$row->user;
						}
					?>
                        <tr>
                        <th style="display:none">Id</th>
                           
							<td data-title="Id">{{$id_data}}</td>
							<td data-title="User Name"><?php 
									
									$name = DB::table('users')
									->select('name','profile_pic')
									->where('id', '=',$id_data)
									->get();
									//print_r($name_dieseases);?>
							{{ @$name[0]->name }}</td>
							<td data-title="Profile Image">@if(@$name[0]->profile_pic != '')<img src="{{ URL::asset('public/uploads/thumb') . '/'.  @$name[0]->profile_pic }}">
							 @else
        <img style="width:50px" src="{{ URL::asset('public/quickadmin/images/user_profile.jpg') }}">
    
							@endif</td>
							
                                                      <td>
                                                          <?php   $message= DB::table('numa_message')
			                                    ->select('numa_message.*')
			                                     ->where('status', '=','Active')
			                                     ->where('user_id', '=',$row->user)
			                                     ->orWhere('user_to', '=',$row->user)
			                                     ->orderBy('numa_message.created_at', 'desc')
                                                              ->get(); ?>
                                                     {{ str_limit($message[0]->message, $limit =40, $end = '...') }}
                                                          </td>
                            <td data-title="Action">
                                {!! link_to_route('message.view','View', array($id_data), array('class' => 'btn btn-xs btn-info')) !!}
                             
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
            {!! Form::open(['route' => 'admin.pages.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
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