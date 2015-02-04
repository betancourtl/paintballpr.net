@extends('layouts.admin')
@section('breadcrumb-header')  All Posts @stop
@section('breadcrumb-small')  New Posts @stop
@section('breadcrumb-link') {{link_to_route('home','Home')}} @stop
@section('breadcrumb-active')  New Posts @stop
@section('script')
    {{HTML::script("ckeditor-full/ckeditor.js")}}
@stop

@section('dashboardPage')
    Image Upload

@stop
@section('content')

    @if(Session::has('message'))
        <h3>{{Session::get('message')}}</h3>
    @endif

    @if($errors->has())
        <div class="alert alert-danger">
            <ul>
                {{$errors->first('title','<li>:message</li>')}}
                {{$errors->first('body','<li>:message</li>')}}
                {{$errors->first('photo','<li>:message</li>')}}
            </ul>
        </div>
    @endif

    {{Form::open(array('route'=>'posts-store','method'=>'POST','files'=>true))}}

    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',Input::old('title'),array('class'=>'form-control'))}}
    </div>

    <div class="form-group">
        {{Form::label('body','Body:')}}
        {{Form::textarea('body',Input::old('body'),array('class'=>'form-control CKEditor'))}}
    </div>


    <div class="'checkbox">
        {{Form::label('cat','Select Categories:')}}<br/>

        @foreach( $categories as $category)
            {{Form::checkbox('cat[]',$category->id)}} <span>{{$category->category}}</span><br/>
        @endforeach
        <br/>
    </div>

    <div class="form-group">
        {{Form::label('photo','File input')}}
        {{Form::file('photo')}}
    </div>

    <div class="form-group">
        {{Form::submit('Upload',array('class'=>'beta-class-btn'))}}
    </div>

    {{Form::close()}}

@stop
@section('javascript')
    <script>
        CKEDITOR.replace('body');
    </script>

    <script>
        //Disable update button once pressed

        $('#beta-form-btn').click(function() {
            $('#beta-form-btn').click(function (e) {
                e.preventDefault()
            });
        });
    </script>

@stop