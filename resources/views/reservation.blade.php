@extends('layouts.app')
@section('header')
    <link href="{{ URL::asset('css/bootstrap-datepicker.standalone.min.css') }}" rel="stylesheet">
    <style>
        .block{
            min-height: 100vh;
            height: auto;
        }

        .block>.container{
            padding-top:15vh;
        }
    </style>
@endsection
@section('content')

    <div class="block">
        <div class="container">
            @if(Session::has('flash_message'))
                <div class="alert alert-danger">{{Session::get('flash_message')}}</div>
            @endif
            <form role="form" method="POST" action="/reservation">
                {{ csrf_field() }}
                <div class="col-sm-12 col-md-5 col-md-offset-1">

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" value="{{ Auth::user()->email }}" name="email">
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name" value="{{Auth::user()->name}}" name="name">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Enter your lastname" value="{{Auth::user()->lastname}}" name="lastname">
                    </div>

                    <div class="form-group">
                        <label>Choose dates </label>
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" name="arrival" />
                            <span class="input-group-addon">To</span>
                            <input type="text" class="input-sm form-control" name="departure" />
                        </div>
                    </div>

                </div>
                <div class="col-sm-12 col-md-5">
                    <div class="form-group">
                        <label>Select room: </label>
                        <select class="form-control" name="room">
                            @foreach($rooms as $room)
                                <option value="{{$room->id}}"
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
                        <select class="form-control" name="people">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Special requirements: </label>
                        <textarea class="form-control" name="req"></textarea>
                    </div>

                    <div class="form-group">
                        <label></label>
                        <button type="submit" class="form-control btn btn-info">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.input-daterange').datepicker({
            format: "dd-mm-yyyy",
            startDate: "Today",
            orientation: "bottom left",
            leftArrow: '<i class="fa fa-long-arrow-left"></i>',
            rightArrow: '<i class="fa fa-long-arrow-right"></i>',
            datesDisabled: ['today'],
            todayHighlight:"true"
        });
    </script>
@endsection
