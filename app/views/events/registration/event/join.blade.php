@extends('layouts.event')
@section('breadcrumb-header')
    Events
@stop
@section('breadcrumb-small')
    {{$event->event}}
@stop
@section('breadcrumb-link')
    {{link_to_route('events-index','Events')}}
@stop
@section('breadcrumb-active')
    {{$event->event}}
@stop

@section('content')



    <div class="row">

        <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
            {{Form::open(array('route'=>array('events-join-post',$event->id),'method'=>'POST'))}}
            <div class="form-group">
                {{Form::label('team','Select Team To register',array('class'=>'label-control'))}}
                <select class="form-control" name="team">
                    @foreach($teams as $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach()
                </select>
            </div>
            <div class="form-group">

                {{Form::submit('join Event',array('class'=>'btn btn-info'))}}
            </div>
        </div>
    </div>
    <!--  Form input -->

@stop


