@include('admin.partials.header_front')
@include('admin.partials.topbar_front')
@if(url()->current()!=url('') && url()->current()!=url('login'))
@include('admin.partials.sidebar_front')
@endif
@yield('content')
@include('admin.partials.javascripts_front')
@yield('javascripts_front')
@include('admin.partials.footer_front')


