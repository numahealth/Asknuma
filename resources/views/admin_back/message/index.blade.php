@extends('admin.layouts.master')

@section('content')



@if (count($message))
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
			
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        <!--th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th-->
						<th>Id</th>
                        <th class="no-sort">User Name</th>

						<th class="no-sort">Diseases Name</th>

                        <th class="no-sort">Diseases Article</th>
						<th class="no-sort">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($message as $row)
                        <tr>
                            <!--td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td-->
							<td>{{$row->user_id}}</td>
							<td><?php $name = DB::table('users')
									->select('name')
									->where('id', '=',$row->user_id)
									->get();
									//print_r($name_dieseases);?>
							{{ @$name[0]->name }}</td>
							<td><?php $name = DB::table('diseases')
									->select('disease_name')
									->where('id', '=',$row->diseases_id)
									->get();
									//print_r($name_dieseases);?>
							{{ @$name[0]->disease_name }}</td>
							<td><?php $name = DB::table('diseasesarticle')
									->select('article_title')
									->where('id', '=',$row->diseases_article_id)
									->get();
									//print_r($name_dieseases);?>
							{{ @$name[0]->article_title }}</td>
                            <td>
                                {!! link_to_route('message.view','View', array($row->user_id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array('admin.pages.destroy', $row->id))) !!}
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