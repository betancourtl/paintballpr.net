@extends('layouts.default')
@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">About
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        {{link_to('/','Home')}}
                    </li>
                    <li class="active">About</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Intro Content -->
        <div class="row">
            <div class="col-md-6">
                {{HTML::image('images/home/about-us.jpg','About us image',array('class'=>'img-responsive'))}}
            </div>
            <div class="col-md-6">
                <h2>About PaintballPR.net</h2>

                <p>
                    PaintballPR.net was created with the intention to promote the sport of paintball in Puerto Rico.
                </p>

                <p>
                    PaintballPR.net is a website dedicated to bringing the most recent news in the paintball scene in
                    Puerto Rico.
                    We publish articles related to local events and
                    articles that are related to National Paintball Leagues.
                    You can also find articles on new products in the market ranging from Paintball markers,
                    apparel, and upgrades.
                </p>

                <p>
                    PaintballPR.net is not affiliated with any paintball teams , stores or leagues.
                </p>

                <p>
                    This website was made by Luis Betancourt, a strong supporter of the paintball community.
                </p>
            </div>
        </div>
        <!-- /.row -->

        <!-- Team Members -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Our Team</h2>
            </div>
            <div class="col-md-4 text-center ">
                <div class="thumbnail beta-min-height-450px">
                    {{HTML::image('images/home/me.jpg','Owner of paintballpr.net',array('class'=>'img-responsive'))}}
                    <div class="caption">
                        <h3>Luis Betancourt<br>
                            <small>Web Developer</small>
                        </h3>
                        <p>Hello! I created this website to bring the paintball community the latest news in the
                           paintball scene I hope you enjoy it.</p>
                        <ul class="list-inline">
                            <li><a href="https://www.facebook.com/paintballpr.net"><span
                                            class="fa fa-2x fa-facebook-square"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Kiddo -->
            <div class="col-md-4 text-center ">
                <div class="thumbnail beta-min-height-450px">
                    {{HTML::image('images/home/Andre.jpg','Owner of paintballpr.net',array('class'=>'img-responsive'))}}
                    <div class="caption">
                        <h3>Andre Rojas<br>
                            <small>Web Designer</small>
                        </h3>
                        <p>Andre is a huge contributor to paintballpr.net. He is the man behind the design of paintballpr.net .</p>
                        <ul class="list-inline">
                            <li><a href="https://www.facebook.com/andre.rojas.391"><span
                                            class="fa fa-2x fa-facebook-square"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->


@stop