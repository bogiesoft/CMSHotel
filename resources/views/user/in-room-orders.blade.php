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
                        <li class="active">Active reservations</li>
                    </ol>
                </div>
                @foreach($reservations as $reservation)
                    <div class="col-md-6">
                        <a href="/activity-orders/{{$reservation->id}}">
                            @include('user.reservation')
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection