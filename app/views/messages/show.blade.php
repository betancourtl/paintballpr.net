@extends('layouts.admin')
@section('breadcrumb-header')  Banners @stop
@section('breadcrumb-small') Banners @stop
@section('breadcrumb-link') {{link_to_route('home','Home')}} @stop
@section('breadcrumb-active') Banners @stop

@section('script')
    {{HTML::script("ckeditor/ckeditor.js")}}
@stop

@section('dashboardPage')
    Message

@stop
@section('content')

    @if(Session::has('message'))
        <h3>{{Session::get('message')}}</h3>
    @endif

    @if($errors->has())
        <div class="alert alert-danger">
            <ul>
                {{$errors->first('title','<li>:message</li>')}}
                {{$errors->first('message','<li>:message</li>')}}
                {{$errors->first('user_to','<li>:message</li>')}}
            </ul>
        </div>
    @endif

    {{Form::model($message,array('route'=>'message-reply','method'=>'POST'))}}

    <h4>From: <small>{{Message::getUserFromId($message->user_from)->username}}</small></h4>

    <!-- displays the title -->
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',Input::old('title'),array('class'=>'form-control'))}}
    </div>

    <!-- displays the message -->
    <div class="form-group">
        {{Form::label('message','Message:')}}
        {{Form::textarea('message',Input::old('body'),array('class'=>'form-control CKEditor'))}}
    </div>

    <!-- user that sent the message -->
    <div class = "form-group">
            {{Form::hidden('user_to',$message->user_from)}}
    </div>
    <div class="form-group">
        {{Form::submit('Reply',array('id'=>'beta-form-btn ','class'=>'btn btn-info'))}}
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

