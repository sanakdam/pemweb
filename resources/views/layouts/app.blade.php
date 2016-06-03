<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ url('src/css/bootstrap.min.css') }}" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="{{ url('src/css/bootstrap-theme.min.css') }}" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ url('src/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('src/css/prettyPhoto.css') }}">

    <style>
        body {
            background-color: #EAEAEA;
        }
        .container .row {
            margin-top:100px;
        }
    </style>
</head>
<body>
@include('includes.header')
<div class="container">
    <div class="row">
        <div class="panel panel-default col-xs-6 col-xs-offset-3">
            @yield('content')
        </div>
    </div>
</div>

<script   src="{{ URL::to('src/jquery-2.2.3.min.js') }}"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>

<script   src="{{ URL::to('src/jquery-migrate-1.4.0.min.js') }}"   integrity="sha256-nxdiQ4FdTm28eUNNQIJz5JodTMCF5/l32g5LwfUwZUo="   crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="{{ URL::to('src/js/bootstrap.min.js') }}" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ URL::to('src/js/app.js') }}"></script>

<!-- PRETTYPHOTO  SCRIPTS  LIBRARY-->
<script src="{{ URL::to('src/jquery.prettyPhoto.js') }}"></script>

@yield('footer')

</body>
</html>
