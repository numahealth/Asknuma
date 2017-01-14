@extends('admin.layouts.front')

@section('content')
<div class="container">
		<?php 
		$content = DB::table('pages')
								->where('id', '=',3)
								->get();
		echo @$content[0]->description
		?>     
<div class="container home_about">
  <div class="row">
    <div class="col-md-12"> 
      <!-- .fancy-heading start -->
      <section class="fancy-heading center">
        <h2 style="color: #53b553;">About Us</h2>
      </section>
      <!-- .fancy-heading end -->
      
      <p class="text-center"> 
	 
      Numa Health builds delightful healthcare tools, made specially for busy achievers, that puts healthcare back in your hands. 
	  </p>
      
       <div class="col-md-12 home_about1"> 
         <div class="col-md-4 col-sm-4 col-xs-12"> <img src="{{ URL::asset('public/front/img') . '/girl.png' }}"> 
         
         <p> Your very own artificially intelligent health assistant</p>
         </div>

         <div class="col-md-4 col-sm-4 col-xs-12"> <img src="{{ URL::asset('public/front/img') . '/book.png' }}">
        
        <p> High quality health advice </p>
          </div>         


         <div class="col-md-4 col-sm-4 col-xs-12"> <img src="{{ URL::asset('public/front/img') . '/hospital.png' }}"> 
         <p> Find vetted specialists, pharmacies and health facilities near you</p>
         </div>
         
        
         
         </div>
      
      
    </div>
    <!-- .col-md-12 end --> 
  </div>
  <!-- .row end --> 
  
</div>   
</div>
@endsection
