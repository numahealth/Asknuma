@extends('admin.layouts.master')

@section('content')
 
<?php 

 $name = DB::table('users')
		->select('name','profile_pic','email','age','gender')
		->where('id', '=',@$main_message)
		->get();
?>
	<div class="row">
		
            <div class="col-sm-12">
			<!--**************profile details *************-->
			 <div id="admin_profile" class="col-md-6 " style=" ">
				<div class="pro_pic_wrap">
					@if(@$name[0]->profile_pic != '')<img src="{{ URL::asset('public/uploads') . '/'.  $name[0]->profile_pic }}">@else
					<img src="https://asknuma.com/asknuma/public/quickadmin/images/Chat-profile.jpg">@endif
				</div>
            <h3>{{ @$name[0]->name }}</h3>
            
            <div class="row profile_wrape">
            
				 <div class="col-md-7 pro-txt_mar"> 
				 
				<div class="row txt_space">
				  <div class="col-md-4"> <strong>Gender</strong> </div>
				  <div class="col-md-8">
				  {{ @$name [0]->gender }}
				  </div></div>
				  
				   <div class="row txt_space">
				  <div class="col-md-4"> <strong>Age</strong> </div>
				  <div class="col-md-8">
				  {{ @$name[0]->age }} years
				  </div></div>
				  
					<div class="row txt_space">
				  <div class="col-md-4"> <strong>Email ID</strong> </div>
				  <div class="col-md-8">
				  {{ @$name[0]->email }}
				  </div></div>

				</div>
            

            </div>
    
            </div>
			
			<!--**************profile details *************-->
                <div id="chatbox_female" class="col-md-6 chatbox1" style="bottom: 0px; right: 20px; display: block;">
					<div class="chatboxhead">
						<div class="chatboxtitle">
						   <!-- <span class="glyphicon glyphicon-heart-empty pulse"></span> --> Message Thread with
										{{ @$name[0]->name }} / {{@$name[0]->age}} / {{@$name[0]->gender}}
						</div>
						<!--<div class="chatboxoptions">
							<div class="dropdown">
								<a href="javascript:void(0)" id="settings" data-toggle="dropdown" area-haspopup="true" area-expanded="true"><i class="fa fa-gears"></i></a> 
								<ul class="dropdown-menu dropdown-menu-right"  aria-labelledby="settings">
									<li><a href="#"><i class="fa fa-flag"></i> Report</a></li>
									<li><a href="#"><i class="fa fa-ban"></i> Block</a></li>
								</ul>	
							</div>
							<a onclick="javascript:toggleChatBoxGrowth('female')" href="javascript:void(0)"><i class="fa fa-minus"></i></a> 	
							<a onclick="javascript:closeChatBox('female')" href="javascript:void(0)"><i class="fa fa-close"></i></a>
						</div>-->
						<br clear="all">
					</div>
				<div class="chatboxcontent">
						
						<?php foreach($message as $value) { ?>
						<div class="chatboxmessage <?php if($value->user_id==1){ echo "ltr" ;} ?>">
							<span class="chatboxmessagefrom"><?php if($value->user_id==1){ echo "Admin" ;}else {echo "User"; } ?></span>
							<div class="chatboxmessagecontent"><time datetime="2009-11-13T20:00"><? echo date('d M Y h:i:sa',strtotime($value->created_at)); ?><?php if($value->age!==0){ echo ' /'.$value->age.' /'.$value->gender;}?></time> 
								<?php echo $value->message;?>
							</div>
					   </div>
						<?php }?>
				 
				</div>
				{!! Form::open(array('method'=>'post','route' =>'message.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}
				   <div class="chatboxinput">
					
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								{!! implode('', $errors->all('
								<li class="error">:message</li>
								')) !!}
							</ul>
						</div>
					@endif
				
		 
				   <textarea name="message" id="message" class="chatboxtextarea form-control" rows="5" ></textarea>
				   {!! Form::hidden('user_to', @$main_message) !!}
				   {!! Form::hidden('parent_id',0) !!}
					<button type="submit" class="btn btn-default chat_submit">Submit</button>
				   </div>
		   
			{!! Form::close() !!}
		   </div>
          <div class="clearfix"> </div>
            </div>
    	  
		</div>
	</div>



@endsection
