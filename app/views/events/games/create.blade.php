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


            <div class="col-xs-3 col-lg-2">
                <button id="addGames" class="btn btn-info">Add Game</button>
            </div>
    </div>
    <br/>
    {{Form::open(array('route'=>array('games-store-post',$event->id),'method'=>'POST'))}}

    <div class="games-container">
        <div class="row">
            <div class="col-xs-2">
                <h3 class="text-info text-center ">Home Team</h3>
            </div>
            <div class="col-xs-2">
                <h3 class="text-info text-center ">Score</h3>
            </div>
            <div class="col-xs-1">
                <h3 class="text-info text-center">Vs</h3>
            </div>
            <div class="col-xs-2">
                <h3 class="text-info text-center">Away Team</h3>
            </div>
            <div class="col-xs-2">
                <h3 class="text-info text-center ">Score</h3>
            </div>

            <div class="col-xs-2">
                <h3 class="text-info text-center">Remove</h3>
            </div>
        </div>
        <br/>
        @if($games->count() )
                @foreach($games as $game)
            <div class="row game"> <!-- Main content row -->
                <div class="col-xs-2">

                    <div class="form-group">
                        <select name="homeGames[]" class="form-control">
                            @foreach($teams->pbteams as $team)

                                <option value="{{$team->id}}" @if($game->team_1_id == $team->id) {{'selected'}} @endif>{{$team->name}}</option>

                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-xs-2">

                    <!-- Score_team_1 Form input -->

                    <div class="form-group">
                        {{Form::text('team_1_score[]',$game->team_1_score,['class'=>'form-control'])}}
                    </div>

                </div>
                <div class="col-xs-1">
                    <h4 class="text-center text-capitalize ">Vs</h4>
                </div>


                <div class="col-xs-2">
                    <div class="form-group">
                        <select name="awayGames[]" class="form-control">
                            @foreach($teams->pbteams as $team)

                                <option value="{{$team->id}}" @if($game->team_2_id == $team->id) {{'selected'}} @endif>{{$team->name}}</option>

                            @endforeach


                        </select>
                    </div>
                </div>
                <div class="col-xs-2">

                    <!-- Score_team_1 Form input -->

                    <div class="form-group">
                        {{Form::text('team_2_score[]',$game->team_2_score,['class'=>'form-control'])}}
                    </div>

                </div>

                <div class="col-xs-2">

                    <button class="btn btn-danger btn-block remove">Delete</button>
                </div>

            </div>
            <!-- /. Of main content row -->
        @endforeach

        @else
            <div class="row game"> <!-- Main content row -->
                <div class="col-xs-4">

                    <div class="form-group">
                        <select name="homeGames[]" class="form-control">
                            @foreach($teams->pbteams as $team)

                                <option value="{{$team->id}}">{{$team->name}}</option>

                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-xs-2">
                    <h4 class="text-center text-capitalize ">Vs</h4>
                </div>


                <div class="col-xs-4">
                    <div class="form-group">
                        <select name="awayGames[]" class="form-control">
                            @foreach($teams->pbteams as $team)

                                <option value="{{$team->id}}" >{{$team->name}}</option>

                            @endforeach


                        </select>
                    </div>
                </div>
                <div class="col-xs-2">

                    <button class="btn btn-danger btn-block remove">Delete</button>
                </div>

            </div>
            <!-- /. Of main content row -->


        @endif


    </div> <!-- /. of games container -->
    <div class="row">
        <div class="col-xs-12">
            {{Form::submit('Submit',array('class'=>'btn btn-success'))}}
            {{Form::close()}}
        </div>
        @endif

    </div>
@stop
@section('javascript')

    <script>


        //show message of the ammount of elements in a page
        // count the .game divisions

        // Adds a new game
        $('#addGames').click(function () {
            $(".game").first().clone(true, true).appendTo(".games-container");

        });


        //removes selected game
        $(".remove").click(function (e) {

            // Get the number of classes that have the class .game
            var games = $('.game').length;

            // if the count of .games classes is only 1 then disable the remove function
            if (games > 1) {

                $(this).closest(".game").remove();

            }
            // prevents submit button from working
            e.preventDefault();
        });


    </script>

@stop
