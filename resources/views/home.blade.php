@extends('layouts.app')
@section('content')
<div class="block bg-image2 fadeIn">
    <div class="container text-center">
            <h1 class="text-center text-uppercase"><strong>Cms Hotel</strong></h1>
            <h5 class="white-text text-center">The art of meeting your highest expectations.</h5>
            <a href="{{url('/rooms')}}" class="btn btn-link" type="submit" title="Browse rooms">
                <i class="fa fa-angle-double-right fa-3x"></i>
            </a>
    </div>
</div>
<div class="block">
    <div class="container">
        <h2 class="text-center" style="color: black;"><strong>Stay with us, and feel like home</strong></h2>
        <h5 class="text-center" style="color: black; margin-bottom: 10vh">
            When it comes to luxury in the most romantic and stylish city in the world,
            look no further than the legendary Hotel CMS. Situated in the heart of Content City,
            on the renowned avenue Management, this 4 star hotel is in the ideal location for the finest
            content managing that Content has to offer
        </h5>
        <div class="row" style="padding-top: 5vh">
            @if($room)
                <a href="{{url('/rooms')}}">
                    <div class="col-xs-6 col-sm-4 col-md-4 text-center">
                        <div class="popular">
                            <img src="/images/rooms/{{$room->img}}" class="img-responsive img-circle center-block">
                            <h6><strong>Check out our rooms</strong></h6>
                        </div>
                    </div>
                </a>
            @endif
            @if($activity)
                <a href="{{url('/activities')}}">
                    <div class="col-xs-6 col-sm-4 col-md-4 text-center">
                        <div class="popular">
                            <img src="/images/activities/{{$activity->img}}" class="img-responsive img-circle center-block">
                            <h6><strong>Check out our hotel activities</strong></h6>
                        </div>
                    </div>
                </a>
            @endif
            @if($meal)
                <a href="{{url('/restaurant')}}">
                    <div class="col-xs-offset-3 col-xs-6 col-sm-offset-0 col-sm-4 col-md-4 text-center">
                        <div class="popular">
                            <img src="/images/meals/{{$meal->img}}" class="img-responsive img-circle center-block">
                            <h6><strong>Check out our restaurant</strong></h6>
                        </div>
                    </div>
                </a>
            @endif
        </div>
    </div>
</div>

@endsection
@section('footer')
@endsection