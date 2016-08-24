@extends('layouts.app')
@section('content')
<div class="block bg-image2">
    <div class="container">
            <h2 class="text-center"><strong>Curabitur turpis sapien</strong></h2>
            <h5 class="white-text text-center">Maecenas blandit felis nec massa porta, sed laoreet nunc blandit.</h5>
            <form action="/rooms" method="get">
                <button class="btn btn-link center-block" type="submit" title="Browse rooms">
                    <i class="fa fa-angle-double-right fa-3x"></i>
                </button>
            </form>
    </div>
</div>
<div class="block">
    <div class="container">
        <h2 class="text-center" style="color: black;"><strong>Class aptent taciti sociosqu</strong></h2>
        <h5 class="text-center" style="color: black;">
            Proin a mi nisl. Quisque in sagittis est, nec bibendum tortor. Nulla facilisi. Nam varius condimentum erat id dapibus. Aenean in turpis libero. Donec consequat metus a ultrices mollis. Donec sit amet sagittis tellus, in vestibulum augue. Nunc porta pretium tristique. Mauris efficitur nisi vel ipsum sollicitudin, quis dictum ligula tempor. In sodales, elit ut posuere maximus,
            mi ligula varius neque, ac rutrum justo nisi quis enim.
            Vivamus eget tincidunt sem, quis tincidunt massa.
        </h5>
        <div class="row-fluid" style="padding-top:5vh">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="/images/rooms/{{$room->img}}" class="img-responsive img-rounded">
                    <div class="caption text-center">
                        <a href="/rooms">
                            <span class="label label-warning pull-right">from €{{$room->price}}</span>
                        </a>
                        <h3 class="text-center">{{$room->name}}
                        </h3>
                        <p class="equal-height">{{$room->text}}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="/images/meals/{{$meal->img}}" class="img-responsive img-rounded">
                    <div class="caption text-center">
                        <a href="/diner#meals">
                            <span class="label label-warning pull-right">from €{{$meal->price}}</span>
                        </a>
                        <h3 class="text-center">{{$meal->name}}</h3>
                        <p class="equal-height">{{$meal->text}}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="/images/activities/{{$activity->img}}" class="img-responsive img-rounded">
                    <div class="caption text-center">
                        <span class="label label-warning pull-right">from €{{$activity->price}}</span>
                        <h3>{{$activity->name}}</h3>
                        <p class="equal-height">{{$activity->text}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@endsection