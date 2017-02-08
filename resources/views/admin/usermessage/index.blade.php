@extends('admin.layouts.user')

@section('content')

<?php
$name = DB::table('users')
        ->select('name', 'profile_pic', 'email', 'age', 'gender')
        ->where('id', '=', @$main_message)
        ->get();
?>


<!--**************profile details *************-->

@stop