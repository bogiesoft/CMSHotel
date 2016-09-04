@extends('layouts.app')
@section('content')
    <div class="block">
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="/activity-orders">Active reservations</a></li>
                        <li class="active">Options</li>
                        <!--  <li><a href="#">Finished</a></li> -->
                    </ol>
                </div>
                <div class="col-md-12">
                    <div class="list-group">
                        @if(!isset($_GET['page'])  || $_GET['page'] == 1)
                            <a href="/{{$reservation->id}}/meal-order" class="list-group-item" style="padding: 2em">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="/images/meals/img0.jpg" class="img-responsive img-circle">
                                    </div>
                                    <div class="col-md-10">
                                        <h4 class="list-group-item-heading">Food order</h4>
                                        <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                    </div>
                                </div>
                            </a>
                        @endif
                        @foreach($activities as $activity)
                            <a href="/activity-orders/{{$reservation->id}}/{{$activity->id}}" class="list-group-item" style="padding: 2em;">
                                @include('user.activity')
                            </a>
                        @endforeach
                    </div>
                    <div class="col-md-12 text-center center-block">
                        {{$activities->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection