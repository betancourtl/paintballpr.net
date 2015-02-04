<!--FOOTER-->
<footer>
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xs-8">
                    <p class="navbar-text">Copyright &copy; PaintballPR.net 2014 </p>
                </div>
                <div class="col-lg-2 col-xs-4">
                    <a href="#menu-toggle" class="btn btn-default btn-success beta-footer-btn " id="menu-toggle">Toggle Menu</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery Version 2.1.1 -->
{{HTML::script('bower_components/jquery/dist/jquery.min.js')}}

<!-- Bootstrap Core JavaScript -->
{{HTML::script('bower_components/bootstrap/dist/js/bootstrap.min.js')}}

<!-- Extra js files -->
@yield('javascript')
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
<script>
    /* Website Global Error Messages */
    $('.beta-error-message').fadeOut(3000);
</script>



