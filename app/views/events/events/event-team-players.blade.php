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
                <th>{{link_to('#','Username')}}</th>
                <th>{{link_to('#','First Name')}}</th>
                <th>{{link_to('#','Last Name')}}</th>
                <th>{{link_to('#','Team')}}</th>
                <th>{{link_to('#','E-mail')}}</th>
                <th>{{link_to('#','Role')}}</th>

                </thead>
                <tbody>
                @if(count($players))

                    @foreach($players as $player )
                    <tr>

                        <td>{{$player->username}}</td>
                        <td>{{$player->first_name}}</td>
                        <td>{{$player->last_name}}</td>
                        <td>{{$player->name}}</td>
                        <td>{{$player->email}}</td>
                        <td>{{$player->pbrole}}</td>


                    </tr>
                @endforeach()
                @else
                    <h2>Team has no players</h2>
                @endif
                </tbody>
            </table>
        </div>
    </div> <!-- /. Of main content row -->
@stop









