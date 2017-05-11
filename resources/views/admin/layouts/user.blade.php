@include('admin.partials.header_user')
<div id="wrapper">
    @include('admin.partials.topbar_user')
    @include('admin.partials.sidebar_user')
    <div id="main">
        @yield('page_header_hider', '')
        <ol id="breadcrumb" class="breadcrumb">
            <li><a href="<?php echo url('admin/setting/'); ?>">Home</a></li>
            <li class="active">
                <?php
                $titles = preg_replace('/([a-z0-9])?([A-Z])/', '$1 $2', str_replace('Controller', '', explode("@", class_basename(app('request')->route()->getAction()['controller']))[0]));
                $methos_name = substr(Route::currentRouteAction(), (strpos(Route::currentRouteAction(), '@') + 1));
                $position = strpos($titles, "Search History");
                if ($position == 1 && $methos_name == 'bookmark') {
                    echo "Pinned Media";
                } else {
                    ?>
                    {{ preg_replace('/([a-z0-9])?([A-Z])/','$1 $2',str_replace('Controller','',explode("@",class_basename(app('request')->route()->getAction()['controller']))[0])) }} 
                <?php } ?>
            </li>
        </ol>
        <header id="panel_header" class="panel-heading main_txt">
            <h2 style="text-transform:none; font-family:sans-serif;">
                @yield('page_title', '')
            </h2>
            @yield('page_subtitle', '')
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


