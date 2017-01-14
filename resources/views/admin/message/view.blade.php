@extends('admin.layouts.master')

@section('content')
 
<?php 

 $name = DB::table('users')
		->select('name','profile_pic','email','age','gender')
		->where('id', '=',@$main_message)
		->get();
		$user_sent=1;
?>
	
		
       
			
			
			<!--**************profile details *************-->
              <div class="row">
                <div id="chatbox_female" class="col-md-12 chatbox1">
					<div class="chatboxhead">
						<div class="chatboxtitle">
						   <!-- <span class="glyphicon glyphicon-heart-empty pulse"></span> --> Message Thread with
										{{ ucfirst(@$name[0]->name) }} / {{@$name[0]->age}} / {{@$name[0]->gender}}
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
							<span class="chatboxmessagefrom"><?php if($value->user_id==1){?> <img style="width:50px;" src="{{ URL::asset("public")}}/quickadmin/images/asknuma.png" /> <?php }else
							{ $user_sent=2;if(@$name[0]->profile_pic != '') { $url=URL::asset('public/uploads/thumb'). '/'.@$name[0]->profile_pic; } else { 
							
							$url = URL::asset('public/quickadmin/images/user_profile.jpg');
							}?> <img style="width:50px;" src="<?php echo $url;?>" /> 
							<?php  } ?></span>
							<div class="chatboxmessagecontent"><time datetime="2009-11-13T20:00"><?php if($value->age!==0){ echo 'Age : '.$value->age.' | '.$value->gender.' | ';}?><? echo date('d M Y h:iA',strtotime($value->created_at)); ?> @if($value->embedded != '')
								| <a style="cursor:pointer" data-toggle="modal" data-target="#myModalv{{ $value->id }}"> Video attachment </a>
								@endif  </a> </time> 
								
								@if($value->profile_pic != '')<img style="cursor:pointer" data-toggle="modal" data-target="#myModal{{ $value->id }}" src="{{ URL::asset('public/uploads/thumb') . '/'.  $value->profile_pic }}">
								<div class="chatbox_text"><p id="message_for_slack<?php echo $value->id ;?>"> 
								<?php echo trim($value->message);?>
								</p></div>
								@else
								<p id="message_for_slack<?php echo $value->id ;?>"><?php echo trim($value->message);?></p>	
								@endif
								
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
				{!! Form::open(array('method'=>'post','files' => true,'route' =>'message.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal','id'=>'validation_form')) !!}
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
				
		 
				   <textarea name="message" id="message" class="chatboxtextarea form-control ckeditor" rows="5" placeholder="Please enter message here"></textarea>
				   {!! Form::file('profile_pic',array( 'class'=>"chatboxtextareas form-control")) !!}
				   {!! Form::text('embedded', old('embedded'), array('class'=>' chatboxtextareas  form-control','placeholder'=>'Embedded video')) !!}
		       		   {!! Form::hidden('profile_pic_w', 4096) !!}
                                   {!! Form::hidden('profile_pic_h', 4096) !!}
				   {!! Form::hidden('user_to', @$main_message) !!}
				   {!! Form::hidden('parent_id',0) !!}
				<div id="admin_chat">
					<button type="submit" class="btn btn-default chat_submit">Submit</button>
				   </div></div>
		   
			{!! Form::close() !!}
		   </div>
         
    
	</div>

<style>
.alert li:nth-of-type(2),.alert li:nth-of-type(3) {
  display:none;
}
iframe{width:100%!important}
.chatboxmessagecontent img {
    width: 10%;
    padding-right: 10px;
}
.cke_reset_all{
	display:none;
}
.chatbox_text {
    float: right;
    width: 90%;
}
</style>

@endsection

