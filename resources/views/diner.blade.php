@extends('layouts.app')
@section('content')
    <div class="loading-div" hidden><i class="fa fa-cog fa-3x fa-spin fa-fw loading"></i></div>
    <div class="fog" hidden></div>

        <div class="block block1">
            <div class="hide-opacity bounceInLeft container">
                <h2 class="text-info"><i>Sistema di gestione dei contenuti</i></h2>
                <h2 class="text-info text-uppercase"><strong>Restaurant</strong>
                    <small class="white-text">
                        Great food, greater service
                    </small>
                </h2>
            </div>
        </div>

    <div class="animateOnce block block2">
        <div class="container">
            <a name="meals"></a>
            <div class="row">
                <h4 class="text-center text-info"><strong>MEALS</strong></h4><hr>
            </div>
            @include('meals')
        </div>
    </div>
    <div class="animateOnce block block3">
        <div class="container">
            <div class="row">
                <h4 class="text-center text-info"><strong>DRINKS</strong></h4><hr>
            </div>
            @include('drinks')
        </div>
    </div>
    <div class="animateOnce block block4">
        <div class="container">

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

@endsection