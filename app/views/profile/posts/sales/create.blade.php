@extends('layouts.default')


@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sales
                    <small>New Post</small>
                </h1>
                <ol class="breadcrumb">
                    <li> {{link_to_route('home','Home')}}</li>
                    <li class="active">Sales Post</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-lg-12 col-md-12">
                @if($errors->has())
                    <div class="alert alert-danger">
                        <ul>
                            {{$errors->first('title','<li>:message</li>')}}
                            {{$errors->first('body','<li>:message</li>')}}
                            {{$errors->first('photo','<li>:message</li>')}}
                            {{$errors->first('type','<li>:message</li>')}}
                            {{$errors->first('price','<li>:message</li>')}}
                        </ul>
                    </div>
                @endif

                {{Form::open(array('route'=>'sales-create-post','method'=>'POST','files'=>true))}}

                <div class="form-group">
                    {{Form::label('title','Title')}}
                    {{Form::text('title',Input::old('title'),array('class'=>'form-control'))}}
                </div>

                    <!-- Fix using a database table later if the webite goes well -->
                    <div class="form-group">
                        {{Form::label('type','Type',array('class'=>'control-label'))}}

                        {{Form::select('type',array(
                        'Marker'=>'marker',
                        'Hopper'=>'Hopper',
                        'Tank'=>'Tank',
                        'Mask'=>'Mask',
                        'Gearbag'=>'Gearbag',
                        'Cloathing'=>'Cloathing',
                        'Other'=>'Other'
                        ),null,array(
                        'class'=>'form-control beta-quarter-width'
                        ))}}
                    </div>

                    <!-- Price Form input -->

                    <div class="form-group">
                        {{Form::label('price','Price:',['class'=>'form-label']);}}
                        {{Form::text('price',null,['class'=>'form-control beta-quarter-width'])}}
                    </div>


                    <div class="form-group">
                    {{Form::label('body','Body:')}}
                    {{Form::textarea('body',Input::old('body'),array('class'=>'form-control CKEditor'))}}
                </div>

                <div class="form-group">
                    {{Form::label('photo','File input')}}
                    {{Form::file('photo')}}
                </div>

                <div class="form-group">
                    {{Form::submit('Upload',array('id'=>'beta-form-btn'))}}
                </div>


                {{Form::close()}}

                @stop
                @section('javascript')
                    {{HTML::script("ckeditor/ckeditor.js")}}
                    <script>
                        CKEDITOR.replace('body');
                    </script>

                    <script>
                        //Disable update button once pressed

                        $('#beta-form-btn').click(function () {
                            $('#beta-form-btn').click(function (e) {
                                e.preventDefault()
                            });
                        });
                    </script>
                @stop
            </div>
        </div>
    </div>
