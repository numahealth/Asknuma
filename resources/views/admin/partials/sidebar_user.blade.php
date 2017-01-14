<div id="nav">
				<div id="nav-scroll">
						<div class="avatar-slide">
							<?php 
							$counting=0;
							if($main_message->profile_pic!="")
							{
								$counting++;
							}
							if($main_message->age!=0)
							{
								$counting++;
							}
							if($main_message->phone!='')
							{
								$counting++;
							}
							if(@$main_message->medical_history!='')
							{
								$counting++;
							}
							if(@$main_message->active_medications!='')
							{
								$counting++;
							}
							 $total=$counting+3;
							 $per=($total*100)/8;
							?>
								<span class="easy-chart avatar-chart" data-color="theme-inverse" data-percent="<?php echo $per; ?>" data-track-color="rgba(255,255,255,0.1)" data-line-width="5" data-size="118">
										<span class="percent"></span>
										<?php if(@$main_message->profile_pic != '') { $url=URL::asset('public/uploads/thumb'). '/'.@$main_message->profile_pic; } else { 
										$url = URL::asset('public/quickadmin/images/user_profile.jpg');
										}?> 
										<img alt="" src="<?php echo  $url;?>" class="circle">
								</span>
								<!-- //avatar-chart-->
								
								<div class="avatar-detail">
										<p><strong>Hi</strong>, {{ucwords(Auth::user()->name)}}</p>
										<!--p><a href="#">@ Chaing Mai , TH</a></p>
										<span>12,110 Sales</span>
										<span>106 Follower</span-->
								</div>
								<!-- //avatar-detail-->
								
								<div class="avatar-link btn-group btn-group-justified">
								
								</div>
								<!-- //avatar-link-->
								
						</div>
						<!-- //avatar-slide-->
						
						
				</div>
				<!-- //nav-scroller-->
		</div>