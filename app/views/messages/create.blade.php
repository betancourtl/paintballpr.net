@extends('layouts.admin')
@section('breadcrumb-header')  Banners @stop
@section('breadcrumb-small') Banners @stop
@section('breadcrumb-link') {{link_to_route('home','Home')}} @stop
@section('breadcrumb-active') Banners @stop
@section('script')
    {{HTML::script("ckeditor/ckeditor.js")}}
@stop

@section('dashboardPage')
    Create Messsage

@stop
@section('content')

    @if($errors->has())
        <div class="alert alert-danger">
            <ul>
                {{$errors->first('title','<li>:message</li>')}}
                {{$errors->first('message','<li>:message</li>')}}
                {{$errors->first('username','<li>:message</li>')}}
            </ul>
        </div>
    @endif


    {{Form::open(array('route'=>'message-store','method'=>'POST'))}}

    <!-- User_to Form input -->

    <div class="form-group">
        {{Form::label('username','To: ',['class'=>'form-label']);}}

        {{Form::text('username',Input::old('username'),array(
         'class'=>'form-control beta-quarter-width',
         'list'=>'users',
         'autocomplete'=>'off'
         ))}}
        <datalist id="users">
            @foreach($users as $user)
                <option value="{{$user->username}}">
            @endforeach
        </datalist>
    </div>

    <div class="form-group">
        {{Form::label('title','Title: ')}}
        {{Form::text('title',Input::old('title'),array('class'=>'form-control'))}}
    </div>

    <div class="form-group">
        {{Form::label('message','Message: ',array('class'=>'control-label'))}}
        {{Form::textarea('message',Input::old('message'),array('class'=>'form-control CKEditor'))}}
    </div>

    <div class="form-group">
        {{Form::submit('Send Message',array('class'=>'btn btn-info beta-class-btn'))}}
    </div>

    {{Form::close()}}

@stop
@section('javascript')
    <script>
        CKEDITOR.replace('message');
    </script>

    <script>
        //Disable update button once pressed

        $('#beta-form-btn').click(function () {
            $('#beta-form-btn').click(function (e) {
                e.preventDefault()
            });
        });
    </script>

@stop

