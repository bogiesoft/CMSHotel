@extends('layouts.app')
@section('header')
    <style>
        .block{
            min-height: 100vh;
            height:100%;
        }

        .block>.container{
            padding-top: 15vh;
        }
    </style>
@endsection
@section('content')
    <div class="block">
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="/activity-orders">Active reservations</a></li>
                        <li><a href="/activity-orders/{{$reservation->id}}">Activities</a></li>
                        <li class="active">Order details</li>
                    </ol>
                </div>
                <div class="col-md-12 text-center">
                    <h5>Order for room: {{$reservation->room->name}}</h5>
                    <h5>For: {{$reservation->name}}</h5>
                    <h5>What: {{$activity->name}}</h5>
                    <h5>When: {{$date}}</h5>
                    <h5>Duration: {{$activity->duration}}</h5>
                </div>
            </div>
        </div>
    </div>
@endsection