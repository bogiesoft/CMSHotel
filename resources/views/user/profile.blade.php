@extends('layouts.app')
@section('content')

<div class="block">
<div class="container">
    <div class="col-md-10 col-md-offset-1">
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
                @foreach($reservations as $reservation)
                    <div class="col-md-6">
                        @include('user.reservation')
                    </div>
                @endforeach
            </div>
            <div class="tab-pane fade" id="table-reservations">
                @foreach($table_reservations as $reservation)
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
</div>
@endsection
@section('footer')
    <script src="{{ URL::asset('js/profile.js') }}"></script>
@endsection