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
        .fog{
            position: absolute;
            width: 100vw;
            height: 100vh;
            background-color: rgba(255,255,255,0.6);
            z-index: 90;
        }
        .loading{
            position: absolute;
            left:50vw;
            top:50vh;
            margin-left: -48px;
            margin-top:-56px;
            z-index: 100;
        }
    </style>
@endsection
@section('content')

    <div class="loading-div" hidden><i class="fa fa-cog fa-3x fa-spin fa-fw loading"></i></div>
    <div class="fog" hidden></div>

    <div class="block">
        <div class="container">
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-danger alert-res" hidden>
                        <p class="text-center"></p>
                    </div>
                </div>
            <form role="form" method="POST" action="/reservation" id="form-reservation">
                {{ csrf_field() }}
                <div class="col-sm-12 col-md-5 col-md-offset-1">

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" value="{{ Auth::user()->email }}" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name" value="{{Auth::user()->name}}" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Enter your lastname" value="{{Auth::user()->lastname}}" name="lastname" required>
                    </div>

                    <div class="form-group">
                        <label>Choose dates </label>
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" name="arrival"  required />
                            <span class="input-group-addon">To</span>
                            <input type="text" class="input-sm form-control" name="departure"  required />
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
                        <label>Price total (in euros): </label>
                        <p class="form-control-static">
                            <i class="fa fa-money"></i>
                            <span id="price">10</span>
                            €
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5 col-md-offset-6">
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-info submit-res" data-token="{{csrf_token()}}">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </button>
                    </div>
                </div>
            </form>

            <div id="reservation-info" hidden>

            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/ajax.js') }}"></script>
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

        rePopulatePeopleSelect();
        updatePrice();
        $('#rooms').on('change', function () {
            rePopulatePeopleSelect();
            updatePrice();
        });

        $('#people').on('change', function () {
            updatePrice();
        })

        function rePopulatePeopleSelect(){
            numPeople = $('#rooms option:selected').data('people');
            $('#people').find('option').remove();
            for (i = 1; i <= numPeople; i++) {
                $('#people').append($('<option>', {value:i, text:i}));
            }

        }

        function updatePrice(){
            numPeople = parseInt($('#people').val());
            price = parseInt($('#rooms option:selected').data('price'));
            total = price * numPeople;
            $('#price').text(total);
        }

    </script>
@endsection
