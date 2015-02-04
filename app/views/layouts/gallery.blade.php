<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" lang="en">

@include('layouts.templates.headers.header_gallery')
<body>
<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery"  data-use-bootstrap-modal="false">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

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
<!-- Javascript for the gallery -->
@include('layouts.templates.includes.galleryJavascript')
</body>
</html>
