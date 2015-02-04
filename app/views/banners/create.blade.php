@extends('layouts.admin')
@section('breadcrumb-header')  Banners  @stop
@section('breadcrumb-small')  New @stop
@section('breadcrumb-link') {{link_to_route('home','Home')}} @stop
@section('breadcrumb-active') New Banner @stop
@section('content')


    <div class="row">
        <div class="col-lg-12">

            {{Form::open(array('route'=>'banners-store','method'=>'POST','files'=>true))}}

            <!-- Description Form input -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{Form::label('banner_description','Description:',['class'=>'form-label']);}}
                        {{Form::text('banner_description',Input::old('banner_description'),['class'=>'form-control'])}}
                        @if($errors->has('banner_description'))
                            {{$errors->first('banner_description','<li class="text-danger">:message</li>')}}
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{Form::label('begin_date','Begin date:',['class'=>'form-label']);}}
                        {{Form::input('date','begin_date',Input::old('begin_date'),array('class'=>'form-control'))}}
                        @if($errors->has('begin_date'))
                            {{$errors->first('begin_date','<li class="text-danger">:message</li>')}}
                        @endif

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{Form::label('end_date','End date:',['class'=>'form-label']);}}
                        <input type="date" name="end_date" class="form-control" value="{{Input::old('end_date')}}"/>
                        @if($errors->has('end_date'))
                            {{$errors->first('end_date','<li class="text-danger">:message</li>')}}
                        @endif

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{Form::label('file','Banner:',['class'=>'form-label']);}}
                        {{Form::file('uploads')}}
                        @if($errors->has('uploads'))
                            {{$errors->first('uploads','<li class="text-danger">:message</li>')}}
                        @endif

                        <p class="text-info">Image must be 1000px X 300px </p>

                    </div>
                </div>
            </div>
            {{Form::submit('submit',array('class'=>'btn btn-success'))}}



            {{Form::close()}}
        </div>
    </div>


@stop

