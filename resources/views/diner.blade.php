@extends('layouts.app')
@section('header')
    <link href="{{ URL::asset('css/bootstrap-datepicker.standalone.min.css') }}" rel="stylesheet"
          xmlns="http://www.w3.org/1999/html">
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

        .block>.container{
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
            color: white;
            font-size:150%;
        }
        .block.pattern-bg{
            background-color:#9e9e9e;
            background-image:
                    repeating-linear-gradient(45deg, transparent, transparent 15px,
                    rgba(205, 205, 205, .6) 15px,
                    rgba(205, 205, 205, .6) 30px);
        }
        .pattern-bg>.container>h2{
            color:white;
        }

        .form-div{
            background-color: #bca7cf;
            padding: 5vh;
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
        <div class="container">
            @include('table-reservation')
        </div>
    </div>
@endsection

@section('footer')

    <script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.date').datepicker({
            format: "yyyy-mm-dd",
            startDate: "Today",
        });
    </script>
@endsection