@extends('layouts.app')
@section('content')
    <div class="block block1">
        <div class="container">
            <h2 class="text-info text-uppercase"><strong>Diner</strong></h2>
            <h5 class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Integer facilisis nisl augue, vel dapibus dui mollis non.
                Suspendisse id cursus tortor, euismod elementum tellus.
                Fusce aliquam viverra odio, eu pretium sem sollicitudin quis.
                Pellentesque in imperdiet felis, gravida efficitur mauris.
            </h5>
        </div>
    </div>
    <div class="block block2">
        <a name="meals"></a>
        <div class="container">
            <div class="row">
                <h4 class="text-center text-info"><strong>MEALS</strong></h4><hr>
            </div>
            @include('meals')
        </div>
    </div>
    <div class="block block3">
        <div class="container">
            <div class="row">
                <h4 class="text-center text-info"><strong>DRINKS</strong></h4><hr>
            </div>
            @include('drinks')
        </div>
    </div>
    <div class="block block4">
        <div class="loading-div" hidden><i class="fa fa-cog fa-3x fa-spin fa-fw loading"></i></div>
        <div class="fog" hidden></div>
        <div class="container">
            <div class="col-md-10 col-md-offset-1 ">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-res" hidden>
                        <p class="text-center"></p>
                    </div>
                    <div class="alert alert-success success-res" hidden>
                        <p class="text-center"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <h4 class="text-center text-info"><strong>BOOK A TABLE</strong></h4>
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