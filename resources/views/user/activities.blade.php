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
                        <li class="active">Activities</li>
                        <!--  <li><a href="#">Finished</a></li> -->
                    </ol>
                </div>
                @foreach($activities as $activity)
                    <div class="col-md-6">
                        @include('user.activity')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/activity-orders.js') }}"></script>
@endsection