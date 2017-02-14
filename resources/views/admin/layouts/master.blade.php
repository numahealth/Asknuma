@include('admin.partials.header')
@include('admin.partials.topbar')
<div class="clearfix"></div>
<div class="page-container">
    @include('admin.partials.sidebar')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="white_bg_container">
                <h3 class="page-title">
                    <?php
                    $titles = preg_replace('/([a-z0-9])?([A-Z])/', '$1 $2', str_replace('Controller', '', explode("@", class_basename(app('request')->route()->getAction()['controller']))[0]));
                    $position = strpos($titles, "Searchkeyword");
                    if ($position == 1) {
                        echo "Search Keyword";
                    } else {
                        ?>
                        {{ preg_replace('/([a-z0-9])?([A-Z])/','$1 $2',str_replace('Controller','',explode("@",class_basename(app('request')->route()->getAction()['controller']))[0])) }} <?php } ?>
                </h3>

                <!--<div class="row">-->
                <?php $methos_name = substr(Route::currentRouteAction(), (strpos(Route::currentRouteAction(), '@') + 1)); ?>
                <div class="col-md-<?php
                    if ($methos_name == 'index' || $methos_name == 'getIndex' || $methos_name == 'show'
                            || $methos_name == 'getView') {
                         echo '12';
                     } else {
                         echo "10 dummy";
                     }
                     ?> "
                     >
                    @if (Session::has('message'))
                    <div class="note note-info">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                    @endif
                    @yield('content')
                </div>
                <!-- </div>-->
            </div>
        </div>
    </div>
</div>

<div class="scroll-to-top"
     style="display: none;">
    <i class="fa fa-arrow-up"></i>
</div>
@include('admin.partials.javascripts')

@yield('javascript')
@include('admin.partials.footer')


