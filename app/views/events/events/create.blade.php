@extends('layouts.event')
@section('breadcrumb-header')
    Events
@stop
@section('breadcrumb-small')
    Create event
@stop
@section('breadcrumb-link')
    {{link_to_route('events-index','Events')}}
@stop
@section('breadcrumb-active')
    Create event
@stop


@section('content')
    {{Form::open(array('route'=>'events-store','method'=>'POST'))}}

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
                <input type="date" name="date" class="form-control" value="{{Input::old('date')}}"/>
            </div>
        </div>
    </div>
    {{Form::submit('create-event',array('class'=>'btn btn-info'))}}

    {{Form::close()}}


    <div class="row"> <!-- Main content row -->
        <div class="col-xs-12">
            <table class="table table-responsive table-striped table-hover">
                <thead>
                <th>{{link_to('#','Events')}}</th>
                <th>{{link_to('#','Date')}}</th>
                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td> {{$event->event}}</td>
                        <td> {{$event->date}}</td>
                        <td>{{link_to_route('events-edit','Update',$event->id,array('class'=>'btn btn-warning'))}}</td>
                        {{Form::open(array('route'=>array('events-delete',$event->id),'method'=>'POST'))}}
                        <td>{{Form::submit('Delete',array('class'=>'btn btn-danger'))}}</td>
                        {{Form::close()}}

                        @if($event->status == 0)
                        {{Form::open(array('route'=>array('events-status',$event->id),'method'=>'POST'))}}
                        <td>{{Form::submit('Event Open',array('class'=>'btn btn-success'))}}</td>
                        {{Form::close()}}
                            @else
                            {{Form::open(array('route'=>array('events-status',$event->id),'method'=>'POST'))}}
                            <td>{{Form::submit('Event Closed',array('class'=>'btn btn-info'))}}</td>
                            {{Form::close()}}


                        @endif()
                    </tr>
                @endforeach()
                </tbody>
            </table>
        </div>
    </div> <!-- /. Of main content row -->
@stop
