@extends('layouts.admin')
@section('breadcrumb-header')  All Posts @stop
@section('breadcrumb-small') All Posts @stop
@section('breadcrumb-link') {{link_to_route('home','Home')}} @stop
@section('breadcrumb-active') All Posts @stop

@section('content')

<div class="row">
    <div class="col-md-6">

       {{link_to_route('posts-create','Add New Post!','',['class'=>'btn btn-info'])}}

    </div>

    <div class="col-md-6">
        <form class="navbar-form pull-right" role="search">
            <div class="form-group">
               <input class="form-control" type="search" name="search" placeholder="Search Post"/>
               <input class="form-control btn-info" type="submit" name="submit" value="Search"/>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        @if ($posts->count())

        <table class="table table-responsive table-striped table-hover">
            <thead>
                <th><a href="#">Title</a></th>
                <th><a href="#">Author</a></th>
                <th><a href="#">Created</a></th>
                <th><a href="#">Updated</a></th>
                <th>Show</th>
                <th>Edit</th>
                <th >Delete</th>
            </thead>
                <tbody>
                    @foreach($posts as $post)

                        <tr>
                            <td>{{$post->title}}</td>
                            <td>{{$post->user->username}}</td>
                            <td>{{$post->created_at->toDateString()}}</td>
                            <td>{{$post->updated_at->toDateString()}}</td>

                            <td>{{link_to_route('blog-post','Show',array($post->id),['class'=>'btn btn-primary'])}}</td>
                            <td>{{link_to_route('posts-edit','Edit',array($post->id),['class' =>'btn btn-info'])}}</td>
                            <td>
                                {{Form::open(array('method'=>'POST', 'route' => array('posts-destroy',$post->id ))) }}
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


        {{$posts->links()}}

    </div>
    <div class="col-lg-4"></div>


</div>
<!-- /.row -->
        @else
        <h2>There are no posts.</h2>
        @endif
@stop