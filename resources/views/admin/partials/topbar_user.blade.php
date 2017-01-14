<div id="header">
		
				<div class="logo-area clearfix">
						<a href="{{ url('') }}" class="logo"> <img src="{{ URL::asset('public/user/images')}}/asknuma.png" alt=""></a>
				</div>
				<!-- //logo-area-->
				
				<div class="tools-bar">
						<ul class="nav navbar-nav nav-main-xs">
								<li><a href="#menu" class="icon-toolsbar"><i class="fa fa-bars"></i></a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right ">
							<li class="top_sprofile_pic"><a href="#" class="nav-collapse avatar-header" >
							<?php if(@$main_message->profile_pic != '') { $url=URL::asset('public/uploads/thumb'). '/'.@$main_message->profile_pic; } else { 
							$url = URL::asset('public/quickadmin/images/user_profile.jpg');
							}?> 
												<img alt="" src="{{$url}}	"  class="circle">
												<!--span class="badge">3</span-->
										</a>
								</li>
								<li class="dropdown">
										<a href="#" class="dropdown-toggle" >
											<em><strong>Hi</strong>, {{ucwords(Auth::user()->name)}} </em> 
										</a>
								
										<!-- //dropdown-menu-->
								</li>
							
								<li><a href="{{ url('logout') }}" class="h-seperate"><i class="fa fa-sign-out h-seperate"></i> Signout </a></li>
								
							</ul>
							
				</div>
				<!-- //tools-bar-->
				
		</div>