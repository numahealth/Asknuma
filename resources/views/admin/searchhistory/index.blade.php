@extends('admin.layouts.user')

@section('content')
<div class="row">
    <section class="panel">
        <div style="width:98%; height:auto; margin:0px auto 10px; padding:10px 0;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f3f3f3" class="no-more-tables table table-striped table-hover table-responsive datatable" id="datatables">
                <thead>
                    <tr>
                        
						
						
						<th class="no-sort">Serach Keyword</th>
                        
                      
                    </tr>
                </thead>

                <tbody>
				
                    @foreach ($history as $row)
                        <tr>
                           
							
							
							<td data-title="Search Keyword">{{ $row->seach_keyword }}</td>
							
							
                        </tr>
						
                    @endforeach
                </tbody>
            </table>

       </div> 
    </section>
</div>
<style>
thead th {
    text-align: left;
    padding: 10px!important;
}
</style>
@endsection