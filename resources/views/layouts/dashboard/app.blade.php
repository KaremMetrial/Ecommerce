<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
@include('layouts.dashboard._head')
</head>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern"
      data-col="2-columns">
<!-- fixed-top-->
@include('layouts.dashboard._sidebar')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
@include('.layouts.dashboard._footer')
</footer>
@include('.layouts.dashboard._scripts')
</body>

</html>
