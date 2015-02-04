<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" lang="en">

@include('layouts.templates.headers.header_1')
<body>
<!-- google Tag Manager -->
@include('layouts.templates.includes.tagManager')
<!-- Google Analytics -->
@include('layouts.templates.includes.analytics')
<!-- Facebook SDK -->
@include('layouts.templates.includes.facebookSDK')
<!-- Twitter SDK -->
@include('layouts.templates.includes.twitteterSDK')
<!-- Google SDK -->
@include('layouts.templates.includes.googlePlusSDK')
<!-- Navigation -->
@include('layouts.templates.navs.nav_home')
<!-- Global Error Messages -->
@include('layouts.templates.includes.globalMessage')
<!-- Content -->

<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 ">
            @include('layouts.templates.navs.nav_events')
            <!-- add extra nagigation menus -->
            @yield('events-navigation')
        </div> <!-- / of Left content -->
        <div class = "col-md-9 col-sm-9 col-xs-12">
            @include('layouts.templates.breadcrumbs.breadcrumbs')
            @yield('content')

        </div> <!-- / of right content -->
    </div>
</div>
<!-- Footer -->
@include('layouts.templates.footers.footer_1')
</body>
</html>

