@extends('layouts.admin')
@section('breadcrumb-header')  My Posts @stop
@section('breadcrumb-small') Edit @stop
@section('breadcrumb-link') {{link_to_route('home','Home')}} @stop
@section('breadcrumb-active') Edit @stop
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

    {{Form::model($post,array('method'=>'POST','route'=>array('posts-update-sales',$post->id)))}}

    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',Input::old('title'),array('class'=>'form-control','disabled'=>'disabled'))}}
    </div>

    <div class="form-group">
        {{Form::label('body','Body:')}}
        {{Form::textarea('body',Input::old('body'),array('class'=>'form-control CKEditor'))}}
    </div>


    <div class="form-group">
        {{Form::submit('Update', array('class'=>'btn btn-success'))}}
        {{link_to_route('posts-show-sales','Cancel',null,['class'=>'btn btn-warning'])}}
    </div>

    {{Form::close()}}

@stop
@section('javascript')
    <script>
        CKEDITOR.replace('body');
    </script>
@stop
