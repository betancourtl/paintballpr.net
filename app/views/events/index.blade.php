@extends('layouts.event')
@section('breadcrumb-header')
    Events
@stop
@section('breadcrumb-small')
    view
@stop
@section('breadcrumb-link')
    {{link_to('events','Events')}}
@stop
@section('breadcrumb-active')
    Events
@stop

@section('content')
    <p class="text-info"> **To join an event you must be registered as a player and be part of a team</p>


    <div class="row"> <!-- Main content row -->
        <div class="col-xs-12">
            <table class="table table-responsive table-striped table-hover">
                <thead>
                <th>{{link_to('#','Events')}}</th>
                <th>{{link_to('#','Date')}}</th>
                <th class="text-center">{{link_to('#','Teams')}}</th>
                <th>Games</th>
                <th>Join Event</th>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>

                        <td>{{$event->event}}</td>
                        <td>{{$event->date}}</td>
                        <td>
                            <p class="text-center">
                                {{count($event->pbteams)}}<br/>
                            </p>
                        </td>
                        <td>{{link_to_route('games-show','Games',$event->id,array('class'=>'btn btn-info'))}}</td>

                        <!-- if the event status is closed then show closed -->
                        @if($event->status == 0)
                            <td>{{link_to_route('events-join','Join Event',$event->id,array('class'=>'btn btn-success'))}}</td>
                        @endif()

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div> <!-- /. Of main content row -->
@stop
