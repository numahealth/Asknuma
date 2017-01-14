@extends('admin.layouts.front')

@section('content')
 <?php	
		
		$detail = DB::table('blog')
					->where('blog.status', '=','Active')
					->where('id', '=',@Request::segment(2))
					->get();
		if(empty($detail))
		{
			return Redirect::to('search_result')->send();
				
		}
	//	print_r($detail);
?>
<div class="container"> 
	<div class="row disease_details">
		<section class="fancy-heading left">
            <h3><span> {{$detail[0]->blog_name}} </span></h3>
        </section>
		<?php 
		echo ucfirst(str_limit( $detail[0]->description, $limit = 1000, $end = '...</br>')) 
		?>
	
		<a href="{{ url('/blog_details/'.	@Request::segment(2))}}" class="btn btn-success">Read More</a>	


    </div>     
</div>
<div class="container-fluid helpful">
<div class="container">


<div class="col-md-5 helpful_wrap"> 
 <h1>Was this helpful?</h1>
 <div class="yes_no">
 
 <a href="#"  class="btn btn-danger" <?php if (Auth::check()){ ?> data-toggle="modal" data-target="#no_helpful" <?php } else{?> data-toggle="modal" data-target="#myModal" <?php } ?> >NO</a>
 <a style="cursor:pointer" <?php if (Auth::check()){ ?> onclick ='yes_no_blog({{$detail[0]->id}},"Yes");' <?php } else {?> data-toggle="modal" data-target="#myModal" <?php }?>class="btn btn-success" >Yes</a>
 <a href="#" id="thanks" class="btn btn-success hide" data-toggle="modal" data-target="#yes_helpful">Yes</a>
 </div>
 <div class="yes_no large_btn">
 
 <a href="#" class="btn btn-info" <?php if (Auth::check()){ ?> data-toggle="modal" data-target="#ask_doctor" <?php } else{?> data-toggle="modal" data-target="#myModal" <?php } ?> >Ask A Doctor</a>
 <a href="#" class="btn btn-info">Change Symptoms</a>
 </div>
<div class="yes_no large_btn">
	<?php if (Auth::check()){ 
			$exist_bookmark= DB::table('numa_bookmark')
			->select('id')
			->where('user_id', '=',Auth::user()->id)
			->where('diseases_article_id', '=',$detail[0]->id)
			->where('type', '=','blog')
			->where('status', '=','Active')
            ->get();
			if(empty($exist_bookmark)) { ?>
		<a style="cursor:pointer" <?php if (Auth::check()){ ?> onclick ='bookmark_blog({{$detail[0]->id}},"Active");' <?php } else {?> data-toggle="modal" data-target="#myModal" <?php }?>class="save_bookmark" >Save this article for later</a>
			<?php } else { ?>
			<a style="cursor:pointer" <?php if (Auth::check()){ ?> onclick ='bookmark_blog({{$detail[0]->id}},"Inactive");' <?php } else {?> data-toggle="modal" data-target="#myModal" <?php }?>class="delete_bookmark" >Delete Bookmark</a>	
	<?php } } else { ?>
	<a style="cursor:pointer" <?php if (Auth::check()){ ?> onclick ='bookmark_blog({{$detail[0]->id}});' <?php } else {?> data-toggle="modal" data-target="#myModal" <?php }?>class="save_bookmark" >Save this article for later</a>
	<?php } ?>

 </div>


</div>

</div>
</div>


 <!-- Popup modal box -->

<!-- Was this helpful? (Yes) -->
  <div class="modal fade" id="yes_helpful" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-thumbs-up"> </i> </h4>
        </div>
        <div class="modal-body">
          <p><h5>Thank you for your feedback</h5></p>
        </div>
       
      </div>
    </div>
  </div>



<!-- Was this helpful? (No) -->
  <div class="modal fade" id="no_helpful" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Please let us know why...</h4>
        </div>
        <div class="modal-body">
		<div class="form-group">
		  <label for="comment">Reason:</label>
		 
		<?php $values=array();
							  $symptom = DB::table('reason')->where('status', '=','Active')->get();
							  if(!empty($symptom))
								{
									 foreach($symptom as $records)
									 {
										 
										 $values[$records->id]=$records->reason;
									}
								}
							
							
				?>
	{!! Form::select('search_keyword', $values, old('search_keyword'), array('class'=>'form-control','id'=>'reason_id')) !!}
 
        
   
		</div>
	<div class="form-group">
	  <label for="comment">Comment:</label>
	  <textarea class="form-control" rows="3" id="reasons"></textarea>
	</div>
	<button onclick ='yes_no_blog({{$detail[0]->id}},"No");' type="submit" class="btn btn-info" style=" float:none"  data-dismiss="modal">Submit</button>

        </div>
       
      </div>
    </div>
  </div>



<!-- Ask Doctor -->
  <div class="modal fade" id="ask_doctor" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Please enter your query below</h4>
        </div>
        <div class="modal-body">
		 {!! Form::open(['route' => 'users.store', 'files' => true, 'class' => 'form-horizontal','id'=>'validation_form']) !!}
		<div class="form-group">
  <label for="gender">Gender:</label>
  <?php
  $gender['Male']='Male';
  $gender['Female']='Female';
  $gender['Other']='Other';
  ?>
  {!! Form::select('gender', $gender, old('gender'), array('class'=>'form-control','id'=>'gender')) !!}
	</div>
		<div class="form-group">
  <label >Age:</label>
   {!! Form::number('age', old('age'), ['class'=>'form-control', 'placeholder'=> 'Age','min'=>'1','required'=>'true','id'=>'age']) !!}
	</div>
	<div class="form-group">
	  <label for="comment">Query:</label>
	  <textarea name="comment" class="form-control" required rows="3" id="comment"></textarea>
	</div>

<button  onclick='query_to_doc(<?php echo @Request::segment(2)?>);' type="button" class="btn btn-info" style=" float:none" data-toggle="modal"  >Submit</button>
<button  id="click_here" type="submit" class="btn btn-info hide" style=" float:none" data-toggle="modal"  >Submit</button>
<button  id="dismiss" type="button" class="btn btn-info hide" style=" float:none" data-toggle="modal"  data-dismiss="modal" >Submit</button>

</form>      
	  </div>
       
      </div>
    </div>
  </div>
@endsection
