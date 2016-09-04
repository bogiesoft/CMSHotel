<nav class="navbar navbar-inverse navbar-fixed-top text-uppercase">
<div class="container-fluid">
    <div class="navbar-header">
        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand text-center" href="{{ url('/') }}">
            <span class="text-uppercase">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            <br>
            {{$title}}</span>
        </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
            <li><a href="{{ url('/rooms') }}">Rooms</a></li>
            <li><a href="{{url('/reservation')}}">Make a reservation</a></li>
            <li><a href="{{ url('/activities') }}">Hotel activities</a></li>
            <li><a href="{{ url('/restaurant') }}">Restaurant</a></li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{url('/login')}}" >Login</a></li>
            <li><a href="{{url('/register')}}" >Register</a></li>
        @else
            <li class="dropdown text-capitalize">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <p class="pull-left">
                        <span class="nav-account account-name"> {{ Auth::user()->name }} </span>
                    </p>
                    <img class="img-circle avatar-image" src="/images/users/avatars/{{Auth::user()->img}}" style="max-width:25px; max-height: 25px">
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>&nbsp; Profile</a></li>
                    <li class="@if(!Auth::user()->hasActiveReservation())  disabled" title="You have no active reservations @endif">
                        <a href="{{ url('/activity-orders') }}"><i class="fa fa-btn fa-shopping-cart"></i>&nbsp; Room service</a>
                    </li>
                    @if(\Auth::user()->hasDashboard())
                    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-btn fa-dashboard"></i>&nbsp; Dashboard</a></li>
                    @endif
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>&nbsp; Logout</a></li>
                </ul>
            </li>
        @endif
        </ul>
    </div>
</div>
</nav>


