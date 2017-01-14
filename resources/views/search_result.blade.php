@extends('admin.layouts.front')

@section('content')
<div class="container"> 

    <div class="col-md-12 row">
		   <?php 				
                $empty_record=1; 		   
				$values=array();
				$symptom = DB::table('symptom_search')
							 ->join('symptom', 'symptom.id', '=', 'symptom_search.symptom_id')
							->select('symptom_search.symptom_id')
							->where('symptom.status', '=','Active')
							->where('symptom_search.search_keyword', '=',@Session::get('key'))
							->get();
				$resultArray = json_decode(json_encode($symptom), true);
				$result = ($resultArray);
				if(empty($symptom))
					{
						$empty_record=0;
					}
					else
					{
						$group = DB::table('group')
						 ->join('diseases', 'diseases.id', '=', 'group.dieases')
						->select('group.mapping','group.id','group.dieases')
						->where('diseases.status', '=','Active')
						->whereIn('group.symptom', $result)
						->get();
						
						if(empty($group))
						{
							$empty_record=0;
						}
						/*else{
							
							if(empty($article))
							{
								$empty_record=0;
							}
						}*/
						
					}
				

							
		?>
		<h3 style=" color:#333333; margin-bottom:0;">
			@if($empty_record==1) 
				Please choose from the option below that best matches what you searched for so we can point you in the right direction.
			@else
				No Record matched.
			@endif
			
		</h3>
    </div><!-- .col-md-12 end --> 
	@if($empty_record==1) 							
    <div class="row">
		@foreach($group as $groups)
		<?php 				
		$article = DB::table('diseasesarticle')
					->select('id')
					->where('status','Active')
					->where('diseases_id', $groups->dieases)
					->orderBy('created_at','desc')
					->take(1)
					->get();
		
		?>
		<?php if(@$article[0]->id!=''){ ?>
		<div class="symptom_wrap">
		
		  <ul class="nav">
		  <?php $symptom_list = json_decode($groups->mapping);
		  foreach(@$symptom_list as $sym)
		  {
			  
			  $name_sym = DB::table('symptom')
					->select('symptom_name')
					->where('id', @$sym)
					->get();
			?>
			<a href="{{ url('/article_details_small/'.	@$article[0]->id)}}">  <li>  <i class="fa fa-angle-double-right"> </i> {{ @$name_sym[0]->symptom_name }}</li></a>
		
		  <?php } ?>
		  
		  
		  </ul>
      </div>   
		<?php } ?>
		@endforeach
    </div> 
	@endif
</div>
@endsection
