@extends('layouts.app')
@section('header')
    <style>
        .block{
            min-height: 100vh;
            height: auto;
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
            @include('auth.register-form')
        </div>
    </div>
</div>
@endsection
