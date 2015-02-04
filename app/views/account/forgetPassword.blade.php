@extends('layouts.default')
@section('content')

    <div class="row">

        <div class="col-md-4 col-sm-4 col-xs-1"></div>
        <div class="col-md-4 col-sm-4 col-xs-10">

        <h2>
       Forget your password?
       </h2>

  {{Form::open(array('route'=>'account-forget-password-post','method'=>'POST'))}}
  <!-- Email Form input -->
  <div class="form-group">
      <p class="text-info">Enter your email to reset your password</p>
      {{Form::label('email','Email:',['class'=>'form-label']);}}
      {{Form::email('email',e(Input::old('email')),['class'=>'form-control'])}}
      @if($errors->has('email'))
        {{$errors->first('email')}}
      @endif
  </div>

    {{Form::submit('Recover',array('class'=>'btn btn-info'))}}
    {{Form::close()}}

        </div>
        <div class="col-md-4 col-sm-4 col-xs-1"></div>

    </div>
@stop

