@extends('layouts.dashboard')
@section('content')

@include('modals.rooms.add-room-modal')
<?php $active = 'rooms';  ?>
<div class="col-md-12">
    <a href="/dashboard/rooms/reservations" class="btn btn-default pull-right" style="margin-bottom: 1em">
        <i class="fa fa-btn fa-angle-right fa-fw"></i>&nbsp; Room reservations
    </a>
</div>
<div class="col-sm-12 col-md-12" style="background-color: lightgrey">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-bed"></i> &nbsp
                Rooms

                <div class="dropdown pull-right">
                    <a class="btn btn-xs btn-info"
                       data-toggle="modal"
                       data-target="#addRoomModal">
                        <i class="fa fa-plus"></i>&nbsp; add
                    </a>

                    <button class="btn btn-xs btn-info pull-right dropdown-toggle" id="dropdownSort" data-toggle="dropdown"aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-caret-down"></i>
                        <i class="fa fa-caret-filter"></i>&nbsp; sort
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownSort">
                        <li>
                            <a href="{{url('/dashboard/rooms/name/' . $order)}}"> &nbsp;
                                <i class="fa fa-sort-alpha-{{$order}} fa-fw"></i> &nbsp;
                                Room
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/dashboard/rooms/max_people/' . $order)}}"> &nbsp;
                                <i class="fa fa-sort-amount-{{$order}} fa-fw"></i> &nbsp;
                                People
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/dashboard/rooms/price/' . $order)}}"> &nbsp;
                                <i class="fa fa-sort-numeric-{{$order}} fa-fw"></i> &nbsp;
                                Price
                            </a>
                        </li>
                    </ul>
                </div>
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive">
                    <thead>
                    <th class="hidden-xs hidden-sm"></th>
                    <th>Room</th>
                    <th>Max people</th>
                    <th>Price</th>
                    <th>Average Rating</th>
                    <th>Options</th>
                    </thead>

                    @foreach($rooms as $room)
                        <tr id="room{{$room->id}}" @if($room->trashed())    class="text-muted" title="This room is not available for reservations"    @endif>
                            <td class="hidden-xs hidden-sm" style="width: 5%;"><img src="/images/rooms/{{$room->img}}" class="img-circle" style="width: 100%"> </td>
                            <td>{{$room->name}}</td>
                            <td>{{$room->max_people}}</td>
                            <td>€{{$room->price}}</td>
                            <td>{{$room->getRating()}}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#showRoomModal{{$room->id}}">
                                    <i class="fa fa-eye" aria-hidden="false" aria-label="show"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#editRoomModal{{$room->id}}">
                                    <i class="fa fa-pencil-square-o" aria-hidden="false" aria-label="edit"></i>
                                </a>
                                @if($room->trashed())
                                    <button type="submit" class="btn btn-sm btn-info restore-room" data-token="{{csrf_token()}}" value="{{$room->id}}" title="Make room available for reservation">
                                        <i class="fa fa-cart-plus" aria-hidden="false"></i>&nbsp;
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-info delete-room" data-token="{{csrf_token()}}" value="{{$room->id}}">
                                        <i class="fa fa-trash" aria-hidden="false" aria-label="delete"></i>&nbsp;
                                    </button>
                                @endif

                            </td>
                        </tr>
                        @include('modals.rooms.show-room-modal')
                        @include('modals.rooms.edit-room-modal')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<!-- most popular room   -->
<div class="col-sm-12 col-md-6">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-fire" aria-hidden="true"></i> &nbsp;
                Most popular room
            </h5>
        </div>
        <div class="panel-body">
            @if($most_popular_room)
                <table class="table">
                    <tr class="row text-center">
                        <td class="col-sm-4 col-md-6 center-block" style="border:none">
                            <img src="/images/rooms/{{$most_popular_room->img}}" class="img-responsive img-circle">
                        </td>
                        <td class="col-sm-8 col-md-6 h3" style="border:none">{{$most_popular_room->name}}<br>
                            <small>
                                Booked {{$most_popular_room->counter}} times <br>
                                Rating {{$most_popular_room->getRating()}}
                            </small>
                        </td>
                    </tr>
                </table>
            @else
                <h5 class="text-center">No rooms yet</h5>
            @endif

        </div>
    </div>
</div>
<!-- income by room -->
<div class="col-sm-12 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-money" aria-hidden="true"></i> &nbsp;
                Income
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <th>Name</th>
                    <th>Income from room reservation</th>
                    <th>Total income (including room services)</th>
                    <th>Number of bookings</th>
                    </thead>
                    @foreach($rooms as $room)
                        <tr id="room-income{{$room->id}}" @if($room->trashed())    class="text-muted" title="This room is not available for reservations"    @endif>
                            <td>{{$room->name}}</td>
                            <td>€{{$room->getRoomIncome()}}</td>
                            <td>€{{$room->getTotalRoomIncome()}}</td>
                            <td>{{$room->counter}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection