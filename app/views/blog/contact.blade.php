@extends('layouts.default')

@section('content')

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Contact
                    <small>contact Paintballpr.net</small>
                </h1>
                <ol class="breadcrumb">
                    <li> {{link_to('/','Home')}}</li>
                    <li class="active">Contact</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
            <div class="col-md-8">
                {{HTML::image('images/home/contac-us.jpg','contact paintballpr.net image',array('class'=>'img-responsive'))}}
            </div>
            <!-- Contact Details Column -->
            <div class="col-md-4">
                <h3>Contact Details</h3>

                <p><span class="fa fa-phone"></span>
                    <abbr title="Phone">P</abbr>: (787) 378 - 4608</p>

                <p><span class="fa fa-envelope-o"></span>
                    <abbr title="Email">E</abbr>: <a href="mailto:paintballpr.net@gmail.com">paintballpr.net@gmail
                                                                                             .com</a>
                </p>

                <p><span class="fa fa-clock-o"></span>
                    <abbr title="Hours">H</abbr>: 24/7</p>
                <ul class="list-unstyled list-inline list-social-icons">
                    <li>
                        <a target="_blank" href="https://www.facebook.com/paintballpr.net"><span
                                    class="fa fa-facebook-square fa-2x"></span> Facebook</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

    </div>

@stop
