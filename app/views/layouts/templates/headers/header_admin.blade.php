<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Paintballpr.net website has information about:, paintball fields paintball stores paintball news paintball pictures paintball videos">
    <meta name="keywords" content="Paintball Puerto Rico Hyperball Speedball field store news CPF">
    <meta name="author" content="Luis Betancourt">


    <title>@yield('title') | Paintballpr.net</title>

    <!-- icon -->
    {{HTML::style('images/favicon/icon.png',array('type'=>'image/png','rel'=>'icon'))}}

    <!-- Bootstrap Core CSS -->
    {{HTML::style('bower_components/bootstrap/dist/css/bootstrap.min.css')}}

    <!-- Layout CSS -->
    {{HTML::style('simple-sidebar/css/simple-sidebar.css')}}

    <!-- Custom CSS -->
    {{HTML::style('my_css/style.css')}}

    <!-- Custom Fonts -->
    {{HTML::style('modern_businness_layout/font-awesome-4.1.0/css/font-awesome.min.css')}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('script')
</head>

