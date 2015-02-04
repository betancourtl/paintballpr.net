@extends('layouts.event')
@section('breadcrumb-header')
    Events
@stop
@section('breadcrumb-small')
    {{$event->name}}
@stop
@section('breadcrumb-link')
    {{link_to_route('events-index','Events')}}
@stop
@section('breadcrumb-active')
    {{$event->name}}
@stop

@section('events-navigation')
    @include('layouts.templates.navs.nav_events_2')
@stop
@section('content')


    <div class="row"> <!-- Main content row -->
        <div class="col-xs-12">
            <table class="table table-responsive table-striped table-hover">
                <thead>
                <th>{{link_to('#','Events')}}</th>
                <th>{{link_to('#','Date')}}</th>
                <th>{{link_to('#','Teams Registered')}}</th>
                <th>View</th>
                </thead>
                <tbody>
                <tr>

                    <td>{{$event->name}}</td>
                    <td>{{$event->date}}</td>
                    <td>{{link_to_route('home','Show',$event->id,array('class'=>'btn btn-info'))}}</td>


                </tr>
                </tbody>
            </table>
        </div>
    </div> <!-- /. Of main content row -->
@stop
