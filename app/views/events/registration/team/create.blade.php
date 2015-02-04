@extends('layouts.event')
@section('breadcrumb-header')
    Events
@stop
@section('breadcrumb-small')
    Register Team
@stop
@section('breadcrumb-link')
    {{link_to_route('events-index','Events')}}
@stop
@section('breadcrumb-active')
    Register Team
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            {{Form::open(array('route'=>'team-store', 'method' =>'POST'))}}
            <!-- Team Form input -->

            <div class="form-group">
                {{Form::label('name','Team:',['class'=>'form-label']);}}
                {{Form::text('name',null,['class'=>'form-control'])}}
                @if($errors->has('name'))
                    {{$errors->first('name')}}
                @endif
            </div>


            <label for="division">Division</label>
            <select name="division" id="division" class="form-control">
                @if($errors->has('division'))
                    {{$errors->first('division')}}
                @endif


            @foreach($divisions as $division)
                    <option value="{{$division->id}}">{{$division->division}}</option>
                @endforeach
            </select>
        <br/>

            <div class="form-group">
                {{Form::label('password','Password',array('class'=>'form-label'))}}
                {{Form::password('password',array('class'=>'form-control'))}}
                @if($errors->has('password'))
                    {{$errors->first('password')}}
                @endif

            </div>


            <div class="form-group">
                {{Form::label('password_confirmation','Confirm',array('class'=>'form-label'))}}
                {{Form::password('password_confirmation',array('class'=>'form-control'))}}
                @if($errors->has('password_confirmation'))
                    {{$errors->first('password_confirmation')}}
                @endif

            </div>

            {{form::submit('Create team',array('class'=>'btn btn-info'))}}
            {{Form::close()}}
        </div>
    </div>

@stop


