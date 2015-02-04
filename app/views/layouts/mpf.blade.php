<!DOCTYPE html>
<html lang="en">

@include('layouts.templates.headers.header_1')

<body>
<!-- Google Analytics -->
@include('layouts.templates.includes.analytics')
<!-- Navigation -->
@include('layouts.templates.navs.nav_mpf')

@yield('content')

@include('layouts.templates.footers.footer_1')
</body>

</html>
