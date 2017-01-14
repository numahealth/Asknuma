@include('admin.partials.header_user')
<div id="wrapper">
@include('admin.partials.topbar_user')
@include('admin.partials.sidebar_user')
    <div id="main">
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">
			<?php 
			  $titles = preg_replace('/([a-z0-9])?([A-Z])/','$1 $2',str_replace('Controller','',explode("@",class_basename(app('request')->route()->getAction()['controller']))[0]));
			$methos_name = substr(Route::currentRouteAction(), (strpos(Route::currentRouteAction(), '@') + 1) );
				$position = strpos($titles,"Search History");
			if($position==1 && $methos_name=='bookmark')
			{
			  echo "Pinned Media";
			}
			else {?>
                {{ preg_replace('/([a-z0-9])?([A-Z])/','$1 $2',str_replace('Controller','',explode("@",class_basename(app('request')->route()->getAction()['controller']))[0])) }} <?php } ?>
			</li>
		</ol>
		<header class="panel-heading main_txt">
			<h2 style="text-transform:none; font-family:sans-serif;">
			<?php 
			/// $titles = preg_replace('/([a-z0-9])?([A-Z])/','$1 $2',str_replace('Controller','',explode("@",class_basename(app('request')->route()->getAction()['controller']))[0]));
			// $methos_name = substr(Route::currentRouteAction(), (strpos(Route::currentRouteAction(), '@') + 1) );
				$position = strpos($titles,"Search History");
				$setting= strpos($titles,"Setting");
				$reset= strpos($methos_name,"Reset_");
				
				$user_message= strpos($titles,"User Message");
			if($position==1 && $methos_name=='bookmark')
			{
			  echo "Saved Items";
			}
			else if($setting==1 && $methos_name!='reset_password')
			{
			  //echo Auth::user()->name." 's profile";
			  $myvalue = Auth::user()->name;
                          $arr = explode(' ',trim($myvalue));
                          echo ucfirst($arr[0]." 's profile");
			}else if($setting==1 && $reset==0)
			{
				 $myvalue = Auth::user()->name;
                          $arr = explode(' ',trim($myvalue));
                          echo ucfirst($arr[0]." 's reset password");
			}
			else if($user_message==1)
			{
				echo "Ask a Numa Doctor";
			}
			else {?>
                {{ preg_replace('/([a-z0-9])?([A-Z])/','$1 $2',str_replace('Controller','',explode("@",class_basename(app('request')->route()->getAction()['controller']))[0])) }}<?php } ?></h2>
                <?php 
			/// $titles = preg_replace('/([a-z0-9])?([A-Z])/','$1 $2',str_replace('Controller','',explode("@",class_basename(app('request')->route()->getAction()['controller']))[0]));
			// $methos_name = substr(Route::currentRouteAction(), (strpos(Route::currentRouteAction(), '@') + 1) );
				$position = strpos($titles,"Search History");
				$setting= strpos($titles,"Setting");
				$user_message= strpos($titles,"User Message");
			if($position==1 && $methos_name=='bookmark')
			{
			  echo "<p>this is for saved item</p>";
			}
			else if($setting==1)
			{
			  //echo Auth::user()->name." 's profile";
			  $myvalue = Auth::user()->name;
                          $arr = explode(' ',trim($myvalue));
                          echo "<p>this is for profike item</p>";
			}else if($user_message==1)
			{
				echo "Ask a Numa Doctor";
			}
			else {
               			echo "<p>this is for search item</p>";  } ?>
		</header>
		<div id="content">
		@if (Session::has('message'))
            <div class="note note-info">
                <p>{{ Session::get('message') }}</p>
            </div>
        @endif
        
		@yield('content')
		</div>
    @include('admin.partials.menu_user')
    </div>
</div>
@include('admin.partials.javascripts_user')
@yield('javascript')
@include('admin.partials.footer_user')


