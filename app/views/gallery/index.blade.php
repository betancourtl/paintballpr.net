@extends('layouts.default')

@section('content')

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Gallery
                    <small>pictures</small>
                </h1>
                <ol class="breadcrumb">
                    <li> {{link_to('/','Home')}}</li>
                    <li class="active">Gallery</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            @foreach($albums as $album)
            <div class="col-md-3 img-portfolio">
                    {{! $filename = $album->galleries->first()->gallery_filename}}

                <img class="img-responsive img-hover center-block beta-album-item " src="/gallery/albums/{{$album->album_name}}/small/{{$filename}}" alt="{{$album->description}}">

                <h3>
                    {{link_to_route('gallery-show',$album->album_name,$album->id)}}
                </h3>

                <p>{{$album->album_description}}</p>
                <small>{{$album->album_date}}</small>

            </div>
@endforeach
        </div>
        <!-- /.row -->

        <hr>

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <!-- Pagination -->
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-center">


                        {{$albums->links()}}

                    </div>
                    <div class="col-lg-4"></div>


                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.row -->

@stop
