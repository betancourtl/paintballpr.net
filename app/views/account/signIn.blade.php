@extends('layouts.default')
@section('content')

    <div class="row">

        <div class="col-md-4 col-sm-4 col-xs-1"></div>
        <div class="col-md-4 col-sm-4 col-xs-10">

            <h2>Sign In</h2>

            {{Form::open(array('route'=>'account-sign-in-post','method'=>'post'))}}
            <!-- Email Form input -->
            <div class="form-group">
                {{Form::label('email','Email:',['class'=>'form-label']);}}
                {{Form::text('email',Input::old('email'),['class'=>'form-control'])}}
                @if($errors->has('email'))
                    {{$errors->first('email')}}
                @endif
            </div>

            <!--password Form Input -->

            <div class="form-group">
                {{Form::label('password','Password:',['class'=>'form-label']);}}
                {{Form::password('password',['class'=>'form-control'])}}
                @if($errors ->has('password'))
                    {{$errors->first('password')}}
                @endif
            </div>

            <div class=form-group">
                {{Form::checkbox('remember')}}
                {{Form::label('remember','Remember me')}}
            </div>

            {{Form::submit('Sign In',array('class'=>'btn btn-info  beta-btn-half-width'))}}

            {{link_to_route('account-create','Register')}}
            {{Form::close()}}

        </div>
        <div class="col-md-4 col-sm-4 col-xs-1"></div>

    </div>

@stop



