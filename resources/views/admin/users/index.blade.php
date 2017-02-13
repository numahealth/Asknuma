@extends('admin.layouts.master')
@section('content')
<?php
/* echo '<pre>';
  print_r($users);
  echo '</pre>'; */
?>

@if(1)
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">{{ trans('quickadmin::admin.users-index-users_list') }}</div>
        <p>{!! link_to_route('users.create', trans('quickadmin::admin.users-index-add_new'), [], ['class' => 'btn btn-success']) !!}</p>
    </div>
    <div class="portlet-body">
        <table id="datatables" class="no-more-tables table table-striped table-hover table-responsive datatable">
            <thead>
                <tr>

                    <th>ID</th>
                    <th class="no-sort">Profile Image </th>
                    <th class="">Name</th>
                    <th class="no-sort">Latest Diagnosis</th>
                    <th class="no-sort">Message</th>
                    <th class="no-sort">Status</th>
                    <th class="no-sort">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $user_exists_array = array(); ?>
                @foreach ($users as $user)
                @if(!in_array($user->id,$user_exists_array)) 
                <tr>
                    <?php $user_exists_array[] = $user->id; ?>

                    <td data-title="Id">{{ $user->id }}</td>
                    <td data-title="Profile Image">
                        @if($user->profile_pic != '')<img src="{{ URL::asset('public/uploads/thumb') . '/'.  $user->profile_pic }}">
                        @else
                        <img style="width:90px" src="{{ URL::asset('public/quickadmin/images/user_profile.jpg') }}">

                        @endif
                    </td>
                    <td data-title="Name">{{ $user->name }}</td>
                    <td data-title="Latest Diagnosis">{{ $user->seach_keyword }}</td>
                    <td data-title="Message">
                        <?php
                        $messages = DB::table('numa_message')
                                ->select('message', 'id')
                                ->where('user_id', '=', $user->id)
                                ->orderBy('numa_message.created_at', 'desc')
                                ->get();
                        if (@$messages[0]->message != '') {
                            echo substr(@$messages[0]->message, 0, 30) . ' <a style="float:right	" href="' . url('/admin/message/view/' . $user->id . '') . '">Read More</a>';
                        }
                        ?>
                    </td>
                    <td data-title="Status">{{ $user->status }}</td>
                    <td data-title="Action">
                        {!! link_to_route('users.view', 'View', [$user->id], ['class' => 'btn btn-xs btn-danger']) !!}
                        {!! link_to_route('users.edit', trans('quickadmin::admin.users-index-edit'), [$user->id], ['class' => 'btn btn-xs btn-info']) !!}


                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@else
{{ trans('quickadmin::admin.users-index-no_entries_found') }}
@endif

@endsection