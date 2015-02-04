@extends('layouts.admin')
@section('breadcrumb-header')   Change Password @stop
@section('breadcrumb-small')  Edit @stop
@section('breadcrumb-link') {{link_to_route('home','Home')}} @stop
@section('breadcrumb-active')  Change Password @stop
@section('content')

    <div class="row">

        <div class="col-md-4 col-sm-4 col-xs-1"></div>
        <div class="col-md-4 col-sm-4 col-xs-10">

        <h2>Change Password</h2>

    {{Form::open()}}

    <!--Old_password Form Input -->

    <div class="form-group">
        {{Form::label('old_password','Old Password:',['class'=>'form-label']);}}
        {{Form::password('old_password',['class'=>'form-control'])}}
        @if($errors->has('old_password'))
            {{$errors->first('old_password')}}
        @endif
    </div>

    <!--New_password Form Input -->

    <div class="form-group">
        {{Form::label('new_password','New Password:',['class'=>'form-label']);}}
        {{Form::password('new_password',['class'=>'form-control'])}}
        @if($errors->has('new_password'))
            {{$errors->first('new_password')}}
        @endif

    </div>

    <!--Confirm_new_password Form Input -->

    <div class="form-group">
        {{Form::label('confirm_new_password','Confirm New Password:',['class'=>'form-label']);}}
        {{Form::password('confirm_new_password',['class'=>'form-control'])}}
        @if($errors->has('confirm_new_password'))
            {{$errors->first('confirm_new_password')}}
        @endif

    </div>

    {{Form::submit('Change Password',array('class'=>'btn btn-info'))}}

    {{Form::close()}}

        </div>
        <div class="col-md-4 col-sm-4 col-xs-1"></div>

    </div>

@stop

