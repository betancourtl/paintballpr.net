

@extends('layouts.event')
@section('breadcrumb-header')
    Events
@stop
@section('breadcrumb-small')
    Register player
@stop
@section('breadcrumb-link')
    {{link_to_route('events-index','Events')}}
@stop
@section('breadcrumb-active')
    Register player
@stop


@section('content')
    <h2>Register player</h2>
    {{Form::open(array('route'=>'player-store','method'=>'POST'))}}
    <!-- Username Form input -->

    <div class="form-group">
        {{Form::label('username','Username',['class'=>'form-label'])}}
        {{Form::text('username',e(Input::old('username')),['class'=>'form-control'])}}
        <!-- Email Errors -->
        @if($errors->has('username'))
            {{$errors->first('username')}}
        @endif
    </div>

    <div class="form-group">
        {{Form::label('first_name','First Name:',['class'=>'form-label'])}}
        {{Form::text('first_name',e(Input::old('first_name')),['class'=>'form-control'])}}
        <!-- Email Errors -->
        @if($errors->has('first_name'))
            {{$errors->first('first_name')}}
        @endif
    </div>


    <div class="form-group">
        {{Form::label('last_name','Last Name:',['class'=>'form-label'])}}
        {{Form::text('last_name',e(Input::old('last_name')),['class'=>'form-control'])}}
        <!-- Email Errors -->
        @if($errors->has('last_name'))
            {{$errors->first('last_name')}}
        @endif
    </div>


    <div class="form-group">
        {{Form::label('email','Email:',['class'=>'form-label'])}}
        {{Form::email('email',e(Input::old('email')),['class'=>'form-control'])}}
        <!-- Email Errors -->
        @if($errors->has('email'))
            {{$errors->first('email')}}
        @endif
    </div>



    <div class="form-group">
        {{Form::label('cell','Cell no.',['class'=>'form-label'])}}
        <br/>
        {{Form::text('cell-start',e(Input::old('cell-start')),['class'=>'form-control beta-cell beta-inline'])}} -

        {{Form::text('cell-middle',e(Input::old('cell-middle')),['class'=>'form-control beta-cell beta-inline'])}} -

        {{Form::text('cell-last',e(Input::old('cell-last')),['class'=>'form-control beta-cell beta-inline'])}}
                                                                                                                 <!-- Email Errors -->
        <br/>
        @if($errors->has('cell-start'))
            {{$errors->first('cell-start')}}
        @endif
        <br/>

        @if($errors->has('cell-middle'))
            {{$errors->first('cell-middle')}}
        @endif
        @if($errors->has('cell-last'))
            {{$errors->first('cell-last')}}
        @endif
    </div>

    <!--Password Form Input -->

    <div class="form-group">
        {{Form::label('password','Password:',['class'=>'form-label']);}}
        {{Form::password('password',['class'=>'form-control'])}}
        <!-- Email Errors -->
        @if($errors->has('password'))
            {{$errors->first('password')}}
        @endif

    </div>

    <div class="form-group">
        {{Form::label('password_confirmation','Confirm Password:',['class'=>'form-label']);}}
        {{Form::password('password_confirmation',['class'=>'form-control'])}}
        <!-- Email Errors -->
        @if($errors->has('password_confirmation'))
            {{$errors->first('password_confirmation')}}
        @endif

    </div>

    {{Form::submit('Create Account',array('class'=>'btn btn-info'))}}
    {{Form::close()}}
@stop
