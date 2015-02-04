@extends('layouts.admin')
@section('content')
@section('breadcrumb-header')  Albums @stop
@section('breadcrumb-small') Gallery @stop
@section('breadcrumb-link') {{link_to_route('home','Home')}} @stop
@section('breadcrumb-active') Albums @stop


<div class="row">
    <div class="col-md-4">
        <h2>New Album</h2>

        {{Form::open(array('route'=>'gallery-store','method'=>'POST','files'=>true))}}
        <div class="form-group">
            {{Form::label('album_name','Album name',array('class'=>'label-control'))}}
            {{Form::text('album_name',Input::old('album_name'),array('class'=>'form-control'))}}

            @if($errors->has('album_name'))
                {{$errors->first('album_name','<li class="text-danger">:message</li>')}}
            @endif
        </div>
        <div class="form-group">
            {{Form::label('album_description','Album description',array('class'=>'label-control'))}}
            {{Form::text('album_description',Input::old('album_description'),array('class'=>'form-control'))}}

            @if($errors->has('album_description'))
                {{$errors->first('album_description','<li class="text-danger">:message</li>')}}
            @endif

        </div>
        <div class="form-group">
            {{Form::label('album_date','Date',array('class'=>'label-control'))}}
            {{Form::input('date','album_date',Input::old('album_date'),array('class'=>'form-control'))}}

            @if($errors->has('album_date'))
                {{$errors->first('album_date','<li class="text-danger">:message</li>')}}
            @endif

        </div>

        <!-- Checkbox group -->
        <div class="form-group">
            {{Form::label('tags','Main tags',array('class'=>'label-control'))}}
            <br/>

            {{Form::checkbox('tags[]',$tags->id,true) .  $tags->tag}}
            <br/> <br/>

            {{Form::label('subtags','Select subtags',array('class'=>'label-control'))}}
            <br/>

            @foreach($subtags as $subtag)
                {{Form::checkbox('subtags[]',$subtag->id) .  $subtag->subtag}}
                <br/>
            @endforeach
        </div>

        <div class="form-group">
            {{Form::label('uploads','Select images (125.0 MB max), 100 files',array('class'=>'label-control'))}}
            </br>
            </br>
            {{Form::file('uploads[]',array('multiple'=>true))}}
            </br>
            <p>Individual files must be less than 7 MB</p>


        @if($errors->has('uploads'))
                {{$errors->first('uploads','<li class="text-danger">:message</li>')}}
            @endif

        </div>


        <div class="form-group">

            {{Form::submit('Create album',array('class'=>'btn btn-info'))}}
        </div>
        {{Form::close()}}

    </div>

    <div class="col-md-8">
        <h2>Albums</h2>

        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th>
                    Album Name
                </th>
                <th>
                    Album Date
                </th>
                <th class="text-center">
                    Album Images
                </th>
                <th class="text-center">
                    Show
                </th>

                <th class="text-center">
                    Update
                </th>
                <th class="text-center">
                    Delete
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($albums as $album)
                <tr>
                    <td>
                        {{$album->album_name}}
                    </td>
                    <td>
                        {{$album->album_date}}
                    </td>
                    <td class="text-center">
                        {{sizeof($album->galleries)}}
                    </td>
                    <td>
                        {{link_to_route('gallery-show','Show',$album->id,array('class' =>'btn btn-info'))}}
                    </td>
                    <td>
                        {{Form::open(array('method'=>'POST','route'=>array('gallery-update',$album->id)))}}
                        {{Form::submit('Update',array('class'=>'btn btn-warning'))}}
                        {{Form::close()}}
                    </td>
                    <td>
                        {{Form::open(array('method'=>'POST','route'=>array('gallery-destroy',$album->id)))}}
                        {{Form::submit('Delete',array('class'=>'btn btn-danger'))}}
                        {{Form::close()}}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 text-center">


                {{$albums->links()}}

            </div>
            <div class="col-lg-4"></div>


        </div>

    </div>
</div>

@stop