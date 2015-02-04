@extends('layouts.gallery')
@section('meta')


    {{!$image = 'gallery/albums/'.$album->album_name.'/large/'.$album->galleries()->first()->gallery_filename}}

    <?php
    $size = getimagesize($image);

    $width = $size[0];
    $height = $size[1];
    $mime = $size['mime'];
    ?>
    <!-- Facebook Meta -->
    <meta property="og:title" content="{{$album->album_name}}"/>
    <meta property="og:site_name" content="www.paintballpr.net/"/>
    <meta property="og:url" content="{{Request::url()}}"/>
    <meta property="og:description" content="{{strip_tags(Str::limit($album->album_description,200))}}"/>
    <meta property="og:image" content="{{'http://www.paintballpr.net/'.$image}}"/>
    <meta property="fb:app_id" content="1510958372522838"/>
    <meta property="og:type" content="website"/>

    <!-- Twitter Meta -->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@PaintballprNet"/>
    <meta name="twitter:title" content="{{$album->album_name}}"/>
    <meta name="twitter:description" content="{{strip_tags(Str::limit($album->album_description,200))}}"/>
    <meta name="twitter:image" content="{{'http://www.paintballpr.net/'.$image}}"/>
    <meta name="twitter:url" content="https://twitter.com/PaintballprNet"/>

    <!-- Google Plus Meta and Other Links -->
@stop


@section('content')


    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Gallery
                    <small>{{$album->album_name}}</small>
                </h1>
                <ol class="breadcrumb">
                    <li> {{link_to_route('home','Home')}}</li>

                    <li> {{link_to_route('gallery-index','Gallery')}}</li>
                    <li class="active">{{$album->album_name}}</li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <ul class="social">
                    <li>
                        <!-- Facebook Like Button -->
                        <div class="fb-like" data-href="{{Request::url()}}" data-width="600"
                             data-layout="button_count" data-action="like" data-show-faces="true"
                             data-share="true"></div>
                    </li>
                    <!-- Google Plus -->
                    <li>
                        <div class="g-plusone" data-size="small (bubble)" ...></div>
                    </li>
                </ul>
            </div>
            </div>

            <div class="row">
                <div id="links">
                    @foreach($album->galleries as $gallery)

                        {{!$filename = $gallery->gallery_filename}}
                        <div class="col-lg-2 col-md-4 col-xs-12 col-sm-4 thumb">
                            <a class="thumbnail" href="/gallery/albums/{{$album->album_name}}/large/{{$filename}}"
                               data-gallery>
                                <img class="img-responsive beta-gallery-item"
                                     src="/gallery/albums/{{$album->album_name}}/small/{{$filename}}" alt="">
                            </a>
                        </div>
                    @endforeach

                </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="social">
                            <li>
                                <!-- Facebook Like Button -->
                                <div class="fb-like" data-href="{{Request::url()}}" data-width="600"
                                     data-layout="button_count" data-action="like" data-show-faces="true"
                                     data-share="true"></div>
                            </li>
                            <!-- Google Plus -->
                            <li>
                                <div class="g-plusone" data-size="small (bubble)" ...></div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Blog Comments -->
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col xs-12">

                        <div class="fb-comments" data-href="{{Request::url()}}"
                             data-width="100%" data-numposts="10" data-colorscheme="light">

                        </div>
                    </div>
                </div>

                <hr>
                <!-- /.row -->


            </div>

@stop