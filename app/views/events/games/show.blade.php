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

    <div class="row">

        @if($teams->pbteams->count())

            <table class="table table-responsive table-striped table-hover">
                <thead>
                <tr>
                    <th>Home Team</th>
                    <th>Score </th>
                    <th>Away Team</th>
                    <th>Score </th>
                </tr>
                </thead>
                <tbody>
                @foreach($games as $game)

                    <tr>

                        @foreach($event->pbteams as $team)

                            @if($game->team_1_id == $team->id)
                                <td> <h4>{{$team->name}}</h4> </td>@endif
                            @if($game->team_1_id == $team->id)
                                <td> <h4>{{$game->team_1_score}}</h4> </td>@endif

                            @if($game->team_2_id == $team->id)
                                <td> <h4>{{$team->name}}</h4> </td>@endif
                            @if($game->team_2_id == $team->id)
                                <td> <h4>{{$game->team_2_score}}</h4> </td>@endif
                        @endforeach()
                    </tr>

                @endforeach()

</tbody>
            </table>
        @endif

    </div>


    <!-- /. Of main content row -->

@stop

