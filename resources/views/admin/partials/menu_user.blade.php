<footer id="site-footer">
	<section>©2016 All Rights Reserved by Numa Health </section>
</footer>
<nav id="menu" data-search="close">
  <ul>
 
	@foreach($menus as $menu)
                @if($menu->menu_type != 2 && is_null($menu->parent_id))
                    @if(Auth::user()->role->canAccessMenu($menu))
                        <li @if(isset(explode('/',Request::path())[1]) && explode('/',Request::path())[1] == strtolower($menu->name)) class="active" @endif>
                            <a href="{{ route(config('quickadmin.route').'.'.strtolower($menu->name).'.index') }}">
                                <i class="icon fa {{ $menu->icon }}"></i>
                                <span class="title">{{ $menu->title }}</span>
                            </a>
                        </li>
                    @endif
                @else
                    @if(Auth::user()->role->canAccessMenu($menu) && !is_null($menu->children()->first()) && is_null($menu->parent_id))
                        <li>
                            <a href="#">
                                <i class="fa {{ $menu->icon }}"></i>
                                <span class="title">{{ $menu->title }}</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                @foreach($menu['children'] as $child)
                                    @if(Auth::user()->role->canAccessMenu($child))
                                        <li
                                                @if(isset(explode('/',Request::path())[1]) && explode('/',Request::path())[1] == strtolower($child->name)) class="active active-sub" @endif>
                                            <a href="{{ route(config('quickadmin.route').'.'.strtolower($child->name).'.index') }}">
                                                <i class="fa {{ $child->icon }}"></i>
                                                <span class="title">
                                                    {{ $child->title  }}
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endif
            @endforeach
             <li><a href="{{ url('') }}"><i class="icon  fa fa-search"></i> New Search </a></li>
	<li><a href="{{ url('admin/bookmark') }}"><i class="icon  fa  fa-save"></i> Saved Items </a></li>
	
    <li><a href="{{ url('admin/setting') }}"><i class="icon  fa fa-user"></i> My Profile  </a></li>
    <li><a href="{{ url('admin/reset_password') }}"><i class="icon  fa fa-user"></i> Change password  </a></li>
       <li><a href="{{ url('FAQ') }}"><i class="icon  fa  fa-question-circle"></i> Help</a></li>
    <!--li><a href="#"><i class="icon  fa fa-rocket"></i> Print Media</a></li>
    <li><a href="#"><i class="icon  fa fa-search"></i> Search History</a></li-->
    
    
    <!--li> <span><i class="icon  fa  fa-rocket"></i> Blank Page</span>
      <ul>
        <li><a href="{{ url('admin/setting') }}"><i class="icon  fa fa-th"></i> Setting Two </a></li>
      </ul>
    </li-->
    
  </ul>
</nav>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">		
		
		
		
		
		
