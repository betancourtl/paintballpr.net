@extends('layouts.admin')
@section('breadcrumb-header')  Banners @stop
@section('breadcrumb-small') Banners @stop
@section('breadcrumb-link') {{link_to_route('home','Home')}} @stop
@section('breadcrumb-active') Banners @stop
@section('content')


    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                {{link_to_route('banners-create','New Banner',null,array('class'=>'btn btn-success'))}}
            </div>

            <table class="table table-responsive table-striped table-hover">
                <thead>
                <th><a href="#">Name</a></th>
                <th><a href=""> Description</a></th>
                <th><a href="#">Date Begin</a></th>
                <th><a href="#">Date End</a></th>

                <th>Edit</th>
                <th>Delete</th>
                </thead>
                <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td>{{$banner->banner_name}}</td>
                        <td>{{$banner->banner_description}}</td>
                        <td>{{$banner->begin_date}}</td>
                        <td>{{$banner->end_date}}</td>
                        <td>
                            @if($banner->default_banner_image != 1)

                                {{link_to_route('banners-edit','Update',$banner->id,array('class'=>'btn btn-warning'))}}
                            @endif
                        </td>
                        <td>
                            @if($banner->default_banner_image != 1)

                                {{Form::open(array('method'=>'Post', 'route' => array('banners-destroy',$banner->id ))) }}
                                {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                                {{ Form::close() }}
                            @endif
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>


@stop