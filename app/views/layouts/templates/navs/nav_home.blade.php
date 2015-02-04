<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Index -->
            <a class="navbar-brand" rel="home" href="/" title="Paintballpr.net">
                <img style="max-width:250px; margin-top: -25px;"
                     src="/images/logo/logo.png" alt="Logo">
            </a>

        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    {{link_to_route('home','Blog')}}
                </li>

                <li>
                    <!-- 4 is id for sales -->
                    {{link_to_route('home-category','Sales',5)}}
                </li>
                @if(Auth::user())
                    <li>
                        <!-- 4 is id for sales -->
                        {{link_to_route('events-index','Events')}}
                    </li>
                @endif

                <li>
                    <!-- 4 is id for sales -->
                    {{link_to_route('gallery-index','Gallery')}}
                </li>


                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Paintball Fields <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            {{link_to('//www.paintballpr.tv','Carolina Paintball Field')}}
                        </li>
                    </ul>
                </li>

                <!-- Videos -->

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Social <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            {{link_to('https://www.facebook.com/paintballpr.net','Facebook')}}
                        <li>
                            {{link_to('https://www.youtube.com/user/paintballprNET','Youtube')}}
                        </li>
                        <li>
                            {{link_to('https://twitter.com/PaintballprNet','Twitter')}}
                        </li>
                        <li>
                            {{link_to('https://plus.google.com/+PaintballprNet1/','Google +')}}
                        </li>
                    </ul>
                </li>

                <!--About -->

                <li>
                    {{link_to('blog/about','About')}}
                </li>

                <!--Contact -->

                <li>
                    {{link_to('blog/contact','Contact')}}
                </li>

                @if(Auth::user())
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{Auth::user()->username}} <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                {{link_to_route('posts-show-sales','Profile')}}
                            </li>
                            <li class="divider"></li>
                            <li>
                                {{link_to_route('account-sign-out','Sign Out ' . Auth::user()->username)}}
                            </li>

                        </ul>
                    </li>

                @else
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{'Sign in | Register'}} <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                {{link_to_route('account-sign-in','Sign in')}}
                            </li>
                            <li>
                                {{link_to_route('account-create','Register')}}
                            </li>
                            <li class="divider"></li>

                            <li>
                                {{link_to_route('account-forget-password','Forgot Password')}}
                            </li>
                        </ul>
                    </li>

                @endif
            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>