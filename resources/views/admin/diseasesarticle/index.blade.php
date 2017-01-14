@extends('admin.layouts.master')

@section('content')



@if (1)
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
			<p>{!! link_to_route('admin.diseasesarticle.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>
        </div>
        <div class="portlet-body">
            <table class="no-more-tables table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        <!--th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th-->
						<th>ID</th>
                        <th class="no-sort">Diseases Name</th>
						<th class="no-sort">Article Name</th>
						<th class="no-sort">Article video</th>
						<th class="no-sort">Article Image</th>
						<th class="no-sort">Description</th>
						<th class="no-sort">Status</th>
                        <th class="no-sort">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($diseasesarticle as $row)
                        <tr>
                            <!--td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td-->
							<td data-title="Id">{{ $row->id }}</td>
                            <td data-title="Diseases Name">{{ isset($row->diseases->disease_name) ? $row->diseases->disease_name : '' }}</td>
							<td data-title="Article Name">{{ $row->article_title }}</td>
							<td data-title="Article video"> <?php echo $row->article_video; ?> </td>
							<td data-title="Article Image">@if($row->article_profile != '')<img src="{{ asset('public/uploads/thumb') . '/'.  $row->article_profile }}">@endif</td>
							<td data-title="Description">
							<?php  echo str_limit($row->article_description, $limit = 50, $end = '...') ?>
							<?php if(strlen($row->article_description) > 50) { ?>
							<a  class="" data-toggle="modal" data-target="#myModal{{ $row->id }}">
							Read More
							</a>
							<?php  } ?>
							<div class="modal fade" id="myModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Description</h4>
									  </div>
								<div class="modal-body">
								<?php echo $row->article_description ?>
								</div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
									
								  </div>
											</div>
								</div>
							</div>
							</td>
							<td data-title="Status">{{ $row->status }}</td>
                            <td data-title="Action">
                                {!! link_to_route('admin.diseasesarticle.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                <!--{!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array('admin.diseasesarticle.destroy', $row->id))) !!}
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
            {!! Form::open(['route' => 'admin.diseasesarticle.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
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
<style>
iframe{
	width:200px;
	height:100px;
}
</style>