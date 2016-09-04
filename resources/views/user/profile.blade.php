@extends('layouts.app')
@section('content')
<div class="block">
<div class="container">
        <ul class="nav nav-tabs tabs-div col-md-12">
            <li class="active">
                <a href="#reservations" data-toggle="tab">Room reservations</a>
            </li>
            <li>
                <a href="#table-reservations" data-toggle="tab">Table reservations</a>
            </li>
            <li>
                <a href="#account" data-toggle="tab">Account</a>
            </li>
        </ul>
        <div id="profileTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="reservations">
                @foreach($future_reservations as $reservation)
                    {{print_r($reservation)}}
                    <div id="receipt-popover{{$reservation->id}}" hidden>
                        @include('user.price-listing')
                    </div>
                    <div class="col-md-6">
                        @include('user.reservation')
                    </div>
                @endforeach
                @if(!$past_reservations->isEmpty())
                    <div class="col-md-12 hide-opacity bounceInLeft">
                        <h5>Past reservations: </h5><hr>
                    </div>
                @endif
                @foreach($past_reservations as $reservation)
                    <div class="col-md-6">
                        @include('user.reservation')
                    </div>
                @endforeach
            </div>
            <div class="tab-pane fade" id="table-reservations">
                @foreach($future_table_reservations as $reservation)
                    <div class="col-md-6">
                        @include('user.table-reservation')
                    </div>
                @endforeach
                @if(!$past_table_reservations->isEmpty())
                    <div class="col-md-12 hide-opacity bounceInLeft">
                        <h5>Past reservations: </h5><hr>
                    </div>
                @endif
                @foreach($past_table_reservations as $reservation)
                    <div class="col-md-6">
                        @include('user.table-reservation')
                    </div>
                @endforeach
            </div>
            <div class="tab-pane fade" id="account">
                <div class="col-md-12">
                    @include('user.account')
                </div>
            </div>

        </div>
</div>
</div>
@endsection
@section('footer')
    <script src="{{ URL::asset('js/profile.js') }}"></script>
@endsection