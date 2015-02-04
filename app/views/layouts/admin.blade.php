<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

@include('layouts.templates.headers.header_admin')
<!-- Google Analytics -->
@include('layouts.templates.includes.analytics')
<body>
@include('layouts.templates.navs.nav_home')

<!-- Page Content -->
<div id="page-content-wrapper" class="beta-admin-top-spacing">
    <div class="container-fluid">
        <!-- load profile nav for users or admin nav for admins -->
        @if(Auth::user() && Auth::user()->role_id != 1)
            @include('layouts.templates.navs.nav_profile')
        @else
            @include('layouts.templates.navs.nav_admin')
        @endif

        @include('layouts.templates.breadcrumbs.breadcrumbs')

        <div class="row">
            <div class="col-lg-8">
                <!-- Global Error Messages -->
                @include('layouts.templates.includes.globalMessage')
            </div>
        </div>
        @yield('content')

    </div>
</div>
@include('layouts.templates.footers.footer_admin')
</body>
</html>