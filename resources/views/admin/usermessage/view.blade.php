@extends('admin.layouts.user')

@section('content')

<?php 

 $name = DB::table('users')
		->select('name','profile_pic','email','age','gender')
		->where('id', '=',@$main_message)
		->get();
?>
	
		
       
			
			
			<!--**************profile details *************-->
              <div class="row">
                <div id="chatbox_female" class="col-md-12 chatbox1">
					<div class="chatboxhead">
						<div class="chatboxtitle">
						   <!-- <span class="glyphicon glyphicon-heart-empty pulse"></span> --> Type your medical question below to get an answer from one of our doctors
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
							<span class="chatboxmessagefrom"><?php if($value->user_id==1){ ?> <img style="width:50px;" src="{{ URL::asset("public")}}/quickadmin/images/asknuma.png" /> <?php }else
							{ if(@$main_message->profile_pic != '') { $url=URL::asset('public/uploads/thumb'). '/'.@$main_message->profile_pic; } else { 
							
							$url = URL::asset('public/quickadmin/images/user_profile.jpg');
							}?> <img style="width:50px;" src="<?php echo $url;?>" /> 
							<?php  } ?></span>
							<div class="chatboxmessagecontent"><time datetime="2009-11-13T20:00"><?php if($value->age!==0){ echo 'Age : '.$value->age.' | '.$value->gender.' | ';}?><? echo date('d M Y h:i:sA',strtotime($value->created_at)); ?> | @if($value->embedded != '')
								<a style="cursor:pointer" data-toggle="modal" data-target="#myModalv{{ $value->id }}"> Video attachment </a>
								@endif </time> </time> 
								@if($value->profile_pic != '')<img style="cursor:pointer" data-toggle="modal" data-target="#myModal{{ $value->id }}" src="{{ URL::asset('public/uploads/thumb') . '/'.  $value->profile_pic }}">
								<div class="chatbox_text"><p> 
								<?php echo $value->message;?>
								</p></div>
								@else
								<?php echo $value->message;?>	
								@endif
                                <div class="cl"></div>
							</div>
					   </div>
					     <div class="modal fade" id="myModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Attachment</h4>
									  </div>
								<div class="modal-body">
								@if($value->profile_pic != '')<img  style="width: 100%; cursor:pointer" src="{{ URL::asset('public/uploads') . '/'.  $value->profile_pic }}">
								@endif
								</div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
									
								  </div>
											</div>
								</div>
					</div>
					<div class="modal fade" id="myModalv{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Video Attachment</h4>
									  </div>
								<div class="modal-body">
								<?php echo $value->embedded ?>
								
								</div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
									
								  </div>
											</div>
								</div>
					</div>
					  <div class="modal fade" id="myModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Attachment</h4>
									  </div>
								<div class="modal-body">
								@if($value->profile_pic != '')<img  style="width: 100%; cursor:pointer" src="{{ URL::asset('public/uploads') . '/'.  $value->profile_pic }}">
								@endif
								</div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
									
								  </div>
											</div>
								</div>
					</div>
					<div class="modal fade" id="myModalv{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Video Attachment</h4>
									  </div>
								<div class="modal-body">
								<?php echo $value->embedded ?>
								
								</div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
									
								  </div>
											</div>
								</div>
					</div>
						<?php }?>
				 
				</div>
				{!! Form::open(array('method'=>'post','route' =>'admin.usermessage.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal','files'=>'true')) !!}
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
				
		 
				   <textarea name="message" id="message" class="chatboxtextarea form-control ckeditor" rows="5" placeholder=" Write your question, comment, or request here" ></textarea>
				   {!! Form::hidden('user_to',1) !!}
				   {!! Form::hidden('parent_id',0) !!}
				  <span class="upload"><b>Attach picture</b> &nbsp; <i class="fa fa-upload"></i>
							
							{!! Form::file('profile_pic',array('id'=>'input-file', 'class'=>"chatboxtextareas form-control")) !!}
						<span class="filename"></span></span> 
				   {!! Form::text('embedded', old('embedded'), array('class'=>' chatboxtextareas  form-control','placeholder'=>'Embedded video')) !!}
		       		   {!! Form::hidden('profile_pic_w', 4096) !!}
                                   {!! Form::hidden('profile_pic_h', 4096) !!}
					<button type="submit" class="btn btn-default chat_submit">Submit</button>
				   </div>
		   
			{!! Form::close() !!}
		   </div>
         
    
	</div>
<style>
.alert li:nth-of-type(2),.alert li:nth-of-type(3) {
  display:none;
}
iframe{width:100%!important;}
.chatboxmessagecontent img {
    width: 10%;
    padding-right: 10px;
}

.chatbox_text {
    float: right;
    width: 90%;
}
</style>
 <a href="#" id="welcome_message" class="btn btn-info hide"  data-toggle="modal" data-target="#ask_doctor"  >Ask A Doctor</a>
  <div class="modal fade" id="ask_doctor" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:#75d575;"> Welcome, {{ ucwords(Auth::user()->name) }}</h4>
        </div>
        <div class="modal-body">
		 Welcome to your personal Numa Account! This is where you can chat to one of our healthcare professionals, fill our your personal health profile & find healthcare products and services that you need. Before you get going, there are a few things you can do to make your experience awesome.
		 <br/>  <br/>Firstly, go to My Profile and change your password to something secure and memorable then tell us a bit more about yourself. You can upload a picture and note down and diseases or allergies you have had in the past. This all helps us to create a more personalised service for you. Go to your Messages and tell one of our doctors that this is your first time logging on so we can set up your first appointment. If you have any questions, send us an email on info@numa.io for a quick response!
		
		<div class="form-group">
</br>
        <label><input id="dont_show" type="checkbox" value=""> Don't show this message again.</label>
	</div>
	<button id="close_popup" type="button" class="btn btn-success" style=" float:none" data-toggle="modal" data-dismiss="modal" >Submit</button>


     
	  </div>
       
      </div>
    </div>
  </div>
  <style>
  .cke_reset_all {
    display: none;
}
.cke_chrome
{
 margin-bottom:3px;
}
  </style>
 <script src="https://www.asknuma.com/asknuma/public/user/assets/plugins/ckeditor/ckeditor.js"></script>			
				
@endsection


