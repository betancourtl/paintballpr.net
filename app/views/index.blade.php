@extends('layouts.blog')
@section('content')

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Blog
                    <small>@if(isset($searchTerm)) {{$searchTerm}} @else News @endif</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        {{link_to('/','Home')}}
                    </li>
                    <!-- Displays category of current search -->
                    <li class="active">@if(isset($searchTerm)) {{$searchTerm}} @else News @endif</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-8">
                @if($posts->count())
                    @foreach($posts as $post)
                        <div class=row>
                            <!-- Blog Post Row -->
                            <div class="col-md-2 text-center">
                                <p><span class="fa fa-camera fa-4x"></span>
                                </p>

                                <p>{{$post->created_at->diffForHumans()}}</p>
                            </div>

                            <div class="col-md-5">
                                @foreach($post->pictures as $picture)
                                    {{ HTML::image('uploads/blog_images/small/'.$picture->filename,'Blog Picture',array('class'=>'img-responsive center-block')) }}
                                @endforeach
                            </div>
                            <div class="col-md-5">
                                <!--Title-->
                                <h3>
                                    <a href="{{URL::action('HomeController@show',$post->id)}}">{{$post->title}}</a>
                                </h3>
                                <!--Author-->
                                <p>
                                    by {{link_to('#',$post->user->username)}}
                                </p>

                                <!-- Content -->

                                <p>{{strip_tags(Str::limit($post->body,250),'<br>')}}</p>

                                <a class="btn btn-primary" href="{{URL::action('HomeController@show',$post->id)}}">Read
                                                                                                                   More
                                    <span class="fa fa-angle-right"></span></a>
                            </div>
                        </div>
                        <!-- /.row -->
                        <hr>
                    @endforeach
                @endif
            </div>

            <div class="col-md-4">
                @include('layouts.templates.sidebar.sidebar_1')
            </div>
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 text-center">


                {{$posts->links()}}

            </div>
            <div class="col-lg-4"></div>


        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@stop
