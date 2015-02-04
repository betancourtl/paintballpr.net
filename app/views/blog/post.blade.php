@extends('layouts.default')
@section('meta')

    @foreach($post->pictures as $picture)
        {{!$image = 'uploads/blog_images/large/'.$picture->filename;}}
    @endforeach

    <?php
    $size = getimagesize($image);

    $width = $size[0];
    $height = $size[1];
    $mime = $size['mime'];
    ?>
    <!-- Facebook Meta -->
    <meta property="og:title" content="{{$post->title}}"/>
    <meta property="og:site_name" content="www.paintballpr.net/"/>
    <meta property="og:url" content="{{Request::url()}}"/>
    <meta property="og:description" content="{{strip_tags(Str::limit($post->body,200))}}"/>
    <meta property="og:image" content="{{'http://www.paintballpr.net/'.$image}}"/>
    <meta property="fb:app_id" content="1510958372522838"/>
    <meta property="og:type" content="website"/>

    <!-- Twitter Meta -->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@PaintballprNet"/>
    <meta name="twitter:title" content="{{$post->title}}"/>
    <meta name="twitter:description" content="{{strip_tags(Str::limit($post->body,200))}}"/>
    <meta name="twitter:image" content="{{'http://www.paintballpr.net/'.$image}}"/>
    <meta name="twitter:url" content="https://twitter.com/PaintballprNet"/>

    <!-- Google Plus Meta and Other Links -->
@stop

@section('title'){{$post->title}}@stop

@section('content')
    <!-- google Structured Data -->
    <div itemscope itemtype="http://schema.org/Article" class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header ">

                    <!-- google Structured Data -->
                    <span itemprop="name">
                        {{$post->title}}
                    </span>

                    <br/>
                    <small> posted by
                        <a href="#">
                            <!-- google Structured Data -->
                            <span itemprop="author" itemscope itemtype="http://schema.org/Person">
                                <span itemprop="name">
                                    {{$post->user->username}}
                                </span>
                            </span>
                        </a>
                    </small>

                </h1>
                <ol class="breadcrumb">
                    <li>{{link_to("/",'Home')}}
                    </li>
                    <li class="active">
                        <a itemprop="url" href="{{Request::url()}}">Blog</a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">

            <!-- Blog Post Content Column -->

            <div class="col-lg-8">
                <div class="col-lg-12">
                    <div class="col-lg-1"></div>
                    <!-- Blog Post -->

                    <hr>

                    <!-- Date/Time -->
                    <p>
                    <span class="fa fa-clock-o">

                    </span> Posted on
                    <span itemprop="datePublished" content="{{$post->created_at}}">
                        {{$post->created_at->toDateString()}}
                    </span>
                    </p>
                    <hr>

                    <!-- Preview Image -->
                    @foreach($post->pictures as $picture)

                    <!-- google Structured Data -->
                        {{ HTML::image('uploads/blog_images/large/'.$picture->filename,'Blog Picture',array('class'=>'img-responsive center-block','itemprop'=>"image")) }}

                    @endforeach
                    <br/>

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

                    <hr>
                    <!-- Post Content -->
                    <div class="beta-article">

                        <!-- google Structured Data -->
                        <p itemprop="articleBody">
                            <?php Post::strip_blog_tags($post->body); ?>
                        </p>

                        <!-- google Structured Data -->
                        <p class="text-info">
                        <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
                            <small itemprop="name">
                                www.paintballpr.net
                            </small>
                        </span>
                        </p>


                        <hr>

                        <!-- Blog Comments -->

                        <div class="fb-comments" data-href="{{Request::url()}}"
                             data-width="100%" data-numposts="10" data-colorscheme="light">

                        </div>


                        <!-- Comments Form -->
                        <hr>
                        <!-- Comment -->
                    </div>

                    <div class="col-lg-1"></div>

                </div>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-lg-4">
                @include('layouts.templates.sidebar.sidebar_1')
            </div>

        </div>
        <!-- /.row -->
        <hr>
    </div>
    <!-- /.container -->
@stop

