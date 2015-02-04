<!--FOOTER-->
<footer>
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xs-8">
                    <p class="navbar-text">Copyright &copy; PaintballPR.net 2014 </p>
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

<!-- script for error messages -->
<script>
    /* Website Global Error Messages */
    $('.beta-error-message').fadeOut(8000);
</script>




