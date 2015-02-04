<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" lang="en">

@include('layouts.templates.headers.header_1')
<body>
@include('layouts.templates.includes.banners')
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
@yield('content')
<!-- Footer -->
@include('layouts.templates.footers.footer_1')
</body>
</html>


