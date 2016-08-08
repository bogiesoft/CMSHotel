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
            @foreach($activities as $activity)
            <div class="col-md-6">
                @include('user.activity')
            </div>
            @endforeach
        </div>
    </div>
@endsection