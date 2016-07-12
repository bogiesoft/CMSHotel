<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
    <div class="navbar-header">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">CMS            <i class="fa fa-bed " aria-hidden="true"></i>otel
        </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
            <li><a href="{{ url('/about') }}">About</a></li>
            <li><a href="{{ url('/rooms') }}">Rooms</a></li>
            <li><a href="{{ url('/reserve') }}">Make a reservation</a></li>
            <li><a href="{{ url('/diner') }}">Diner</a></li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
            <li><a href="#" data-toggle="modal" data-target="#registerModal">Register</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <span style="margin-right: 15%"> {{ Auth::user()->name }} </span>
                    <img class="img-circle pull-right avatar-image" src="/images/users/avatars/{{Auth::user()->img}}" style="max-width:25px; max-height: 25px">
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>&nbsp; Profile</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>&nbsp; Logout</a></li>
                    @if(\Auth::user()->hasDashboard())
                        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-btn fa-dashboard"></i>&nbsp; Dashboard</a></li>
                    @endif

                </ul>
            </li>
        @endif
        </ul>
    </div>
</div>
</nav>

<div class="modal fade" tabindex="-1" role="dialog" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="">
                    @include('auth.login-form')
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="registerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="">
                    @include('auth.register-form')
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

