@extends('layouts.event')
@section('breadcrumb-header')
    Events
@stop
@section('breadcrumb-small')
    Update event
@stop
@section('breadcrumb-link')
    {{link_to_route('events-index','Events')}}
@stop
@section('breadcrumb-active')
    Update event
@stop

@section('events-navigation')
    @include('layouts.templates.navs.nav_events_2')
@stop
@section('content')
    {{Form::model($event,array('method'=>'POST','route'=>array('events-update',$event->id)))}}

    <div class="row">

        <!-- Event Form input -->
        @if($errors->has())
            <div class="alert alert-danger">
                <ul>
                    {{$errors->first('event','<li>:message</li>')}}
                    {{$errors->first('date','<li>:message</li>')}}
                </ul>
            </div>
        @endif



        <div class="col-sm-6">
            <div class="form-group">
                {{Form::label('event','Event:',['class'=>'form-label']);}}
                {{Form::text('event',Input::old('event'),['class'=>'form-control'])}}

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {{Form::label('date','Event date:',['class'=>'form-label']);}}
                {{Form::input('date','date',Input::old('date'),['class'=>'form-control'])}}
            </div>
        </div>
    </div>
    {{Form::submit('update event',array('class'=>'btn btn-info'))}}

    {{Form::close()}}


    <div class="row"> <!-- Main content row -->
        <div class="col-xs-12">
            <table class="table table-responsive table-striped table-hover">
                <thead>
                <th>{{link_to('#','Events')}}</th>
                <th>{{link_to('#','Date')}}</th>
                <th>Delete</th>
                </thead>
                <tbody>
                    <tr>
                        <td> {{$event->event}}</td>
                        <td> {{$event->date}}</td>
                        {{Form::open(array('route'=>array('events-delete',$event->id),'method'=>'POST'))}}
                        <td>{{Form::submit('Delete',array('class'=>'btn btn-danger'))}}</td>
                        {{Form::close()}}
                    </tr>
                </tbody>
            </table>
        </div>
    </div> <!-- /. Of main content row -->
@stop
