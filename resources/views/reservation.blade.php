@extends('layouts.app')
@section('content')

    <div class="loading-div" hidden><i class="fa fa-cog fa-3x fa-spin fa-fw loading"></i></div>
    <div class="fog" hidden></div>

    <div class="block">
        <div class="container reservation-container bounceInLeft">
            <div class="col-md-10 col-md-offset-1">
                <h4 class="text-center text-info"><strong>BOOK A ROOM</strong></h4>
            </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-danger alert-res" hidden>
                        <p class="text-center"></p>
                    </div>
                    <div class="alert alert-success success-res" hidden>
                        <p class="text-center"></p>
                    </div>
                </div>
            <form role="form" method="POST" action="/reservation" id="form-reservation">
                {{ csrf_field() }}
                <div class="col-sm-12 col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" value="@if(Auth::check()){{ Auth::user()->email }}@endif" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name" value="@if(Auth::check()){{ Auth::user()->name }}@endif" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Enter your lastname" value="@if(Auth::check()){{ Auth::user()->lastname }}@endif" name="lastname" required>
                    </div>

                    <div class="form-group">
                        <label>Choose dates </label>
                        <div class="input-group" id="dates">
                            <input type="text" class="span2 form-control" value="" id="arrival"name="arrival"  required >
                            <span class="input-group-addon">To</span>
                            <input type="text" class="span2 form-control" value="" id="departure" name="departure"  required >
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5">
                    <div class="form-group">
                        <label>Select room: </label>
                        <select class="form-control" name="room" id="rooms">
                            @foreach($rooms as $room)
                                <option value="{{$room->id}}" data-people="{{$room->max_people}}" data-price="{{$room->price}}"
                                @if(isset($_GET['selected_room']))
                                    @if($_GET['selected_room'] == $room->id)
                                        {{ ' selected' }}
                                            @endif
                                        @endif>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>People: </label>
                        <select class="form-control" name="people" id="people">
                            <option value="1" selected>1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Special requirements: </label>
                        <textarea class="form-control" name="req"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Price total: </label>
                        <p class="form-control-static">
                            <i class="fa fa-money"></i>
                            @if($rooms->isEmpty())
                                <span>€0</span>
                            @else
                                €<span id="price">10</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5 col-md-offset-6">
                    <div class="form-group">
                        @if(Auth::check())
                            @if($rooms->isEmpty())
                                <p class="text-center">No rooms yet, please come back later</p>
                            @else
                                <button type="submit" class="form-control btn btn-info submit-res" data-token="{{csrf_token()}}">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </button>
                            @endif
                        @else
                            <a href="{{url('/login')}}" class="btn btn-link btn-block">
                                <span class="glyphicon glyphicon-log-in"></span>
                                Login to book a room
                            </a>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('footer')
    <script src="{{ URL::asset('js/new-datepicker.js') }}"></script>
    <script src="{{ URL::asset('js/reservation.js') }}"></script>
@endsection
