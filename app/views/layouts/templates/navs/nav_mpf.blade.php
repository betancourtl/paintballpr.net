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
                <!-- Gallery -->
                <li>
                    {{link_to('mudaPaintballField','Home')}}
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Paintball Fields <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            {{link_to('mudaPaintballField/hyperball','Hyperball')}}
                        </li>
                        <li>
                            {{link_to('mudaPaintballField/speedball','Speedball')}}
                        </li>
                    </ul>
                </li>

                <!-- Gallery -->
                <li>
                    {{link_to('mudaPaintballField/gallery','Gallery')}}
                </li>

                <!-- Videos -->

                <li>
                    {{link_to('mudaPaintballField/videos','Videos')}}
                </li>

                <!-- Prices -->

                <li>
                    {{link_to('mudaPaintballField/prices','Prices')}}
                </li>

                <!--Contact -->

                <li>
                    {{link_to('mudaPaintballField/contact','Contact')}}
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Pages <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            {{link_to('mudaPaintballField/downloadForm','Responsibility Form')}}
                        <li>
                            {{link_to('mudaPaintballField/faq','FAQ')}}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
