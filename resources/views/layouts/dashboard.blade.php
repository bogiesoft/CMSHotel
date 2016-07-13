<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/dashboard.css') }}" rel="stylesheet">
    @yield('header')
</head>
<body>
    <div class="container-fluid parent">
        <!-- HEADER ROW -->

            <div class="row">
                <div class="col-md-2  side-bar">
                    <div class="col-md-12">
                        <h4 class="text-center">CMSHOTEL</h4>
                        <img src="/images/users/avatars/{{\Auth::user()->img}}" class="img-responsive img-circle">
                        <h5 class="text-center">
                            {{  Auth::user()->name . ' ' . \Auth::user()->lastname}}
                            <small>{{\Auth::user()->email}}</small>
                        </h5>
                    </div>

                    <div class="list-group col-md-12">
                        <a class="list-group-item" href="/dashboard/rooms">
                            <i class="fa fa-bed" aria-hidden="true"></i>&nbsp;
                            Rooms
                        </a>
                        <a class="list-group-item" href="/dashboard/meals">
                            <i class="fa fa-apple" aria-hidden="true"></i>&nbsp;
                            Meals
                        </a>
                        <a class="list-group-item" href="/dashboard/drinks">
                            <i class="fa fa-glass" aria-hidden="true"></i>&nbsp;
                            Drinks
                        </a>
                        <a class="list-group-item" href="/dashboard/tables">
                            <i class="fa fa-table" aria-hidden="true"></i>&nbsp;
                            Tables
                        </a>
                        <a class="list-group-item" href="/" class="btn-link" target="_blank">
                            <i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;
                            Website
                        </a>
                    </div>

                </div>
                <div class="col-md-10">
                    <div class="row top-bar">
                        <a href="/dashboard" class="btn-link">
                        <h4 class="text-right"><small>{{\Auth::user()->role->role}}</small>Dashboard</h4>
                        </a>
                    </div>
                    <div class="row content-column">
                        @yield('content')
                    </div>
                </div>
            </div>


    </div>


    <!-- JavaScripts -->
    <script src="{{ URL::asset('js/jquery-1.12.3.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    @yield('footer')
</body>