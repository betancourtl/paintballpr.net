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
            {{Form::open(array('route'=>'team-join-post', 'method' =>'POST'))}}
            <!-- Team Form input -->

            <div class="form-group">
                {{Form::label('team','Join ',['class'=>'form-label']);}}

                {{Form::text('team',Input::old('team'),array(
                 'class'=>'form-control',
                 'list'=>'users',
                 'autocomplete'=>'off'
                 ))}}
                <datalist id="users">
                    @foreach($teams as $team)
                        <option value="{{$team->name}}">{{$team->division}}
                    @endforeach
                </datalist>
            </div>

            <div class="form-group">
                {{Form::label('password','Password',array('class'=>'form-label'))}}
                {{Form::password('password',array('class'=>'form-control'))}}
            </div>

            <br/>
            {{form::submit('Join team',array('class'=>'btn btn-info'))}}
            {{Form::close()}}
        </div>

        <div class="col-md-6">
            <h2>Teams that you belong to</h2>
            <table class="table table-responsive table-striped table-hover">
                <thead>
                <tr>
                    <th>Team</th>
                    <th>Join on</th>
                    <th>division</th>
                    <th>Leave Team</th>
                </tr>
                </thead>

                <tbody>
                @foreach($players->pbteams as $team)
                    <tr>
                        <td>{{$team->name}}</td>
                        <td>12/12/12</td>
                        <td></td>

                        {{Form::open(array('route'=>array('team-destroy-post',$team->id),'method'=>'POST'))}}
                        <td>{{Form::submit('Leave',array('class'=>'btn btn-danger'))}}</td>
                        {{Form::close()}}
                    </tr>
                @endforeach()
                </tbody>
            </table>
        </div>

    </div>

@stop


