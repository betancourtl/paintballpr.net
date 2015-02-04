@extends('layouts.default')
@section('content')

    <div class="row">

        <div class="col-md-4 col-sm-4 col-xs-1"></div>
        <div class="col-md-4 col-sm-4 col-xs-10">

            <h2>Register</h2>
            {{Form::open(array('route'=>'account-create-post','method'=>'post'))}}
            <!-- Username Form input -->

            <div class="form-group">
                {{Form::label('username','Username:',['class'=>'form-label'])}}
                {{Form::text('username',e(Input::old('username')),['class'=>'form-control'])}}
                <!-- Email Errors -->
                @if($errors->has('username'))
                    {{$errors->first('username')}}
                @endif
            </div>

            <!-- E-mail Form input -->
            <div class="form-group">
                {{Form::label('email','Email:',['class'=>'form-label']);}}
                {{Form::email('email',e(Input::old('email')),['class'=>'form-control'])}}

                <!-- Email Errors -->
                @if($errors->has('email'))
                    {{$errors->first('email')}}
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
                {{Form::label('confirm_password','Confirm Password:',['class'=>'form-label']);}}
                {{Form::password('confirm_password',['class'=>'form-control'])}}
                <!-- Email Errors -->
                @if($errors->has('confirm_password'))
                    {{$errors->first('confirm_password')}}
                @endif

            </div>

            {{Form::submit('Create Account',array('class'=>'btn btn-info form-control'))}}
            {{link_to_route('account-sign-in','Log in!')}}
            {{Form::close()}}


        </div>
        <div class="col-md-4 col-sm-4 col-xs-1"></div>

    </div>



@stop