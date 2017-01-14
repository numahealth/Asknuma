@extends('admin.layouts.front')

@section('content')
<div class="container">
		<?php 
		$content = DB::table('pages')
								->where('id', '=',6)
								->get();
		echo @$content[0]->description
		?>        
</div>
@endsection
