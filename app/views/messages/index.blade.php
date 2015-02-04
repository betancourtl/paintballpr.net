@extends('layouts.admin')
@section('breadcrumb-header')  Banners @stop
@section('breadcrumb-small') Banners @stop
@section('breadcrumb-link') {{link_to_route('home','Home')}} @stop
@section('breadcrumb-active') Banners @stop
@section('content')

    <div class="row">
        <div class="col-md-6">
            {{link_to_route('message-create','New Message',null,array('class'=>'btn btn-info'))}}
            @if($messages->count())
                <h2>Messages</h2>
            @endif
        </div>

        <div class="col-md-6">
            <form class="navbar-form pull-right" role="search">
                <div class="form-group">
                    <input class="form-control" type="search" name="search" placeholder="Search Message"/>
                    <input class="form-control btn-info" type="submit" name="submit" value="Search"/>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @if ($messages->count())

                <table class="table table-responsive table-striped table-hover">
                    <thead>
                    <th><a href="#">From</a></th>
                    <th><a href="#">Title</a></th>
                    <th><a href="#">Sent</a></th>

                    <th>Show</th>
                    <th >Delete</th>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)

                        <tr>
                            <td>{{Message::getUserFromId($message->user_from)->username}}</td>
                            <td>{{Str::limit($message->title,75)}}</td>
                            <td>{{$message->created_at->toDateString()}}</td>

                            <td>{{link_to_route('message-show','Show',array($message->id),['class'=>'btn btn-primary'])}}</td>
                            <td>
                                {{Form::open(array('method'=>'Post', 'route' => array('message-destroy',$message->id ))) }}
                                {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                                {{ Form::close() }}

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 text-center">


            {{$messages->links()}}

        </div>
        <div class="col-lg-4"></div>


    </div>
    <!-- /.row -->
    @else
        <h2>There are no Messages.</h2>
    @endif
@stop


