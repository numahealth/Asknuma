@extends('admin.layouts.master')

@section('content')



@if ($feedback->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
			<p><a href="{{url('/admin/feedback/excel_download')}}" class="btn btn-success">Download Excel</a></p>
        </div>
        <div class="portlet-body">
            <table class="no-more-tables table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        <!--th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th-->
						<th>Id</th>
                        <th class="no-sort">Diseases Article</th>
						<th class="no-sort">Type</th>
						<th class="no-sort">User Name</th>
						<th class="no-sort">Feedback</th>
						<th class="no-sort">Reason</th>

                        <th>Action</th>
                    </tr>
                </thead>

                  <tbody>
                    @foreach ($feedback as $row)
                        <tr>
                            <!--td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td-->
							<td>{{ $row->id }}</td>
                            <td>
							<?php 
							if($row->type=='blog')
							{
								$detail = DB::table('blog')
								->select('blog_name')
								->where('id', '=',$row->diseasesarticle_id)
								->get();
								$name= $detail[0]->blog_name;
							}else{
								$detail = DB::table('diseasesarticle')
								->select('article_title')
								->where('id', '=',$row->diseasesarticle_id)
								->get();
								$name=$detail[0]->article_title;
							}
							?>
							{{  $name}}
							
							</td>
                            <td>{{ isset($row->type) ? $row->type : '' }}</td>
							<td>{{ isset($row->user->name) ? $row->user->name : '' }}</td>
							<td>{{ $row->feedback }}</td>
							<td>{{ isset($row->reason->reason) ? $row->reason->reason : '' }}</td>
							

                            <td>
                               
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array('admin.feedback.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
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
            {!! Form::open(['route' => 'admin.feedback.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
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