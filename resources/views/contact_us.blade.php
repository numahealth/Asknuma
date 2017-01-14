@extends('admin.layouts.front')

@section('content')
<style>
iframe{
	    width: 400px!important;
    height: 300px!important;
}
</style>
<div class="container">
        
    <?php 
		$content = DB::table('pages')
								->where('id', '=',4)
								->get();
		echo @$content[0]->description
		?> 
                
        </div>
@endsection
