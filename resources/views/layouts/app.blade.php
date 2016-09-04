<!DOCTYPE html>
<html lang="en">
<head>
    <?php   $title=  \App\Config::where('config', '=', 'hotel_name')->first()->value;   ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title}}</title>

    <!-- Styles -->
    <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-datepicker.standalone.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/animations.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/54cb56152d.js"></script>
    @yield('header')
</head>
<body id="app-layout">
    @include('nav')

    @yield('content')


    <!-- JavaScripts -->
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="{{ URL::asset('js/jquery-1.12.3.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/js.js') }}"></script>
    @yield('footer')

</body>
</html>
