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

@section('events-navigation')
    @include('layouts.templates.navs.nav_events_2')
@stop
@section('content')


    <div class="row"> <!-- Main content row -->
        <div class="col-xs-12">
            <table class="table table-responsive table-striped table-hover">
                <thead>
                <th>{{link_to('#','Teams')}}</th>
                <th>{{link_to('#','Registered')}}</th>
                <th>View players</th>
                </thead>
                <tbody>
                    @foreach($event->pbteams as $team)
                <tr>

                    <td>{{$team->name}}</td>
                    <td>No</td>
                    <td>{{link_to_route('events-team-players','Show',array($team->id,$event->id),array('class'=>'btn btn-info'))}}</td>


                </tr>
                        @endforeach()
                </tbody>
            </table>
        </div>
    </div> <!-- /. Of main content row -->
@stop
