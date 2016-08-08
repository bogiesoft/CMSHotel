@extends('layouts.app')
@section('header')
    <style>
        .img-meals{
            max-width: 64px;
            max-height:64px;
        }

        .block{
            min-height: 100vh;
            height: auto;
        }

        .block.bg-image{
            background-image: url("/images/web/diner02.jpg");
            background-color: rgba(0,0,0, .5);
            background-size: cover;
            position: relative;
        }

        .container>.inner-container{
            padding-top: 25vh;
            text-align: center;
            font-size: 200%;
        }

        .block.white-bg{
            background-color: rgba(255,255,255, 1);
        }

        .block.off-white-bg{
            background-color: rgba(205, 205, 205, 0.15);
        }

        .white-bg>.container{
            padding-top: 15vh;
        }

        .off-white-bg>.container{
            padding-top: 15vh;
        }

        .pattern-bg>.container{
            padding-top: 15vh;
            font-size:150%;
        }
        .block.pattern-bg{
            background:#9e9e9e
            repeating-linear-gradient(
                    90deg, transparent, transparent 15px,
                    rgba(205, 205, 205, .2) 15px,
                    rgba(205, 205, 205, .2) 30px);
        }
        .form-div{
            background-color: rgba(205, 205, 205, 1);
            padding: 5vh;
        }
        .fog{
            position: absolute;
            width: 100%;
            height: 100vh;
            background-color: rgba(255,255,255,0.6);
            z-index: 90;
        }
        .loading{
            position: fixed;
            left:50%;
            top:50%;
            margin-left: -48px;
            margin-top:-56px;
            z-index: 100;
        }

        .meal-div{
            margin-bottom:1em;
        }

    </style>
@endsection
@section('content')
    <div class="block bg-image">
        <div class="container">
            <div class="inner-container">
                <h2 class="text-info text-uppercase">Diner</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Integer facilisis nisl augue, vel dapibus dui mollis non.
                    Suspendisse id cursus tortor, euismod elementum tellus.
                    Fusce aliquam viverra odio, eu pretium sem sollicitudin quis.
                    Pellentesque in imperdiet felis, gravida efficitur mauris.
                </p>
            </div>
        </div>
    </div>
    <div class="block white-bg">
        <div class="container">
            @include('meals')
        </div>
    </div>
    <div class="block off-white-bg">
        <div class="container">
            @include('drinks')
        </div>
    </div>
    <div class="block pattern-bg">
        <div class="loading-div" hidden><i class="fa fa-cog fa-3x fa-spin fa-fw loading"></i></div>
        <div class="fog" hidden></div>
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-danger alert-res" hidden>
                    <p class="text-center"></p>
                </div>
                <div class="alert alert-success success-res" hidden>
                    <p class="text-center"></p>
                </div>
            </div>
            @include('table-reservation')
        </div>
    </div>
@endsection

@section('footer')

    <script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/table-reservation.js') }}"></script>
    <script>

    </script>
@endsection